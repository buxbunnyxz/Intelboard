@php
    $currentLocale = app()->getLocale();
@endphp
<header class="header-area bg-white mb-4 rounded-10 border border-white" id="header-area">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <div class="left-header-content">
                {{-- Hamburger Menu... --}}
                <ul class="d-flex ps-0 mb-0 list-unstyled justify-content-center justify-content-md-start">
                    <li class="d-xl-none">
                        <button class="header-burger-menu bg-transparent p-0 border-0 position-relative top-3"
                            id="header-burger-menu">
                            <span class="border-1 d-block for-dark-burger"
                                style="border-bottom: 1px solid #fff; height: 1px; width: 25px;"></span>
                            <span class="border-1 d-block for-dark-burger"
                                style="border-bottom: 1px solid #fff; height: 1px; width: 25px; margin: 6px 0;"></span>
                            <span class="border-1 d-block for-dark-burger"
                                style="border-bottom: 2px solid #fff; height: 1px; width: 25px;"></span>
                        </button>
                    </li>
                    <li class="moblog d-block d-md-none ms-3">
                        <img src="{{ asset('assets/images/logo_sm.png') }}" alt="logo-icon"
                            style="width: 35px; height: auto;"><span class="logo-text text-light fw-light spaced">
                            Intelboard</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-auto">
            <div class="right-header-content">
                <ul
                    class="d-flex align-items-center justify-content-center justify-content-md-end ps-0 mb-0 list-unstyled">
                    {{-- Language Item... --}}
                    <li class="header-right-item language-item">
                        @php
                            $availableLocales = config('app.available_locales', []);
                            $alternateLocale = null;

                            foreach ($availableLocales as $locale) {
                                if ($locale !== $currentLocale) {
                                    $alternateLocale = $locale;
                                    break;
                                }
                            }
                        @endphp
                        <div class="language-switcher">
                            @if ($alternateLocale)
                                <a href="{{ route('lang.switch', $alternateLocale) }}" class="language-switcher-btn"
                                    title="{{ strtoupper($alternateLocale) }}"
                                    aria-label="{{ 'Switch language to ' . strtoupper($alternateLocale) }}">
                                    <img src="{{ asset("assets/images/flags/$currentLocale.jpg") }}" height="16"
                                        width="24" alt="{{ strtoupper($currentLocale) }}">
                                </a>
                            @else
                                <span class="language-switcher-btn disabled">
                                    <img src="{{ asset("assets/images/flags/$currentLocale.jpg") }}" height="16"
                                        width="24" alt="{{ strtoupper($currentLocale) }}">
                                </span>
                            @endif
                        </div>
                    </li>

                    <li class="header-right-item">
                        <div class="dropdown admin-profile">
                            {{-- This trigger is now an <a> tag for reliability --}}
                            <a href="#"
                                class="d-flex align-items-center bg-transparent border-0 text-start p-0 cursor dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="flex-shrink-0 position-relative">
                                    <span id="user-initials"
                                        class="rounded-circle d-inline-flex align-items-center justify-content-center bg-secondary text-white"
                                        style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->full_name)[1] ?? '', 0, 1)) }}
                                    </span>
                                </div>
                            </a>
                            <div class="dropdown-menu border-0 bg-white dropdown-menu-end">
                                {{-- Your profile dropdown links... --}}
                                <div class="d-flex align-items-center info">
                                    <div class="flex-grow-1 text-center">
                                        <h3 class="fw-medium fs-15 mb-0">{{ Auth::user()->full_name }}</h3>
                                        <span class="fs-12 fw-light">{{ strtoupper(Auth::user()->role) }}</span>
                                    </div>
                                </div>
                                <ul class="admin-link mb-0 list-unstyled">
                                    <li>
                                        <a class="dropdown-item admin-item-link d-flex align-items-center text-body"
                                            href="{{ route('user.settings') }}">
                                            <i class="material-symbols-outlined">settings</i>
                                            <span class="ms-2">{{ __('messages.settings') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item admin-item-link d-flex align-items-center text-body"
                                            href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="material-symbols-outlined">logout</i>
                                            <span class="ms-2">{{ __('messages.logout') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
