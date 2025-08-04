<div class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-2 border-bottom ">
    <button class="btn btn-outline-primary d-md-none me-2 rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" aria-controls="sidebarMobile" style="width: 40px; height: 40px;">
        <i class="bi bi-list"></i> 
    </button>

    <div class="flex-grow-1 text-center text-md-start ms-2">
        <h5 class="mb-0 fw-bold text-gradient">
            Admin Panel
        </h5>
    </div>

    @auth
    @php
        $admin = Auth::user();
        $unreadNotifications = $admin->unreadNotifications;
    @endphp

    <div class="d-flex align-items-center gap-3">

        {{-- Notification Bell --}}
        <div class="dropdown">
            <a href="#" class="btn btn-outline-primary position-relative" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.3rem;">
                <i class="bi bi-bell"></i>
                @if($unreadNotifications->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $unreadNotifications->count() }}
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" aria-labelledby="notificationDropdown" style="min-width: 320px; max-height: 400px; overflow-y: auto;">
                <li class="dropdown-header">Notifications</li>

                @if($unreadNotifications->count() > 0)
                    @foreach ($unreadNotifications as $notification)
                        <li>
                            <a href="{{ route('admin.bookings.show', $notification->data['booking_id']) }}" class="dropdown-item">
                                <div>
                                    <strong>{{ $notification->data['user_name'] }}</strong> booked a trip<br>
                                    {{ $notification->data['trip'] }} | Seats: {{ $notification->data['seats'] }}<br>
                                    <small class="text-muted">Total: {{ number_format($notification->data['total']) }} MMK</small><br>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="dropdown-item text-center text-muted">No new notifications</li>
                @endif

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form action="{{ route('admin.notifications.markAllRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-center text-primary">Mark all as read</button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- User Dropdown --}}
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2"></i>
                {{ $admin->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>

    </div>
    @endauth

</div>
