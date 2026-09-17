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

        {{-- Manage Users --}}
        <li class="menu-item {{ setSidebar(['admin.user*', 'admin.instructor*']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div>Manage Users</div>
            </a>

            <ul class="menu-sub">

                {{-- Admin Users --}}
                <li class="menu-item {{ setSidebar(['admin.user*']) }}">
                    <a href="{{ route('admin.user.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div>Admin Users</div>
                    </a>
                </li>

                {{-- Instructors --}}
                <li class="menu-item {{ setSidebar(['admin.instructor*']) }}">
                    <a href="{{ route('admin.instructor.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                        <div>Instructors</div>
                    </a>
                </li>

            </ul>
        </li>

        {{-- Banner --}}
        <li class="menu-item {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
            <a href="{{ route('admin.banner.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image-alt"></i>
                <div>Banner</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.info.*') ? 'active' : '' }}">
            <a href="{{ route('admin.info.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i><div>Info Cards</div>
            </a>
        </li>
        {{-- Blogs --}}
        <li class="menu-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
            <a href="{{ route('admin.blog.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Blogs</div>
            </a>
        </li>

        {{-- Courses --}}
        <li class="menu-item {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
            <a href="{{ route('admin.courses.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-open"></i>
                <div>Courses</div>
            </a>
        </li>

        {{-- Manage Categories --}}
        <li class="menu-item {{ setSidebar(['admin.category*', 'admin.sub-category*']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Manage Categories</div>
            </a>

            <ul class="menu-sub">

                {{-- Categories --}}
                <li class="menu-item {{ setSidebar(['admin.category*']) }}">
                    <a href="{{ route('admin.category.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-category-alt"></i>
                        <div>Categories</div>
                    </a>
                </li>

                {{-- Sub Categories --}}
                <li class="menu-item {{ setSidebar(['admin.sub-category*']) }}">
                    <a href="{{ route('admin.sub-category.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-ul"></i>
                        <div>Sub Categories</div>
                    </a>
                </li>

            </ul>
        </li>

        {{-- Contact Inquiries --}}
        <li class="menu-item {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
            <a href="{{ route('admin.contact.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div>Contact Inquiries</div>
            </a>
        </li>

    </ul>
</aside>
