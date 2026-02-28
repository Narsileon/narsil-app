<?php

namespace Database\Seeders;

#region USE

use Database\Seeders\Entities\ContactEntitySeeder;
use Database\Seeders\Entities\HomeEntitySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Narsil\Cms\Models\Entities\Entity;
use Narsil\Cms\Models\Globals\Footer;
use Narsil\Cms\Models\Globals\Header;
use Narsil\Cms\Models\Sites\Site;
use Narsil\Cms\Models\Sites\SitePage;
use Narsil\Cms\Models\Sites\SitePageEntity;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
final class SiteSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return Site
     */
    public function run(): Site
    {
        $url = parse_url(Config::get('app.url'), PHP_URL_HOST);

        if ($site = Site::firstWhere(Site::HOSTNAME, $url))
        {
            return $site;
        }

        return Site::factory()
            ->has(
                SitePage::factory()
                    ->state([
                        SitePage::SLUG => 'home',
                        SitePage::TITLE => 'Home',
                    ]),
                Site::RELATION_PAGES
            )
            ->has(
                SitePage::factory()
                    ->state([
                        SitePage::SLUG => 'contact',
                        SitePage::TITLE => 'Contact',
                    ]),
                Site::RELATION_PAGES
            )
            ->has(
                SitePage::factory()->state([
                    SitePage::SHOW_IN_MENU => false,
                    SitePage::SLUG => 'imprint',
                    SitePage::TITLE => 'Imprint',
                ]),
                Site::RELATION_PAGES
            )
            ->has(
                SitePage::factory()->state([
                    SitePage::SHOW_IN_MENU => false,
                    SitePage::SLUG => 'privacy-notice',
                    SitePage::TITLE => 'Privacy Notice',
                ]),
                Site::RELATION_PAGES
            )
            ->for(
                Header::factory()
                    ->state([
                        Header::SLUG => 'main',
                    ]),
                Site::RELATION_HEADER,
            )
            ->for(
                Footer::factory()
                    ->state([
                        Footer::SLUG => 'main',
                    ]),
                Site::RELATION_FOOTER,
            )
            ->afterCreating(function (Site $site)
            {
                $footer = $site->{Site::RELATION_FOOTER};

                $home = $site
                    ->pages()
                    ->where(SitePage::SLUG . '->en', 'home')
                    ->first();
                $contact = $site
                    ->pages()
                    ->where(SitePage::SLUG . '->en', 'contact')
                    ->first();
                $imprint = $site
                    ->pages()
                    ->where(SitePage::SLUG . '->en', 'imprint')
                    ->first();
                $privacyNotice = $site
                    ->pages()
                    ->where(SitePage::SLUG . '->en', 'privacy-notice')
                    ->first();

                $contact?->update([
                    SitePage::PARENT_ID => $home->{SitePage::ID},
                    SitePage::RIGHT_ID  => $imprint->{SitePage::ID},
                ]);
                $imprint?->update([
                    SitePage::LEFT_ID   => $contact->{SitePage::ID},
                    SitePage::PARENT_ID => $home->{SitePage::ID},
                    SitePage::RIGHT_ID  => $privacyNotice->{SitePage::ID},
                ]);
                $privacyNotice?->update([
                    SitePage::PARENT_ID => $home->{SitePage::ID},
                    SitePage::LEFT_ID   => $imprint->{SitePage::ID},
                ]);

                if ($footer && $imprint)
                {
                    $footer
                        ->site_pages()
                        ->attach($imprint->{SitePage::ID});
                }

                if ($footer && $privacyNotice)
                {
                    $footer
                        ->site_pages()
                        ->attach($privacyNotice->{SitePage::ID});
                }

                $homeEntity = new HomeEntitySeeder()->run();
                $contactEntity = new ContactEntitySeeder()->run();

                SitePageEntity::create([
                    SitePageEntity::SITE_PAGE_ID => $home->{SitePage::ID},
                    SitePageEntity::TARGET_ID => $homeEntity->{Entity::ID},
                    SitePageEntity::TARGET_TYPE => $homeEntity->getTable(),
                ]);

                SitePageEntity::create([
                    SitePageEntity::SITE_PAGE_ID => $contact->{SitePage::ID},
                    SitePageEntity::TARGET_ID => $contactEntity->{Entity::ID},
                    SitePageEntity::TARGET_TYPE => $contactEntity->getTable(),
                ]);
            })
            ->create([
                Site::HOSTNAME => $url,
                Site::LABEL => 'Main',
            ]);
    }

    #endregion
}
