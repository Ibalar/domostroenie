<!DOCTYPE html>
<html lang="ru">
<head>
    @include('partials.head')
</head>
<body>
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon">
                <figure class="reveal">
                    <img src="{{ asset('images/placeholder.png') }}" alt="MicroVilla">
                </figure>
            </div>
        </div>
    </div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.scripts')
</body>
</html>
