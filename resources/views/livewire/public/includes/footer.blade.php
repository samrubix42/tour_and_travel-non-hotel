<footer class="footer-compact mt-auto">
    <div class="container">
        <div class="row py-2">
            <!-- Logo & About -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <a href="{{ route('home') }}" class="d-inline-block mb-3">
                    <img src="{{ asset(setting('logo') ?: 'asset/image/logo22.png') }}" alt="{{ setting('site_name', 'Heliyatra Holidays') }}" class="footer-logo">
                </a>
                <p class="fs-14 opacity-6 lh-24 mb-0 pe-lg-5">
                    {{ setting('footer_about', 'Discover handpicked travel experiences designed for comfort, value, and excitement. We specialize in making your spiritual and leisure journeys memorable.') }}
                </p>
            </div>

            <!-- Links -->
            <div class="col-lg-2 col-md-3 col-6 mb-4 mb-lg-0">
                <h6 class="footer-title">Company</h6>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('experience') }}">Experiences</a></li>
                    <li><a href="{{ route('blog') }}">Travel Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-3 col-6 mb-4 mb-lg-0">
                <h6 class="footer-title">Destinations</h6>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="{{ route('destination', ['categorySlug' => 'domestic']) }}">India Tours</a></li>
                    <li><a href="{{ route('destination', ['categorySlug' => 'international']) }}">Global Tours</a></li>
                    <li><a href="{{ route('destination', ['categorySlug' => 'yatra']) }}">Spiritual Yatra</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-12">
                <h6 class="footer-title">Contact Information</h6>
                <div class="footer-contact-item d-flex align-items-start mb-2">
                    <i class="fa-solid fa-location-dot mt-1 me-2 text-orange fs-14" style="width: 16px; text-align: center;"></i>
                    <span class="fs-14 opacity-7">{{ setting('address', 'South Extension I, New Delhi, 110049') }}</span>
                </div>
                <div class="footer-contact-item d-flex align-items-center mb-2">
                    <i class="fa-solid fa-envelope me-2 text-orange fs-14" style="width: 16px; text-align: center;"></i>
                    <a href="mailto:{{ setting('email', 'info@chardhamheliyatra.in') }}" class="fs-14 text-white text-decoration-none opacity-7 hover-opacity-10">{{ setting('email', 'info@chardhamheliyatra.in') }}</a>
                </div>
                <div class="footer-contact-item d-flex align-items-center mb-3">
                    <i class="fa-solid fa-phone me-2 text-orange fs-14" style="width: 16px; text-align: center;"></i>
                    <a href="tel:{{ setting('phone', '+91-9411841092') }}" class="fs-14 text-white text-decoration-none opacity-7 hover-opacity-10">{{ setting('phone', '+91-9411841092') }}</a>
                </div>
                
                <div class="social-icons-wrapper d-flex gap-2">
                    @if(setting('facebook_link'))
                    <a href="{{ setting('facebook_link') }}" target="_blank" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if(setting('instagram_link'))
                    <a href="{{ setting('instagram_link') }}" target="_blank" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if(setting('twitter_link'))
                    <a href="{{ setting('twitter_link') }}" target="_blank" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                    @endif
                    @if(setting('whatsapp_number'))
                    <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                    @endif
                    @if(setting('linkedin_link'))
                    <a href="{{ setting('linkedin_link') }}" target="_blank" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    @endif
                    @if(setting('youtube_link'))
                    <a href="{{ setting('youtube_link') }}" target="_blank" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row py-1 border-top border-white-subtle">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="mb-0 fs-12 opacity-5">&copy; {{ date('Y') }} {{ setting('site_name', 'Heliyatra Holidays') }}. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="fs-12 opacity-5">
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .footer-compact {
            background-color: #1e110a;
            color: #ffffff;
            padding-bottom: 0px;
        }

        .footer-title {
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-logo {
            height: 50px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .footer-links a:hover {
            color: #e45b15 !important;
            padding-left: 5px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 6px;
            color: #ffffff !important;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: #e45b15;
            color: #fff !important;
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(228, 91, 21, 0.2);
        }

        .text-orange { color: #e45b15; }
        .hover-opacity-10:hover { opacity: 1 !important; }
        .border-white-subtle { border-color: rgba(255, 255, 255, 0.05) !important; }
        
        .fs-12 { font-size: 12px; }
        .fs-14 { font-size: 14px; }
        .opacity-5 { opacity: 0.5; }
        .opacity-6 { opacity: 0.6; }
        .opacity-7 { opacity: 0.7; }

        @media (max-width: 991px) {
            .footer-compact { padding-top: 10px; }
            .footer-title { margin-top: 15px; margin-bottom: 15px; }
            .footer-logo { height: 45px; }
        }
    </style>
</footer>