<?php

namespace Database\Seeders\Templates;

#region USE

use Narsil\Database\Seeders\Fields\TitleFieldSeeder;
use Narsil\Models\Structures\Field;
use Narsil\Models\Structures\Template;
use Narsil\Models\Structures\TemplateTab;
use Narsil\Models\Structures\TemplateTabElement;
use Narsil\Services\MigrationService;

#endregion

final class EventSeeder
{
    #region PUBLIC METHODS

    /**
     * @return Template
     */
    public function run(): Template
    {
        $template = Template::query()
            ->where(Template::HANDLE, 'events')
            ->first();

        if (!$template)
        {
            $template = Template::firstOrCreate([
                Template::HANDLE => 'events',
            ], [
                Template::PLURAL => 'events',
                Template::SINGULAR => 'event',
            ]);

            $this->createMainTab($template);

            MigrationService::syncTable($template);
        }

        return $template;
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param Template $template
     *
     * @return TemplateTab
     */
    private function createMainTab(Template $template): TemplateTab
    {
        $titleField = new TitleFieldSeeder()->run();

        $templateTab = TemplateTab::firstOrCreate([
            TemplateTab::HANDLE => 'main',
            TemplateTab::TEMPLATE_ID => $template->{Template::ID},
        ], [
            TemplateTab::NAME => 'Main',
        ]);

        $templateTab->fields()->attach($titleField->{Field::ID}, [
            TemplateTabElement::HANDLE => $titleField->{Field::HANDLE},
            TemplateTabElement::NAME => ['en' => $titleField->{Field::NAME}],
            TemplateTabElement::POSITION => 0,
        ]);

        return $templateTab;
    }

    #endregion
}
