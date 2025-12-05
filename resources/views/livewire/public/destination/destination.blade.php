<div>
    @section('meta_tags')
    <title>{{ $page->meta_title ?? ($page->page_title ?? 'Destinations - Explore Destinations') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @endsection
    <style>
        .destination-figure { aspect-ratio: 1/1; width: 100%; max-height: 420px; overflow: hidden; }
        .destination-figure img { width: 100%; height: 100%; object-fit: cover; display: block; }
        @media (max-width: 992px) { .destination-figure { max-height: 360px; } }
        @media (max-width: 576px) { .destination-figure { max-height: 260px; } }
    </style>
        <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('asset/image/demo-travel-agency-destinations-title-bg.jpg')">
            <div class="opacity-light bg-bay-of-many-blue"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center extra-small-screen">
                    <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Explore the world</h2>
                        <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Destinations</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->
        <!-- start section -->
        <section class="position-relative">
            <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url('asset/images/demo-travel-agency-about-bg-02.png')"></div>
            <div class="container">
                <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 justify-content-center mb-7 lg-mb-5 md-mb-10 sm-mb-0" data-anime='{ "el": "childs", "scale":[0.9,1], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    @foreach($destinations ?? collect() as $destination)
                    <div class="col text-center interactive-banner-style-01 last-paragraph-no-margin mb-30px">
                            <figure class="m-0 position-relative hover-box border-radius-6px overflow-hidden destination-figure">
                            <img src="{{ $destination->image ?? ($destination->storage_path ? asset($destination->storage_path) : 'https://placehold.co/600x600') }}" alt="{{ $destination->name }}" style="height:100%;width:100%; object-fit: cover;" />
                            <div class="position-absolute top-0px left-0px w-100 h-100 bg-gradient-gray-light-dark-transparent opacity-1"></div>
                            <figcaption class="w-100 h-100 d-flex flex-column justify-content-end align-items-center p-30px">
                                <div class="position-relative z-index-1">
                                    <a href="{{ url('/tour?slug=' . ($destination->slug ?? $destination->id)) }}" class="d-flex justify-content-center align-items-center mx-auto icon-box w-70px h-70px rounded-circle bg-white mb-50px box-shadow-quadruple-large"><i class="bi bi-arrow-right-short text-dark-gray icon-medium lh-0px"></i></a>
                                    <a href="{{ url('/tour?slug=' . ($destination->slug ?? $destination->id)) }}" class="alt-font fs-22 fw-500 lette text-white d-inline-block text-uppercase">{{ $destination->name }}</a>
                                </div>
                                <div class="box-overlay bg-dark-gray"></div>
                            </figcaption>                            
                        </figure>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
</div>
