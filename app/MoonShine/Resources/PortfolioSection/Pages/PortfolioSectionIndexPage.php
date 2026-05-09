<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioSection\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use App\MoonShine\Resources\PortfolioSection\PortfolioSectionResource;

/**
 * @extends IndexPage<PortfolioSectionResource>
 */
class PortfolioSectionIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Портфолио', 'portfolio.title')->sortable(),
            Text::make('Заголовок', 'title')->sortable(),
            Number::make('Сортировка', 'sort_order')->sortable(),
        ];
    }
}