<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Portfolio\Pages;

use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use App\MoonShine\Resources\Portfolio\PortfolioResource;

/**
 * @extends DetailPage<PortfolioResource>
 */
class PortfolioDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Text::make('Slug', 'slug'),
            Textarea::make('Описание', 'description'),
            Text::make('Проект', 'project.title'),
            Image::make('Главное изображение', 'main_image'),
            Number::make('Этажность', 'floors'),
            Number::make('Площадь', 'area'),
            Text::make('Срок реализации', 'implementation_period'),
            Text::make('Стоимость строительства', 'cost_text'),
            Switcher::make('Опубликован', 'is_published'),
            Number::make('Сортировка', 'sort_order'),
        ];
    }
}