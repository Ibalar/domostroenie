<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        abort_unless($service->is_published, 404);

        $service->load([
            'category',
            'blocks' => fn ($query) => $query->where('is_active', true),
        ]);

        $serviceCategories = ServiceCategory::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->with(['menuServices' => fn ($query) => $query->where('id', '!=', $service->id)])
            ->get();

        return view('pages.service', compact('service', 'serviceCategories'));
    }
}
