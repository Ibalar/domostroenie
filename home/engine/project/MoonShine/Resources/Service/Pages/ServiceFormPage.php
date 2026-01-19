<?php
declare(strict_types=1);

namespace App\MoonShine\Resources\Service\Pages;

use App\MoonShine\Resources\Service\ServiceResource;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\TinyMce\Fields\TinyMce;
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
                Text::make('Заголовок', 'title')
                    ->required()
                    ->max(255),

                Slug::make('URL slug', 'slug')
                    ->from('title')
                    ->live()
                    ->unique()
                    ->required()
                    ->max(255),

                Textarea::make('Описание', 'description')
                    ->nullable()
                    ->max(1000)
                    ->rows(3),

                TinyMce::make('Полный текст', 'full_text')
                    ->nullable()
                    ->options([
                        'height' => 500,
                        'menubar' => false,
                        'plugins' => [
                            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                            'preview', 'anchor', 'searchreplace', 'visualblocks', 'code',
                            'fullscreen', 'insertdatetime', 'media', 'table', 'help',
                            'wordcount',
                        ],
                        'toolbar' => 'undo redo | blocks | bold italic forecolor | ' .
                            'alignleft aligncenter alignright alignjustify | ' .
                            'bullist numlist outdent indent | removeformat | help',
                    ]),

                BelongsTo::make('Родительская услуга', 'parent', resource: ServiceResource::class)
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
            ])->columnSpan(12),
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
