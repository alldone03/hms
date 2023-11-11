<li class="sidebar-item @if (Request::path() == 'dashboard') active @endif">
    <a href="{{ route('dashboard') }}" class="sidebar-link ">
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="sidebar-item @if (Request::path() == 'history') active @endif">
    <a href="{{ route('history') }}" class="sidebar-link ">
        <i class="bi bi-grid-fill"></i>
        <span>History</span>
    </a>
</li>

@if (Auth::user()->role->id == 1)
    <li class="sidebar-item @if (Request::path() == 'managedevice') active @endif">
        <a href="{{ route('managedevice') }}" class="sidebar-link ">
            <i class="bi bi-grid-fill"></i>
            <span>Manage Device</span>
        </a>
    </li>
@endif
