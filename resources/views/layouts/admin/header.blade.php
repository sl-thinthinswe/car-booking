<div class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-2 border-bottom">
    
    <button class="btn btn-outline-secondary d-md-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" aria-controls="sidebarMobile">
        <i class="bi bi-list"></i> 
    </button>

    <div class="flex-grow-1 text-center text-md-start">
        <h5 class="mb-0 fw-semibold">Admin Panel</h5>
    </div>

    @auth
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
    @endauth

</div>
