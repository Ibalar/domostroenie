<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioSection\Pages;

use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Number;
use App\MoonShine\Resources\PortfolioSection\PortfolioSectionResource;

/**
 * @extends DetailPage<PortfolioSectionResource>
 */
class PortfolioSectionDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Портфолио', 'portfolio.title'),
            Text::make('Заголовок', 'title'),
            Textarea::make('Описание', 'description'),
            Number::make('Сортировка', 'sort_order'),
        ];
    }
}