<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioSection\Pages;

use App\MoonShine\Resources\Portfolio\PortfolioResource;
use App\MoonShine\Resources\PortfolioSection\PortfolioSectionResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends FormPage<PortfolioSectionResource>
 */
class PortfolioSectionFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                BelongsTo::make('Портфолио', 'portfolio', resource: PortfolioResource::class)
                    ->required()
                    ->searchable(),
                Text::make('Заголовок', 'title')
                    ->required(),
                Textarea::make('Описание', 'description')
                    ->nullable(),
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}