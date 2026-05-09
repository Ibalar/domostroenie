<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ServiceCategory\Pages;

use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends DetailPage<ServiceCategoryResource>
 */
class ServiceCategoryDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Text::make('Slug', 'slug'),
            Textarea::make('Описание', 'description'),
            Text::make('Родитель', 'parent.title'),
            Number::make('Сортировка', 'sort_order'),
            Switcher::make('Опубликовано', 'is_published'),
            Switcher::make('В меню', 'show_in_menu'),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}
