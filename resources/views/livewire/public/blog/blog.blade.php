<div>
    @section('meta_tags')
    <title>{{ $page->meta_title ?? ($page->page_title ?? 'Blog - Latest Posts') }}</title>
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    @endsection
    <section class="page-title-button-style cover-background position-relative ipad-top-space-margin top-space-padding md-pt-20px" style="background-image: url('asset/image/demo-travel-agency-blog-title-bg.jpg')">
        <div class="opacity-light bg-bay-of-many-blue"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center extra-small-screen">
                <div class="col-lg-6 col-md-8 position-relative text-center page-title-extra-large" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h2 class="text-uppercase mb-10px alt-font text-white fw-500 bg-dark-gray border-radius-4px">Amazing stories</h2>
                    <h1 class="mb-0 text-white alt-font ls-minus-2px text-uppercase fw-600 text-shadow-double-large">Travel Blog</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
    <section class="bg-very-light-gray position-relative">
        <div class="h-110px position-absolute w-100 h-100 left-0px right-0px top-minus-70px" style="background-image:url('asset/images/demo-travel-agency-home-bg-02.png')"></div>
        <div class="container">
            <div class="row">
                <div class="mb-2 md-mb-7 sm-mb-0">
                    <div class="row g-4" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        @forelse($posts as $post)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card h-100 border-0 shadow-sm">
                                <a href="{{ route('blog.view', $post->slug) }}" style="display:block;overflow:hidden;height:400px;">
                                    <img src="{{ $post->thumbnail_image ?? 'https://placehold.co/800x1015' }}" class="card-img-top img-fluid rounded-top" style="object-fit: cover; height: 400px;" alt="{{ $post->title }}">
                                </a>
                                <div class="card-body p-3 text-center">
                                    <a href="{{ route('blog.view', $post->slug) }}" class="card-title mb-0 fs-18 lh-26 d-block text-dark">{{ $post->title }}</a>
                                </div>
                                <div class="card-footer bg-white border-0 text-center py-2">
                                    <small class="text-muted">{{ $post->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="box-hover text-center">
                                <p class="mb-0 p-30px">No posts found.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-12 mt-1 mb-3 d-flex justify-content-center">
                            <!-- start pagination -->
                            {{ $posts->links('vendor.pagination.tour') }}
                            <!-- end pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('livewire:load', function () {
            function clearGridLoading() {
                document.querySelectorAll('.grid-loading').forEach(function (el) {
                    el.classList.remove('grid-loading');
                });
            }

            clearGridLoading();

            Livewire.hook('message.processed', function () {
                clearGridLoading();
            });
        });
    </script>
</div>