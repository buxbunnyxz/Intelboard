@include('layouts.partials.header')


<div class="content-page">
    <div class="content">
        @include('layouts.partials.topbar')
        @include('layouts.partials.sidebar')

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    @include('layouts.partials.footer')
</div>
