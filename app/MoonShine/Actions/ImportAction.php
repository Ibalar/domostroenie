<?php

namespace App\MoonShine\Actions;

use MoonShine\Actions\Action;
use MoonShine\Fields\File;
use MoonShine\Fields\Select;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Fragment;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Modal;
use App\Services\ProjectImportService;

class ImportAction extends Action
{
    protected string $label = 'Импорт CSV';

    public function render(): Div
    {
        $form = FormBuilder::make()
            ->fields([
                File::make('CSV файл', 'file')
                    ->required()
                    ->accept('.csv,.txt')
                    ->removable(),

                Select::make('Режим импорта', 'mode')
                    ->options([
                        'create' => 'Только новые проекты',
                        'update' => 'Только обновление существующих',
                        'create_or_update' => 'Создать или обновить',
                    ])
                    ->default('create_or_update'),
            ])
            ->submit('Импортировать', ['class' => 'btn-primary']);

        $modal = Modal::make('Импорт проектов из CSV')
            ->form($form)
            ->async();

        return Fragment::make([
            $this->button($modal),
            $modal,
        ]);
    }

    public function handle(): void
    {
        $file = request()->file('file');
        $mode = request()->input('mode', 'create_or_update');

        try {
            $importService = new ProjectImportService();
            $result = $importService->import($file->getPathname(), $mode);

            $this->toast("Импорт завершен. Обработано: {$result['processed']}, Успешно: {$result['success']}, Ошибки: {$result['errors']}");

        } catch (\Exception $e) {
            $this->toast("Ошибка импорта: " . $e->getMessage(), 'error');
        }
    }
}
