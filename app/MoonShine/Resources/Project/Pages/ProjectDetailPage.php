<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends DetailPage<ProjectResource>
 */
class ProjectDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'title'),
            Text::make('Slug', 'slug'),
            Textarea::make('Описание', 'description'),
            Text::make('Категория', 'category.name'),
            Number::make('Цена от', 'price_from'),
            Number::make('Цена до', 'price_to'),
            Number::make('Площадь', 'area'),
            Number::make('Этажей', 'floors'),
            Number::make('Спален', 'bedrooms'),
            Number::make('Санузлов', 'bathrooms'),
            Switcher::make('Есть гараж', 'has_garage'),
            Text::make('Тип крыши', 'roof_type'),
            Text::make('Стиль', 'style'),
            Image::make('Основное изображение', 'main_image'),
            Text::make('Внешний ID', 'external_id'),
            Switcher::make('Рекомендуемый', 'is_featured'),
            Switcher::make('Опубликован', 'is_published'),
            Number::make('Сортировка', 'sort_order'),
            Text::make('Создано', 'created_at'),
            Text::make('Обновлено', 'updated_at'),
        ];
    }
}