<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Block\Pages;

use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Block\BlockResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
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
                ID::make()->sortable(),

                Grid::make([
                    Column::make([
                        Text::make('Системное имя', 'name')
                            ->required()
                            ->hint('Только латинские буквы в нижнем регистре, цифры и подчеркивания')
                            ->sortable(),
                    ])->columnSpan(6),

                    Column::make([
                        Text::make('Заголовок', 'title')
                            ->sortable(),
                    ])->columnSpan(6),
                ]),

                Tabs::make([
                    Tab::make('Контент', [
                        TinyMce::make('Содержимое', 'content')
                            ->toolbar('undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat'),


                        Json::make('JSON контент', 'content')
                            ->hint('Альтернатива - JSON данные для блока'),
                    ]),

                    Tab::make('Медиа', [
                        Image::make('Изображение', 'image')
                            ->dir('blocks')
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp', 'svg'])
                            ->removable(),

                        Url::make('Ссылка', 'link'),
                    ]),

                    Tab::make('Настройки', [
                        Switcher::make('Активен', 'is_active')
                            ->default(true),

                        Switcher::make('Использование в коде', 'usage_example')
                            ->setValue(function() {
                                return '@block(\'' . $this->name . '\')';
                            })
                            ->badge('purple'),
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
