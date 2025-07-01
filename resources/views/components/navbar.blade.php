<header class="header py-2 shadow-sm">
    <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        <!-- Left side: Navigation -->
        <div class="d-flex align-items-center gap-3">
            <a class="nav-btn" href="{{ route('index') }}">Home</a>

            @auth
                @if (auth()->user()->roles !== 'admin')
                    <a class="nav-btn" href="{{ route('reward.index') }}">Reward</a>
                    <a class="nav-btn" href="{{ route('checkout') }}">Checkout</a>
                @endif
            @endauth
        </div>

        <!-- Right side: Auth -->
        <div class="d-flex align-items-center gap-3">
            @guest
                <a class="nav-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            @endguest

            @auth
                @if (auth()->user()->roles === 'admin')
                    <a class="nav-btn" href="{{ route('admin.dashboard') }}">Admin</a>
                    <a class="nav-btn" href="{{ route('reports.index') }}">Reports</a>
                @endif
                @if (auth()->user()->roles === 'user')
                    <a class="nav-btn" href="{{ route('profile') }}">Profile</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="nav-btn">Logout</button>
                </form>
            @endauth

            @auth
                <span class="fw-bold text-dark">Welcome, {{ auth()->user()->name }}</span>
            @endauth
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('loginAttempt') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
