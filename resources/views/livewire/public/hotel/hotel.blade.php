<div>
    @section('meta_tags')
    <title>{{ $page->meta_title ?? ($page->page_title ?? 'Hotels - Find & Book Hotels') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @endsection
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('asset/image/sasha-kaunas-TAgGZWz6Qg8-unsplash.jpg')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large">
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Stay with comfort</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Hotels</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-12 bg-very-light-gray">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search hotels by name or address...">
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse($hotels as $hotel)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="{{route('hotel.view',$hotel->slug)}}"> <img src="{{ $hotel->image_url ?? 'https://placehold.co/600x480' }}" class="card-img-top" style="height:350px;object-fit:cover;" alt="{{ $hotel->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title mb-1"><a href="{{ route('hotel.view', $hotel->slug) }}" class="text-dark text-decoration-none">{{ $hotel->name }}</a></h5>
                            <p class="text-muted mb-2 small">{{ $hotel->destination->name ?? '' }} &middot; {{ $hotel->category->name ?? '' }}</p>
                            <p class="card-text small text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($hotel->description ?? ''), 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex align-items-center justify-content-between">
                            <span class="badge bg-base-color text-white">{{ $hotel->rating ?? 'N/A' }} <i class="bi bi-star-fill ms-1"></i></span>
                            <a href="{{route('hotel.view',$hotel->slug)}}" class="btn btn-sm btn-outline-dark">View details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">No hotels found.</div>
                @endforelse
            </div>

            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $hotels->links('vendor.pagination.tour')  }}
                </div>
            </div>
        </div>
    </section>
    <livewire:public.hotel.contact-sticky />
</div>
</section>
</div>