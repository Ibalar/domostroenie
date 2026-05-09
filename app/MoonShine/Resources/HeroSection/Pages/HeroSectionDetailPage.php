<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\HeroSection\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use App\MoonShine\Resources\HeroSection\HeroSectionResource;
use MoonShine\Support\ListOf;
use Throwable;

/**
 * @extends DetailPage<HeroSectionResource>
 */
class HeroSectionDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Image::make('Фон', 'background_image'),
            Text::make('Заголовок', 'main_title'),
            Text::make('Подзаголовки', 'subtitles')->json(),
            Text::make('Кнопка 1 текст', 'button_primary_text'),
            Text::make('Кнопка 1 ссылка', 'button_primary_url'),
            Text::make('Кнопка 2 текст', 'button_secondary_text'),
            Text::make('Кнопка 2 ссылка', 'button_secondary_url'),
            Switcher::make('Активен', 'is_active'),
        ];
    }

    /**
     * @return ListOf<ActionButtonContract>
     */
    protected function buttons(): ListOf
    {
        return parent::buttons();
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
