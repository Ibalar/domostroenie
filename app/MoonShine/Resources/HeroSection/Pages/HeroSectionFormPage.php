<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\HeroSection\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\HeroSection\HeroSectionResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Switcher;
use Throwable;

/**
 * @extends FormPage<HeroSectionResource>
 */
class HeroSectionFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     * @throws Throwable
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),

            Box::make('Главный экран', [
                Grid::make([
                    Column::make([
                        Image::make('Фоновое изображение', 'background_image')
                            ->disk('public')
                            ->dir('hero')
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                            ->removable(),

                        Switcher::make('Активен', 'is_active')
                            ->default(true),
                    ])->columnSpan(6),

                    Column::make([
                        Textarea::make('Заголовок H1', 'main_title')
                            ->hint('Основной заголовок секции (поддерживает HTML, например <br>)')
                            ->unescape(),

                        Json::make('Подзаголовки H3', 'subtitles')
                            ->fields([
                                Text::make('Текст', 'text')
                                    ->required(),
                            ])
                            ->hint('Добавляйте неограниченное количество подзаголовков')
                            ->creatable()
                            ->removable(),
                    ])->columnSpan(6),
                ]),
            ])->icon('photo'),

            Box::make('Кнопки', [
                Grid::make([
                    Column::make([
                        Text::make('Текст кнопки 1', 'button_primary_text')
                            ->hint('Наши услуги'),

                        Text::make('Ссылка кнопки 1', 'button_primary_url')
                            ->hint('# или полный URL'),
                    ])->columnSpan(6),

                    Column::make([
                        Text::make('Текст кнопки 2', 'button_secondary_text')
                            ->hint('Готовые проекты'),

                        Text::make('Ссылка кнопки 2', 'button_secondary_url')
                            ->hint('# или полный URL'),
                    ])->columnSpan(6),
                ]),
            ])->icon('cursor-arrow-rays'),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
