@php
    use App\Models\Setting;
    $address = Setting::getValue('header_address', 'г. Минск, ул. Примерная, 1');
    $workHours = Setting::getValue('header_work_hours', 'Пн-Пт: 9:00 - 18:00');
    $phonesRaw = Setting::getValue('header_phones', json_encode([
        ['label' => 'Основной', 'number' => '+375 (29) 123-45-67'],
        ['label' => 'Дополнительный', 'number' => '+375 (33) 765-43-21'],
    ]));
    $phones = is_string($phonesRaw) ? json_decode($phonesRaw, true) : $phonesRaw;
    if (!is_array($phones)) $phones = [];
@endphp

<header id="sisf-page-header" class="sisf-main-header sisf-standerd-header">
    <div class="header-top-bar sisf-skin--dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <div class="header-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{ $address }}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="header-top-item justify-content-center">
                        <i class="fa-regular fa-clock"></i>
                        <span>{{ $workHours }}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-end">
                    <div class="header-top-phones">
                        @foreach($phones as $phone)
                            @php
                                $phoneLink = preg_replace('/\D/', '', $phone['number'] ?? '');
                            @endphp
                            <div class="header-top-item justify-content-end">
                                <i class="fa-solid fa-phone"></i>
                                <div class="header-phone-info">
                                    @if(!empty($phone['label']))
                                        <small>{{ $phone['label'] }}</small>
                                    @endif
                                    <a href="tel:{{ $phoneLink }}">{{ $phone['number'] ?? '' }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sisf-page-header-inner" class="sisf-skin--dark position-relative pb-0 d-flex align-items-center">
        <div class="container p-0">
            <a class="navbar-brand sisf-header-logo-link mobile-block" href="{{ route('home') }}">
                <img src="{{ asset('images/logo_new.svg') }}" alt="Logo">
            </a>

            <div class="sisf-centered-header-wrapper sisf--header bg-white d-flex justify-content-between align-items-center">
                <a class="navbar-brand sisf-header-logo-link" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo_new.svg') }}" alt="Logo">
                </a>

                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item submenu"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                                @foreach(($menuServiceCategories ?? collect()) as $category)
                                    @include('partials.menu.service-category-item', ['category' => $category, 'depth' => 0])
                                @endforeach
                                <li class="nav-item submenu"><a class="nav-link" href="#">Property</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">Pages</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">Blogs</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="sisf-widget-holder sisf--two d-flex align-items-center">
                    <div class="full-width-search-bar me-4">
                        <div class="search-icon" id="openSearch">
                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                        <div class="search-overlay" id="searchOverlay">
                            <div class="search-with-icon position-relative">
                                <input type="text" placeholder="Search" class="search-input">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            <span class="close-btn" id="closeSearch">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar-toggle"></div>
            <div class="responsive-menu"></div>
        </div>
    </div>
</header>
