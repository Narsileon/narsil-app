<?php

namespace Database\Seeders;

#region USE

use Database\Seeders\Templates\EventSeeder;
use Database\Seeders\Templates\PageSeeder;
use Illuminate\Database\Seeder;
use Narsil\Models\Structures\Template;
use Narsil\Models\Entities\Entity;

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
        $pageTemplate = new PageSeeder()
            ->run();

        $this->createEvents($eventTemplate);
        $this->createPage($pageTemplate);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param Template $template
     *
     * @return array<Entity>
     */
    private function createEvents(Template $template): array
    {
        Entity::setTemplate($template);

        $events = [];

        foreach (range(1, 10) as $index)
        {
            $event = new Entity([
                Entity::ID => $index,
                Entity::SLUG => fake()->slug(1),
                'title' => fake()->words(3, true),
            ]);

            $event->save();

            $events[] = $event;
        }

        return $events;
    }

    /**
     * @param Template $template
     *
     * @return Entity
     */
    private function createPage(Template $template): Entity
    {
        Entity::setTemplate($template);

        $page = new Entity([
            Entity::ID => 1,
            Entity::SLUG => fake()->slug(1),
            'title' => fake()->words(3, true),
        ]);

        $page->save();

        return $page;
    }

    #endregion
}
