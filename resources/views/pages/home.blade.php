@php
    use App\Models\HeroSection;
    $hero = HeroSection::getActive();
@endphp

@extends('layouts.app')

@section('title', 'MicroVilla — Главная')

@section('content')
    <div class="hero hero-slider">
        <div class="hero-slider-layout">
            <div class="hero-swiper">
                <div class="hero-slide">
                    <div class="hero-slider-image">
                        <img src="{{ $hero && $hero->background_image ? asset('storage/' . $hero->background_image) : asset('images/home_hero-bg.png') }}" alt="MicroVilla">
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="hero-content">
                                    <div class="section-title mb-3">
                                        @if($hero && $hero->subtitles)
                                            @foreach($hero->subtitles as $subtitle)
                                                <h3 class="sisf-subtitle text-anime-style-3 text-start">{{ $subtitle['text'] ?? $subtitle }}</h3>
                                            @endforeach
                                        @else
                                            <h3 class="sisf-subtitle text-anime-style-3 text-start">Строительство дачных домов, коттеджей под ключ</h3>
                                            <h3 class="sisf-subtitle text-anime-style-3 text-start">Комплексное строительство</h3>
                                            <h3 class="sisf-subtitle text-anime-style-3 text-start">Благоустройство территорий под ключ</h3>
                                            <h3 class="sisf-subtitle text-anime-style-3 text-start">Строительство бань под ключ</h3>
                                        @endif
                                        <h1 class="text-start text-anime-style-3">{!! $hero && $hero->main_title ? $hero->main_title : 'Все для <br>загородной жизни' !!}</h1>
                                        <div class="d-flex align-items-center">
                                            @if($hero && $hero->button_primary_text)
                                                <div class="hero-content-body me-4">
                                                    <a href="{{ $hero->button_primary_url ?? '#' }}" class="btn-slider"><span>{{ $hero->button_primary_text }}</span></a>
                                                </div>
                                            @else
                                                <div class="hero-content-body me-4">
                                                    <a href="#" class="btn-slider"><span>Наши услуги</span></a>
                                                </div>
                                            @endif
                                            @if($hero && $hero->button_secondary_text)
                                                <div class="sisf-m-button">
                                                    <a href="{{ $hero->button_secondary_url ?? '#' }}" class="btn-default btn-dark">{{ $hero->button_secondary_text }}<i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            @else
                                                <div class="sisf-m-button">
                                                    <a href="#" class="btn-default btn-dark">Готовые проекты<i class="fa-solid fa-arrow-right"></i></a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="hero-counters counter-item mb-4 position-relative">
                                            <div class="counter-title mb-2">
                                                <h2 class="d-flex align-items-center justify-content-center">
                                                    <span class="counter text-white">210</span>
                                                    <span class="sisf-digit-label text-white">+</span>
                                                </h2>
                                            </div>
                                            <div class="counter-content text-center">
                                                <span class="sisf-content text-white">Довольных клиентов</span>
                                            </div>
                                        </div>
                                        <div class="hero-counters counter-item position-relative">
                                            <div class="counter-title mb-2">
                                                <h2 class="d-flex align-items-center justify-content-center">
                                                    <span class="counter text-white">10</span>
                                                    <span class="sisf-digit-label text-white">+</span>
                                                </h2>
                                            </div>
                                            <div class="counter-content text-center">
                                                <span class="sisf-content text-white">Лет успешной работы</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="hero-counters counter-item mb-4 position-relative">
                                            <div class="counter-title mb-2">
                                                <h2 class="d-flex align-items-center justify-content-center">
                                                    <span class="counter text-white">2000</span>
                                                    <span class="sisf-digit-label text-white">+</span>
                                                </h2>
                                            </div>
                                            <div class="counter-content text-center">
                                                <span class="sisf-content text-white">Готовых проектов</span>
                                            </div>
                                        </div>
                                        <div class="hero-counters counter-item position-relative">
                                            <div class="counter-title mb-2">
                                                <h2 class="d-flex align-items-center justify-content-center">
                                                    <span class="counter text-white">5</span>
                                                </h2>
                                            </div>
                                            <div class="counter-content text-center">
                                                <span class="sisf-content text-white">Лет гарантия</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="letest-blog-section section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sisf-sis-section-title text-center section-title">
                        <h5 class="sisf-subtitle text-anime-style-3">Latest Blog</h5>
                        <h2 class="sisf-m-title text-anime-style-3"><span class="sisf-e-colored">We build</span> more than cabins</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
