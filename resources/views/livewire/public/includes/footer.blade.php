<footer class="bg-light-gray pb-40px">
    <div class="container">
        <div class="row mb-2 md-mb-4 overlap-section" data-anime='{ "el": "childs", "translateY": [-15, 0], "scale": [0.5, 1], "opacity": [0,1], "duration": 800, "delay": 300, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-12 text-center">
                <img class="rounded-circle" src="{{ asset('asset/images/demo-travel-agency-home-16.png') }}" alt="" />
            </div>
        </div>
        <!-- start subscribe item -->
        <div class="row justify-content-center mb-6 md-mb-8 xs-mb-40px">
            <div class="col-xl-6 col-lg-8 col-md-10 text-center last-paragraph-no-margin">
                <h2 class="text-dark-gray alt-font fw-600 mb-40px mx-auto w-90 ls-minus-2px">Get the amazing travel offers into your inbox!</h2>
                <div class="d-inline-block w-100 newsletter-style-03 position-relative mb-30px">
                    <form action="email-templates/subscribe-newsletter.php" method="post" class="position-relative w-100">
                        <input class="input-large bg-white border-color-transparent w-100 border-radius-100px box-shadow-extra-large form-control required" type="email" name="email" placeholder="Enter your email address" />
                        <input type="hidden" name="redirect" value="">
                        <button class="btn btn-large text-dark-gray ls-0px left-icon submit fw-600" aria-label="submit"><i class="icon feather icon-feather-mail icon-small text-base-color"></i><span>Subscribe</span></button>
                        <div class="form-results border-radius-100px pt-10px pb-10px ps-15px pe-15px fs-16 mt-10px w-100 z-index-1 text-center position-absolute d-none"></div>
                    </form>
                </div>
                <p class="fs-16 lh-normal">We are committed to protecting your <a href="#" class="text-decoration-line-bottom text-dark-gray text-dark-gray-hover">privacy policy.</a></p>
            </div>
        </div>
        <!-- end subscribe item -->
     
        <div class="row align-items-center">
            <div class="col-xl-3 col-sm-6 text-center text-sm-start last-paragraph-no-margin fs-15 text-dark-gray order-3 order-md-1">
                <p>&COPY; Copyright 2025 <a href="{{route('home')}}" target="_blank" class="text-dark-gray text-dark-gray-hover text-decoration-line-bottom fw-600">TeerthYatraHoliday</a></p>
            </div>
            <div class="col-xl-6 text-center lg-mt-10px sm-mt-0 sm-mb-15px order-1 order-xl-2 order-md-3">
                <ul class="footer-navbar">
                    <li class="nav-item"><a href="{{route('about')}}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{route('destination')}}" class="nav-link">Destinations</a></li>
                    <li class="nav-item"><a href="{{route('tour')}}" class="nav-link">Tours</a></li>
                    <li class="nav-item"><a href="{{route('blog')}}" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact</a></li>
                </ul>
            </div>
            <div class="col-xl-3 col-sm-6 position-relative text-center text-sm-end elements-social social-text-style-08 order-2 order-xl-3 xs-mb-10px">
                <ul class="small-icon dark">
                    <li><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a class="dribbble" href="http://www.dribbble.com" target="_blank"><i class="fa-brands fa-dribbble"></i></a></li>
                    <li><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>