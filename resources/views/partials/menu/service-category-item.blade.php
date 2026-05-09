@php
    $depth = $depth ?? 0;
    $hasChildren = $category->allVisibleChildren->isNotEmpty();
    $menuService = $category->menuServices->first();
    $categoryUrl = $menuService ? route('services.show', $menuService) : '#';
    $itemClass = $depth === 0 ? 'nav-item submenu' : 'nav-item';
@endphp

<li class="{{ $itemClass }}">
    <a class="nav-link" href="{{ $categoryUrl }}">
        <span>{{ $category->title }}</span>
        @if($hasChildren)
            @if($depth === 0)
                <i class="fas fa-chevron-down custom-toggle-icon px-2"></i>
            @else
                <span class="menu-item-arrow ps-0">
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            @endif
        @endif
    </a>

    @if($hasChildren)
        <ul class="sub-menu">
            @foreach($category->allVisibleChildren as $child)
                @include('partials.menu.service-category-item', ['category' => $child, 'depth' => $depth + 1])
            @endforeach
        </ul>
    @endif
</li>
