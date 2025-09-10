<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
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
                <div>Dashboard</div>
            </a>
        </li>

        {{-- Manage Banners --}}
        <li class="menu-item {{ setSidebar(['admin.banner*', 'admin.sub-banner*']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-photo-album"></i>
                <div>Manage Banners</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ setSidebar(['admin.banner*']) }}">
                    <a href="{{ route('admin.banner.index') }}" class="menu-link">
                        <div>Banner</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ setSidebar(['admin.sub-banner*']) }}">
                    <a href="{{ route('admin.sub-banner.index') }}" class="menu-link">
                        <div>Sub Categories</div>
                    </a>
                </li> --}}
            </ul>
        </li>

        {{-- Manage Categories --}}
        <li class="menu-item {{ setSidebar(['admin.category*', 'admin.sub-category*']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Manage Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ setSidebar(['admin.category*']) }}">
                    <a href="{{ route('admin.category.index') }}" class="menu-link">
                        <div>Categories</div>
                    </a>
                </li>
                <li class="menu-item {{ setSidebar(['admin.sub-category*']) }}">
                    <a href="{{ route('admin.sub-category.index') }}" class="menu-link">
                        <div>Sub Categories</div>
                    </a>
                </li>
            </ul>
        </li>



        {{-- Manage Instructor --}}
        <li class="menu-item {{ setSidebar(['admin.category*', 'admin.instructor*']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Manage Instructor</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ setSidebar(['admin.instructor*']) }}">
                    <a href="{{ route('admin.instructor.index') }}" class="menu-link">
                        <div>Instructor</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ setSidebar(['admin.sub-category*']) }}">
                    <a href="{{ route('admin.sub-category.index') }}" class="menu-link">
                        <div>Sub Instructor</div>
                    </a>
                </li> --}}
            </ul>
        </li>



    </ul>
</aside>
