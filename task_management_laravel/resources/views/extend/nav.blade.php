<!-- Topbar Start -->
<div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center">
                <small class="py-2">
                    <i class="far fa-clock text-primary me-2"></i>
                    খোলার সময়: শনিবার - বৃহস্পতিবার : ১০.০০ am - ৮.০০ pm, শুক্রবার বন্ধ
                </small>
            </div>
        </div>
        <div class="col-md-6 text-center text-lg-end">
            <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                <div class="me-3 pe-3 border-end py-2">
                    <p class="m-0"><i class="fa fa-envelope-open me-2"></i>info@example.com</p>
                </div>
                <div class="py-2">
                    <p class="m-0"><i class="fa fa-phone-alt me-2"></i>০১৮৯৬৫১১০৩৮ / ০১৮৯৬৫১১০৩৯</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-4 py-3 py-lg-0">
    <a href="{{ route('page.index') }}" class="navbar-brand p-0">
        <h1 class="m-0 text-primary d-flex align-items-center">
            <img src="{{ asset('asset/img/logo.webp') }}" alt="" style="max-width: 220px;">
        </h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('page.index') }}" class="nav-item nav-link {{ request()->routeIs('page.index') ? 'active' : '' }}">হোম</a>
            <a href="{{ route('page.about') }}" class="nav-item nav-link {{ request()->routeIs('page.about') ? 'active' : '' }}">আমাদের সম্পর্কে</a>
            <a href="{{ route('page.service') }}" class="nav-item nav-link {{ request()->routeIs('page.service') ? 'active' : '' }}">সেবা</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('page.price', 'page.team', 'page.testimonial', 'page.appointment') ? 'active' : '' }}" data-bs-toggle="dropdown">পেইজ</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('page.price') }}" class="dropdown-item {{ request()->routeIs('page.price') ? 'active' : '' }}">মূল্য পরিকল্পনা</a>
                    <a href="{{ route('page.team') }}" class="dropdown-item {{ request()->routeIs('page.team') ? 'active' : '' }}">আমাদের স্টাফ</a>
                    <a href="{{ route('page.testimonial') }}" class="dropdown-item {{ request()->routeIs('page.testimonial') ? 'active' : '' }}">মন্তব্য</a>
                    <a href="{{ route('page.appointment') }}" class="dropdown-item {{ request()->routeIs('page.appointment') ? 'active' : '' }}">অ্যাপয়েন্টমেন্ট</a>
                </div>
            </div>
            <a href="{{ route('page.contact') }}" class="nav-item nav-link {{ request()->routeIs('page.contact') ? 'active' : '' }}">যোগাযোগ</a>
            <a href="" class="nav-item nav-link">ইংরেজিতে দেখুন</a>
        </div>
        <!-- <button type="button" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#searchModal"><i
                class="fa fa-search"></i></button> -->
        <a href="{{route('page.appointment')}}" class="btn btn-primary py-2 px-4 ms-3">অ্যাপয়েন্টমেন্ট</a>
        <a href="{{route('login')}}" class="btn btn-primary py-2 px-4 ms-3">লগিন</a>
    </div>    
</nav>
<!-- Navbar End -->
