@extends('layouts.app')

@section('title', $service->title . ' — Услуга')

@section('content')
    <div class="sisf-banner position-relative">
        <div class="banner-img">
            <figure>
                <img src="{{ asset('images/page-banner-scaled-1.png') }}" alt="{{ $service->title }}">
            </figure>
        </div>
        <div class="sisf-page-title sisf-m sisf-title--standard sisf-alignment--center">
            <div class="sisf-m-inner">
                <div class="sisf-breadcrumbs text-center mb-3">
                    <a class="sisf-breadcrumbs-link text-white" href="{{ route('home') }}">
                        <span>Home</span>
                    </a>
                    <span class="sisf-breadcrumbs-separator text-white mx-2"><i class="fa-solid fa-chevron-right"></i></span>
                    @if($service->category)
                        <span class="sisf-breadcrumbs-current text-white">{{ $service->category->title }}</span>
                        <span class="sisf-breadcrumbs-separator text-white mx-2"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                    <span class="sisf-breadcrumbs-current text-white">{{ $service->title }}</span>
                </div>
                <div class="sisf-m-content sisf-content-grid">
                    <h1 class="sisf-m-title text-anime-style-3 text-center entry-title">{{ $service->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sisf-page-section section">
        <div class="sisf-grid sisf-layout--template">
            <div class="sisf-grid-inner container">
                @if($service->image)
                    <div class="row">
                        <div class="col-12">
                            <div class="sisf-blog-item-image mb-4">
                                <div class="sisf-e-media position-relative">
                                    <div class="sisf-e-media-image">
                                        <figure class="image-anime reveal">
                                            <img
                                                src="{{ asset('storage/' . $service->image) }}"
                                                class="image-fluid rounded-4"
                                                alt="{{ $service->title }}"
                                            >
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-9">
                        <div class="sisf-blog sisf-blog-single">
                            <div class="sisf-blog-item">
                                <div class="sisf-e-inner">
                                    <div class="sisf-e-content">
                                        @if($service->description)
                                            <div class="sisf-e-text wow fadeInUp mb-4">
                                                <p>{{ $service->description }}</p>
                                            </div>
                                        @endif

                                        @if($service->full_text)
                                            <div class="sisf-e-text wow fadeInUp">
                                                {!! $service->full_text !!}
                                            </div>
                                        @endif

                                        @foreach($service->blocks as $block)
                                            @php
                                                $blockTitle = $block->pivot->title ?: $block->title;
                                                $blockContent = $block->pivot->content ?: $block->content;
                                                $blockImage = $block->pivot->image ?: $block->image;
                                                $blockLink = $block->pivot->link ?: $block->full_link;
                                            @endphp
                                            <section class="mt-5">
                                                @if($blockTitle)
                                                    <h3 class="mb-3">{{ $blockTitle }}</h3>
                                                @endif

                                                @if($blockImage)
                                                    <div class="mb-3">
                                                        <img
                                                            src="{{ asset('storage/' . $blockImage) }}"
                                                            alt="{{ $blockTitle ?: $block->name }}"
                                                            class="image-fluid rounded-4"
                                                        >
                                                    </div>
                                                @endif

                                                @if($blockContent)
                                                    <div class="sisf-e-text">
                                                        {!! $blockContent !!}
                                                    </div>
                                                @endif

                                                @if($blockLink)
                                                    <div class="mt-3">
                                                        <a href="{{ $blockLink }}" class="btn-default">Подробнее</a>
                                                    </div>
                                                @endif
                                            </section>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="sisf-page-sidebar">
                            <div class="sidebar-widget widget_categories">
                                <h3 class="sidebar-title">Услуги</h3>
                                <div class="product-categories">
                                    <ul class="product-categories-list">
                                        @foreach($serviceCategories as $category)
                                            @foreach($category->menuServices as $categoryService)
                                                <li class="product-categories-list-item">
                                                    <a href="{{ route('services.show', $categoryService) }}">
                                                        <span>{{ $categoryService->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
