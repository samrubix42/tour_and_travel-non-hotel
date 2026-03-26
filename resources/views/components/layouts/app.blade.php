<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="ThemeZaa">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    @yield('meta_tags')
    <link rel="icon" type="image/x-icon" href="{{ asset(setting('favicon') ?: 'asset/image/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('asset/images/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('asset/images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('asset/images/apple-touch-icon-114x114.png') }}">
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- slider revolution CSS files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/revolution/css/navigation.css') }}">
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="{{ asset('asset/css/vendors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/travel-agency/travel-agency.css') }}" />
    @livewireStyles
    <style>
        /* Social bottom bar - mobile only (monochrome, professional) */
        .social-bottom-bar {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background: rgba(10, 12, 16, 0.85);
            display: flex;
            justify-content: center;
            gap: 12px;
            padding: 10px 14px;
            padding-bottom: calc(10px + env(safe-area-inset-bottom));
            z-index: 9999;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            box-shadow: 0 -6px 24px rgba(0, 0, 0, .28)
        }

        .social-bottom-bar .sb-link {
            color: #fff;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            font-weight: 600;
            font-size: 18px;
            padding: 6px;
            border: 1px solid rgba(255, 255, 255, 0.04)
        }

        .social-bottom-bar .sb-link i {
            font-size: 18px;
            line-height: 1;
            display: block
        }

        .social-bottom-bar .sb-link:hover {
            transform: translateY(-4px);
            transition: transform .14s, box-shadow .14s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .28)
        }

        /* Neutral (no bright brand colors) tap target variants kept for semantic classes */
        .social-bottom-bar .sb-link.facebook,
        .social-bottom-bar .sb-link.youtube,
        .social-bottom-bar .sb-link.phone,
        .social-bottom-bar .sb-link.instagram,
        .social-bottom-bar .sb-link.linkedin {
            background: rgba(255, 255, 255, 0.03);
            color: #fff
        }

        /* Sticky right contacts for desktop */
        /* Sticky left contacts for desktop (social icons) */
        .sticky-left-contacts{
            position:fixed;
            left:18px;
            top:60%;
            display:flex;
            flex-direction:column;
            gap:12px;
            z-index:99999;
            transform:translateY(-10%);
        }

        .sticky-left-contacts a{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:48px;
            height:48px;
            border-radius:8px;
            color:#fff;
            text-decoration:none;
            box-shadow:0 8px 26px rgba(6,8,13,.12);
            font-size:16px;
            border:1px solid rgba(255,255,255,0.06);
        }

        .sticky-left-contacts a i{font-size:18px}

        .sticky-left-contacts a.facebook{background:#1877F2}
        .sticky-left-contacts a.youtube{background:#FF0000}
        .sticky-left-contacts a.instagram{background:linear-gradient(45deg,#feda75,#d62976,#962fbf,#4f5bd5)}
        .sticky-left-contacts a.linkedin{background:#0A66C2}

        /* Sticky right contacts for desktop (lowered) */
        .sticky-right-contacts{
            position:fixed;
            right:18px;
            top:70%;
            display:flex;
            flex-direction:column;
            gap:12px;
            z-index:99999;
            transform:translateY(-5%);
        }

        .sticky-right-contacts a{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:56px;
            height:56px;
            border-radius:50%;
            color:#fff;
            text-decoration:none;
            box-shadow:0 8px 26px rgba(6,8,13,.12);
            font-size:18px;
            border:1px solid rgba(255,255,255,0.06);
        }

        .sticky-right-contacts a i{font-size:20px}

        .sticky-right-contacts a.whatsapp{background:#25D366;color:#fff;border-color:rgba(37,211,102,0.12)}
        .sticky-right-contacts a.phone{background:#e45b15;color:#fff;border-color:rgba(228,91,21,0.12)}

        /* Hover state */
        .sticky-left-contacts a:hover, .sticky-right-contacts a:hover{transform:translateY(-4px);transition:transform .14s, box-shadow .14s;box-shadow:0 14px 34px rgba(6,8,13,.14)}
        /* Desktop: hide mobile bottom bar; Mobile: hide desktop sticky */
        @media (min-width: 768px) {
            .social-bottom-bar {
                display: none
            }
        }

        @media (max-width: 767px) {
            .sticky-right-contacts {
                display: none !important;
            }
            .sticky-left-contacts {
                display: none !important;
            }

            .social-bottom-bar {
                justify-content: center;
                padding: 10px
            }

            .social-bottom-bar .sb-link {
                width: 46px;
                height: 46px;
                border-radius: 10px
            }

            .social-bottom-bar .sb-link i {
                font-size: 18px
            }
        }
    </style>
</head>

<body data-mobile-nav-style="classic">

    <livewire:public.includes.header />

    {{-- Main content slot --}}
    {{ $slot }}

    {{-- Footer include (provided by user) --}}
    <livewire:public.includes.footer />
    <!-- Bottom social bar (mobile order: Facebook, YouTube, Phone, Instagram, LinkedIn) -->
    <div class="social-bottom-bar" aria-hidden="false">
        <a href="https://www.facebook.com/nareshsharmajnv" class="sb-link facebook" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
        <a href="https://www.youtube.com/@nareshsharmajnv" class="sb-link youtube" aria-label="YouTube" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube"></i></a>
        <a href="https://www.instagram.com/naresh_sharma_jnv" class="sb-link instagram" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/in/naresh-sharma-b72a98201" class="sb-link linkedin" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
        <a href="tel:+919411841092" id="mobile-phone-contact" class="sb-link phone" aria-label="Phone"><i class="bi bi-telephone"></i></a>
        <a href="https://wa.me/919411841092?text=Hello,%20I%20am%20interested%20in%20your%20tour%20packages.%20Could%20you%20please%20share%20details%20and%20pricing%3F" class="sb-link whatsapp" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp"></i></a>

    </div>

    <!-- Sticky left-side social contacts (desktop) -->
    <div class="sticky-left-contacts" aria-hidden="false">
        <a href="https://www.facebook.com/nareshsharmajnv" class="facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.youtube.com/@nareshsharmajnv" class="youtube" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
        <a href="https://www.instagram.com/naresh_sharma_jnv" class="instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.linkedin.com/in/naresh-sharma-b72a98201" class="linkedin" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
    </div>

    <!-- Sticky right-side contacts (desktop) -->
    <div class="sticky-right-contacts" aria-hidden="false">
        <a href="tel:+919411841092" id="sticky-phone-contact" class="phone" aria-label="Call"><i class="bi bi-telephone"></i></a>
        <a href="https://wa.me/919411841092?text=Hello,%20I%20am%20interested%20in%20your%20tour%20packages.%20Could%20you%20please%20share%20details%20and%20pricing%3F" target="_blank" rel="noopener noreferrer" class="whatsapp" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
    </div>
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <script type="text/javascript" src="{{ asset('asset/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/vendors.min.js') }}"></script>

    <!-- slider revolution core javaScript files -->
    <script type="text/javascript" src="{{ asset('asset/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

    <!-- slider revolution extension scripts. ONLY NEEDED FOR LOCAL TESTING -->
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <!-- Slider Revolution add on files -->
    <script type='text/javascript' src='{{ asset('asset/revolution/revolution-addons/particles/js/revolution.addon.particles.min.js') }}?ver=1.0.3'></script>
    <!-- Slider's main "init" script -->
    <script type="text/javascript">
        /* https://learn.jquery.com/using-jquery-core/document-ready/ */
        jQuery(document).ready(function() {

            /* initialize the slider based on the Slider's ID attribute from the wrapper above */
            jQuery('#travel-agency-slider').show().revolution({
                sliderType: "standard",
                /* options are 'auto', 'fullwidth' or 'fullscreen' */
                sliderLayout: 'fullscreen',
                /* sets the Slider's default timeline */
                delay: 9000,
                /* options that disable autoplay */
                stopLoop: "off",
                stopAfterLoops: 0,
                stopAtSlide: 1,
                navigation: {

                    keyboardNavigation: 'on',
                    keyboard_direction: 'horizontal',
                    mouseScrollNavigation: 'off',
                    mouseScrollReverse: 'reverse',
                    onHoverStop: 'off',
                    touch: {
                        touchenabled: 'on',
                        touchOnDesktop: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: 'horizontal',
                        drag_block_vertical: true
                    },
                    arrows: {

                        enable: true,
                        style: 'hesperiden',
                        tmp: '',
                        rtl: false,
                        hide_onleave: false,
                        hide_onmobile: true,
                        hide_under: 0,
                        hide_over: 9999,
                        hide_delay: 200,
                        hide_delay_mobile: 1200,

                        left: {
                            container: 'slider',
                            h_align: 'left',
                            v_align: 'center',
                            h_offset: 30,
                            v_offset: 0
                        },

                        right: {
                            container: 'slider',
                            h_align: 'right',
                            v_align: 'center',
                            h_offset: 30,
                            v_offset: 0
                        }

                    }
                },
                responsiveLevels: [1240, 1024, 778, 480],
                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                gridwidth: [1190, 1024, 778, 480],
                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                gridheight: [900, 920, 700, 650],
                /* Lazy Load options are "all", "smart", "single" and "none" */
                lazyType: "smart",
                spinner: "spinner0",
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 1000,
                    speedbg: 1500,
                    speedls: 1000,
                    levels: [3, 5, 8, 10, 12, 15, 35, 40, 45, 50, -50, -45, -40, -35, -30, -25],
                    ddd_shadow: "on",
                    ddd_bgfreeze: "off",
                    ddd_overflow: "hidden",
                    ddd_layer_overflow: "visible",
                    ddd_z_correction: 40,
                    disable_onmobile: 'on'
                },
                shadow: 0,
                shuffle: "off",
                autoHeight: "on",
                fullScreenAutoWidth: "off",
                fullScreenAlignForce: "off",
                fullScreenOffsetContainer: "",
                fullScreenOffset: "",
                disableProgressBar: "on",
                hideThumbsOnMobile: "on",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('asset/js/main.js') }}"></script>
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            function openContact(tel, wa){
                if(!tel || !wa) return;
                // On touch-first devices prefer the native call behavior
                if(window.matchMedia && window.matchMedia('(pointer: coarse)').matches){
                    window.location.href = 'tel:' + tel;
                    return;
                }
                var ok = confirm('Open WhatsApp chat? Press OK for WhatsApp, Cancel to call.');
                if(ok){
                    var waUrl = 'https://wa.me/' + wa + '?text=' + encodeURIComponent('Hello, I am interested in your tour packages. Could you please share details and pricing?');
                    window.open(waUrl, '_blank');
                } else {
                    window.location.href = 'tel:' + tel;
                }
            }

            ['mobile-phone-contact','sticky-phone-contact'].forEach(function(id){
                var el = document.getElementById(id);
                if(!el) return;
                el.addEventListener('click', function(e){
                    e.preventDefault();
                    openContact('919411841092','919411841092');
                });
            });
        });
    </script>
</body>

</html>