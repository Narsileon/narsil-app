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
use Narsil\Support\Tree;

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
        $navigationMenu = $this->getNavigationMenu($sitePage);
        $page = $this->getPage($sitePage);
        $session = $this->getSession($sitePage);

        return Inertia::render('frontend/index', [
            'footer' => $footer,
            'header' => $header,
            'navigation_menu' => $navigationMenu,
            'page' => $page,
            'session' => $session,
        ]);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param SitePage $sitePage
     *
     * @return HeaderData
     */
    private function getHeader(SitePage $sitePage): HeaderData
    {
        return HeaderData::from($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_HEADER});
    }

    /**
     * @param SitePage $sitePage
     *
     * @return FooterData
     */
    private function getFooter(SitePage $sitePage): FooterData
    {
        return FooterData::from($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_FOOTER});
    }

    /**
     * @param SitePage $sitePage
     *
     * @return array
     */
    private function getNavigationMenu(SitePage $sitePage): array
    {
        $tree = new Tree($sitePage->{SitePage::RELATION_SITE}->{Site::RELATION_PAGES}->where(SitePage::SHOW_IN_MENU, '=', true))
            ->getNestedTree();

        return $tree->map(function ($page)
        {
            return NavigationMenuItemData::from($page);
        })->toArray();
    }

    /**
     * @param SitePage $sitePage
     *
     * @return SitePageData
     */
    private function getPage(SitePage $sitePage): SitePageData
    {
        return SitePageData::from($sitePage);
    }

    /**
     * @param SitePage $sitePage
     *
     * @return array
     */
    private function getSession(SitePage $sitePage): array
    {
        return [
            'locale' => App::getLocale(),
        ];
    }

    #endregion
}
