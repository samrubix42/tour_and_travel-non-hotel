<div>
    @section('meta_tags')
    <title>{{ $meta_title ?? ($package->meta_title ?? $package->title) }}</title>
    <meta name="description" content="{{ $meta_description ?? ($package->meta_description ?? '') }}">
    <meta name="keywords" content="{{ $meta_keywords ?? ($package->meta_keywords ?? '') }}">
    @endsection
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('https://placehold.co/1920x590')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Amazing tour</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Maldives islands</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
    <section class="position-relative">
        <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url('images/demo-travel-agency-about-bg-02.png')"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 md-mb-50px sm-mb-35px">
                    <div class="row align-items-center mb-25px">
                        <div class="col-sm-9">
                            <h2 class="alt-font text-dark-gray fw-600 mb-10px ls-minus-1px">{{ $package->title }}</h2>
                            <ul class="p-0 m-0 list-style-02 d-block d-sm-flex-col">
                                <li class="text-dark-gray fw-500"><i class="bi bi-geo-alt icon-small me-5px"></i>{{ $package->destinations->pluck('name')->implode(', ') ?: 'No Destination' }}</li>
                                <li class="text-dark-gray fw-500"><i class="bi bi-briefcase icon-small me-5px"></i>
                                    {{ $package->experiences->pluck('name')->implode(', ') ?: 'No Destination' }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3 text-sm-end xs-mt-10px">
                            <h4 class="text-dark-gray fw-600 mb-0">{{ !empty($package->price) ? '₹' . number_format($package->price,0) : '-' }}</h4>
                            <span class="d-block lh-22">Starting At</span>
                        </div>
                    </div>
                    <div class="row mb-50px xs-mb-40px">
                        <div class="col-12">
                            <div class="p-0 list-style-02 d-flex flex-wrap border-top border-color-extra-medium-gray pt-20px"></div>
                            <p>{!! $package->description ?? '' !!}</p>
                            @if(!empty($package->featured_image))
                            <img src="{{ $package->featured_image }}" alt="" />
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="alt-font text-dark-gray fw-600">Included / Optional</h5>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 mb-50px xs-mb-40px">
                        <div class="col">
                            @php
                            $includes = json_decode($package->includes ?? 'null', true);
                            if (!is_array($includes)) {
                            $includes = array_filter(array_map('trim', explode("\n", strip_tags($package->includes ?? ''))));
                            }
                            @endphp
                            <ul class="p-0 m-0 list-style-02 text-dark-gray sm-mb-20px">
                                @foreach($includes as $inc)
                                @if(trim($inc) !== '')
                                <li class="border-bottom border-color-extra-medium-gray pb-10px mb-10px"><i class="bi bi-check-circle-fill fs-22 text-green me-10px"></i>{{ $inc }}</li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            @php
                            $optionals = json_decode($package->optional ?? 'null', true);
                            if (!is_array($optionals)) {
                            $optionals = array_filter(array_map('trim', explode("\n", strip_tags($package->optional ?? ''))));
                            }
                            @endphp
                            <ul class="p-0 m-0 list-style-02 text-dark-gray">
                                @foreach($optionals as $opt)
                                @if(trim($opt) !== '')
                                <li class="border-bottom border-color-extra-medium-gray pb-10px mb-10px"><i class="bi bi-info-circle-fill fs-22 text-warning me-10px"></i>{{ $opt }}</li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="alt-font text-dark-gray fw-600">Photo gallery</h5>
                        </div>
                    </div>
                    <div class="row mb-50px xs-mb-40px">
                        <div class="col">
                            <ul class="image-gallery-style-01 gallery-wrapper grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-medium" data-anime='{ "el": "childs", "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                                <li class="grid-sizer"></li>
                                @foreach($package->galleries ?? collect() as $gallery)
                                <li class="grid-item transition-inner-all">
                                    <div class="gallery-box">
                                        <a href="{{ $gallery->image_url ?? 'https://placehold.co/39x66' }}" data-group="lightbox-gallery" title="{{ $package->title }}">
                                            <div class="position-relative gallery-image bg-dark-gray overflow-hidden">
                                                <img src="{{ $gallery->image_url ?? ($gallery->storage_path ? asset($gallery->storage_path) : '#') }}" alt="" />
                                                <div class="d-flex align-items-center justify-content-center position-absolute top-0px left-0px w-100 h-100 gallery-hover move-bottom-top">
                                                    <div class="d-flex align-items-center justify-content-center w-50px h-50px rounded-circle bg-white">
                                                        <i class="feather icon-feather-search text-dark-gray icon-small"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h5 class="alt-font text-dark-gray fw-600 sm-mb-15px">Itinerary</h5>
                        </div>
                        <div class="col-12">
                            @php
                            $itinerary = json_decode($package->itinerary ?? 'null', true);
                            @endphp
                            <div class="accordion accordion-style-02" id="accordion-style-02" data-active-icon="icon-feather-chevron-down" data-inactive-icon="icon-feather-chevron-right">
                                @if(is_array($itinerary) && count($itinerary))
                                @php $i = 0; @endphp
                                @foreach($itinerary as $dayKey => $day)
                                @php
                                $i++;
                                $itemId = 'accordion-style-02-'. $i;
                                $title = $day['title'] ?? ('Day ' . sprintf('%02d', $i));
                                $points = $day['points'] ?? [];
                                @endphp
                                <div class="accordion-item {{ $i === 1 ? 'active-accordion' : '' }}">
                                    <div class="accordion-header border-bottom border-color-extra-medium-gray">
                                        <a href="#" data-bs-toggle="collapse" data-bs-target="#{{ $itemId }}" aria-expanded="{{ $i === 1 ? 'true' : 'false' }}" data-bs-parent="#accordion-style-02">
                                            <div class="accordion-title d-flex align-items-center position-relative text-dark-gray mb-0">
                                                <div class="col-auto bg-base-color lh-28 fw-600 text-white text-uppercase border-radius-30px ps-15px pe-15px fs-12 me-15px d-inline-block align-middle">{{ 'Day ' . sprintf('%02d', $i) }}</div>
                                                <i class="feather {{ $i === 1 ? 'icon-feather-chevron-down' : 'icon-feather-chevron-right' }}"></i><span class="fw-600 lh-normal">{{ $title }}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="{{ $itemId }}" class="accordion-collapse collapse {{ $i === 1 ? 'show' : '' }}" data-bs-parent="#accordion-style-02">
                                        <div class="accordion-body last-paragraph-no-margin border-bottom border-color-light-medium-gray">
                                            @if(is_array($points) && count($points))
                                            <ul>
                                                @foreach($points as $p)
                                                <li>{{ $p }}</li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <p>{{ $day['title'] ?? '' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="accordion-item active-accordion">
                                    <div class="accordion-header border-bottom border-color-extra-medium-gray">
                                        <div class="accordion-title d-flex align-items-center position-relative text-dark-gray mb-0">
                                            <div class="col-auto bg-base-color lh-28 fw-600 text-white text-uppercase border-radius-30px ps-15px pe-15px fs-12 me-15px d-inline-block align-middle">Day 01</div>
                                            <i class="feather icon-feather-chevron-down"></i><span class="fw-600 lh-normal">{{ $package->itinerary ?? 'Itinerary not available' }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start sidebar -->
                <aside class="col-xl-3 col-lg-4 offset-xl-1 lg-ps-50px md-ps-15px">
                    <div class="position-sticky top-70px">
                        <div class="bg-very-light-gray contact-form-style-03 position-relative overflow-hidden p-40px lg-p-30px mb-30px">
                            @if (session()->has('message'))
                            <div class="alert alert-success small mb-3">{{ session('message') }}</div>
                            @endif
                            <form wire:submit.prevent="submit">
                                <div class="position-relative form-group mb-5px">
                                    <span class="form-icon"><i class="bi bi-emoji-smile icon-small"></i></span>
                                    <input wire:model.defer="name" class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control required @error('name') is-invalid @enderror" type="text" placeholder="Your name*" />
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="position-relative form-group mb-5px">
                                    <span class="form-icon"><i class="bi bi-telephone icon-small"></i></span>
                                    <input wire:model.defer="phone" class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control required @error('phone') is-invalid @enderror" type="tel" placeholder="Your phone*" />
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="position-relative form-group mb-5px">
                                    <span class="form-icon"><i class="bi bi-envelope icon-small"></i></span>
                                    <input wire:model.defer="email" class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control @error('email') is-invalid @enderror" type="email" placeholder="Your email" />
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="position-relative form-group form-textarea mb-0">
                                    <textarea wire:model.defer="message" class="ps-0 border-radius-0px border-bottom border-color-transparent-dark-very-light bg-transparent form-control" placeholder="Your message" rows="2"></textarea>
                                    <span class="form-icon"><i class="bi bi-chat-square-dots icon-small"></i></span>
                                    <input type="hidden" name="tour_id" wire:model.defer="tour_id" />
                                    <button class="btn btn-medium btn-dark-gray btn-round-edge btn-box-shadow mt-25px w-100 submit" type="submit" wire:click="submit" aria-label="submit">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>
                <!-- end sidebar -->
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <!-- start section -->
    <section id="reviews" class="position-relative bg-very-light-gray overlap-height cover-background" style="background-image: url('https://placehold.co/1920x780');">
        <div class="container">
            <div class="row align-items-center justify-content-center mb-4" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
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
                    <div class="swiper position-relative magic-cursor" data-slider-options='{ "autoHeight": true, "loop": true, "allowTouchMove": true, "autoplay": { "delay": 30000000, "disableOnInteraction": false }, "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" }, "effect": "slide" }'>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>