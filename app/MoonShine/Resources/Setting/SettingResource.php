<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Setting;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;
use App\MoonShine\Resources\Setting\Pages\SettingIndexPage;
use App\MoonShine\Resources\Setting\Pages\SettingFormPage;
use App\MoonShine\Resources\Setting\Pages\SettingDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Setting, SettingIndexPage, SettingFormPage, SettingDetailPage>
 */
class SettingResource extends ModelResource
{
    protected string $model = Setting::class;

    protected string $title = 'Настройки сайта';

    protected string $column = 'key';

    protected bool $editInModal = true;

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            SettingIndexPage::class,
            SettingFormPage::class,
            SettingDetailPage::class,
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'key' => 'required|string|regex:/^[a-z0-9_]+$/|unique:settings,key,' . $item->id,
            'group' => 'required|string|max:50',
            'type' => 'required|in:string,text,boolean,number,json,array',
            'value' => 'nullable|string',
        ];
    }

    public function search(): array
    {
        return ['key', 'label', 'value'];
    }

    public function filters(): array
    {
        return [
            Text::make('Ключ', 'key'),
            Select::make('Группа', 'group')
                ->options([
                    'general' => 'Общие',
                    'contacts' => 'Контакты',
                    'social' => 'Соцсети',
                    'seo' => 'SEO',
                    'other' => 'Другое',
                ]),
        ];
    }
}
