<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.header')
</head>

<body class="bg-body-bg" sidebar-dark-light-data-theme="sidebar-dark" header-dark-light-data-theme="header-dark">

    @include('layouts.partials.sidebar')

    <div class="container-fluid">
        <div class="main-content d-flex flex-column">

            @include('layouts.partials.topbar')

            <div class="main-content-container overflow-hidden">
                @yield('content')
            </div>

            <div class="flex-grow-1"></div>

            @include('layouts.partials.footer')
        </div>
    </div>

    @include('layouts.partials.scripts')
</body>

</html>
