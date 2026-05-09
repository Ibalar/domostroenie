<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Block\Pages;

use App\MoonShine\Resources\Block\BlockResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends FormPage<BlockResource>
 */
class BlockFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Системное имя', 'name')
                    ->required()
                    ->hint('Латиница, цифры, подчеркивание'),
                Text::make('Заголовок', 'title')->nullable(),
                TinyMce::make('Содержимое', 'content')->nullable(),
                Image::make('Изображение', 'image')
                    ->dir('blocks')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp', 'svg'])
                    ->removable(),
                Url::make('Ссылка', 'link')->nullable(),
                Switcher::make('Активен', 'is_active')->default(true),
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
            'name' => ['required', 'string', 'max:255', 'unique:blocks,name' . ($id ? ',' . $id : '')],
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
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
