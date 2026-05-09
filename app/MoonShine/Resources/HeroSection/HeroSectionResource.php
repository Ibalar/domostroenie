<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\HeroSection;

use Illuminate\Database\Eloquent\Model;
use App\Models\HeroSection;
use App\MoonShine\Resources\HeroSection\Pages\HeroSectionIndexPage;
use App\MoonShine\Resources\HeroSection\Pages\HeroSectionFormPage;
use App\MoonShine\Resources\HeroSection\Pages\HeroSectionDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<HeroSection, HeroSectionIndexPage, HeroSectionFormPage, HeroSectionDetailPage>
 */
class HeroSectionResource extends ModelResource
{
    protected string $model = HeroSection::class;

    protected string $title = 'Главный экран';

    protected string $column = 'main_title';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            HeroSectionIndexPage::class,
            HeroSectionFormPage::class,
            HeroSectionDetailPage::class,
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'main_title' => 'nullable|string|max:255',
            'background_image' => 'nullable|string',
            'subtitles' => 'nullable|array',
            'button_primary_text' => 'nullable|string|max:100',
            'button_primary_url' => 'nullable|string|max:255',
            'button_secondary_text' => 'nullable|string|max:100',
            'button_secondary_url' => 'nullable|string|max:255',
        ];
    }

    public function search(): array
    {
        return ['main_title'];
    }
}
