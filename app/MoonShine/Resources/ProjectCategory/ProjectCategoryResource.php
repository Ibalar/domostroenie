<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ProjectCategory;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectCategory;
use App\MoonShine\Resources\ProjectCategory\Pages\ProjectCategoryIndexPage;
use App\MoonShine\Resources\ProjectCategory\Pages\ProjectCategoryFormPage;
use App\MoonShine\Resources\ProjectCategory\Pages\ProjectCategoryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<ProjectCategory, ProjectCategoryIndexPage, ProjectCategoryFormPage, ProjectCategoryDetailPage>
 */
class ProjectCategoryResource extends ModelResource
{
    protected string $model = ProjectCategory::class;

    protected string $title = 'ProjectCategories';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProjectCategoryIndexPage::class,
            ProjectCategoryFormPage::class,
            ProjectCategoryDetailPage::class,
        ];
    }
}
