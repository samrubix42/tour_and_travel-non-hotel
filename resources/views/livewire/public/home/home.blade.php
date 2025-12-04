<div>
    @section('meta_tags')
    <title>{{ $page->meta_title ?? ($page->page_title ?? 'Home - Explore Tours & Hotels') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @endsection

    <main>
        <style>
            .swiper-pagination-bullet {
                background: #cfd8dc !important;
                width: 10px;
                height: 10px;
                opacity: 1 !important;
            }

            .swiper-pagination-bullet-active {
                background: #d2a057 !important;
            }
        </style>
        <section class="p-0 full-screen md-h-600px sm-h-650px">
            <div class="swiper h-100 magic-cursor swiper-light-pagination" data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-pagination-bullets", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                    <div class="swiper-slide cover-background" style="background-image:url('{{ $banner->image_url ?? asset($banner->storage_path) }}');">
                        <div class="container h-100">
                            <div class="row align-items-center h-100 xl-ps-10 sm-ps-0">
                                <div class="col-xxl-7 col-xl-10 text-white" style="margin-top: 80px;">
                                    <h1 class="fw-600">{{ $banner->title }}</h1>
                                    @if($banner->subtitle)
                                    <div class="fs-20 opacity-6 mb-40px sm-mb-30px">{{ $banner->subtitle }}</div>
                                    @endif
                                    @if($banner->button_text && $banner->button_url)
                                    <div class="lg-mb-8 md-mb-0">
                                        <a href="{{ $banner->button_url }}" class="btn btn-white btn-extra-large btn-round-edge fw-700 btn-box-shadow me-35px">{{ $banner->button_text }}</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- start slider navigation -->
                <div class="slider-one-slide-prev-1 icon-very-medium text-white swiper-button-prev slider-navigation-style-06 bg-black-transparent-medium h-60px w-60px d-none d-sm-flex border-radius-100"><i class="bi bi-arrow-left-short"></i></div>
                <div class="slider-one-slide-next-1 icon-very-medium text-white swiper-button-next slider-navigation-style-06 bg-black-transparent-medium h-60px w-60px d-none d-sm-flex border-radius-100"><i class="bi bi-arrow-right-short"></i></div>
                <!-- end slider navigation -->
            </div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="position-relative pb-0 xs-pt-30px">
            <div class="w-100 h-70px position-absolute top-minus-70px md-top-minus-50px left-0px" style="background-image:url('{{ asset("asset/images/demo-travel-agency-slider-07.png") }}');"></div>
        </section>
        <!-- end section -->
        <!-- start section -->
        <section class="extra-big-section background-position-center-bottom background-size-contain background-no-repeat position-relative pt-0" style="background-image:url('{{ asset('asset/images/demo-travel-agency-home-bg-02.png') }}');">
            <div class="position-absolute left-0px bottom-minus-50px d-none d-lg-inline-block" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
                <img src="{{ asset('asset/image/demo-travel-agency-home-bg-01.png') }}" alt="" />
            </div>

            <div class="container background-position-right background-no-repeat sm-mb-10 xs-mb-15" style="background-image:url('{{ asset('asset/image/demo-travel-agency-home-bg.png') }}');">
                <div class="row align-items-center position-relative mb-7">
                    <div class="position-absolute left-0px top-0px h-100 w-130px border-end border-color-extra-medium-gray d-none d-md-inline-block">
                        <div class="vertical-title-center align-items-center justify-content-center">
                            <div class="title fs-24 alt-font text-base-color fw-600 text-uppercase">Explore the world</div>
                        </div>
                    </div>

                    <div class="col-lg-1 col-md-2 d-none d-md-inline-block">
                        <div class="divider-dot d-flex align-items-center w-100 h-200px"></div>
                    </div>

                    <!-- LEFT CONTENT -->
                    <div class="col-lg-5 col-md-9 offset-md-1">
                        <h1 class="alt-font fw-600 text-dark-gray ls-minus-3px w-90 xl-w-100 mb-30px">
                            Discover your next unforgettable journey.
                        </h1>

                        <p class="w-75 lg-w-100">
                            From weekend getaways to international adventures, we bring you handpicked travel experiences designed for comfort, value, and excitement.
                        </p>

                        <div class="d-inline-block mt-5px">
                            <a href="#" class="btn btn-large btn-round-edge btn-dark-gray btn-hover-animation btn-box-shadow me-25px">
                                <span><span class="btn-text">About us</span><span class="btn-icon"><i class="feather icon-feather-feather"></i></span></span>
                            </a>

                            <a href="#" class="btn btn-link-gradient expand btn-extra-large text-dark-gray text-dark-gray-hover ls-0px">
                                Explore tours<span class="bg-dark-gray"></span>
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT IMAGE -->
                    <div class="col-lg-4 col-md-8 position-relative offset-lg-1 offset-md-4 ps-0 sm-ps-15px md-mt-50px">
                        <img src="{{ asset('asset/image/demo-travel-agency-home-01.jpg') }}" class="border-radius-6px md-w-100" alt="">
                        <img class="position-absolute left-minus-120px top-80px sm-top-0px sm-w-160px sm-left-0px" src="{{ asset('asset/images/demo-travel-agency-home-02.png') }}" alt="">
                    </div>
                </div>

                <!-- FEATURES -->
                <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 justify-content-center">

                    <div class="col icon-with-text-style-01 md-mb-30px">
                        <div class="feature-box feature-box-left-icon-middle">
                            <div class="feature-box-icon"><i class="line-icon-Medal-2 icon-large text-base-color"></i></div>
                            <div class="feature-box-content">
                                <span class="alt-font text-dark-gray fw-500 fs-22">Superior service</span>
                                <p>Guidance and support at every step of your journey.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col icon-with-text-style-01 md-mb-30px">
                        <div class="feature-box feature-box-left-icon-middle">
                            <div class="feature-box-icon"><i class="line-icon-Globe icon-large text-base-color"></i></div>
                            <div class="feature-box-content">
                                <span class="alt-font text-dark-gray fw-500 fs-22">Best prices</span>
                                <p>Affordable packages without compromising quality.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col icon-with-text-style-01 xs-mb-30px">
                        <div class="feature-box feature-box-left-icon-middle">
                            <div class="feature-box-icon"><i class="line-icon-Administrator icon-large text-base-color"></i></div>
                            <div class="feature-box-content">
                                <span class="alt-font text-dark-gray fw-500 fs-22">Expert guides</span>
                                <p>Local experts who make every trip more meaningful.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col icon-with-text-style-01">
                        <div class="feature-box feature-box-left-icon-middle">
                            <div class="feature-box-icon"><i class="line-icon-Police icon-large text-base-color"></i></div>
                            <div class="feature-box-content">
                                <span class="alt-font text-dark-gray fw-500 fs-22">Secure travel</span>
                                <p>Safe, protected, and trusted travel experiences.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- end section -->
        <section class="bg-very-light-gray background-position-center-bottom background-size-contain background-no-repeat pt-2 pb-6" style="background-image:url('{{ asset('asset/images/demo-travel-agency-home-bg-05.png') }}');">
            <div class="container">
                <div class="row justify-content-center mb-3">
                    <div class="col-lg-6 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <span class="fw-500 text-base-color text-uppercase d-inline-block">Most popular tours</span>
                        <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Popular Destinations</h2>
                    </div>
                </div>
                <div class="row row-cols-1 justify-content-center mb-10 md-mb-5 xs-mb-10">
                    <!-- start content carousal item -->
                    <div class="col position-relative" data-anime='{ "opacity": [0,1], "duration": 800, "delay": 50, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="swiper slider-four-slide magic-cursor swiper-number-navigation-style" data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "pagination": { "el": ".swiper-pagination", "clickable": true }, "autoplay": { "delay": 4000, "disableOnInteraction": false }, "navigation": { "nextEl": ".slider-four-slide-next", "prevEl": ".slider-four-slide-prev" }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1400": { "slidesPerView": 4 }, "1200": { "slidesPerView": 3 }, "992": { "slidesPerView": 3 }, "576": { "slidesPerView": 2 } }, "effect": "slide" }' data-swiper-number-navigation="true" data-swiper-show-progress="true">
                            <div class="swiper-wrapper pb-5 md-pb-6">
                                @foreach($featuredDestinations ?? [] as $destination)
                                <div class="swiper-slide">
                                    <div class="interactive-banner-style-01 text-center last-paragraph-no-margin mb-30px">
                                        <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden" style="height:360px;">
                                            <img src="{{ $destination->image ?? 'https://placehold.co/600x600' }}" alt="{{ $destination->name }}" style="width:100%;height:100%;object-fit:cover;">
                                            <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>

                                            <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                                                <div class="position-relative z-index-1">
                                                    <a href="#" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large">
                                                        <i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i>
                                                    </a>
                                                    <a href="#" class="alt-font fs-22 fw-500 text-white d-block text-uppercase">{{ $destination->name }}</a>
                                                </div>
                                                <div class="box-overlay bg-dark-gray"></div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- start slider pagination -->
                            <div class="swiper-navigation-wrapper d-flex align-items-center justify-content-center">
                                <div class="swiper-button-previous-nav swiper-button-prev slider-four-slide-prev"><i class="feather icon-feather-arrow-left icon-small text-dark-gray"></i>
                                    <div class="number-prev fs-14 fw-500"></div>
                                </div>
                                <div class="swiper-pagination-progress w-200px xs-w-150px bg-medium-gray-transparent"><span class="swiper-progress"></span></div>
                                <div class="swiper-button-next-nav swiper-button-next slider-four-slide-next">
                                    <div class="number-next fs-14 fw-500"></div><i class="feather icon-feather-arrow-right icon-small text-dark-gray"></i>
                                </div>
                            </div>
                            <!-- end slider pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- start section -->
        <section class="pt-0">
            @foreach($categories as $category)
            <section class="pt-0">
                <div class="container">
                    <div class="row justify-content-center mb-3">
                        <div class="col-lg-6 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <span class="fw-500 text-base-color text-uppercase d-inline-block">{{ $category->description ?? ('Category: ' . $category->name) }}</span>
                            <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">{{ $category->name }}</h2>
                        </div>
                    </div>

                    <!-- SLIDER for destinations in this category -->
                    @if($category->destinations->count())
                    <div class="swiper slider-one-slide magic-cursor slider-zoom"
                        data-slider-options='{
                            "slidesPerView": 1,
                            "loop": true,
                            "pagination": { "el": ".swiper-pagination", "clickable": true },
                            "autoplay": { "delay": 2000, "disableOnInteraction": false },
                            "breakpoints": {
                                "1400": {"slidesPerView": 4},
                                "1200": {"slidesPerView": 3},
                                "768": {"slidesPerView": 2},
                                "576": {"slidesPerView": 2},
                                "0": {"slidesPerView": 1}
                            }
                    }'>

                        <div class="swiper-wrapper pb-5 md-pb-6 d-flex align-items-center gap-4">
                            @php $packages = $categoryPackages[$category->id] ?? collect(); @endphp
                            @foreach($packages as $p)
                            @php
                            $img = $p->featured_image ?? ($p->storage_path ? asset($p->storage_path) : 'https://placehold.co/800x655');
                            $days = 0;
                            if ($p->itinerary) {
                            $decoded = @json_decode($p->itinerary, true);
                            if (is_array($decoded)) $days = count($decoded);
                            }
                            @endphp
                            <div class="swiper-slide">
                                <div class="overflow-hidden border-radius-6px box-shadow-large">
                                    <div class="image">
                                        <a href="{{ url('/tour/' . ($p->slug ?? $p->id)) }}">
                                            <img class="w-100" src="{{ $img }}" alt="{{ $p->title }}">
                                        </a>
                                    </div>
                                    <div class="bg-white p-35px position-relative">
                                        <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">Customizable</div>
                                        <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Starting At</span>{{ $p->price ? '₹' . number_format($p->price,2) : '—' }}</div>
                                        <a href="{{ url('/tour/' . ($p->slug ?? $p->id)) }}" class="mt-10px fs-18 text-dark-gray fw-500 lh-26 d-block">{{ $p->title }}</a>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- PAGINATION (WITH INLINE COLORS) -->
                        <div class="mt-2">
                            <div class="swiper-pagination"
                                style="margin-top: 15px;">
                            </div>
                        </div>

                    </div>
                    @else
                    <div class="text-center py-4">No packages available for this category.</div>
                    @endif

                </div>
            </section>
            @endforeach
            <!-- end section -->
            <!-- start parallax style-1 -->
            <section class="position-relative overlap-height" data-parallax-background-ratio="0.5" style="background-image: url('{{ asset('asset/image/demo-travel-agency-home-parallax.jpg') }}');">
                <div class="opacity-extra-medium bg-gradient-gulf-blue-sepia-brown"></div>
                <div class="container overlap-gap-section">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-8 col-lg-10 position-relative text-center parallax-scrolling-style-1" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <span class="fw-500 text-white text-uppercase mb-5px d-inline-block ls-1px">Finding the perfect trips</span>
                            <h1 class="text-white mx-auto alt-font fw-500 mb-40px ls-minus-2px">Get ready to explore and discover your world.</h1>
                            <a href="#explore" class="section-link d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-base-color"><i class="bi bi-arrow-down-short text-white icon-medium d-flex"></i></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end parallax style-1 -->
            <!-- start section -->
            <section id="explore" class="cover-background overflow-visible" style="background-image: url('https://placehold.co/1920x780');">
                <div class="container overlap-section">
                    <div class="swiper slider-experiences bg-white border-radius-6px mx-0 ps-8 pe-8 lg-ps-3 lg-pe-3 pt-4 pb-4 sm-pt-8 sm-pb-8 xs-pt-15 xs-pb-40px" data-slider-options='{"spaceBetween":20,"loop":true,"autoplay":{"delay":3000,"disableOnInteraction":false},"pagination":{"el":".slider-experiences-pagination","clickable":true},"navigation":{"nextEl":".slider-experiences-next","prevEl":".slider-experiences-prev"},"breakpoints":{"1400":{"slidesPerView":5},"992":{"slidesPerView":4},"768":{"slidesPerView":3},"576":{"slidesPerView":2},"0":{"slidesPerView":1}}}'>
                        <div class="swiper-wrapper align-items-center justify-content-center">
                            @forelse($experiences ?? [] as $experience)
                            <div class="swiper-slide text-center">
                                <a href="{{ route('tour') }}?experience={{ $experience->slug ?? $experience->id }}" class="d-block text-decoration-none">
                                    <div class="mb-10px d-block mx-auto" style="width:70px;height:70px;overflow:hidden;border-radius:8px;">
                                        <img src="{{ $experience->image ?? 'https://placehold.co/140x125' }}" alt="{{ $experience->name ?? 'Experience' }}" style="width:100%;height:100%;object-fit:cover;" />
                                    </div>
                                    <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px d-block mt-2">{{ $experience->name }}</span>
                                </a>
                            </div>
                            @empty
                            <div class="swiper-slide text-center">
                                <div class="mb-10px d-block mx-auto" style="width:70px;height:70px;overflow:hidden;border-radius:8px;">
                                    <img src="https://placehold.co/140x125" alt="No experiences" style="width:100%;height:100%;object-fit:cover;" />
                                </div>
                                <span class="alt-font fs-19 fw-600 text-dark-gray text-uppercase ls-minus-05px d-block mt-2">No experiences</span>
                            </div>
                            @endforelse
                        </div>
                        <div class="mt-2">
                            <div class="swiper-pagination slider-experiences-pagination"></div>

                        </div>
                        <div class="swiper-button-prev slider-experiences-prev"><i class="bi bi-arrow-left-short icon-very-medium"></i></div>
                        <div class="swiper-button-next slider-experiences-next"><i class="bi bi-arrow-right-short icon-very-medium"></i></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row align-items-center justify-content-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <div class="col-lg-3 md-mb-20px text-center text-lg-start">
                            <span class="fw-500 text-base-color text-uppercase">Testimonials</span>
                            <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Our happy traveller.</h2>
                            <div class="d-flex justify-content-center justify-content-lg-start">
                                <!-- start slider navigation -->
                                <div class="slider-one-slide-prev-1 bg-white box-shadow-double-large swiper-button-prev slider-navigation-style-04"><i class="bi bi-arrow-left-short icon-very-medium"></i></div>
                                <div class="slider-one-slide-next-1 bg-white box-shadow-double-large swiper-button-next slider-navigation-style-04"><i class="bi bi-arrow-right-short icon-very-medium"></i></div>
                                <!-- end slider navigation -->
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-9">
                            <div class="swiper position-relative magic-cursor" data-slider-options='{ "autoHeight": true, "loop": true, "allowTouchMove": true, "autoplay": { "delay": 3000, "disableOnInteraction": false }, "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" }, "effect": "slide" }'>
                                <div class="swiper-wrapper">
                                    <!-- start text slider item -->
                                    <div class="swiper-slide review-style-11">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                                <img src="https://placehold.co/350x335" alt="">
                                            </div>
                                            <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                                <p class="fs-20 lh-28 text-dark-gray mb-20px">Our Africa travel specialist planned the most <span class="text-decoration-line-bottom fw-600">amazing trip</span> to kenya for us. We had an <span class="text-decoration-line-bottom fw-600">incredible time</span> and were able to capture so many awesome pictures.</p>
                                                <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                                    <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                                        <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">Alexander moore</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end text slider item -->
                                    <!-- start text slider item -->
                                    <div class="swiper-slide review-style-11">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                                <img src="https://placehold.co/350x335" alt="">
                                            </div>
                                            <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                                <p class="fs-20 lh-28 text-dark-gray mb-20px">Excellent travel company. We have already <span class="text-decoration-line-bottom fw-600">recommended</span> it to our family and friends. We are looking forward to our <span class="text-decoration-line-bottom fw-600">next trip.</span> Everything was very well organized.</p>
                                                <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                                    <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                                        <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">Matthew taylor</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end text slider item -->
                                    <!-- start text slider item -->
                                    <div class="swiper-slide review-style-11">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 text-center text-md-start sm-mb-15px">
                                                <img src="https://placehold.co/350x335" alt="">
                                            </div>
                                            <div class="col-md-7 position-relative ps-16 sm-ps-15px text-center text-md-start">
                                                <p class="fs-20 lh-28 text-dark-gray mb-20px">This itinerary was a perfect <span class="text-decoration-line-bottom fw-500">combination</span> of city sights, history and culture together with the peace of the <span class="text-decoration-line-bottom fw-500">amazon rainforest</span> and the adventure.</p>
                                                <div class="text-center bg-base-color text-white fs-15 border-radius-22px d-inline-block ps-20px pe-20px lh-36 ls-minus-1px">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>
                                                <div class="position-absolute left-0px top-0px h-100 w-90px sm-w-100 border-end border-color-transparent-dark-very-light sm-position-relative sm-mt-10px sm-border-end-0">
                                                    <div class="vertical-title-center align-items-center justify-content-center sm-vertical-title-inherit">
                                                        <div class="title fs-20 alt-font text-base-color fw-600 text-uppercase">Herman miller</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end text slider item -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end section -->
            <!-- end section -->
            <section class="bg-very-light-gray background-position-center-top background-no-repeat overlap-height" style="background-image:url('{{ asset('asset/images/demo-travel-agency-home-bg-04.png') }}');">
                <div class="container overlap-gap-section">
                    <div class="row justify-content-center mb-2">
                        <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                            <span class="fw-500 text-base-color text-uppercase d-inline-block">Inspiring story</span>
                            <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Travel blogs</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="blog-modern blog-wrapper grid-loading grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <li class="grid-sizer"></li>
                                @forelse($latestPosts ?? [] as $post)
                                <li class="grid-item md-mb-20px">
                                    <div class="box-hover text-center">
                                        <figure class="mb-0 position-relative">
                                            <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                                @php
                                                $img = $post->featured_image ?? 'https://placehold.co/800x1015';
                                                @endphp
                                                <a href="{{ url('/blog/' . ($post->slug ?? $post->id)) }}"><img src="{{ $img }}" alt="{{ $post->title }}" /></a>
                                            </div>
                                            <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">
                                                <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                                    <a href="{{ url('/blog/' . ($post->slug ?? $post->id)) }}" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">{{ $post->title }}</a>
                                                    <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                                </div>
                                                <div class="fs-15 bg-white p-15px lg-ps-10px lg-pe-10px lh-initial"><span class="d-inline-block">By <a href="#">{{ $post->author ?? 'Admin' }}</a></span><span class="separator d-inline-block">|</span><a href="#">{{ $post->created_at ? $post->created_at->format('d M Y') : '' }}</a></div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>
                                @empty
                                <li class="grid-item md-mb-20px">
                                    <div class="box-hover text-center">
                                        <figure class="mb-0 position-relative">
                                            <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                                <a href="#"><img src="https://placehold.co/800x1015" alt="" /></a>
                                            </div>
                                            <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">
                                                <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                                    <a href="#" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">No blog posts yet</a>
                                                    <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- start section -->
            <!-- start footer -->



    </main>
</div>