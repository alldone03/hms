<li class="sidebar-item @if (Request::path() == 'dashboard') active @endif">
    <a href="{{ route('dashboard') }}" class="sidebar-link ">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>
</li>

@if (Auth::user()->role->id == 2 || Auth::user()->role->id == 1)
    {{-- <li class="sidebar-item @if (Request::path() == 'manageuser') active @endif">
        <a href="{{ route('manageuser') }}" class="sidebar-link ">
            <i class="bi bi-grid-fill"></i>
            <span>Manageuser</span>
        </a>
    </li>
    <li class="sidebar-item @if (Request::path() == 'logtap') active @endif">
        <a href="{{ route('logtap') }}" class="sidebar-link ">
            <i class="bi bi-grid-fill"></i>
            <span>Logtap</span>
        </a>
    </li> --}}
@endif
