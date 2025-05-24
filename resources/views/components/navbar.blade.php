<header class="header">
    <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex gap-3 me-4">
            @guest
                <a class="nav-btn" href = "{{ route('login') }}">Login</a>
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-btn">Logout</button>
                </form>

                @if (auth()->user()->roles == 'admin')
                    <a class="nav-btn" href = "{{ route('users.index') }}">User</a>
                @endif
            @endauth




            <button class="nav-btn">Menu</button>
            <button class="nav-btn">Reward</button>
        </div>
        <input class="search-bar" type="text" placeholder="Search Menu...">
    </div>
</header>
