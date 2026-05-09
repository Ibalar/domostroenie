<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioImage;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioImage;
use App\MoonShine\Resources\PortfolioImage\Pages\PortfolioImageIndexPage;
use App\MoonShine\Resources\PortfolioImage\Pages\PortfolioImageFormPage;
use App\MoonShine\Resources\PortfolioImage\Pages\PortfolioImageDetailPage;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<PortfolioImage, PortfolioImageIndexPage, PortfolioImageFormPage, PortfolioImageDetailPage>
 */
class PortfolioImageResource extends ModelResource
{
    protected string $model = PortfolioImage::class;

    protected string $title = 'Изображения портфолио';

    protected function pages(): array
    {
        return [
            PortfolioImageIndexPage::class,
            PortfolioImageFormPage::class,
            PortfolioImageDetailPage::class,
        ];
    }
}