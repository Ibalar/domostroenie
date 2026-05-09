<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service\Pages;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Block\BlockResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;


/**
 * @extends FormPage<ServiceResource>
 */
class ServiceFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Заголовок', 'title')
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
                Textarea::make('Описание', 'description')
                    ->nullable()                    ,
                TinyMce::make('Полный текст', 'full_text')
                    ->nullable(),
                BelongsTo::make('Родительская услуга', 'parent', resource: ServiceResource::class)
                    ->nullable()
                    ->searchable(),
                BelongsTo::make('Категория услуги', 'category', resource: ServiceCategoryResource::class)
                    ->nullable()
                    ->searchable(),
                Number::make('Порядок сортировки', 'sort_order')
                    ->nullable()
                    ->min(0)
                    ->step(1)
                    ->default(0),
                File::make('Изображение', 'image')
                    ->nullable()
                    ->disk('public')
                    ->dir('services')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'gif', 'webp']),
                Checkbox::make('Опубликовано', 'is_published')
                    ->default(true),
                BelongsToMany::make('Блоки оформления', 'blocks', resource: BlockResource::class)
                    ->searchable()
                    ->creatable()
                    ->pivotModalMode()
                    ->fields([
                        Number::make('Порядок', 'sort_order')
                            ->default(0)
                            ->min(0)
                            ->step(1),
                        Text::make('Заголовок в услуге', 'title')
                            ->nullable(),
                        Textarea::make('Контент в услуге', 'content')
                            ->nullable(),
                        Image::make('Изображение в услуге', 'image')
                            ->dir('services/blocks')
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp', 'svg'])
                            ->removable(),
                        Url::make('Ссылка в услуге', 'link')
                            ->nullable(),
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
        $id = $item?->getKey();
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:services,slug' . ($id ? ',' . $id : ''),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'full_text' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:services,id'],
            'category_id' => ['nullable', 'exists:service_categories,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ];
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
