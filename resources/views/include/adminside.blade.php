<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <x-logos.main-logo />
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">LMS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- Dashboard --}}
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        {{-- Manage Categories --}}
        @php
            $categoryRoutes = ['admin.category*', 'admin.sub-category*'];
        @endphp

        <li class="menu-item {{ request()->routeIs($categoryRoutes) ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Layouts">Manage Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Categories</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.sub-category.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.sub-category.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Sub Categories</div>
                    </a>
                </li>
                <!-- Example static links -->
                <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">Container</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-fluid.html" class="menu-link">
                        <div data-i18n="Fluid">Fluid</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-blank.html" class="menu-link">
                        <div data-i18n="Blank">Blank</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
