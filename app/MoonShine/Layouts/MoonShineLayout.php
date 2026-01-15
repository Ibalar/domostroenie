<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use App\MoonShine\Resources\Page\PageResource;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\ProjectImage\ProjectImageResource;
use App\MoonShine\Resources\Block\BlockResource;
use App\MoonShine\Resources\Setting\SettingResource;
use App\MoonShine\Resources\Lead\LeadResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
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
            ...parent::menu(),
            MenuItem::make(PageResource::class, 'Pages'),
            MenuItem::make(ServiceResource::class, 'Services'),
            MenuItem::make(ProjectCategoryResource::class, 'ProjectCategories'),
            MenuItem::make(ProjectResource::class, 'Projects'),
            MenuItem::make(ProjectImageResource::class, 'ProjectImages'),
            MenuItem::make(BlockResource::class, 'Blocks'),
            MenuItem::make(SettingResource::class, 'Settings'),
            MenuItem::make(LeadResource::class, 'Leads'),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}
