<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-top" style="height: 36px; width: auto;" />
        </a>

        <!-- Hamburger / Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links and dropdown -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side - Nav Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <!-- Add more nav links here -->
            </ul>
            

            <!-- Right Side - User Dropdown -->
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <!-- 🔹 Clear Cache Button -->
    <li class="nav-item me-3"> <!-- me-3 adds margin-end -->
        <form action="{{ route('cache.clear') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-dark btn-sm d-flex align-items-center mt-1" title="Clear Cache">
                <i class="bi bi-arrow-repeat me-2"></i> Cache Clear
            </button>
        </form>
    </li>

    <!-- User Dropdown -->
    <li class="nav-item">
    <a id="userDropdown" class="nav-link text-secondary" href="#" role="button"
       data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
       style="font-weight: 400;"> <!-- inline style ensures normal weight -->
        Welcome, {{ Auth::user()->name }}
    </a>


      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
    <li>
        <a class="dropdown-item" href="{{ route('profile.edit') }}">
            {{ __('Profile') }}
        </a>
    </li>
    <li><hr class="dropdown-divider" /></li>
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item">
                {{ __('Log Out') }}
            </button>
        </form>
    </li>
</ul>

        </div>
    </div>
</nav>
