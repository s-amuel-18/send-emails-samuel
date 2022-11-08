<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- Search Engine -->
    <meta name="description"
        content=" Somos una agencia de profesionales experimentados en el diseño y desarrollo de interfaces web, donde nuestra principal objetivo es impulsar las ventas de tu negocio, dando una presencia con alta visibilidad en el campo de marketing digital de manera efectiva.">
    <meta name="keywords"
        content="Diseño web, Desarrollo de sistemas, Creacion de paginas web, Landing page, Maquetación" />
    <meta name="image" content="{{ asset('images/logo/Fluxel_logo_meta.png') }}">
    <meta name="copyright" content="Fluxel-code" />
    <meta name="Revisit-after" content="10 days">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="Fluxel Code">
    <meta itemprop="description"
        content=" Somos una agencia de profesionales experimentados en el diseño y desarrollo de interfaces web, donde nuestra principal objetivo es impulsar las ventas de tu negocio, dando una presencia con alta visibilidad en el campo de marketing digital de manera efectiva.">
    <meta itemprop="image" content="{{ asset('images/logo/Fluxel_logo_meta.png') }}">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Fluxel Code">
    <meta name="twitter:description"
        content=" Somos una agencia de profesionales experimentados en el diseño y desarrollo de interfaces web, donde nuestra principal objetivo es impulsar las ventas de tu negocio, dando una presencia con alta visibilidad en el campo de marketing digital de manera efectiva.">
    <meta name="twitter:image:src" content="{{ asset('images/logo/Fluxel_logo_meta.png') }}">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="Fluxel Code">
    <meta name="og:description"
        content=" Somos una agencia de profesionales experimentados en el diseño y desarrollo de interfaces web, donde nuestra principal objetivo es impulsar las ventas de tu negocio, dando una presencia con alta visibilidad en el campo de marketing digital de manera efectiva.">
    <meta name="og:image" content="{{ asset('images/logo/Fluxel_logo_meta.png') }}">
    <meta name="og:url" content="https://www.fluxelcode.com">
    <meta name="og:site_name" content="Fluxel Code">
    <meta name="og:type" content="website">

    <link rel="icon" href="{{ asset('images/logo/fluxel_code.png') }}" type="image/x-icon">

    <title>Fluxel Code | Samuel Graterol</title>

    <style>
        .lorader-first {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 999;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/css/style.css') }}" />

</head>

<body class="pt-5 pt-md-0">
    {{-- <div class="lorader-first" id="lorader_first"></div> --}}

    <div id="preloader">
        <div class="loader_line"></div>
    </div>
    <!-- /PRELOADER -->

    <!-- WRAPPER ALL -->
    <div class="dizme_tm_all_wrap" data-magic-cursor="show">


        <!-- MOBILE MENU -->
        <div class="dizme_tm_mobile_menu">
            <div class="mobile_menu_inner">
                <div class="mobile_in">
                    <div class="logo">
                        <a href="{{ route('home') }}#">
                            <img src="{{ asset($info_page['route_logo'] ?? 'front/Vectores/Logo/Artboard 36.png') }}"
                                alt="" />
                        </a>
                    </div>
                    <div class="trigger">
                        <div class="hamburger hamburger--slider">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <div class="dropdown_inner">
                    <ul class="anchor_nav">
                        <li class="current"><a href="{{ route('home') }}#home">Inicio</a></li>
                        <li><a href="{{ route('home') }}#about">Sobre Mi</a></li>
                        <li><a href="{{ route('home') }}#portfolio">Portafolio</a></li>
                        <li><a href="{{ route('home') }}#testimonies">Testimonios</a></li>
                        <li><a href="{{ route('home') }}#contact">Contacto</a></li>
                        <li class="download_cv"><a href="{{ asset('pdf/Samuel-Graterol-Curricullum-Vitae.pdf') }}"
                                download><span>Descargar CV</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /MOBILE MENU -->

        <!-- HEADER -->
        <div class="dizme_tm_header">
            <div class="container">
                <div class="inner">
                    <div class="logo">
                        <a href="{{ route('home') }}#">
                            <img src="{{ asset($info_page['route_logo'] ?? 'front/Vectores/Logo/Artboard 36.png') }}"
                                alt="" />
                        </a>
                    </div>
                    <div class="menu">
                        <ul class="anchor_nav">
                            <li class="current"><a href="{{ route('home') }}#home">Inicio</a></li>
                            <li><a href="{{ route('home') }}#about">Sobre Mi</a></li>
                            <li><a href="{{ route('home') }}#portfolio">Portafolio</a></li>
                            <li><a href="{{ route('home') }}#testimonies">Testimonios</a></li>
                            <li><a href="{{ route('home') }}#contact">Contacto</a></li>
                            <li class="download_cv"><a href="{{ asset('pdf/Samuel-Graterol-Curricullum-Vitae.pdf') }} "
                                    download><span>Descargar CV</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /HEADER -->


        @yield('content')

        @if ($info_page['contact_info']->whatsapp_url ?? null)
            <a target="_blanck" href="{{ $info_page['contact_info']->whatsapp_url }}" class="btn btn_fixed whatsapp">
                <i class="fab fa-whatsapp" aria-hidden="true"></i>
            </a>
        @endif
        <!-- COPYRIGHT -->
        <div class="dizme_tm_section">
            <div class="dizme_tm_copyright">
                <div class="container">
                    <div class="inner">
                        <div class="left wow fadeInLeft" data-wow-duration="1s">
                            <p>Desarrollado por Samuel Graterol &copy; 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /COPYRIGHT -->

        <!-- CURSOR -->
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>
        <!-- /CURSOR -->

        <!-- TOTOP -->
        {{-- <div class="progressbar">
            <a href="{{ route('home') }}#"><span class="text">To Top</span></a>
            <span class="line"></span>
        </div> --}}
        <!-- /TOTOP -->

    </div>
    <!-- / WRAPPER ALL -->


    <div id="testimony" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="testimony_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testimony_modal">Testimonio</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="insert_review"></p>
                </div>
            </div>
        </div>
    </div>


    <!-- STYLES -->
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/lib/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/css/plugins.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/css/dark.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/lib/justlazy/justlazy.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-portfolio/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" />


    <!--[if lt IE 9]> <script type="text/javascript" src="js/modernizr.custom.js"></script> <![endif]-->
    <!-- /STYLES -->
    @stack('css')

    <!-- SCRIPTS -->
    <script src="{{ asset('assets-portfolio/js/jquery.js') }}"></script>
    {{-- <script src="{{ asset('assets-portfolio/js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('front/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap 4.1.3 -->
    <script src="{{ asset('assets-portfolio/lib/justlazy/justlazy.min.js') }}"></script>
    <!--[if lt IE 10]> <script type="text/javascript" src="js/ie8.js"></script> <![endif]-->
    <script src="{{ asset('assets-portfolio/js/plugins.js') }}"></script>
    <script src="{{ asset('assets-portfolio/js/init.js') }}"></script>
    {{-- * mostrar testimonio en modal --}}
    <script src="{{ asset('js/testimony/show_testimony.js') }}"></script>


    <script>
        Justlazy.registerLazyLoadByClass("lazy-load");
    </script>
    <!-- /SCRIPTS -->
    @stack('js')

</body>

</html>
