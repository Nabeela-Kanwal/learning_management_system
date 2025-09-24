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
         <!-- Dashboard -->
         <li class="menu-item active">
             <a href="{{ route('instructor.dashboard') }}" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-home-circle"></i>
                 <div data-i18n="Analytics">Dashboard</div>
             </a>
         </li>

         <!-- Layouts -->
         {{-- Manage Courses --}}
         <li class="menu-item {{ setSidebar(['instructor.course*', 'instructor.sub-course*']) }}">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-photo-album"></i>
                 <div>Manage Courses</div>
             </a>
             <ul class="menu-sub">
                 <li class="menu-item {{ setSidebar(['instructor.course*']) }}">
                     <a href="{{ route('instructor.course.index') }}" class="menu-link">
                         <div>Course List</div>
                     </a>
                 </li>
                 {{-- <li class="menu-item {{ setSidebar(['instructor.sub-course*']) }}">
                    <a href="{{ route('instructor.sub-course.index') }}" class="menu-link">
                        <div>Sub Categories</div>
                    </a>
                </li> --}}
             </ul>
         </li>
     </ul>
 </aside>
