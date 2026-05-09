<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioImage\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use App\MoonShine\Resources\PortfolioImage\PortfolioImageResource;

/**
 * @extends IndexPage<PortfolioImageResource>
 */
class PortfolioImageIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Портфолио', 'portfolio.title')->sortable(),
            Image::make('Изображение', 'image_path'),
            Number::make('Сортировка', 'sort_order')->sortable(),
        ];
    }
}