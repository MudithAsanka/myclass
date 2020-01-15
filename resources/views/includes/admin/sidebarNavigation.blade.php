<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <!--
            <li class="nav-title">Student</li>

            <li class="nav-item">
                <a href="index.html" class="nav-link active">
                    <i class="icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a href="#" class="nav-link">
                    <i class="icon icon-bell"></i> Notifications
                </a>
            </li>


            <li class="nav-title">Teacher</li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon icon-people"></i> Students
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon icon-envelope"></i> Messages
                </a>
            </li>
            -->
            @if(Auth::user()->admin == true)
            <li class="nav-title">Admin</li>

            <li class="nav-item">
                <a href="{{ route('adminDashboard') }}" class="nav-link {{ Route::currentRouteName() == 'adminDashboard' ? 'active':''}}">
                    <i class="icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('adminStudents') }}" class="nav-link {{ Route::currentRouteName() == 'adminStudents' ? 'active':''}}">
                    <i class="icon icon-people"></i> Students
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('adminTeachers') }}" class="nav-link {{ Route::currentRouteName() == 'adminTeachers' ? 'active':''}}">
                    <i class="icon icon-graduation"></i> Teachers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('adminPayments') }}" class="nav-link {{ Route::currentRouteName() == 'adminPayments' ? 'active':''}}">
                    <i class="icon icon-credit-card"></i> Payments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('adminMessages') }}" class="nav-link {{ Route::currentRouteName() == 'adminMessages' ? 'active':''}}">
                    <i class="icon icon-envelope"></i> Messages
                </a>
            </li>
            @endif
        </ul>
    </nav>
</div>
