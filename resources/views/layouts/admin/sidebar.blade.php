<div class="offcanvas offcanvas-start d-md-none bg-white shadow-sm" tabindex="-1" id="sidebarMobile">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-primary">SeatSnap</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body px-3">
        <ul class="nav flex-column gap-4">
            @php
                $navItems = [
                    ['route' => 'dashboard', 'icon' => 'speedometer', 'label' => 'Dashboard'],
                    ['route' => 'admin.users.index', 'icon' => 'people', 'label' => 'Users'],
                    ['route' => 'admin.cities.index', 'icon' => 'buildings', 'label' => 'Cities'],
                    ['route' => 'admin.routes.index', 'icon' => 'signpost', 'label' => 'Routes'],
                    ['route' => 'admin.vehicles.index', 'icon' => 'truck-front', 'label' => 'Vehicles'],
                    ['route' => 'admin.seats.index', 'icon' => 'grid', 'label' => 'Seats'],
                    ['route' => 'admin.trips.index', 'icon' => 'geo-alt', 'label' => 'Trips'],
                    ['route' => 'admin.bookings.index', 'icon' => 'ticket-perforated', 'label' => 'Bookings'],
                    ['route' => 'admin.booking_seats.index', 'icon' => 'calendar-check', 'label' => 'Booking Seats'],
                ];
            @endphp

            @foreach ($navItems as $item)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded {{ request()->routeIs(str_replace('.', '*', $item['route'])) ? 'bg-primary text-white fw-semibold' : 'text-dark' }}"
                       href="{{ route($item['route']) }}">
                        <i class="bi bi-{{ $item['icon'] }}"></i> {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<nav class="col-md-2 d-none d-md-block bg-white min-vh-100 border-end shadow-sm">
    <div class="p-3">
        <h5 class="fw-bold text-primary mb-4">SeatSnap</h5>

        <ul class="nav flex-column gap-4">
            @foreach ($navItems as $item)
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 rounded {{ request()->routeIs(str_replace('.', '*', $item['route'])) ? 'bg-primary text-white fw-semibold' : 'text-dark' }}"
                       href="{{ route($item['route']) }}">
                        <i class="bi bi-{{ $item['icon'] }}"></i> {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
