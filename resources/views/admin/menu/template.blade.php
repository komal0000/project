<!-- Navbar Start -->
<style>
    @media(max-width:425px) {
        .h-logo {
            max-width: 250px;
        }

        .h-logo img {
            width: 100%;
        }
    }
</style>
@php
    $logo = getSetting('top_logo', true);
@endphp
<nav class="navbar navbar-expand-lg bg-white navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="/" class="navbar-brand ms-4 ms-lg-0">
        <h1 class="h-logo display-5 text-primary m-0">
            <img src="{{ asset($logo) }}" alt="">
        </h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">

            @foreach ($menus as $menu)
                @if ($menu->is_header)
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown">{{ $menu->name }}</a>
                        <div class="dropdown-menu border-light m-0">
                            @foreach ($menu->childs() as $child)
                                <a href="{{ $child->link }}" class="dropdown-item">{{ $child->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $menu->link }}" class="nav-item nav-link">{{ $menu->name }}</a>
                @endif
            @endforeach
        </div>

        @includeIf('front.includes.headersocial')
    </div>
</nav>
