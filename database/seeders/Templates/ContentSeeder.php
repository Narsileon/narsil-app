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
use Narsil\Models\Structures\TemplateTab;
use Narsil\Models\Structures\TemplateTabElement;
use Narsil\Services\MigrationService;

#endregion

final class ContentSeeder
{
    #region PUBLIC METHODS

    /**
     * @return Template
     */
    public function run(): Template
    {
        $template = Template::query()
            ->where(Template::HANDLE, 'contents')
            ->first();

        if (!$template)
        {
            $template = Template::firstOrCreate([
                Template::HANDLE => 'contents',
            ], [
                Template::PLURAL => 'contents',
                Template::SINGULAR => 'content',
            ]);

            $this->createMainTab($template);
            $this->createContentTab($template);

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
     * @return TemplateTab
     */
    private function createContentTab(Template $template): TemplateTab
    {
        $contentField = $this->createContentField();

        $templateTab = TemplateTab::firstOrCreate([
            TemplateTab::HANDLE => 'content',
            TemplateTab::TEMPLATE_ID => $template->{Template::ID},
        ], [
            TemplateTab::NAME => 'Content',
        ]);

        $templateTab->fields()->attach($contentField->{Block::ID}, [
            TemplateTab::HANDLE => $contentField->{Block::HANDLE},
            TemplateTab::NAME => ['en' => $contentField->{Block::NAME}],
            TemplateTab::POSITION => 0,
        ]);

        return $templateTab;
    }

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
}
