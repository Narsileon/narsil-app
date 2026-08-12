<?php

namespace App\Http\Controllers;

#region USE

use App\Http\Data\FooterData;
use App\Http\Data\GlobalData;
use App\Http\Data\HeaderData;
use App\Http\Data\NavigationMenuItemData;
use App\Http\Data\SitePageData;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Narsil\Cms\Models\Sites\Site;
use Narsil\Cms\Models\Sites\SitePage;
use Narsil\Cms\Services\PageService;
use Narsil\Cms\Support\Tree;
use Spatie\LaravelData\DataCollection;

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

        $data = new GlobalData(
            editorMode: $request->boolean('_editor'),
            footer: $this->footer($sitePage),
            header: $this->header($sitePage),
            navigation: $this->navigationMenu($sitePage),
            page: $this->page($sitePage),
        );

        return Inertia::render('frontend/index', $data);
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
     * @return DataCollection
     */
    private function navigationMenu(SitePage $sitePage): DataCollection
    {
        $pages = ($sitePage->{SitePage::RELATION_SITE})->{Site::RELATION_PAGES};

        $tree = new Tree($pages->where(SitePage::SHOW_IN_MENU, true))
            ->getNestedTree();

        return NavigationMenuItemData::collect($tree->map(function (SitePage $sitePage)
        {
            return NavigationMenuItemData::from($sitePage);
        }), DataCollection::class);
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

    #endregion
}
