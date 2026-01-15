<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Block;

use Illuminate\Database\Eloquent\Model;
use App\Models\Block;
use App\MoonShine\Resources\Block\Pages\BlockIndexPage;
use App\MoonShine\Resources\Block\Pages\BlockFormPage;
use App\MoonShine\Resources\Block\Pages\BlockDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Block, BlockIndexPage, BlockFormPage, BlockDetailPage>
 */
class BlockResource extends ModelResource
{
    protected string $model = Block::class;

    protected string $title = 'Блоки';
    protected string $column = 'name';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            BlockIndexPage::class,
            BlockFormPage::class,
            BlockDetailPage::class,
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => 'required|string|regex:/^[a-z0-9_]+$/|unique:blocks,name,' . $item->id,
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }

    public function search(): array
    {
        return ['name', 'title'];
    }

    public function filters(): array
    {
        return [
            Text::make('Системное имя', 'name'),
            Text::make('Заголовок', 'title'),
            Switcher::make('Активен', 'is_active'),
        ];
    }
}
