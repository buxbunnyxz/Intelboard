<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ __('messages.login_title') }} | Intelboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin login page" name="description" />
    <meta content="Intelboard" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
</head>

<body class="loading authentication-bg" data-layout-config='{"darkMode":false}'>

    @php
        $flagImages = ['en' => 'us.jpg', 'fr' => 'france.jpg'];
        $currentLocale = app()->getLocale();
    @endphp

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="{{ url('/') }}">
                                <svg width="228" height="36" viewBox="0 0 228 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <circle cx="18" cy="18" r="15" fill="#6AC0D7" />
                                        <circle cx="27" cy="18" r="15" fill="white" />
                                    </g>
                                    <text x="48" y="27" fill="white" font-family="Arial, Helvetica, sans-serif"
                                        font-size="24" font-weight="bold" letter-spacing="0.04em">INTELBOARD</text>
                                </svg>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="mt-2 mb-3 text-end" id="langswitcher">
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle text-muted p-0 arrow-none"
                                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                        aria-expanded="false">
                                        <img src="{{ asset('assets/images/flags/' . $flagImages[$currentLocale]) }}"
                                            alt="flag" class="me-1" height="12">
                                        <span
                                            class="align-middle">{{ $currentLocale === 'fr' ? 'Français' : 'English' }}</span>
                                        <i class="mdi mdi-chevron-down align-middle"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                        @foreach (config('app.available_locales') as $locale)
                                            <a href="{{ route('lang.switch', ['locale' => $locale]) }}"
                                                class="dropdown-item notify-item">
                                                <img src="{{ asset('assets/images/flags/' . $flagImages[$locale]) }}"
                                                    alt="{{ strtoupper($locale) }}" class="me-1" height="12">
                                                <span
                                                    class="align-middle">{{ $locale === 'fr' ? 'Français' : 'English' }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first() }}</strong>
                                </div>
                            @endif

                            <div class="vstack gap-2 mb-3">
                                <a href="{{ route('auth.google.redirect') }}"
                                    class="btn btn-light d-flex align-items-center justify-content-center gap-2">
                                    <svg width="20" height="20" viewBox="0 0 48 48">
                                        <path fill="#FFC107"
                                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                                        </path>
                                        <path fill="#FF3D00"
                                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                                        </path>
                                        <path fill="#4CAF50"
                                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                                        </path>
                                        <path fill="#1976D2"
                                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.574l6.19,5.238C42.022,35.545,44,30.035,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                                        </path>
                                    </svg>
                                    {{ __('messages.register_with_google') }}
                                </a>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress"
                                        class="form-label">{{ __('messages.login_email_label') }}</label>
                                    <input class="form-control" type="email" id="emailaddress" name="email" required
                                        placeholder="{{ __('messages.login_email_placeholder') }}"
                                        value="{{ old('email') }}">
                                </div>

                                <div class="mb-3">
                                    <a href="#"
                                        class="text-muted float-end"><small>{{ __('messages.login_forgot_password') }}</small></a>
                                    <label for="password"
                                        class="form-label">{{ __('messages.login_password_label') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            required placeholder="{{ __('messages.login_password_placeholder') }}">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                            name="remember" checked>
                                        <label class="form-check-label"
                                            for="checkbox-signin">{{ __('messages.login_remember_me') }}</label>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary"
                                        type="submit">{{ __('messages.login_button') }}</button>
                                </div>

                                <div class="mb-3 text-center">
                                    <a href="{{ route('register') }}" class="text-dark-50 fw-bold text-muted">
                                        {{ __('messages.login_no_account') }}
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>

    <footer class="footer footer-alt">
        2024 -
        <script>
            document.write(new Date().getFullYear())
        </script> © Intelboard
    </footer>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
