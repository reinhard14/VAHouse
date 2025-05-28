<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link  {{ request()->segment(2) === 'dashboard' ? 'active' : '' }}">
            <i class="bi bi-file-bar-graph"></i>
            <p>Dashboard</p>
            </a>
        </li>

        @if($adminDepartment === 'Management Team' || $adminDepartment === 'Virtual Assistant Manager')
            <li class="nav-item">
                <a href="{{ route('administrator.edit-myinformation', Auth::id()) }}" class="nav-link  {{ request()->segment(2) === 'my-information' ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i>
                <p>My Information</p>
                </a>
            </li>
        @endif

        @if($adminDepartment !== 'Management Team' && $adminDepartment !== 'Virtual Assistant Manager')
            <li class="nav-item" >
                <a href="{{ route('administrator.index') }}" class="nav-link {{ request()->segment(2) === 'administrators' ? 'active' : '' }}">
                <i class="bi bi-person-fill-gear"></i>
                <p>Administrators</p>
                </a>
            </li>
        @endif

        @if($adminDepartment === 'Virtual Assistant Manager')
            <li class="nav-item" >
                <a href="{{ route('admin.users.vamIndex') }}" class="nav-link {{ (request()->segment(2) === 'users' && request()->segment(2) === 'users') ? 'active' : '' }}">
                <i class="bi bi-file-person"></i>
                <p>VAM Applicants List</p>
                </a>
            </li>
        @elseif($adminDepartment === 'Management Team')
            <li class="nav-item" >
                <a href="{{ route('admin.users.hrIndex') }}" class="nav-link {{ (request()->segment(2) === 'users' && request()->segment(2) === 'users') ? 'active' : '' }}">
                <i class="bi bi-file-person"></i>
                <p>HR Applicants List</p>
                </a>
            </li>
        @else
            <li class="nav-item" >
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ (request()->segment(2) === 'users' && request()->segment(2) === 'users') ? 'active' : '' }}">
                <i class="bi bi-file-person"></i>
                <p>Applicants</p>
                </a>
            </li>
        @endif

        @if($adminDepartment !== 'Management Team' && $adminDepartment !== 'Virtual Assistant Manager')
            <li class="nav-item {{ request()->segment(2) === 'department' ? 'menu-open' : 'menu' }}">
                <a href="{{ route('administrator.index') }}" class="nav-link">
                    <i class="bi bi-tools"></i>
                <p>Setup
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('department.index') }}" class="nav-link {{ request()->segment(2) === 'department' ? 'active' : '' }}">
                        <ion-icon name="id-card-outline"x></ion-icon>
                        <p>Department</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('administrator.index') }}" class="nav-link">
                        <ion-icon name="id-card-outline"></ion-icon>
                        <p>Notifications</p>
                        </a>
                    </li> --}}
                </ul>
            </li>
        @endif

        <li class="nav-header">ACCOUNT SETTINGS</li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p> {{ __('Logout') }}</p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</nav>

