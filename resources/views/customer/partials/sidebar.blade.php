<div class="account-sidebar">
    <div class="account-sidebar-header">
        <img src="{{ auth()->user()->avatar_url }}" class="account-avatar">
        <div class="name">{{ auth()->user()->name }}</div>
        <div class="email">{{ auth()->user()->email }}</div>
    </div>
    <nav class="account-nav">
        @foreach([
            ['route' => 'account.dashboard', 'icon' => 'speedometer2', 'label' => 'Dashboard'],
            ['route' => 'account.orders',    'icon' => 'box',          'label' => 'My Orders'],
            ['route' => 'account.profile',   'icon' => 'person',       'label' => 'Profile'],
            ['route' => 'account.addresses', 'icon' => 'geo-alt',      'label' => 'Addresses'],
            ['route' => 'wishlist.index',    'icon' => 'heart',        'label' => 'Wishlist'],
        ] as $item)
        <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['route']) ? 'active' : '' }}">
            <i class="bi bi-{{ $item['icon'] }}"></i> {{ $item['label'] }}
        </a>
        @endforeach
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </nav>
</div>
