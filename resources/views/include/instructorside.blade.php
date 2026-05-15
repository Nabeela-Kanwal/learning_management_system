 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="{{ route('instructor.dashboard') }}" class="app-brand-link">
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
         <li class="menu-item {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
             <a href="{{ route('instructor.dashboard') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div>Dashboard</div>
             </a>
         </li>

         <li class="menu-item {{ request()->routeIs('instructor.course.*') ? 'active' : '' }}">
             <a href="{{ route('instructor.course.index') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-image"></i>
                 <div>Course</div>
             </a>
         </li>
     </ul>
 </aside>
