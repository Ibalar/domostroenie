<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\ProjectImage\ProjectImageResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends FormPage<ProjectResource>
 */
class ProjectFormPage extends FormPage
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
                BelongsTo::make('Категория', 'category', resource: ProjectCategoryResource::class)
                    ->required()
                    ->searchable(),
                Number::make('Цена от', 'price_from')->nullable()->step(0.01)->min(0),
                Number::make('Цена до', 'price_to')->nullable()->step(0.01)->min(0),
                Number::make('Площадь', 'area')->nullable()->step(0.01)->min(0),
                Number::make('Этажей', 'floors')->min(1)->step(1)->default(1),
                Number::make('Спален', 'bedrooms')->min(0)->step(1)->default(0),
                Number::make('Санузлов', 'bathrooms')->min(0)->step(1)->default(0),
                Checkbox::make('Есть гараж', 'has_garage')->default(false),
                Text::make('Тип крыши', 'roof_type')->nullable(),
                Text::make('Стиль', 'style')->nullable(),
                File::make('Основное изображение', 'main_image')
                    ->nullable()
                    ->disk('public')
                    ->dir('projects')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'gif', 'webp']),
                HasMany::make('Галерея проекта', 'images', resource: ProjectImageResource::class)
                    ->fields([
                        Image::make('Изображение', 'image_path'),
                        Number::make('Сортировка', 'sort_order'),
                    ])
                    ->creatable(),
                Text::make('Внешний ID', 'external_id')->nullable(),
                Checkbox::make('Рекомендуемый', 'is_featured')->default(false),
                Checkbox::make('Опубликован', 'is_published')->default(true),
                Number::make('Сортировка', 'sort_order')->min(0)->step(1)->default(0),
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
                'unique:projects,slug' . ($id ? ',' . $id : ''),
            ],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:project_categories,id'],
            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to' => ['nullable', 'numeric', 'min:0'],
            'area' => ['nullable', 'numeric', 'min:0'],
            'floors' => ['required', 'integer', 'min:1'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'has_garage' => ['nullable', 'boolean'],
            'roof_type' => ['nullable', 'string', 'max:255'],
            'style' => ['nullable', 'string', 'max:255'],
            'main_image' => ['nullable', 'string', 'max:255'],
            'external_id' => [
                'nullable',
                'string',
                'max:255',
                'unique:projects,external_id' . ($id ? ',' . $id : ''),
            ],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
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
