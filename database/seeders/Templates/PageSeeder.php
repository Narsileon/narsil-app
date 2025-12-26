<?php

namespace Database\Seeders\Templates;

#region USE

use Narsil\Contracts\Fields\BuilderField;
use Narsil\Database\Seeders\Blocks\AccordionBlockSeeder;
use Narsil\Database\Seeders\Blocks\HeadlineBlockSeeder;
use Narsil\Database\Seeders\Blocks\HeroHeaderBlockSeeder;
use Narsil\Database\Seeders\Fields\TitleFieldSeeder;
use Narsil\Models\Structures\Block;
use Narsil\Models\Structures\Field;
use Narsil\Models\Structures\FieldBlock;
use Narsil\Models\Structures\Template;
use Narsil\Models\Structures\TemplateSection;
use Narsil\Models\Structures\TemplateSectionElement;
use Narsil\Services\MigrationService;

#endregion

final class PageSeeder
{
    #region PUBLIC METHODS

    /**
     * @return Template
     */
    public function run(): Template
    {
        $template = Template::query()
            ->where(Template::HANDLE, 'pages')
            ->first();

        if (!$template)
        {
            $template = Template::firstOrCreate([
                Template::HANDLE => 'pages',
            ], [
                Template::PLURAL => 'pages',
                Template::SINGULAR => 'page',
            ]);

            $this->createMainSection($template);
            $this->createContentSection($template);

            MigrationService::syncTable($template);
        }

        return $template;
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return Field
     */
    private function createContentField(): Field
    {
        $accordionBlock = new AccordionBlockSeeder()->run();
        $headlineBlock = new HeadlineBlockSeeder()->run();
        $heroHeaderBlock = new HeroHeaderBlockSeeder()->run();

        $field = Field::firstOrCreate([
            Field::HANDLE => 'content',
            Field::TYPE => BuilderField::class,
        ], [
            Field::NAME => 'Content',
        ]);

        FieldBlock::firstOrCreate([
            FieldBlock::BLOCK_ID => $accordionBlock->{Block::ID},
            FieldBlock::FIELD_ID => $field->{Block::ID},
        ]);

        FieldBlock::firstOrCreate([
            FieldBlock::BLOCK_ID => $headlineBlock->{Block::ID},
            FieldBlock::FIELD_ID => $field->{Block::ID},
        ]);

        FieldBlock::firstOrCreate([
            FieldBlock::BLOCK_ID => $heroHeaderBlock->{Block::ID},
            FieldBlock::FIELD_ID => $field->{Block::ID},
        ]);

        return $field;
    }

    /**
     * @param Template $template
     *
     * @return TemplateSection
     */
    private function createContentSection(Template $template): TemplateSection
    {
        $contentField = $this->createContentField();

        $templateSection = TemplateSection::firstOrCreate([
            TemplateSection::HANDLE => 'content',
            TemplateSection::TEMPLATE_ID => $template->{Template::ID},
        ], [
            TemplateSection::NAME => 'Content',
        ]);

        $templateSection->fields()->attach($contentField->{Block::ID}, [
            TemplateSection::HANDLE => $contentField->{Block::HANDLE},
            TemplateSection::NAME => json_encode(['en' => $contentField->{Block::NAME}]),
            TemplateSection::POSITION => 0,
        ]);

        return $templateSection;
    }

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
}
