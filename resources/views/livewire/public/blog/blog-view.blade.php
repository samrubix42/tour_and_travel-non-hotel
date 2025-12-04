<div>
    @section('meta_tags')
    <title>{{ $meta_title ?? ($post->meta_title ?? $post->title) }}</title>
    <meta name="description" content="{{ $meta_description ?? ($post->meta_description ?? '') }}">
    <meta name="keywords" content="{{ $meta_keywords ?? ($post->meta_keywords ?? '') }}">
    @endsection

    <section class="one-fourth-screen sm-mb-50px bg-dark-gray" data-parallax-background-ratio="0.5" style="background-image: url({{ $post->featured_image ?? 'https://placehold.co/1920x1100' }})"></section>
    <!-- end section -->
    <!-- start section -->
    <section class="p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 overlap-section text-center">
                    <div class="p-10 box-shadow-extra-large border-radius-4px bg-white text-center">
                        <a href="{{ route('blog') }}" class="btn btn-large fw-400 ps-20px pe-20px pt-5px pb-5px btn-dark-gray btn-box-shadow btn-round-edge mb-3 sm-mb-15px">Back to Blog</a>
                        <h1 class="h2 alt-font text-dark-gray fw-600 ls-minus-1px mb-15px">{{ $post->title }}</h1>
                        <div class="lg-mb-20px sm-mb-0">
                            on <a href="#" class="text-dark-gray">{{ $post->created_at->format('d F Y') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="overlap-section text-center p-0 sm-pt-30px">
        <img class="rounded-circle box-shadow-extra-large w-130px h-130px border border-8 border-color-white" src="{{ $post->thumbnail_image ?? 'https://placehold.co/125x125' }}" alt="{{ $post->title }}">
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="pb-0 pt-3" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 dropcap-style-01">
                    {!! $post->main_content !!}

                </div>
            </div>
        </div>
    </section>


    <!-- end section -->
    <!-- start section -->
    <section class="half-section">
        <div class="container">
            <div class="row justify-content-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                <div class="col-lg-9">
                    <div class="row mb-30px">
                        <div class="tag-cloud col-md-9 text-center text-md-start sm-mb-15px">
                            @php
                            $tags = collect(explode(',', $post->tags ?? ''))
                            ->map(fn($t) => trim($t))
                            ->filter()
                            ->unique()
                            ->values();
                            @endphp
                            @forelse($tags as $tag)
                            <a href="{{ route('blog', ['tag' => $tag]) }}">{{ $tag }}</a>
                            @empty
                            <span class="text-muted">No tags</span>
                            @endforelse
                        </div>

                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 text-center elements-social social-icon-style-04">
                            <ul class="medium-icon dark">
                                <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span></a></li>
                                <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i><span></span></a></li>
                                <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i><span></span></a></li>
                                <li><a class="linkedin" href="http://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin-in"></i><span></span></a></li>
                                <li><a class="behance" href="http://www.behance.com/" target="_blank"><i class="fa-brands fa-behance"></i><span></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="bg-very-light-gray">
        <div class="container">
            <div class="row justify-content-center mb-1">
                <div class="col-lg-7 text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <span class="fw-500 text-base-color text-uppercase">You may also like</span>
                    <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px">Related posts</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="blog-modern blog-wrapper grid grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 1200, "delay": 0, "staggervalue": 150, "easing": "easeOutQuad" }'>
                        <li class="grid-sizer"></li>
                        @forelse($relatedPosts as $rp)
                        <li class="grid-item md-mb-20px">
                            <div class="box-hover text-center">
                                <figure class="mb-0 position-relative">
                                    <div class="blog-image position-relative overflow-hidden border-radius-6px">
                                        <a href="{{ route('blog.view', $rp->slug) }}"><img src="{{ $rp->thumbnail_image ?? 'https://placehold.co/800x1015' }}" alt="{{ $rp->title }}" /></a>
                                    </div>
                                    <figcaption class="post-content-wrapper overflow-hidden border-radius-6px">
                                        <div class="position-relative bg-dark-gray post-content p-30px z-index-2 lh-initial">
                                            <a href="{{ route('blog.view', $rp->slug) }}" class="card-title mb-0 fs-20 lh-28 text-white d-inline-block">{{ $rp->title }}</a>
                                            <div class="box-overlay bg-dark-gray z-index-minus-1"></div>
                                        </div>
                                        <div class="fs-15 bg-white p-15px lg-ps-10px lg-pe-10px lh-initial"><span class="d-inline-block">By <a href="#">{{ $rp->category->name ?? 'Admin' }}</a></span><span class="separator d-inline-block">|</span><a href="#">{{ $rp->created_at->format('d M Y') }}</a></div>
                                    </figcaption>
                                </figure>
                            </div>
                        </li>
                        @empty
                        <li class="grid-item">No related posts.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->

</div>