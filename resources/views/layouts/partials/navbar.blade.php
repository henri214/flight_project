<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" data-auto-collapse-size="768"
                @guest
                    hidden
                @endguest><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('flights.index') }}" class="nav-link">
                <p>
                    Flights
                </p>
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto gap-4">
        @isset(auth()->user()->username)
            <li class="nav-item mt-2">
                <p>Welcome , {{ ucwords(auth()->user()->username) }}</p>
            </li>
        @endisset
        @guest
            <li class="nav-item">
                <a href="{{ route('authen.register') }}" class="nav-link">
                    <p>Register</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('authen.login') }}" class="nav-link">
                    <p>Login</p>
                </a>
            </li>
        @endguest
        <li class="nav-item  mt-2">
            <p>{{ now()->format('d-m-Y') }}</p>
            </a>
        </li>
    </ul>
</nav>
