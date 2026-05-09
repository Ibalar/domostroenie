<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioImage\Pages;

use App\MoonShine\Resources\Portfolio\PortfolioResource;
use App\MoonShine\Resources\PortfolioImage\PortfolioImageResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;

/**
 * @extends FormPage<PortfolioImageResource>
 */
class PortfolioImageFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                BelongsTo::make('Портфолио', 'portfolio', resource: PortfolioResource::class)
                    ->required()
                    ->searchable(),
                Image::make('Изображение', 'image_path')
                    ->required()
                    ->disk('public')
                    ->dir('portfolio/gallery')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'gif', 'webp']),
                Number::make('Сортировка', 'sort_order')
                    ->min(0)
                    ->step(1)
                    ->default(0),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'portfolio_id' => ['required', 'exists:portfolios,id'],
            'image_path' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}