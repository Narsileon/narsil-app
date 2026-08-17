<?php

declare(strict_types=1);

namespace App\Http\Resources;

#region USE

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Narsil\Cms\Models\Sites\SitePage;
use Narsil\Cms\Models\Sites\SiteUrl;

#endregion

final class NavigationResource extends JsonResource
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        $page = $this->resource;

        return [
            SitePage::RELATION_CHILDREN => collect($page->{SitePage::RELATION_CHILDREN})->map(function (SitePage $child) use ($request): array
            {
                return new self($child)
                    ->toArray($request);
            })->all(),
            SitePage::ID => $page->{SitePage::ID},
            SitePage::TITLE => $page->{SitePage::TITLE},
            SiteUrl::URL => $page->{SitePage::RELATION_URLS}->first()?->{SiteUrl::URL},
        ];
    }

    #endregion
}
