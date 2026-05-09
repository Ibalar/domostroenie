<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ServiceCategory\Pages;

use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends FormPage<ServiceCategoryResource>
 */
class ServiceCategoryFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
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
                BelongsTo::make('Родительская категория', 'parent', resource: ServiceCategoryResource::class)
                    ->nullable()
                    ->searchable(),
                Number::make('Порядок сортировки', 'sort_order')
                    ->min(0)
                    ->step(1)
                    ->default(0),
                Checkbox::make('Опубликовано', 'is_published')->default(true),
                Checkbox::make('Показывать в меню', 'show_in_menu')->default(true),
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
        $id = $item?->getKey();

        $parentRules = ['nullable', 'exists:service_categories,id'];
        if ($id) {
            $parentRules[] = 'not_in:' . $id;
        }

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:service_categories,slug' . ($id ? ',' . $id : ''),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'parent_id' => $parentRules,
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'show_in_menu' => ['nullable', 'boolean'],
        ];
    }

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
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}
