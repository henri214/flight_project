@auth
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">Dashboard Panel</a>

        <div class="sidebar">
            
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @can('admin', Auth::user())
                        <li class="nav-item ">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('pages.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <p>
                                    Flights
                                </p>
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item ">
                        <a href="{{ route('bookings.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Bookings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('authen.logout') }}" class="nav-link"
                            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('authen.logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
@endauth
