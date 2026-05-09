<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::with(['project', 'images'])
            ->published()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('portfolio.index', compact('portfolios'));
    }

    public function show(Portfolio $portfolio): View
    {
        $portfolio->load(['project', 'images', 'sections']);

        return view('portfolio.show', compact('portfolio'));
    }
}