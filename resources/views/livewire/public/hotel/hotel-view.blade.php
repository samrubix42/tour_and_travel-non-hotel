<div>
    <!-- THEMED HERO (matches blog-view style) -->
    @php
        $hero = $hotel->image_url ?? (isset($hotel->galleries) && $hotel->galleries->first() ? $hotel->galleries->first()->image_url : null);
        if (empty($hero) && !empty($hotel->storage_path)) {
            $hero = asset('storage/' . $hotel->storage_path);
        }
    @endphp
    @section('meta_tags')
    <title>{{ $meta_title ?? ($hotel->meta_title ?? $hotel->name) }}</title>
    <meta name="description" content="{{ $meta_description ?? ($hotel->meta_description ?? '') }}">
    <meta name="keywords" content="{{ $meta_keywords ?? ($hotel->meta_keywords ?? '') }}">
    @endsection

    <section class="one-fourth-screen sm-mb-50px bg-dark-gray" data-parallax-background-ratio="0.5" style="background-image: url('{{ $hero ?? 'https://placehold.co/1920x590' }}')"></section>

    <!-- TITLE BAR -->
    <section class="p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 overlap-section text-center">
                    <div class="p-10 box-shadow-extra-large border-radius-4px bg-white text-center">
                        <a href="{{ route('hotels') ?? '#' }}" class="btn btn-large fw-400 ps-20px pe-20px pt-5px pb-5px btn-dark-gray btn-box-shadow btn-round-edge mb-3 sm-mb-15px">Back to Hotels</a>
                        <h1 class="h2 alt-font text-dark-gray fw-600 ls-minus-1px mb-15px">{{ $hotel->name ?? 'Hotel' }}</h1>
                        <div class="lg-mb-20px sm-mb-0">{{ $hotel->address ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- THUMBNAIL -->
    <section class="overlap-section text-center p-0 sm-pt-30px">
        @php
            $thumb = $hotel->image_url ?? (isset($hotel->galleries) && $hotel->galleries->first() ? $hotel->galleries->first()->image_url : null);
            if (empty($thumb) && !empty($hotel->storage_path)) {
                $thumb = asset('storage/' . $hotel->storage_path);
            }
        @endphp
        <img class="rounded-circle box-shadow-extra-large w-130px h-130px border border-8 border-color-white" src="{{ $thumb ?? 'https://placehold.co/125x125' }}" alt="{{ $hotel->name ?? 'Hotel' }}">
    </section>

    <!-- MAIN ARTICLE -->
    <section class="pb-0 pt-3" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 dropcap-style-01">
                    <p class="text-muted mb-3">{{ $hotel->short_description ?? $hotel->description ?? '' }}</p>

                    <h4 class="alt-font fw-600 mt-4 mb-3">Description</h4>
                    <p>{{ $hotel->description ?? '' }}</p>

                    <h4 class="alt-font fw-600 mt-4 mb-3">Amenities</h4>
                    <div class="row row-cols-2 row-cols-md-3 g-2 mt-1 mb-4">
                        @php
                            $amenities = [];
                            if (!empty($hotel->amenities)) {
                                if (is_array($hotel->amenities)) $amenities = $hotel->amenities;
                                else {
                                    $decoded = json_decode($hotel->amenities, true);
                                    $amenities = is_array($decoded) ? $decoded : [];
                                }
                            }
                        @endphp
                        @forelse($amenities as $a)
                            <div class="col">{{ $a }}</div>
                        @empty
                            <div class="col">No amenities listed</div>
                        @endforelse
                    </div>

                    <!-- Facilities (additional) -->
                    <h4 class="alt-font fw-600 mt-3 mb-3">Facilities</h4>
                    <div class="row row-cols-2 row-cols-md-3 g-2 mt-1 mb-4">
                        @php
                            $facilities = [];
                            if (!empty($hotel->facilities)) {
                                if (is_array($hotel->facilities)) $facilities = $hotel->facilities;
                                else {
                                    $decodedF = json_decode($hotel->facilities, true);
                                    $facilities = is_array($decodedF) ? $decodedF : [];
                                }
                            }
                        @endphp
                        @forelse($facilities as $f)
                            <div class="col">{{ $f }}</div>
                        @empty
                            <div class="col">No facilities listed</div>
                        @endforelse
                    </div>

                    <!-- GALLERY (copied style from blog-view) -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="alt-font fw-600 mb-3">Photo gallery</h4>
                            <div class="row mb-50px xs-mb-40px">
                                        <div class="col">
                                    <ul class="image-gallery-style-01 gallery-wrapper grid grid-3col xxl-grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-medium" data-anime='{ "el": "childs", "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
                                        <li class="grid-sizer"></li>
                                        @php
                                            $galleries = $hotel->galleries ?? [];
                                        @endphp
                                        @forelse($galleries as $gal)
                                            @php
                                                $imgUrl = $gal['image_url'] ?? ($gal['storage_path'] ? asset('storage/' . $gal['storage_path']) : null);
                                            @endphp
                                            <li class="grid-item transition-inner-all">
                                                <div class="gallery-box">
                                                    <a href="{{ $imgUrl ?? 'https://placehold.co/800x630' }}" data-group="lightbox-gallery" title="{{ $hotel->name ?? '' }}">
                                                        <div class="position-relative gallery-image bg-dark-gray overflow-hidden">
                                                            <img src="{{ $imgUrl ?? 'https://placehold.co/800x630' }}" alt="" />
                                                            <div class="d-flex align-items-center justify-content-center position-absolute top-0px left-0px w-100 h-100 gallery-hover move-bottom-top">
                                                                <div class="d-flex align-items-center justify-content-center w-50px h-50px rounded-circle bg-white">
                                                                    <i class="feather icon-feather-search text-dark-gray icon-small"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="grid-item transition-inner-all">
                                                <div class="gallery-box">
                                                    <div class="position-relative gallery-image bg-dark-gray overflow-hidden">
                                                        <img src="https://placehold.co/800x630" alt="" />
                                                    </div>
                                                </div>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LOCATION -->
                    <h4 class="alt-font fw-600 mt-4 mb-3">Location</h4>
                    <div class="row mb-40px">
                        <div class="col-md-6">
                        
                                <p class="text-muted">{{ $hotel->address ?? 'Location details not available.' }}</p>
                       
                        </div>
                        <div class="col-md-6">
                            <div class="border-radius-6px overflow-hidden" style="min-height:160px;">
                                @if(!empty($hotel->map_embed))
                                    {!! $hotel->map_embed !!}
                                @else
                                    @php
                                        $q = $hotel->address ?? (is_string($hotel->location) ? $hotel->location : '');
                                        $src = 'https://www.google.com/maps?q=' . urlencode($q) . '&output=embed';
                                    @endphp
                                    <iframe src="{{ $src }}" width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                    <livewire:public.hotel.contact-sticky/>

                    <!-- CONTACT INFO -->
                    <div class="row mb-40px">
                        <div class="col-12">
                            <div class="bg-very-light-gray p-4 border-radius-6px">
                                <h5 class="alt-font fw-600 mb-2">Contact</h5>
                                @if(!empty($hotel->phone))
                                    <p class="mb-1"><strong>Phone:</strong> <a href="tel:{{ preg_replace('/\s+/', '', $hotel->phone) }}">{{ $hotel->phone }}</a></p>
                                @endif
                                @if(!empty($hotel->email))
                                    <p class="mb-0"><strong>Email:</strong> <a href="mailto:{{ $hotel->email }}">{{ $hotel->email }}</a></p>
                                @endif
                                @if(empty($hotel->phone) && empty($hotel->email))
                                    <p class="mb-0 text-muted">No contact information available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>