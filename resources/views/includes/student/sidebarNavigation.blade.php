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
            @if(Auth::user()->student == true)
            <li class="nav-title">Student</li>

            <li class="nav-item">
                <a href="{{ route('studentDashboard') }}" class="nav-link {{ Route::currentRouteName() == 'studentDashboard' ? 'active':''}}">
                    <i class="icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                    <a href="{{ route('studentPayments') }}" class="nav-link {{ Route::currentRouteName() == 'studentPayments' ? 'active':''}}">
                        <i class="icon icon-credit-card"></i> Payments
                    </a>
                </li>
            <li class="nav-item">
                <a href="{{ route('studentMessages') }}" class="nav-link {{ Route::currentRouteName() == 'studentMessages' ? 'active':''}}">
                    <i class="icon icon-envelope"></i> Messages
                </a>
            </li>
            @endif
        </ul>
    </nav>
</div>
