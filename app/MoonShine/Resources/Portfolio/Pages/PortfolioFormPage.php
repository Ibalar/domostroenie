<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Portfolio\Pages;

use App\MoonShine\Resources\Portfolio\PortfolioResource;
use App\MoonShine\Resources\PortfolioSection\PortfolioSectionResource;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends FormPage<PortfolioResource>
 */
class PortfolioFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make(),
                Text::make('Название', 'title')
                    ->when(
                        fn() => $this->getResource()->isCreateFormPage(),
                        fn(Text $field) => $field->reactive(),
                        fn(Text $field) => $field
                    )
                    ->required(),
                Slug::make('URL slug', 'slug')
                    ->unique()
                    ->locked()
                    ->when(
                        fn() => $this->getResource()->isCreateFormPage(),
                        fn(Slug $field) => $field->from('title')->live(),
                        fn(Slug $field) => $field->readonly()
                    ),
                Textarea::make('Описание', 'description')->nullable(),
                BelongsTo::make('Проект (необязательно)', 'project', resource: ProjectResource::class)
                    ->nullable()
                    ->searchable(),
            ]),

            Box::make('Характеристики', [
                Grid::make([
                    Column::make([
                        Number::make('Этажность', 'floors')->min(1)->step(1)->default(1),
                        Text::make('Срок реализации', 'implementation_period')
                            ->nullable()
                            ->hint('Например: 2 года 6 месяцев'),
                    ])->columnSpan(6),
                    Column::make([
                        Number::make('Площадь (м²)', 'area')->nullable()->step(0.01)->min(0),
                        Text::make('Стоимость строительства', 'cost_text')
                            ->nullable()
                            ->hint('Например: 3 234 325 BYN'),
                    ])->columnSpan(6),
                ]),
            ]),

            Box::make('Изображения', [
                File::make('Главное изображение', 'main_image')
                    ->nullable()
                    ->disk('public')
                    ->dir('portfolio')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'gif', 'webp']),
                Image::make('Фотогалерея', 'gallery')
                    ->disk('public')
                    ->dir('portfolio/gallery')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'gif', 'webp'])
                    ->multiple()
                    ->removable(),
            ]),

            Box::make('Секции (подробности)', [
                HasMany::make('Секции', 'sections', resource: PortfolioSectionResource::class)
                    ->fields([
                        Text::make('Заголовок', 'title'),
                        Textarea::make('Описание', 'description'),
                        Number::make('Сортировка', 'sort_order'),
                    ])
                    ->creatable(),
            ]),

            Box::make('Настройки', [
                Checkbox::make('Опубликован', 'is_published')->default(true),
                Number::make('Сортировка', 'sort_order')->min(0)->step(1)->default(0),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        $id = $item?->getKey();

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:portfolios,slug' . ($id ? ',' . $id : '')],
            'description' => ['nullable', 'string'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'main_image' => ['nullable', 'string', 'max:255'],
            'gallery' => ['nullable', 'array'],
            'floors' => ['nullable', 'integer', 'min:1'],
            'area' => ['nullable', 'numeric', 'min:0'],
            'implementation_period' => ['nullable', 'string', 'max:255'],
            'cost_text' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}