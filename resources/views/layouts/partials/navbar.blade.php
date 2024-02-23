<nav class="navbar navbar-expand-sm navbar-light bg-light justify-content-center">
    <ul class="nav justify-content-center  ">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('Login') }}">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">Index</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('permissions.index') }}">Permissions</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('users.index') }}">Users</a>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="nav-link" type="submit">Logout</button>
                </form>
            </li>
        @endguest
    </ul>
</nav>
