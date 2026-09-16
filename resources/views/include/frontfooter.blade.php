<footer class="lms-footer">
    <div class="lms-footer-inner">
        <div class="lms-footer-grid">
            <div class="lms-footer-column">
                <div class="footer-item">
                    <a href="{{ route('home') }}" aria-label="LMS home" class="lms-footer-brand">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="LMS" class="footer__logo">
                    </a>
                    <p class="lms-footer-about">A little curiosity. A new skill.<br>A world of possibilities.</p>
                    <ul class="generic-list-item lms-footer-contact">
                        <li><a href="tel:+1631237884">+163 123 7884</a></li>
                        <li><a href="mailto:support@website.com">support@website.com</a></li>
                        <li>Melbourne, Australia, 105 South Park Avenue</li>
                    </ul>
                    <h3 class="fs-20 font-weight-semi-bold pt-4 pb-2">We are on</h3>
                    <ul class="social-icons social-icons-styled">
                        <li class="mr-1"><a href="#" class="facebook-bg" aria-label="Facebook"><i
                                    class="la la-facebook"></i></a>
                        </li>
                        <li class="mr-1"><a href="#" class="twitter-bg" aria-label="Twitter"><i
                                    class="la la-twitter"></i></a>
                        </li>
                        <li class="mr-1"><a href="#" class="instagram-bg" aria-label="Instagram"><i
                                    class="la la-instagram"></i></a>
                        </li>
                        <li class="mr-1"><a href="#" class="linkedin-bg" aria-label="LinkedIn"><i
                                    class="la la-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="lms-footer-column">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Company</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('contact') }}">Contact us</a></li>
                        <li><a href="{{ route('instructor.index') }}">Our instructors</a></li>
                        <li><a href="{{ route('contact') }}">Support</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="lms-footer-column">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Courses</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Hacking</a></li>
                        <li><a href="#">PHP Learning</a></li>
                        <li><a href="#">Spoken English</a></li>
                        <li><a href="#">Self-Driving Car</a></li>
                        <li><a href="#">Garbage Collectors</a></li>
                    </ul>
                </div>
            </div>
            <div class="lms-footer-column">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Categories</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        @foreach ($footerCategories as $footerCategory)
                            <li><a
                                    href="{{ route('category.index') }}#category-{{ $footerCategory->id }}">{{ $footerCategory->name }}</a>
                            </li>
                        @endforeach
                        <li><a href="{{ route('category.index') }}">View all categories</a></li>
                    </ul>
                </div>
            </div>
            <div class="lms-footer-column">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Resources</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="#">Learning Tips</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="{{ route('contact') }}">Help Center</a></li>
                    </ul>
                </div>
            </div>
            <div class="lms-footer-column">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Legal</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Refund Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="lms-footer-column">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Download App</h3>
                    <span class="section-divider section--divider"></span>
                    <div class="mobile-app">
                        <p class="pb-3 lh-24">Download our mobile app and learn on the go.</p>
                        <a href="#" class="d-block mb-2 hover-s"><img
                                src="{{ asset('frontend/images/appstore.png') }}" alt="App store"
                                class="img-fluid"></a>
                        <a href="#" class="d-block hover-s"><img
                                src="{{ asset('frontend/images/googleplay.png') }}" alt="Google play store"
                                class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lms-footer-bottom">
        <p>&copy; {{ date('Y') }} LMS. All rights reserved.</p>
        <span>Keep learning. Keep growing.</span>
        <a href="{{ route('contact') }}">Let’s talk <i class="la la-arrow-right" aria-hidden="true"></i></a>
    </div>
</footer>
<div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
</div>
<div class="tooltip_templates">
    <div id="tooltip_content_1">
        <div class="card card-item">
            <div class="card-body">
                <p class="card-text pb-2">By <a href="teacher-detail.html">Jose Portilla</a></p>
                <h5 class="card-title pb-1"><a href="course-details.html">The Business Intelligence Analyst
                        Course 2021</a></h5>
                <div class="d-flex align-items-center pb-1">
                    <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    <p class="text-success fs-14 font-weight-medium">Updated<span
                            class="font-weight-bold pl-1">November
                            2020</span></p>
                </div>
                <ul
                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>23 total hours</li>
                    <li>All Levels</li>
                </ul>
                <p class="card-text pt-1 fs-14 lh-22">The skills you need to become a BI Analyst - Statistics,
                    Database theory, SQL, Tableau – Everything is included</p>
                <ul class="generic-list-item fs-14 py-3">
                    <li><i class="la la-check mr-1 text-black"></i> Become an expert in Statistics, SQL, Tableau,
                        and problem solving</li>
                    <li><i class="la la-check mr-1 text-black"></i> Boost your resume with in-demand skills</li>
                    <li><i class="la la-check mr-1 text-black"></i> Gather, organize, analyze and visualize data
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn theme-btn flex-grow-1 mr-3"><i
                            class="la la-shopping-cart mr-1 fs-18"></i> Add to Cart</a>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tooltip_templates">
    <div id="tooltip_content_2">
        <div class="card card-item">
            <div class="card-body">
                <p class="card-text pb-2">By <a href="teacher-detail.html">Jose Portilla</a></p>
                <h5 class="card-title pb-1"><a href="course-details.html">Ultimate Adobe Photoshop Training:
                        From Beginner to Pro</a></h5>
                <div class="d-flex align-items-center pb-1">
                    <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    <p class="text-success fs-14 font-weight-medium">Updated<span
                            class="font-weight-bold pl-1">November 2020</span></p>
                </div>
                <ul
                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>23 total hours</li>
                    <li>All Levels</li>
                </ul>
                <p class="card-text pt-1 fs-14 lh-22">The skills you need to become a BI Analyst - Statistics,
                    Database theory, SQL, Tableau – Everything is included</p>
                <ul class="generic-list-item fs-14 py-3">
                    <li><i class="la la-check mr-1 text-black"></i> Become an expert in Statistics, SQL, Tableau,
                        and problem solving</li>
                    <li><i class="la la-check mr-1 text-black"></i> Boost your resume with in-demand skills</li>
                    <li><i class="la la-check mr-1 text-black"></i> Gather, organize, analyze and visualize data
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn theme-btn flex-grow-1 mr-3"><i
                            class="la la-shopping-cart mr-1 fs-18"></i> Add to Cart</a>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tooltip_templates">
    <div id="tooltip_content_3">
        <div class="card card-item">
            <div class="card-body">
                <p class="card-text pb-2">By <a href="teacher-detail.html">Jose Portilla</a></p>
                <h5 class="card-title pb-1"><a href="course-details.html">The Complete WordPress Website
                        Business Course</a></h5>
                <div class="d-flex align-items-center pb-1">
                    <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    <p class="text-success fs-14 font-weight-medium">Updated<span
                            class="font-weight-bold pl-1">November 2020</span></p>
                </div>
                <ul
                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>23 total hours</li>
                    <li>All Levels</li>
                </ul>
                <p class="card-text pt-1 fs-14 lh-22">The skills you need to become a BI Analyst - Statistics,
                    Database theory, SQL, Tableau – Everything is included</p>
                <ul class="generic-list-item fs-14 py-3">
                    <li><i class="la la-check mr-1 text-black"></i> Become an expert in Statistics, SQL, Tableau,
                        and problem solving</li>
                    <li><i class="la la-check mr-1 text-black"></i> Boost your resume with in-demand skills</li>
                    <li><i class="la la-check mr-1 text-black"></i> Gather, organize, analyze and visualize data
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn theme-btn flex-grow-1 mr-3"><i
                            class="la la-shopping-cart mr-1 fs-18"></i> Add to Cart</a>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tooltip_templates">
    <div id="tooltip_content_4">
        <div class="card card-item">
            <div class="card-body">
                <p class="card-text pb-2">By <a href="teacher-detail.html">Jose Portilla</a></p>
                <h5 class="card-title pb-1"><a href="course-details.html">The Ultimate Drawing Course - Beginner
                        to Advanced</a></h5>
                <div class="d-flex align-items-center pb-1">
                    <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    <p class="text-success fs-14 font-weight-medium">Updated<span
                            class="font-weight-bold pl-1">November 2020</span></p>
                </div>
                <ul
                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>23 total hours</li>
                    <li>All Levels</li>
                </ul>
                <p class="card-text pt-1 fs-14 lh-22">The skills you need to become a BI Analyst - Statistics,
                    Database theory, SQL, Tableau – Everything is included</p>
                <ul class="generic-list-item fs-14 py-3">
                    <li><i class="la la-check mr-1 text-black"></i> Become an expert in Statistics, SQL, Tableau,
                        and problem solving</li>
                    <li><i class="la la-check mr-1 text-black"></i> Boost your resume with in-demand skills</li>
                    <li><i class="la la-check mr-1 text-black"></i> Gather, organize, analyze and visualize data
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn theme-btn flex-grow-1 mr-3"><i
                            class="la la-shopping-cart mr-1 fs-18"></i> Add to Cart</a>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tooltip_templates">
    <div id="tooltip_content_5">
        <div class="card card-item">
            <div class="card-body">
                <p class="card-text pb-2">By <a href="teacher-detail.html">Jose Portilla</a></p>
                <h5 class="card-title pb-1"><a href="course-details.html">The Complete Digital Marketing Course
                        - 12 Courses in 1</a></h5>
                <div class="d-flex align-items-center pb-1">
                    <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    <p class="text-success fs-14 font-weight-medium">Updated<span
                            class="font-weight-bold pl-1">November 2020</span></p>
                </div>
                <ul
                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>23 total hours</li>
                    <li>All Levels</li>
                </ul>
                <p class="card-text pt-1 fs-14 lh-22">The skills you need to become a BI Analyst - Statistics,
                    Database theory, SQL, Tableau – Everything is included</p>
                <ul class="generic-list-item fs-14 py-3">
                    <li><i class="la la-check mr-1 text-black"></i> Become an expert in Statistics, SQL, Tableau,
                        and problem solving</li>
                    <li><i class="la la-check mr-1 text-black"></i> Boost your resume with in-demand skills</li>
                    <li><i class="la la-check mr-1 text-black"></i> Gather, organize, analyze and visualize data
                    </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn theme-btn flex-grow-1 mr-3"><i
                            class="la la-shopping-cart mr-1 fs-18"></i> Add to Cart</a>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
