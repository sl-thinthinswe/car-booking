<div class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-2 border-bottom">
    <button class="btn btn-outline-primary d-md-none me-2 rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" aria-controls="sidebarMobile" style="width: 40px; height: 40px;">
        <i class="bi bi-list"></i>
    </button>

    <div class="flex-grow-1 text-center text-md-start ms-2">
        <h5 class="mb-0 fw-bold text-gradient">
            Admin Panel
        </h5>
    </div>

    @auth
<<<<<<< HEAD
        @php
            $admin = Auth::user();
        @endphp

        <div class="d-flex align-items-center gap-3">
            {{-- User Dropdown --}}
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Display Profile Photo or Default Image -->
                    <img src="{{ $admin->profile_photo ? asset('storage/' . $admin->profile_photo) : asset('images/profile.jpg') }}" 
                         alt="Profile Photo" class="rounded-circle me-2" style="width: 30px; height: 30px; object-fit: cover;">
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
=======
    

    <div class="d-flex align-items-center gap-3">

        {{-- User Dropdown --}}
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2"></i>
                {{ Auth::user()->name }}

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
>>>>>>> 7333aa110a892c66278f7fe4ad54c673d85fa860
        </div>
    @endauth
</div>
