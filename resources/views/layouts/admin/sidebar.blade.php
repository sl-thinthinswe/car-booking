<!-- Responsive Sidebar using Bootstrap Offcanvas -->
<div class="offcanvas offcanvas-start d-md-none bg-light" tabindex="-1" id="sidebarMobile">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title">SeatSnap</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item active mb-3 "><a class="nav-link text-muted border-bottom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="nav-item mb-3 "><a class="nav-link text-muted border-bottom" href="#">Users</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom {{ request()->routeIs('cities.*') ? 'active' : '' }}" href="{{ route('admin.cities.index') }}">Cities</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom {{ request()->routeIs('routes.*') ? 'active' : '' }}" href="{{ route('admin.routes.index') }}">Routes</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom {{ request()->routeIs('vehicles.*') ? 'active' : '' }}" href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom {{ request()->routeIs('seats.*') ? 'active' : '' }}" href="{{ route('admin.seats.index') }}">Seats</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom {{ request()->routeIs('trips.*') ? 'active' : '' }}" href="{{ route('admin.trips.index') }}">Trips</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">Bookings</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-muted border-bottom" href="#">Booking Seats</a></li>
        </ul>
    </div>
</div>


<nav class="col-md-2 d-none d-md-block bg-light min-vh-100">
    <div class="p-3">
        <h4>SeatSnap</h4>
        <ul class="nav flex-column mt-4">
            <li class="nav-item active mb-3 border-bottom"><a class="nav-link text-muted border-bottom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted" href="#">Users</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted {{ request()->routeIs('cities.*') ? 'active' : '' }}" href="{{ route('admin.cities.index') }}">Cities</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted {{ request()->routeIs('routes.*') ? 'active' : '' }}" href="{{ route('admin.routes.index') }}">Routes</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted {{ request()->routeIs('vehicles.*') ? 'active' : '' }}" href="{{ route('admin.vehicles.index') }}">Vehicles</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted {{ request()->routeIs('seats.*') ? 'active' : '' }}" href="{{ route('admin.seats.index') }}">Seats</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted {{ request()->routeIs('trips.*') ? 'active' : '' }}" href="{{ route('admin.trips.index') }}">Trips</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">Bookings</a></li>
            <li class="nav-item mb-3 border-bottom"><a class="nav-link text-muted" href="#">Booking Seats</a></li>
        </ul>
    </div>
</nav>
