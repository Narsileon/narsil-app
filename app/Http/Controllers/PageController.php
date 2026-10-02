<?php

declare(strict_types=1);

namespace App\Http\Controllers;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Narsil;
use Narsil\Cms\Http\Resources\Frontend\FooterResource;
use Narsil\Cms\Http\Resources\Frontend\HeaderResource;
use Narsil\Cms\Http\Resources\Frontend\NavigationResource;
use Narsil\Cms\Http\Resources\Frontend\SitePageResource;
use Narsil\Cms\Models\Sites\Site;
use Narsil\Cms\Models\Sites\SitePage;
use Narsil\Cms\Services\PageService;
use Narsil\Cms\Services\RedirectService;
use Narsil\Cms\Support\Tree;

#endregion

class PageController extends Controller
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse|View
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $redirect = app(RedirectService::class)->resolve($request);

        if ($redirect)
        {
            return $redirect;
        }

        $sitePage = PageService::resolvePage($request, $this->getPreviewLocale($request));

        $data = [
            'editorMode' => $request->boolean('_editor'),
            'footer' => $this->footer($sitePage, $request),
            'header' => $this->header($sitePage, $request),
            'navigation' => $this->navigationMenu($sitePage, $request),
            'page' => $this->page($sitePage, $request),
            'session' => $this->session(),
        ];

        return view('pages.index', $data);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param SitePage $sitePage
     * @param Request $request
     *
     * @return array
     */
    private function footer(SitePage $sitePage, Request $request): array
    {
        return new FooterResource($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_FOOTER})
            ->toArray($request);
    }

    /**
     * @param Request $request
     *
     * @return string|null
     */
    private function getPreviewLocale(Request $request): ?string
    {
        $language = $request->query('_preview_language');
        $locale = null;

        if (is_string($language) && in_array($language, app(Narsil::class)->getLocales(), true))
        {
            $locale = $language;
        }

        return $locale;
    }

    /**
     * @param SitePage $sitePage
     * @param Request $request
     *
     * @return array
     */
    private function header(SitePage $sitePage, Request $request): array
    {
        return new HeaderResource(null)
            ->toArray($request);
    }

    /**
     * @param SitePage $sitePage
     * @param Request $request
     *
     * @return array
     */
    private function navigationMenu(SitePage $sitePage, Request $request): array
    {
        $pages = ($sitePage->{SitePage::RELATION_SITE})->{Site::RELATION_PAGES};

        $tree = new Tree($pages->where(SitePage::SHOW_IN_MENU, true))
            ->getNestedTree();

        return $tree->map(function (SitePage $sitePage) use ($request): array
        {
            return new NavigationResource($sitePage)
                ->toArray($request);
        })->all();
    }

    /**
     * @param SitePage $sitePage
     * @param Request $request
     *
     * @return array
     */
    private function page(SitePage $sitePage, Request $request): array
    {
        return new SitePageResource($sitePage)
            ->toArray($request);
    }

    /**
     * @return array<string,string>
     */
    private function session(): array
    {
        return [
            'locale' => app()->getLocale(),
            'url' => config('app.url'),
        ];
    }

    #endregion
}
