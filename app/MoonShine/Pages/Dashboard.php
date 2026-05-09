<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use App\Models\Service;
use App\Models\Project;
use App\Models\Lead;
use App\Models\Page as PageModel;
use App\Models\Block;
use App\Models\Setting;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\Lead\LeadResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Block\BlockResource;
use App\MoonShine\Resources\Setting\SettingResource;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\HeroSection\HeroSectionResource;
use App\MoonShine\Pages\HeaderSettings\HeaderSettingsPage;

#[\MoonShine\MenuManager\Attributes\SkipMenu]
class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Dashboard';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        yield Box::make('Быстрые действия', [
            Flex::make([
                ActionButton::make('Главный экран', toPage(page: IndexPage::class, resource: HeroSectionResource::class))
                    ->icon('photo')
                    ->primary(),
                ActionButton::make('Добавить услугу', toPage(page: IndexPage::class, resource: ServiceResource::class))
                    ->icon('plus-circle')
                    ->primary(),
                ActionButton::make('Добавить проект', toPage(page: IndexPage::class, resource: ProjectResource::class))
                    ->icon('plus-circle')
                    ->primary(),
                ActionButton::make('Категории услуг', toPage(page: IndexPage::class, resource: ServiceCategoryResource::class))
                    ->icon('folder'),
                ActionButton::make('Категории проектов', toPage(page: IndexPage::class, resource: ProjectCategoryResource::class))
                    ->icon('folder'),
                ActionButton::make('Страницы', toPage(page: IndexPage::class, resource: PageResource::class))
                    ->icon('document-text'),
                ActionButton::make('Блоки', toPage(page: IndexPage::class, resource: BlockResource::class))
                    ->icon('square-3-stack-3d'),
                ActionButton::make('Настройки шапки', fn() => toPage(page: HeaderSettingsPage::class))
                    ->icon('bars-3'),
                ActionButton::make('Настройки', toPage(page: IndexPage::class, resource: SettingResource::class))
                    ->icon('cog-6-tooth'),
            ])->wrap()->justifyAlign('start'),
        ])->icon('bolt');

        yield Box::make('Статистика', [
            Grid::make([
                ValueMetric::make('Всего услуг')
                    ->value(fn(): int => Service::count())
                    ->icon('wrench-screwdriver')
                    ->columnSpan(3),

                ValueMetric::make('Опубликованные услуги')
                    ->value(fn(): int => Service::published()->count())
                    ->icon('check-circle')
                    ->columnSpan(3),

                ValueMetric::make('Всего проектов')
                    ->value(fn(): int => Project::count())
                    ->icon('home-modern')
                    ->columnSpan(3),

                ValueMetric::make('Опубликованные проекты')
                    ->value(fn(): int => Project::published()->count())
                    ->icon('check-circle')
                    ->columnSpan(3),

                ValueMetric::make('Избранные проекты')
                    ->value(fn(): int => Project::featured()->count())
                    ->icon('star')
                    ->columnSpan(3),

                ValueMetric::make('Всего заявок')
                    ->value(fn(): int => Lead::count())
                    ->icon('inbox')
                    ->columnSpan(3),

                ValueMetric::make('Новые заявки')
                    ->value(fn(): int => Lead::new()->count())
                    ->icon('bell')
                    ->columnSpan(4),

                ValueMetric::make('Обработанные заявки')
                    ->value(fn(): int => Lead::processed()->count())
                    ->icon('check-badge')
                    ->columnSpan(4),

                ValueMetric::make('Завершённые заявки')
                    ->value(fn(): int => Lead::completed()->count())
                    ->icon('flag')
                    ->columnSpan(4),

                ValueMetric::make('Страницы')
                    ->value(fn(): int => PageModel::count())
                    ->icon('document-text')
                    ->columnSpan(4),

                ValueMetric::make('Активные страницы')
                    ->value(fn(): int => PageModel::active()->count())
                    ->icon('eye')
                    ->columnSpan(4),

                ValueMetric::make('Блоки')
                    ->value(fn(): int => Block::count())
                    ->icon('square-3-stack-3d')
                    ->columnSpan(4),
            ])->gap(4),
        ])->icon('chart-bar');
    }
}
