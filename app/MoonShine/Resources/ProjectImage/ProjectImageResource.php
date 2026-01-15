<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ProjectImage;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectImage;
use App\MoonShine\Resources\ProjectImage\Pages\ProjectImageIndexPage;
use App\MoonShine\Resources\ProjectImage\Pages\ProjectImageFormPage;
use App\MoonShine\Resources\ProjectImage\Pages\ProjectImageDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<ProjectImage, ProjectImageIndexPage, ProjectImageFormPage, ProjectImageDetailPage>
 */
class ProjectImageResource extends ModelResource
{
    protected string $model = ProjectImage::class;

    protected string $title = 'ProjectImages';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProjectImageIndexPage::class,
            ProjectImageFormPage::class,
            ProjectImageDetailPage::class,
        ];
    }
}
