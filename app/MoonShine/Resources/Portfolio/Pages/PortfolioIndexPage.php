<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Portfolio\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\Portfolio\PortfolioResource;

/**
 * @extends IndexPage<PortfolioResource>
 */
class PortfolioIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title')->sortable(),
            Text::make('Slug', 'slug')->sortable(),
            Text::make('Проект', 'project.title')->sortable(),
            Number::make('Этажей', 'floors')->sortable(),
            Text::make('Срок реализации', 'implementation_period')->sortable(),
            Switcher::make('Опубликован', 'is_published')->sortable(),
            Number::make('Сортировка', 'sort_order')->sortable(),
        ];
    }
}