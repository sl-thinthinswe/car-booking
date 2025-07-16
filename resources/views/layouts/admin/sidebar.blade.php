<div class="offcanvas offcanvas-start d-md-none bg-light" tabindex="-1" id="sidebarMobile">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold">SeatSnap</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body px-3">
        <ul class="nav flex-column gap-4">
            @php
                $navItems = [
                    ['route' => 'dashboard', 'icon' => 'bi-speedometer2', 'label' => 'Dashboard'],
                    ['route' => 'admin.users.index', 'icon' => 'bi-people', 'label' => 'Users'],
                    ['route' => 'admin.cities.index', 'icon' => 'bi-building', 'label' => 'Cities'],
                    ['route' => 'admin.routes.index', 'icon' => 'bi-signpost-2', 'label' => 'Routes'],
                    ['route' => 'admin.vehicles.index', 'icon' => 'bi-truck', 'label' => 'Vehicles'],
                    ['route' => 'admin.seats.index', 'icon' => 'bi-grid-1x2', 'label' => 'Seats'],
                    ['route' => 'admin.trips.index', 'icon' => 'bi-map', 'label' => 'Trips'],
                    ['route' => 'admin.bookings.index', 'icon' => 'bi-ticket-perforated', 'label' => 'Bookings'],
                    ['route' => 'admin.booking_seats.index', 'icon' => 'bi-calendar-check', 'label' => 'Booking Seats'],
                ];
            @endphp

            @foreach ($navItems as $item)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center px-2 py-2 border-bottom {{ request()->routeIs(str_replace('.', '*', $item['route'])) ? 'fw-semibold text-dark' : 'text-muted' }}"
                       href="{{ route($item['route']) }}">
                        <i class="bi {{ $item['icon'] }} me-2"></i> {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<nav class="col-md-2 d-none d-md-block bg-light min-vh-100 border-end">
    <div class="p-3">
        <h5 class="fw-bold mb-4 pb-2">SeatSnap</h5>

        <ul class="nav flex-column gap-4">
            @foreach ($navItems as $item)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center px-2 py-2 border-bottom {{ request()->routeIs(str_replace('.', '*', $item['route'])) ? 'fw-semibold text-dark' : 'text-muted' }}"
                       href="{{ route($item['route']) }}">
                        <i class="bi {{ $item['icon'] }} me-2"></i> {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
