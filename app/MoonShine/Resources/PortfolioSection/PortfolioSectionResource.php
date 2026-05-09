<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioSection;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioSection;
use App\MoonShine\Resources\PortfolioSection\Pages\PortfolioSectionIndexPage;
use App\MoonShine\Resources\PortfolioSection\Pages\PortfolioSectionFormPage;
use App\MoonShine\Resources\PortfolioSection\Pages\PortfolioSectionDetailPage;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<PortfolioSection, PortfolioSectionIndexPage, PortfolioSectionFormPage, PortfolioSectionDetailPage>
 */
class PortfolioSectionResource extends ModelResource
{
    protected string $model = PortfolioSection::class;

    protected string $title = 'Секции портфолио';

    protected function pages(): array
    {
        return [
            PortfolioSectionIndexPage::class,
            PortfolioSectionFormPage::class,
            PortfolioSectionDetailPage::class,
        ];
    }
}