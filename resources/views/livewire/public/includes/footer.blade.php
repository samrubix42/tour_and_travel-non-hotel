<footer class="footer-dark mt-auto pb-0">
    <div class="container">
        <!-- Top Bar -->
        <div class="row align-items-center footer-top-bar">
            <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                <span class="d-block text-uppercase fs-11 ls-1px text-light-gray-transparent">Send Email</span>
                <a href="mailto:{{ setting('email', 'info@chardhamheliyatra.in') }}" class="fs-18 fw-600 footer-contact-link">
                    {{ setting('email', 'info@chardhamheliyatra.in') }}
                </a>
            </div>
            <div class="col-lg-4 text-center mb-4 mb-lg-0">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(setting('logo') ?: 'asset/image/logo22.png') }}" alt="Logo" class="footer-logo">
                </a>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <span class="d-block text-uppercase fs-11 ls-1px text-light-gray-transparent">Call 24/7</span>
                <a href="tel:{{ setting('phone', '+91-9411841092') }}" class="fs-18 fw-600 footer-contact-link">
                    {{ setting('phone', '+91-9411841092') }}
                </a>
            </div>
        </div>

        <!-- Main Footer Links -->
        <div class="row mt-5">
            <!-- Explore -->
            <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                <h6 class="footer-title">Explore</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('about') }}">About us</a></li>
                    <li><a href="{{ route('tour') }}">Packages</a></li>
                    <li><a href="{{ route('destination') }}">Gallery</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('destination') }}">Yatra</a></li>
                    <li><a href="{{ route('tour') }}">Tours In India</a></li>
                    <li><a href="{{ route('tour') }}">International Tours</a></li>
                    <li><a href="{{ route('blog') }}">Blogs</a></li>
                </ul>
            </div>

            <!-- Contact/Address -->
            <div class="col-lg-3 col-sm-6 mb-5 mb-lg-0">
                <h6 class="footer-title">Contact</h6>
                <p class="footer-text">
                    H-46, 2nd Floor, South<br>
                    Extension I, New Delhi, Delhi<br>
                    110049
                </p>
                <div class="mt-4">
                    <a href="tel:+918077365185" class="d-block footer-text mb-1">+91-8077365185</a>
                    <a href="tel:+918602710001" class="d-block footer-text mb-3">+91-8602710001</a>
                    <a href="mailto:ops@holidaysolution.in" class="d-block footer-text">ops@holidaysolution.in</a>
                </div>
            </div>

            <!-- Let's Connect -->
            <div class="col-lg-3 col-sm-6">
                <h6 class="footer-title">Let's Connect</h6>
                <div class="social-icons-wrapper d-flex flex-wrap">
                    <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <div class="w-100"></div>
                    <a href="#" class="social-icon mt-2"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-5 pt-4 pb-4 border-top border-color-transparent-white">
            <div class="col-12 text-center text-light-gray-transparent fs-13">
                <p class="mb-0">&copy; {{ date('Y') }} Heliyatra Holidays. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Background Decoration matching the "Orange/Brown" request -->
    <style>
        .footer-dark {
            background-color: #352118 !important; /* Rich Dark Brown */
            color: #ffffff;
            padding-top: 60px;
        }

        .footer-top-bar {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 30px;
            margin-bottom: 20px;
        }

        .footer-title {
            color: #ffffff !important;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 30px;
            text-transform: capitalize;
        }

        .footer-logo {
            height: 70px;
            width: auto;
            filter: brightness(0) invert(1); /* Makes logo white if it was dark */
        }

        .text-light-gray-transparent {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .footer-contact-link {
            color: #ffffff !important;
            text-decoration: none;
            transition: 0.3s;
        }

        .footer-contact-link:hover {
            color: #f4b41a !important; /* Golden Orange hover */
        }

        .footer-links {
            padding-left: 0;
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a, .footer-text {
            color: rgba(255, 255, 255, 0.7) !important;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
            line-height: normal;
        }

        .footer-links a:hover {
            color: #f4b41a !important;
            padding-left: 5px;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            margin-right: 12px;
            color: #ffffff !important;
            text-decoration: none;
            transition: 0.3s;
        }

        .social-icon:hover {
            background: #f4b41a !important;
            color: #352118 !important;
            transform: translateY(-3px);
        }

        .border-color-transparent-white {
            border-color: rgba(255, 255, 255, 0.05) !important;
        }

        @media (max-width: 991px) {
            .footer-title {
                margin-bottom: 20px;
                font-size: 18px;
            }
            .footer-top-bar a {
                font-size: 16px;
            }
        }
    </style>
</footer>