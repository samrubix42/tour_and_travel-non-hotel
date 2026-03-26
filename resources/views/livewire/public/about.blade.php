<div>
    @section('meta_tags')
    <title>{{ $page->meta_title ?? ($page->page_title ?? 'About Us') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @endsection
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('{{asset('asset/image/heli.webp')}}')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <style>
                /* Scoped styles for About page profile social icons */
                .about-profile .social-icon {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 40px;
                    height: 40px;
                    border-radius: 8px;
                    background: #f3f4f6;
                    color: #374151 !important;
                    font-size: 16px;
                    text-decoration: none;
                    transition: all .18s ease-in-out;
                }
                .about-profile .social-icon i { color: #374151; }
                .about-profile .social-icon:hover { background: #e45b15; color: #fff !important; }
                /* Dark overlay for banners so text is readable */
                .bg-dark-overlay { background: rgba(0,0,0,0.55); }
                .interactive-banner-style-03 figcaption { position: relative; z-index: 3; }
            </style>
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Our journey</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">About Heliyatra & Holidays</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
    <section class="background-position-center-bottom background-no-repeat background-size-contain position-relative" style="background-image:url({{ asset('asset/images/demo-travel-agency-home-bg-02.png') }});">
        <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url({{ asset('asset/images/demo-travel-agency-about-bg-02.png') }})"></div>
        <div class="container">
            <div class="row align-items-center mb-5 md-mb-50px overflow-hidden">
                <div class="col-xl-6 col-lg-6 md-mb-30px position-relative">
                    <div class="atropos" data-atropos>
                        <div class="atropos-scale">
                            <div class="atropos-rotate">
                                <div class="atropos-inner">
                                    <img data-atropos-offset="5" src="{{ asset('asset/image/traveler.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6 text-center text-lg-start">
                    <h1 class="alt-font fw-600 text-dark-gray ls-minus-2px" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay":0, "staggervalue": 100, "easing": "easeOutQuad" }'>Elevating Your Spiritual Quest for Over 12 Years </h1>
                    <p class="w-85 md-w-100" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay":100, "staggervalue": 100, "easing": "easeOutQuad" }'> From the heart of New Delhi to the highest peaks of the Himalayas, we bridge the gap between devotion and accessibility. Founded by Naresh Sharma, an alumnus of JNV Bareilly, HeliYatra & Holidays was born from a vision to make India’s most sacred and remote shrines accessible to every pilgrim through specialized helicopter services and expert-led tours.</p>
                    <div class="d-inline-block mt-10px" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 800, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <a href="{{ route('destination') }}" class="btn btn-large btn-dark-gray btn-round-edge btn-hover-animation btn-box-shadow me-25px xs-me-15px">
                            <span>
                                <span class="btn-text">Destinations</span>
                                <span class="btn-icon"><i class="feather icon-feather-map-pin"></i></span>
                            </span>
                        </a>
                        <a href="mailto:info@heliyatraholidays.com" class="btn btn-link-gradient expand btn-extra-large text-dark-gray text-dark-gray-hover ls-0px">info@heliyatraholidays.com<span class="bg-dark-gray"></span></a>
                    </div>
                </div>
            </div>
        
            <div class="row justify-content-center mb-6 md-mb-8 xs-mb-60px" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-auto text-center last-paragraph-no-margin">
                   
                    <div class="d-inline-block text-dark-gray alt-font fs-30 align-middle ls-minus-1px">12 Years of experience and achieved some <span class="text-decoration-line-bottom fw-600 text-dark-gray">honorable awards.</span></div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="bg-very-light-gray background-position-center-bottom background-size-contain background-no-repeat pt-2" style="background-image:url('asset/images/demo-travel-agency-home-bg-05.png');">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <span class="fw-500 text-base-color text-uppercase d-inline-block">Brilliant reasons</span>
                    <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Why choose us?</h2>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 justify-content-center mb-5 sm-mb-8" data-anime='{"el": "childs", "translateY": [0, 0], "perspective": [1000,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <!-- start interactive banner item -->
                <div class="col interactive-banner-style-03 transition-inner-all md-mb-30px">
                    <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                        <figure class="m-0">
                            <div class="bg-dark-overlay position-absolute top-0px left-0px w-100 h-100"></div>
                            <img src="{{asset('asset/image/point1.jpg')}}" alt="" />
                            <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Helicopter Yatra Specialists</span>
                                <a href="demo-travel-agency-reviews.html" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-bookmark-heart align-middle icon-extra-medium me-10px"></i> We are industry leaders in organizing seamless aerial transfers to India's most remote shrines, making difficult pilgrimages accessible and efficient, especially for elderly and time-constrained travelers.</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- end interactive banner item -->
                <!-- start interactive banner item -->
                <div class="col interactive-banner-style-03 transition-inner-all md-mb-30px">
                    <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                        <figure class="m-0">
                            <div class="bg-dark-overlay position-absolute top-0px left-0px w-100 h-100"></div>
                            <img src="{{asset('asset/image/point2.jpg')}}" alt="" />
                            <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">12+ Years of Trusted Expertise.</span>
                                <a href="demo-travel-agency-reviews.html" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-award align-middle icon-extra-medium me-10px"></i>With a decade-plus legacy built on the trust of thousands of pilgrims, our seasoned team provides unrivaled reliability, safety, and operational excellence from our base in New Delhi.</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- end interactive banner item -->
                <!-- start interactive banner item -->
                <div class="col interactive-banner-style-03 transition-inner-all">
                    <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                        <figure class="m-0">
                            <div class="bg-dark-overlay position-absolute top-0px left-0px w-100 h-100"></div>
                            <img src="{{asset('asset/image/point3.jpg')}}" alt="" />
                            <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Comprehensive End-to-End Care.</span>
                                <a href="demo-travel-agency-reviews.html" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-shield-check align-middle icon-extra-medium me-10px"></i>We provide a total peace-of-mind guarantee, offering 24/7 on-ground support, expert local guides with deep traditional knowledge, and robust consumer protection plans throughout your sacred journey.</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- end interactive banner item -->
            </div>
            <div class="row mb-12 md-pb-13 md-mt-8 xs-pb-20" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 50, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-12 text-center">
                    <h4 class="alt-font text-dark-gray mb-0 ls-minus-1px fancy-text-style-4">Explore sacred Yatras across India Chardham &amp; beyond for <span class="fw-600" data-fancy-text='{ "effect": "wave", "direction": "up", "speed": 10, "string": ["Chardham pilgrims.", "devotional yatris.", "spiritual seekers."], "duration": 2500 }'></span></h4>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="pt-0">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <span class="fw-500 text-base-color text-uppercase d-inline-block">Our tour guide</span>
                    <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Travel expert</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="bg-white border-radius-8 p-4 p-lg-5 d-flex flex-column flex-lg-row align-items-center about-profile" style="box-shadow:0 10px 30px rgba(16,24,40,0.06);">
                        <div class="flex-shrink-0 text-center mb-3 mb-lg-0" style="width:220px;">
                            <img src="{{ asset('asset/image/naresh.png') }}" alt="Naresh Sharma" class="rounded-circle" style="width:160px;height:160px;object-fit:cover;border:6px solid #fff;box-shadow:0 12px 30px rgba(0,0,0,0.12);display:inline-block;">
                        </div>
                        <div class="ps-lg-4 flex-grow-1 text-center text-lg-start">
                            <h3 class="fw-700 mb-1">Naresh Sharma</h3>
                            <p class="text-muted mb-2">Co-founder &amp; Managing Director</p>
                            <p class="mb-3">An alumnus of JNV Bareilly, Naresh brings over 12 years of experience in the travel and hospitality sector. His passion for religious tourism and his commitment to streamlining difficult pilgrimages have been the driving force behind HeliYatra’s success.</p>
                            <div class="d-flex justify-content-center justify-content-lg-start gap-2">
                                <a href="https://www.facebook.com/nareshsharmajnv" target="_blank" rel="noopener noreferrer" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/naresh_sharma_jnv" target="_blank" rel="noopener noreferrer" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                                <a href="https://www.linkedin.com/in/naresh-sharma-b72a98201" target="_blank" rel="noopener noreferrer" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/@nareshsharmajnv" target="_blank" rel="noopener noreferrer" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>