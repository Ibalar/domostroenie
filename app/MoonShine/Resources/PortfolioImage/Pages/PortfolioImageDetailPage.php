<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioImage\Pages;

use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\PortfolioImage\PortfolioImageResource;

/**
 * @extends DetailPage<PortfolioImageResource>
 */
class PortfolioImageDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Портфолио', 'portfolio.title'),
            Image::make('Изображение', 'image_path'),
            Number::make('Сортировка', 'sort_order'),
        ];
    }
}