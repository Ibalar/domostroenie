<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setting\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<SettingResource>
 */
class SettingFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     * @throws Throwable
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                Tabs::make([
                    Tab::make('Основные настройки', [
                        Grid::make([
                            Column::make([
                                Text::make('Ключ', 'key')
                                    ->required()
                                    ->sortable()
                                    ->readonly(function() {
                                        return $this->getItem() && $this->getItem()->exists;
                                    }),

                                Select::make('Группа', 'group')
                                    ->options([
                                        'general' => 'Общие',
                                        'contacts' => 'Контакты',
                                        'social' => 'Соцсети',
                                        'seo' => 'SEO',
                                        'mail' => 'Почта',
                                        'payment' => 'Оплата',
                                        'other' => 'Другое',
                                    ])
                                    ->default('general')
                                    ->sortable(),

                                Text::make('Название', 'label')
                                    ->sortable(),
                            ])->columnSpan(6),

                            Column::make([
                                Select::make('Тип', 'type')
                                    ->options([
                                        'string' => 'Строка',
                                        'text' => 'Текст',
                                        'boolean' => 'Да/Нет',
                                        'number' => 'Число',
                                        'json' => 'JSON',
                                        'array' => 'Массив',
                                    ])
                                    ->default('string')
                                    ->sortable(),

                                Json::make('Опции', 'options')
                                    ->keyValue('Ключ', 'Значение')
                                    ->hint('Для полей типа select'),
                            ])->columnSpan(6),
                        ]),

                        Textarea::make('Значение', 'value')
                            ->hint('Зависит от выбранного типа'),
                    ]),
                ]),
            ]),
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
