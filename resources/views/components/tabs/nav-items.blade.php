@php
    $prefix = $routePrefix ?? 'admin';
@endphp

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs($prefix . '.profile.index') ? 'active' : '' }}"
        href="{{ route($prefix . '.profile.index') }}">
        <i class="bx bx-user me-1"></i>
        Account
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs($prefix . '.profile.show.update.password') ? 'active' : '' }}"
        href="{{ route($prefix . '.profile.show.update.password') }}">
        <i class="bx bx-cog me-1"></i>
        Settings
    </a>
</li>

{{--
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs($prefix . '.profile.connections') ? 'active' : '' }}"
        href="{{ route($prefix . '.profile.connections') }}">
        <i class="bx bx-link-alt me-1"></i>
        Connections
    </a>
</li> --}}
