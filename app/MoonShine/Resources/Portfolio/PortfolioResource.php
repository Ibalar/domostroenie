<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Portfolio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio;
use App\MoonShine\Resources\Portfolio\Pages\PortfolioIndexPage;
use App\MoonShine\Resources\Portfolio\Pages\PortfolioFormPage;
use App\MoonShine\Resources\Portfolio\Pages\PortfolioDetailPage;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Portfolio, PortfolioIndexPage, PortfolioFormPage, PortfolioDetailPage>
 */
class PortfolioResource extends ModelResource
{
    protected string $model = Portfolio::class;

    protected string $title = 'Портфолио';

    protected function pages(): array
    {
        return [
            PortfolioIndexPage::class,
            PortfolioFormPage::class,
            PortfolioDetailPage::class,
        ];
    }
}