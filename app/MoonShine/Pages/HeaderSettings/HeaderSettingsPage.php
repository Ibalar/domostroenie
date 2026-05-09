<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\HeaderSettings;

use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use App\Models\Setting;

class HeaderSettingsPage extends Page
{
    protected string $title = 'Настройки шапки';

    protected ?string $alias = 'header-settings';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function getBreadcrumbs(): array
    {
        return [
            toPage(page: \App\MoonShine\Pages\Dashboard::class) => 'Dashboard',
            '#' => $this->getTitle(),
        ];
    }

    protected function components(): iterable
    {
        yield Box::make('Настройки шапки сайта', [
            FormBuilder::make(route('header-settings.save'))
                ->fields([
                    Grid::make([
                        Column::make([
                            Text::make('Адрес', 'header_address')
                                ->default(Setting::getValue('header_address', ''))
                                ->hint('Адрес в шапке сайта'),

                            Text::make('График работы', 'header_work_hours')
                                ->default(Setting::getValue('header_work_hours', ''))
                                ->hint('Время работы в шапке сайта'),
                        ])->columnSpan(6),

                        Column::make([
                            Json::make('Телефоны', 'header_phones')
                                ->fields([
                                    Text::make('Название', 'label'),
                                    Text::make('Номер', 'number'),
                                ])
                                ->default(Setting::getValue('header_phones', []))
                                ->creatable()
                                ->removable()
                                ->hint('Добавьте несколько телефонов'),
                        ])->columnSpan(6),
                    ]),
                ])
                ->submit('Сохранить', ['class' => 'btn-primary']),
        ])->icon('bars-3');
    }
}
