<?php

namespace App\Http\Controllers;

#region

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Inertia\Response;
use Narsil\Contracts\Resources\FooterResource;
use Narsil\Contracts\Resources\HeaderResource;
use Narsil\Contracts\Resources\SitePageResource;
use Narsil\Models\Sites\Site;
use Narsil\Models\Sites\SitePage;
use Narsil\Services\PageService;

#endregion

class PageController extends Controller
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request): Response
    {
        $sitePage = PageService::resolvePage($request);

        $header = $this->getHeader($sitePage);
        $footer = $this->getFooter($sitePage);
        $page = $this->getPage($sitePage);
        $session = $this->getSession($sitePage);

        return Inertia::render('frontend/index', [
            'footer' => $footer,
            'header' => $header,
            'page' => $page,
            'session' => $session,
        ]);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param SitePage $sitePage
     *
     * @return HeaderResource
     */
    private function getHeader(SitePage $sitePage): HeaderResource
    {
        return app(HeaderResource::class, [
            'resource' => $sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_HEADER},
        ]);
    }

    /**
     * @param SitePage $sitePage
     *
     * @return FooterResource
     */
    private function getFooter(SitePage $sitePage): FooterResource
    {
        return app(FooterResource::class, [
            'resource' => $sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_FOOTER},
        ]);
    }

    /**
     * @param SitePage $sitePage
     *
     * @return SitePageResource
     */
    private function getPage(SitePage $sitePage): SitePageResource
    {
        return app(SitePageResource::class, [
            'resource' => $sitePage,
        ]);
    }

    /**
     * @param SitePage $sitePage
     *
     * @return SitePageResource
     */
    private function getSession(SitePage $sitePage): array
    {
        return [
            'locale' => App::getLocale(),
        ];
    }

    #endregion
}
