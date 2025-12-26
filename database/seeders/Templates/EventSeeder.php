<?php

namespace Database\Seeders\Templates;

#region USE

use Narsil\Database\Seeders\Fields\TitleFieldSeeder;
use Narsil\Models\Structures\Field;
use Narsil\Models\Structures\Template;
use Narsil\Models\Structures\TemplateSection;
use Narsil\Models\Structures\TemplateSectionElement;
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

            $this->createMainSection($template);

            MigrationService::syncTable($template);
        }

        return $template;
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param Template $template
     *
     * @return TemplateSection
     */
    private function createMainSection(Template $template): TemplateSection
    {
        $titleField = new TitleFieldSeeder()->run();

        $templateSection = TemplateSection::firstOrCreate([
            TemplateSection::HANDLE => 'main',
            TemplateSection::TEMPLATE_ID => $template->{Template::ID},
        ], [
            TemplateSection::NAME => 'Main',
        ]);

        $templateSection->fields()->attach($titleField->{Field::ID}, [
            TemplateSectionElement::HANDLE => $titleField->{Field::HANDLE},
            TemplateSectionElement::NAME => json_encode(['en' => $titleField->{Field::NAME}]),
            TemplateSectionElement::POSITION => 0,
        ]);

        return $templateSection;
    }

    #endregion
}
