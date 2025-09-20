<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('drivers') }}" class="nav-link text-white">
                            <i class="mdi mdi-car"></i> {{ __('messages.drivers') }}
                        </a>
                    </li>
                    <li class="nav-item mt-0">
                        <a href="{{ route('payments.index') }}" class="nav-link text-white">
                            <i class="mdi mdi-receipt"></i> {{ __('messages.payments') }}
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
