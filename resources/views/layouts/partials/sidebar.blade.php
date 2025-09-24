<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="d-block text-decoration-none position-relative">
            <img src="{{ asset('assets/images/logo_sm.png') }}" alt="logo-icon">
            <span class="logo-text text-secondary fw-semibold">Intelboard</span>
        </a>
        <button
            class="sidebar-burger-menu-close bg-transparent py-3 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu-close">
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #fff; height: 1px; width: 25px; transform: rotate(45deg);"></span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #fff; height: 1px; width: 25px; transform: rotate(-45deg);"></span>
        </button>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0" id="sidebar-burger-menu">
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #fff; height: 1px; width: 25px;"></span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #fff; height: 1px; width: 25px; margin: 6px 0;"></span>
            <span class="border-1 d-block for-dark-burger"
                style="border-bottom: 1px solid #fff; height: 1px; width: 25px;"></span>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        @include('layouts.partials.sidebar_menu')
    </aside>
</div>
