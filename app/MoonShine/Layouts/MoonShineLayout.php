<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\Block\BlockResource;
use App\MoonShine\Resources\HeroSection\HeroSectionResource;
use App\MoonShine\Pages\HeaderSettings\HeaderSettingsPage;
use App\MoonShine\Resources\Lead\LeadResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Portfolio\PortfolioResource;
use App\MoonShine\Resources\PortfolioImage\PortfolioImageResource;
use App\MoonShine\Resources\PortfolioSection\PortfolioSectionResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\ProjectImage\ProjectImageResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use App\MoonShine\Resources\Setting\SettingResource;
use MoonShine\ColorManager\ColorManager;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;

final class MoonShineLayout extends AppLayout
{
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('Услуги', [
                MenuItem::make(ServiceCategoryResource::class, 'Категории услуг'),
                MenuItem::make(ServiceResource::class, 'Услуги'),
                MenuItem::make(BlockResource::class, 'Структурные блоки'),
            ])->icon('squares-plus'),
            MenuGroup::make('Готовые проекты', [
                MenuItem::make(ProjectCategoryResource::class, 'Категории проектов'),
                MenuItem::make(ProjectResource::class, 'Проекты'),
                MenuItem::make(ProjectImageResource::class, 'Изображения проектов'),
            ])->icon('building-library'),
            MenuGroup::make('Портфолио', [
                MenuItem::make(PortfolioResource::class, 'Работы'),
                MenuItem::make(PortfolioImageResource::class, 'Изображения'),
                MenuItem::make(PortfolioSectionResource::class, 'Секции'),
            ])->icon('photo'),
            MenuItem::make(PageResource::class, 'Информационные страницы')->icon('book-open'),
            MenuGroup::make('Настройки сайта', [
                MenuItem::make(HeroSectionResource::class, 'Главный экран'),
                MenuItem::make(fn() => toPage(page: HeaderSettingsPage::class), 'Контакты в шапке сайта'),
            ])->icon('table-cells'),
            MenuItem::make(LeadResource::class, 'Заявки')->icon('chat-bubble-left-right'),
            MenuItem::make(SettingResource::class, 'Настройки')->icon('cog-8-tooth'),
            ...parent::menu(),
        ];
    }

    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);
    }
}