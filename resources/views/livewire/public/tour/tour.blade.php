<div>
    @section('meta_tags')
    <title>{{ $metaContent->meta_title}}</title>
    <meta name="description" content="{{ $metaContent->meta_description}}">
    <meta name="keywords" content="{{ $metaContent->meta_keywords}}">
    @endsection
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('{{ $bannerImage }}')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">The perfect trip</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">{{ request()->query('slug') ?? 'Special tours' }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-12 bg-very-light-gray overlap-height">
        <div class="container overlap-gap-section">
            <div class="row row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 justify-content-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                @forelse($tourPackages as $package)
                <div class="col mb-30px">
                    <div class="overflow-hidden border-radius-6px box-shadow-large">
                        <div class="image" width="100%" height="250px" style="height: 250px; overflow: hidden;">
                            <a href="/tour/{{ $package->slug }}">

                                @php
                                $img = $package->featured_image;
                                $placeholder = 'https://placehold.co/600x430';

                                if ($img) {
                                if (str_contains($img, 'ik.imagekit.io'))
                                {
                                $finalUrl = $img . '?tr=w-600,f-auto,q-65';
                                }
                                elseif (filter_var($img, FILTER_VALIDATE_URL))
                                {
                                $finalUrl = $img;
                                }
                                else {
                                $finalUrl = $img;
                                }
                                }
                                else
                                {
                                $finalUrl = $placeholder;
                                }
                                @endphp

                                <img src="{{ $finalUrl }}"
                                    alt="{{ $package->title }}"
                                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                            </a>
                        </div>

                        <div class="bg-white p-40px md-p-30px position-relative">
                            <div class="bg-base-color ps-15px pe-15px fs-14 text-uppercase fw-500 d-inline-block text-white position-absolute right-0px top-0px">Customizable</div>
                            <div class="fs-24 fw-700 text-dark-gray"><span class="text-uppercase d-block fs-14 lh-18 fw-500 text-medium-gray">Starting At</span>₹{{ number_format($package->price ?? 0, 0) }}</div>
                            <a href="/tour/{{ $package->slug }}" class="mt-10px fs-18 text-dark-gray fw-600 d-block">{{ $package->title }}</a>
                            <p class="m-0 lh-30">{{ \Illuminate\Support\Str::limit(strip_tags($package->description), 60) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">No tour packages found.</div>
                @endforelse
            </div>
            <livewire:public.tour.contact-sticky />
            <div class="row">
                <div class="col-12 mt-6 d-flex justify-content-center">
                    {!! $tourPackages->links('vendor.pagination.tour') !!}
                </div>
            </div>
        </div>
    </section>
</div>