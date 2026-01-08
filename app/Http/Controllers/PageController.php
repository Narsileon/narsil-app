<?php

namespace App\Http\Controllers;

#region

use App\Http\Controllers\Controller;
use App\Http\Data\FooterData;
use App\Http\Data\HeaderData;
use App\Http\Data\NavigationMenuItemData;
use App\Http\Data\SitePageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Inertia\Response;
use Narsil\Models\Sites\Site;
use Narsil\Models\Sites\SitePage;
use Narsil\Services\PageService;
use Narsil\Support\TranslationsBag;
use Narsil\Support\Tree;

#endregion

class PageController extends Controller
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $sitePage = PageService::resolvePage($request);

        $header = $this->header($sitePage);
        $footer = $this->footer($sitePage);
        $navigationMenu = $this->navigationMenu($sitePage);
        $page = $this->page($sitePage);
        $session = $this->session($sitePage);

        $translations = app(TranslationsBag::class)->get();

        return Inertia::render('frontend/index', [
            'footer' => $footer,
            'header' => $header,
            'navigation_menu' => $navigationMenu,
            'page' => $page,
            'session' => $session,
            'translations' => $translations,
        ]);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Get the footer data.
     *
     * @param SitePage $sitePage
     *
     * @return FooterData
     */
    private function footer(SitePage $sitePage): FooterData
    {
        return FooterData::from($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_FOOTER});
    }

    /**
     * Get the header data.
     *
     * @param SitePage $sitePage
     *
     * @return HeaderData
     */
    private function header(SitePage $sitePage): HeaderData
    {
        return HeaderData::from($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_HEADER});
    }

    /**
     * Get the navigation menu data.
     *
     * @param SitePage $sitePage
     *
     * @return array
     */
    private function navigationMenu(SitePage $sitePage): array
    {
        $tree = new Tree($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_PAGES}->where(SitePage::SHOW_IN_MENU, '=', true))
            ->getNestedTree();

        return $tree->map(function ($page)
        {
            return NavigationMenuItemData::from($page);
        })->toArray();
    }

    /**
     * Get the page data.
     *
     * @param SitePage $sitePage
     *
     * @return SitePageData
     */
    private function page(SitePage $sitePage): SitePageData
    {
        return SitePageData::from($sitePage);
    }

    /**
     * Get the session data.
     *
     * @param SitePage $sitePage
     *
     * @return array
     */
    private function session(SitePage $sitePage): array
    {
        return [
            'locale' => App::getLocale(),
        ];
    }

    #endregion
}
