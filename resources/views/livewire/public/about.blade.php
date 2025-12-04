<div>
    @section('meta_tags')
    <title>{{ $page->meta_title ?? ($page->page_title ?? 'About Us') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @endsection
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px"    style="background-image: url('{{asset('asset/image/demo-travel-agency-about-title-bg.jpg')}}')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Our journey</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">About us</h1>
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
                                    <img data-atropos-offset="5" src="{{ asset('asset/image/demo-travel-agency-about-01.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="position-absolute right-minus-20px md-right-70px bottom-100px xs-w-190px z-index-9" src="{{ asset('asset/images/demo-travel-agency-home-02.png') }}" alt="" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6 text-center text-lg-start">
                    <h1 class="alt-font fw-600 text-dark-gray ls-minus-2px" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay":0, "staggervalue": 100, "easing": "easeOutQuad" }'>Discover the world's leading travel agency.</h1>
                    <p class="w-85 md-w-100" data-anime='{ "el": "lines", "translateY": [30, 0], "opacity": [0,1], "delay":100, "staggervalue": 100, "easing": "easeOutQuad" }'>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem ipsum has been the industry's standard dummy text ever since. Lorem ipsum is simply dummy text.</p>
                    <div class="d-inline-block mt-10px" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 800, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <a href="demo-travel-agency-destinations.html" class="btn btn-large btn-dark-gray btn-round-edge btn-hover-animation btn-box-shadow me-25px xs-me-15px">
                            <span>
                                <span class="btn-text">Destinations</span>
                                <span class="btn-icon"><i class="feather icon-feather-map-pin"></i></span>
                            </span>
                        </a>
                        <a href="mailto:info@domain.com" class="btn btn-link-gradient expand btn-extra-large text-dark-gray text-dark-gray-hover ls-0px">info@domain.com<span class="bg-dark-gray"></span></a>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 justify-content-center align-items-center mb-5 sm-mb-40px" data-anime='{ "el": "childs", "translateY": [50, 0],"perspective": [1200,1200], "scale": [0.9,1], "rotateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col md-mb-30px">
                    <div class="border border-color-extra-medium-gray border-radius-6px text-center box-shadow-quadruple-large">
                        <div class="pt-10 pb-10">
                            <img src="{{ asset('asset/images/demo-hotel-and-resort-client-01.svg') }}" class="h-60px" alt="" />
                        </div>
                        <div class="border-top border-1 border-color-extra-medium-gray p-15px last-paragraph-no-margin">
                            <p class="text-dark-gray fw-500">2019 - Best of the best</p>
                        </div>
                    </div>
                </div>
                <div class="col md-mb-30px">
                    <div class="border border-color-extra-medium-gray border-radius-6px text-center box-shadow-quadruple-large">
                        <div class="pt-10 pb-10">
                            <img src="{{ asset('asset/images/demo-hotel-and-resort-client-02.svg') }}" class="h-60px" alt="" />
                        </div>
                        <div class="border-top border-1 border-color-extra-medium-gray p-15px last-paragraph-no-margin">
                            <p class="text-dark-gray fw-500">2020 - Travel of excellence</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="border border-color-extra-medium-gray border-radius-6px text-center box-shadow-quadruple-large">
                        <div class="pt-10 pb-10">
                            <img src="{{ asset('asset/images/demo-hotel-and-resort-client-03.svg') }}" class="h-60px" alt="" />
                        </div>
                        <div class="border-top border-1 border-color-extra-medium-gray p-15px last-paragraph-no-margin">
                            <p class="text-dark-gray fw-500">2021 - Responsible tourism</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-6 md-mb-8 xs-mb-60px" data-anime='{ "translateX": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-auto text-center last-paragraph-no-margin">
                    <div class="d-inline-block align-middle me-5px">
                        <img src="https://placehold.co/80x100" class="w-35px" alt="">
                    </div>
                    <div class="d-inline-block text-dark-gray alt-font fs-30 align-middle ls-minus-1px">10 Years of experience and achieved some <span class="text-decoration-line-bottom fw-600 text-dark-gray">honorable awards.</span></div>
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
                            <div class="bg-gradient-gray-light-dark-transparent position-absolute top-0px left-0px w-100 h-100 z-index-1"></div>
                            <img src="https://placehold.co/800x1100" alt="" />
                            <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Preferred style of accommodation.</span>
                                <a href="demo-travel-agency-reviews.html" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-bookmark-heart align-middle icon-extra-medium me-10px"></i>Superior service</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- end interactive banner item -->
                <!-- start interactive banner item -->
                <div class="col interactive-banner-style-03 transition-inner-all md-mb-30px">
                    <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                        <figure class="m-0">
                            <div class="bg-gradient-gray-light-dark-transparent position-absolute top-0px left-0px w-100 h-100 z-index-1"></div>
                            <img src="https://placehold.co/800x1100" alt="" />
                            <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">Our local guides and tour directors.</span>
                                <a href="demo-travel-agency-reviews.html" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-award align-middle icon-extra-medium me-10px"></i>Greatest guides</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- end interactive banner item -->
                <!-- start interactive banner item -->
                <div class="col interactive-banner-style-03 transition-inner-all">
                    <div class="position-relative overflow-hidden border-radius-6px last-paragraph-no-margin">
                        <figure class="m-0">
                            <div class="bg-gradient-gray-light-dark-transparent position-absolute top-0px left-0px w-100 h-100 z-index-1"></div>
                            <img src="https://placehold.co/800x1100" alt="" />
                            <figcaption class="d-flex flex-column w-100 h-100 p-60px lg-p-35px z-index-1">
                                <span class="mb-auto fs-24 text-white text-white-hover w-90 lg-w-100">The best consumer protection plan.</span>
                                <a href="demo-travel-agency-reviews.html" class="align-self-start fs-16 fw-500 ls-1px text-uppercase text-white"><i class="bi bi-shield-check align-middle icon-extra-medium me-10px"></i>Fully protected</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <!-- end interactive banner item -->
            </div>
            <div class="row mb-12 md-pb-13 md-mt-8 xs-pb-20" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 50, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-12 text-center">
                    <h4 class="alt-font text-dark-gray mb-0 ls-minus-1px fancy-text-style-4">World's hottest destinations for <span class="fw-600" data-fancy-text='{ "effect": "wave", "direction": "up", "speed": 10, "string": ["mountain lovers.", "nature lovers.", "independent tours."], "duration": 2500 }'></span></h4>
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
            <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2" data-anime='{ "el": "childs", "perspective": [1000,1200], "scale": [1.05, 1], "rotateY": [-30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <!-- start team member item -->
                <div class="col text-center team-style-01 mb-3 md-mb-30px">
                    <figure class="mb-0 hover-box box-hover position-relative">
                        <img src="https://placehold.co/600x736" alt="" class="border-radius-6px" />
                        <figcaption class="w-100 p-35px bg-white">
                            <div class="position-relative z-index-1 overflow-hidden">
                                <span class="d-block fw-600 fs-18 text-dark-gray lh-24">Jeremy dupont</span>
                                <p class="m-0">Executive officer</p>
                                <div class="social-icon hover-text mt-20px">
                                    <a href="https://www.facebook.com/" target="_blank" class="fw-600 text-dark-gray">Fb.</a>
                                    <a href="https://www.instagram.com/" target="_blank" class="fw-600 text-dark-gray">In.</a>
                                    <a href="https://www.twitter.com/" target="_blank" class="fw-600 text-dark-gray">Tw.</a>
                                    <a href="https://dribbble.com/" target="_blank" class="fw-600 text-dark-gray">Dr.</a>
                                </div>
                            </div>
                            <div class="box-overlay bg-white box-shadow-quadruple-large border-radius-6px"></div>
                        </figcaption>
                    </figure>
                </div>
                <!-- end team member item -->
                <!-- start team member item -->
                <div class="col text-center team-style-01 mb-3 md-mb-30px">
                    <figure class="mb-0 hover-box box-hover position-relative">
                        <img src="https://placehold.co/600x736" alt="" class="border-radius-6px" />
                        <figcaption class="w-100 p-35px bg-white">
                            <div class="position-relative z-index-1 overflow-hidden">
                                <span class="d-block fw-600 fs-18 text-dark-gray lh-24">Jessica dover</span>
                                <p class="m-0">Vice president</p>
                                <div class="social-icon hover-text mt-20px">
                                    <a href="https://www.facebook.com/" target="_blank" class="fw-600 text-dark-gray">Fb.</a>
                                    <a href="https://www.instagram.com/" target="_blank" class="fw-600 text-dark-gray">In.</a>
                                    <a href="https://www.twitter.com/" target="_blank" class="fw-600 text-dark-gray">Tw.</a>
                                    <a href="https://dribbble.com/" target="_blank" class="fw-600 text-dark-gray">Dr.</a>
                                </div>
                            </div>
                            <div class="box-overlay bg-white box-shadow-quadruple-large border-radius-6px"></div>
                        </figcaption>
                    </figure>
                </div>
                <!-- end team member item -->
                <!-- start team member item -->
                <div class="col text-center team-style-01 mb-3 md-mb-30px">
                    <figure class="mb-0 hover-box box-hover position-relative">
                        <img src="https://placehold.co/600x736" alt="" class="border-radius-6px" />
                        <figcaption class="w-100 p-35px bg-white">
                            <div class="position-relative z-index-1 overflow-hidden">
                                <span class="d-block fw-600 fs-18 text-dark-gray lh-24">Matthew taylor</span>
                                <p class="m-0">Financial officer</p>
                                <div class="social-icon hover-text mt-20px">
                                    <a href="https://www.facebook.com/" target="_blank" class="fw-600 text-dark-gray">Fb.</a>
                                    <a href="https://www.instagram.com/" target="_blank" class="fw-600 text-dark-gray">In.</a>
                                    <a href="https://www.twitter.com/" target="_blank" class="fw-600 text-dark-gray">Tw.</a>
                                    <a href="https://dribbble.com/" target="_blank" class="fw-600 text-dark-gray">Dr.</a>
                                </div>
                            </div>
                            <div class="box-overlay bg-white box-shadow-quadruple-large border-radius-6px"></div>
                        </figcaption>
                    </figure>
                </div>
                <div class="col text-center team-style-01 mb-3 md-mb-30px xs-mb-0">
                    <figure class="mb-0 hover-box box-hover position-relative">
                        <img src="https://placehold.co/600x736" alt="" class="border-radius-6px" />
                        <figcaption class="w-100 p-35px bg-white">
                            <div class="position-relative z-index-1 overflow-hidden">
                                <span class="d-block fw-600 fs-18 text-dark-gray lh-24">Daniel james</span>
                                <p class="m-0">People officer</p>
                                <div class="social-icon hover-text mt-20px">
                                    <a href="https://www.facebook.com/" target="_blank" class="fw-600 text-dark-gray">Fb.</a>
                                    <a href="https://www.instagram.com/" target="_blank" class="fw-600 text-dark-gray">In.</a>
                                    <a href="https://www.twitter.com/" target="_blank" class="fw-600 text-dark-gray">Tw.</a>
                                    <a href="https://dribbble.com/" target="_blank" class="fw-600 text-dark-gray">Dr.</a>
                                </div>
                            </div>
                            <div class="box-overlay bg-white box-shadow-quadruple-large border-radius-6px"></div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
</div>