<nav class="navbar page-header">
    <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
        <i class="fa fa-bars"></i>
    </a>

    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('admin/assets/imgs/logo.png') }}" alt="logo">
    </a>

    <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
        <i class="fa fa-bars"></i>
    </a>

    <ul class="navbar-nav ml-auto">
        <!--
        <li class="nav-item d-md-down-none">
            <a href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>

        <li class="nav-item d-md-down-none">
            <a href="#">
                <i class="fa fa-envelope-open"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('admin/assets/imgs/avatar-5.png') }}" class="avatar avatar-sm" alt="logo">
                <span class="small ml-1 d-md-down-none">{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Account</div>

                <a href="{{ route('adminProfile') }}" class="dropdown-item">
                    <i class="fa fa-user"></i> Profile
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope"></i> Messages
                </a>

                <div class="dropdown-header">Settings</div>

                <a href="#" class="dropdown-item">
                    <i class="fa fa-bell"></i> Notifications
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fa fa-wrench"></i> Settings
                </a>

                <form method="POST" id="logout-form" action="{{ route('logout') }}">@csrf</form>
                <a href="#" onclick="document.getElementById('logout-form').submit();" class="dropdown-item">
                    <i class="fa fa-lock"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
