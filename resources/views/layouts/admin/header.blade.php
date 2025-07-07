<div class="d-flex justify-content-between align-items-center py-3 border-bottom">
    <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
        ☰
    </button>

    <div>
        <h5 class="mb-0">Admin Panel</h5>
    </div>

    @auth
    <div class="dropdown">
        <a class="btn btn-sm btn-outline-secondary dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
    @endauth
</div>
