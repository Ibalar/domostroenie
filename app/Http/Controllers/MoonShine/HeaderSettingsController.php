<?php

namespace App\Http\Controllers\MoonShine;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use MoonShine\Support\Enums\ToastType;

class HeaderSettingsController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'header_address' => 'nullable|string|max:255',
            'header_work_hours' => 'nullable|string|max:255',
            'header_phones' => 'nullable|array',
        ]);

        Setting::setValue('header_address', $request->input('header_address', ''), 'contacts', 'string');
        Setting::setValue('header_work_hours', $request->input('header_work_hours', ''), 'contacts', 'string');
        Setting::setValue('header_phones', json_encode($request->input('header_phones', [])), 'contacts', 'json');

        toast('Настройки шапки сохранены', ToastType::SUCCESS);

        return redirect()->back();
    }
}
