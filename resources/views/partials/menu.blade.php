<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @if(!auth()->user()->is_admin)
                <li class="nav-item">
                    <a href="{{ route("admin.balance.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-dollar">

                        </i>
                        My Credits
                    </a>
                </li>
            @endif
            {{-- @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route("admin.transactions.index") }}" class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-dollar nav-icon">

                        </i>
                        Transactions
                    </a>
                </li>
            @endcan --}}
            @can('car_access')
                <li class="nav-item">
                    <a href="{{ route("admin.cars.index") }}" class="nav-link {{ request()->is('admin/cars') || request()->is('admin/cars/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.car.title') }}
                    </a>
                </li>
            @endcan
            @can('event_access')
                <li class="nav-item">
                    <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is('admin/events') || request()->is('admin/events/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.event.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    {{ trans('global.systemCalendar') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("admin.searchCar") }}" class="nav-link {{ request()->is('admin/search-car') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    Search car
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
