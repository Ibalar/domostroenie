@php
    $depth = $depth ?? 0;
    $hasChildren = $page->allVisibleChildren->isNotEmpty();
    $itemClass = $depth === 0 ? 'nav-item submenu' : 'nav-item';
@endphp

<li class="{{ $itemClass }}">
    <a class="nav-link" href="{{ route('pages.show', $page) }}">
        <span>{{ $page->title }}</span>
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
            @foreach($page->allVisibleChildren as $child)
                @include('partials.menu.page-item', ['page' => $child, 'depth' => $depth + 1])
            @endforeach
        </ul>
    @endif
</li>
