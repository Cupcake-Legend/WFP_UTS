<header class="header">
    <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex gap-3 me-4">
            @guest
                <a class="nav-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>


                <div class="modal" id = "loginModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('loginAttempt') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
