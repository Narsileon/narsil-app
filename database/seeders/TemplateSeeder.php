<?php

namespace Database\Seeders;

#region USE

use Database\Seeders\Templates\ContentSeeder;
use Database\Seeders\Templates\EventSeeder;
use Illuminate\Database\Seeder;
use Narsil\Models\Structures\Template;
use Narsil\Models\Entities\Entity;
use Narsil\Services\Models\EntityService;

#endregion

final class TemplateSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function run(): void
    {
        $eventTemplate = new EventSeeder()
            ->run();
        $contentTemplate = new ContentSeeder()
            ->run();

        $this->createEvents($eventTemplate);
        $this->createContent($contentTemplate);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param Template $template
     *
     * @return void
     */
    private function createEvents(Template $template): void
    {
        foreach (range(1, 10) as $index)
        {
            $entity = Entity::create([
                Entity::SLUG => fake()->slug(1),
                Entity::TEMPLATE_ID => $template->{Template::ID},
            ]);

            EntityService::syncFields($entity, $template, [
                'title' => fake()->words(3, true),
            ]);
        }
    }

    /**
     * @param Template $template
     *
     * @return ;
     */
    private function createContent(Template $template): Entity
    {
        $entity = Entity::create([
            Entity::SLUG => fake()->slug(1),
            Entity::TEMPLATE_ID => $template->{Template::ID},
        ]);

        EntityService::syncFields($entity, $template, [
            'title' => fake()->words(3, true),
        ]);

        return $entity;
    }

    #endregion
}
