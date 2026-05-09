<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MoonShine\HeaderSettingsController;
use MoonShine\Laravel\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Маршрут для сохранения настроек шапки (защищён аутентификацией MoonShine)
Route::post('admin/header-settings/save', [HeaderSettingsController::class, 'save'])
    ->middleware(Authenticate::class)
    ->name('header-settings.save');
