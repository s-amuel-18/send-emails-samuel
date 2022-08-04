@extends('front.layouts.app')

@section('content')
    <!-- contenedor oculto de google translate -->
    <div id="google_translate_element" style="display:none"></div>

    {{-- Boton Whatsapp --}}
    <div
        class="btn-ws d-flex justify-content-center align-items-center animate__animated animate__pulse animate__infinite infinite ">
        <div class="btn-ws-2 text-center ">
            <a target="_blank" href="https://walink.co/c9af79"><i class="fa fa-2x fa-whatsapp text-white "
                    aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- Page Loading -->
    <div class="se-pre-con  animate__animated animate__pulse animate__infinite infinite ">
        <div
            class="h-100 d-flex justify-content-center align-items-center animate__animated animate__pulse animate__infinite infinite ">
            <img class="" src="{{ asset('front/Vectores/Logo/Artboard 36.png') }}" width="150" alt="">

        </div>
    </div>
    <!-- ======== Start Navbar ======== -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dar fixed-top ">
        <div class="container ">
            <a class="navbar-brand" href="#"><img class="icon-tec"
                    src="{{ asset('front/Vectores/Logo/Artboard 35.svg') }}" alt="Logo Fluxel-code" /></a>
            <button class="navbar-toggler w-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Características</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#historia"> Historia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonio</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#funciona">Funcionamiento</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#faq" translate="no">FAQ</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-capitalize" href="{{ route('home.index') }}" translate="no">Login</a>
                    </li>


                </ul>
                <a href="#contact" class="btn-1">Contactanos!</a>
                <li class="d-flex nav-item p-2">
                    <a class="flag_link eng pr-2" data-lang="en"><span class="flag-icon flag-icon-us"></span></a>
                    <a class="flag_link es" data-lang="es"><span class="flag-icon flag-icon-es"></span></a>
                </li>

            </div>
        </div>
    </nav>
    <!-- ======== End Navbar ======== -->

    <!-- ======== Start Slider ======== -->
    <section class="slider d-flex align-items-center py-5 flow-h" id="slider">
        <div class="container text-white">
            <div class="content">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5 p-3">
                        <h1 class="text-capitalize" data-w>Estrategia digital</h1>
                        <p>
                            Nos especializamos en diseño web y desarrollo de sistemas,
                            soluciones simples para empresas y emprendedores, que buscan una
                            manera rápida, accesible y práctica para mejorar su presencia en
                            la web.
                        </p>
                        <a href="#contact" class="btn-g">Conocenos</a>
                    </div>
                    <div class="col-lg-7 p-3 wow animate__zoomIn" data-wow-duration="2s">
                        <img src="{{ asset('front/Vectores/1.svg') }}" alt="Principal"
                            class="img-fluid header-img-custom" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Slider ======== -->

    <!-- ======== Start Join ======== -->
    <section class="join flow-h">
        <div class="container">
            <div class="content">
                <div class="row">
                    <!-- Developer -->
                    <div class="col-md-6">
                        <div class="box left-box wow animate__slideInUp" data-wow-duration="2s">
                            <img class="wow animate__fadeInDown" data-wow-duration="1s"
                                src="{{ asset('front/img/developer.png') }}" alt="atomo" />
                            <h3 class="" data-wow-duration="1s">Programacion</h3>
                            <ul class="ul-join text-left ">
                                <li class="text-left" data-wow-duration="1.2s">Desarrollo de sistema financieros</li>
                                <li class="text-left" data-wow-duration="1.5s">Desarrollo de tienda virtual</li>
                                <li class="text-left" data-wow-duration="1.7s">Implementación de sistemas</li>
                                <li class="text-left" data-wow-duration="2s">Creacion de Aplicativos Web</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Designer -->
                    <div class="col-md-6">
                        <div class="box wow animate__slideInUp" data-wow-duration="2s">
                            <img class="wow animate__fadeInDown" data-wow-duration="1s"
                                src="{{ asset('front/img/designer.png') }}" alt="persona usuario" />
                            <h3 class="dark-pink " data-wow-duration="1s">Diseño Audiovisual</h3>
                            <ul class="ul-join text-left">
                                <li class="text-left" data-wow-duration="1.2s">Creacion de marca personal</li>
                                <li class="text-left" data-wow-duration="1.5s">Diseño de logo</li>
                                <li class="text-left" data-wow-duration="1.7s">Edicion foto y video</li>
                                <li class="text-left" data-wow-duration="2s">Diseño Gráfico</li>
                                <li class="text-left" data-wow-duration="2.3s">Redaccion de contenido</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Join ======== -->

    <!-- ======== Start Features ======== -->
    <section class="features flow-h" id="features">
        <div class="container text-center">
            <div class="heading wow animate__slideInUp" data-wow-duration="2s">
                <h2>Te ayudamos a tener éxito con la tecnología!</h2>
                <div class="line m-auto"></div>
                <p>
                    Nuestros especialistas, te aseroraran para obtener el mayor provecho
                    de la tecnologia
                    <br />
                    y asi obtener mayor trafico de usuarios en la web.
                </p>
            </div>
            <!-- Boxes-->
            <div class="slick-slider">
                <!-- Box-1 -->
                <div class="box">
                    <img src="{{ asset('front/Vectores/Slider/desarrollo.svg') }}" alt="grafico" class="m-auto icons" />
                    <h3>Desarrollo de sistema financieros</h3>
                    <p>
                        Te ayudamos a generar sistemas optimizados de manera eficiente
                        para tus necesidades gerenciales administrativas.
                    </p>
                </div>
                <!-- Box-2 -->
                <div class="box">
                    <img src="{{ asset('front/Vectores/Slider/tienda.svg') }}" alt="logo tienda" class="m-auto icons" />
                    <h3>Desarrollo de tienda virtual</h3>
                    <p>
                        Asesoramos a asegurar que el diseño de la tienda virtual se base
                        en grantizar y que la seleccion del producto sea la mas precisa
                        posible.
                    </p>
                </div>
                <!-- Box-3 -->
                <div class="box">
                    <img src="{{ asset('front/Vectores/Slider/aplicativos.svg') }}" alt="monitor"
                        class="m-auto icons" />
                    <h3>Creacion de Aplicativos Web</h3>
                    <p>
                        Aplicamos las tecnologias mas novedosas y adaptables a cualquier
                        dispositivo y necesidades del usuario.
                    </p>
                </div>
                <!-- Box-1 -->
                <div class="box">
                    <img src="{{ asset('front/Vectores/Slider/marca.svg') }}" alt="banner con corazon"
                        class="m-auto img-fluid icons" />
                    <h3>Creacion de Marca personal</h3>
                    <p>
                        Brindamos el apoyo en crear un logo y imagen de manera actractiva
                        para tu marca digital.
                    </p>
                </div>
                <!-- Box-2 -->
                <div class="box">
                    <img src="{{ asset('front/Vectores/Slider/audiovisual.svg') }}" alt="iconos media"
                        class="m-auto icons" />
                    <h3>Creacion Audiovisual</h3>
                    <p>Implementamos todos los medios audiovisuales</p>
                </div>
                <!-- Box-3 -->
            </div>
        </div>
    </section>
    <!-- ======== End Features ======== -->

    <!-- ======== Start Get Started ======== -->
    <section class="get-started flow-h">
        <div class="container text-center text-white wow animate__zoomIn " data-wow-duration="2">
            <h2>Contactanos!</h2>
            <p>Respuesta inmediata con nuestros especialistas</p>
            <a href="#contact" class="btn-1">Contacto</a>
        </div>
    </section>
    <!-- ======== End Get Started ======== -->

    <!-- ======== Start Customer ======== -->
    <section class="customer flow-h" id="historia">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="left">
                        <img src="{{ asset('front/Vectores/historia.svg') }}" class="img-fluid"
                            alt="construcción de codigo ">
                    </div>
                </div>
                <div class="col-md-6 wow animate__fadeInUp" data-wow-duration="2s">
                    <div class="right">
                        <img src="{{ asset('front/img/customer-icon.png') }}" alt="enchufe" />
                        <h5>Nuestra Historia</h5>
                        <p class="p-1">
                            Fluxel-code, presentándonos como una agencia de desarrollo
                            enfocada en sitios web y aplicaciones. El aumento del uso de
                            Internet como medio de comunicación y plataforma de negocios,
                            hizo que nuestros propios consumidores demandarán de
                            resoluciones integrales..
                        </p>
                        <p class="p-2">
                            Poco después comenzamos a desarrollar en novedosas zonas como
                            ser: diseñador web, desarrollo web y sistema. Sumamos la
                            ejecución de campañas de publicidad en internet y producciones
                            audiovisuales a nuestros propios servicios
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Customer ======== -->

    <!-- ======== Start Testimonials ======== -->
    <section class="testimonials flow-h" id="testimonials">
        <div class="container ">
            <div class="row text-center">
                <div class="col-md-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <!-- Indicators-->
                        <ol class="carousel-indicators carousel-dot">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner vh-36">
                            <!-- Item-1 -->
                            <div class="carousel-item active text-center">
                                <img src="{{ asset('front/Vectores/Testimonios/fumimark logo.png') }}"
                                    alt="Fumimark logo " class="center-block team " width="100" height="100" />
                                <h3>Otilio Graterol</h3>
                                <h4>Fumimark</h4>
                                <p>
                                    Necesitábamos un Sistema que cubriera las necesidades de
                                    administración de mi organización para atender mejor a los
                                    consumidores y llevar un mejor control interno. El trato y
                                    la calidad a lo largo de todo el proceso fue perfecto.
                                </p>
                            </div>
                            <!-- Item-2 -->
                            <div class="carousel-item text-center">
                                <img src="{{ asset('front/Vectores/Testimonios/avimark logo.png') }}" alt="Avimark logo"
                                    class="center-block team " width="100" height="100" />
                                <h3>Armando Graterol</h3>
                                <h4>Avimark</h4>
                                <p>
                                    Dejar en vuestras manos la construcción de nuestra página
                                    web, sin lugar a dudas fue un acierto. Vuestro orientación y
                                    profesionalidad nos han dotado de una ventana a los
                                    recientes y futuros consumidores del despacho.
                                </p>
                            </div>
                            <!-- Item-3 -->
                            <div class="carousel-item text-center ">
                                <img src="{{ asset('front/Vectores/Testimonios/logo bm.png') }}" alt="Bm Logo"
                                    class="center-block team " width="100" height="100" />
                                <h3>Marcos Vizcaino</h3>
                                <h4>BM</h4>
                                <p>
                                    Nos asesoraron con la produccion audiovisual de nuestra
                                    campaña publicitaria, y desde entonces, nos ha generado una
                                    fuerte base en nuestra imagen.
                                </p>
                            </div>
                        </div>

                    </div>
                    <a class="carousel-control-prev control d-flex  align-items-end justify-content-start "
                        data-target="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="fa fa-angle-left icon d-flex align-items-center justify-content-center"
                            aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next control d-flex justify-content-end align-items-end "
                        data-target="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="fa fa-angle-right icon d-flex align-items-center justify-content-center"
                            aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Testimonials ======== -->


    </div>
    <!-- ======== Start Worked ======== -->
    <section class="worked py-5 my-5 flow-h" id="funciona">
        <div class="container ">
            <div class="row ">
                <!-- left -->
                <div class="col-md-6 d-flex align-items-center ">
                    <div class="box funcion ">
                        <h2 class="wow animate__slideInLeft flow-h " data-wow-duration="2s">¿CÓMO FUNCIONA?</h2>
                        <div class="line"></div>

                        <div id="Carousel-funcion" class="carousel slide funcion " data-ride="carousel"
                            data-interval="3000">
                            <ol class="carousel-indicators  carousel-indicators-funcion ">
                                <li data-target="#Carousel-funcion" data-slide-to="0" class="active"></li>
                                <li data-target="#Carousel-funcion" data-slide-to="1"></li>
                                <li data-target="#Carousel-funcion" data-slide-to="2"></li>
                                <li data-target="#Carousel-funcion" data-slide-to="3"></li>
                                <li data-target="#Carousel-funcion" data-slide-to="4"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item  active">


                                    <h3 class="h3-funcion">1. Evaluación</h3>
                                    <p>
                                        Iniciamos el plan con una evaluación intensa de sus requerimientos para comprender
                                        los objetivos de
                                        su requerimiento sea pagina web. </p>


                                </div>
                                <div class="carousel-item ">
                                    <h3 class="h3-funcion">2. Pre-Diseño</h3>
                                    <p>

                                        La composición y arquitectura del sitio web van a ser diseñadas considerando las
                                        mejores prácticas
                                        de SEO y la vivencia del usuario. </p>
                                </div>
                                <div class="carousel-item ">
                                    <h3 class="h3-funcion">3. Diseño y Desarrollo</h3>
                                    <p>
                                        Usando el Pre-Diseño aprobado, creamos la versión inicial de su portal web. </p>
                                </div>
                                <div class="carousel-item ">
                                    <h3 class="h3-funcion">4. Revisión Final</h3>
                                    <p>
                                        Su sitio está casi completo. Después de presentar el sitio, ud. crea una comprensiva
                                        lista de
                                        cambios.
                                    </p>
                                </div>
                                <div class="carousel-item ">
                                    <h3 class="h3-funcion">5. Lanzamiento</h3>
                                    <p>
                                        Nuestros propios profesionales lo entrenan en como realizar cualquier cambio y
                                        publicamos en vivo su
                                        nuevo sitio
                                        web. </p>


                                </div>
                            </div>

                        </div>
                        <a href="#contact" class="btn-1">Empieza ya!</a>
                    </div>
                </div>
                <!-- Right -->
                <div class="col-lg-6 ">
                    <img src="{{ asset('front/Vectores/como-funciona.svg') }}" alt="Hombre con signo de interrogacion"
                        class="img-fluid" />
                </div>
            </div>
    </section>
    <!-- ======== End Worked ======== -->

    <!-- ======== Start Download ======== -->
    <section class="download flow-h flow-h">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center icon ">
                <div class="col-md-8">
                    <h2 class="wow animate__slideInLeft flow-h" data-wow-duration="2s">Puedes descargar nuestra carta de
                        presentacion!
                    </h2>
                </div>
                <div class=" col-md-4 wow animate__slideInRight " data-wow-duration=" 2s">
                    <div>
                        <a target="_blank" href="{{ route('pdf.cartaPresentacion') }}" class="btn-1">Descargar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Download ======== -->

    <!-- ======== Start Video ======== -->
    <section class="video flow-h flow-h" id="faq">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center pb-5 ">
                <h1 class="h2-faq wow animate__pulse " data-wow-duration="1s">¿Quieres saber más?</h1>
            </div>
            <div class="row">
                <!-- Left -->
                <div class="col-md-4 flex wow animate__fadeInLeft " data-wow-duration="2s">
                    <div class="right d-flex align-self-center flex-column">
                        <h5 class="h5-faq ">¿Qué es un sistema <br> financiero?</h5>
                        <div class="line "></div>
                        <p>
                            Los sistemas estan encargados a recopilar, guardar y procesar datos de Contabilidad
                            Financiera.Modo que,
                            compilan información usada por los usuarios internos para informar a las autoridades
                        </p>

                    </div>
                </div>

                <!-- Center -->
                <div class="col-md-4 wow animate__fadeInUp " data-wow-duration="3s">
                    <div class="right d-flex align-self-center flex-column">
                        <h5 class="h5-faq">¿Qué pasa si ya tengo una página web?</h5>
                        <div class="line"></div>
                        <p>

                            En ese caso, nosotros nos encargamos de optimizarla, mejorando su aspecto visual, rendimiento,
                            relevancia,
                            usabilidad y posicionamiento en Google.
                        </p>

                    </div>
                </div>
                <!-- Right -->
                <div class="col-md-4 wow animate__fadeInRight flow-h" data-wow-duration="4s">
                    <div class="right d-flex align-self-center flex-column">
                        <h5 class="h5-faq">¿Cuando se demoraria en hacer la landing page?</h5>
                        <div class="line"></div>
                        <p>
                            Nosotros en Fluxel-code, gracias a nuestra experiencia podemos hacerte llegar el producto entre
                            3 dias a
                            una semana dependiendo de su requerimiento de manera optima.

                        </p>

                    </div>

                </div>
            </div class="d-flex align-self-center ">
            <a href="#contact" class="btn-faq ">Empecemos ya!</a>
        </div>
        </div>
    </section>
    <!-- ======== End Video ======== -->

    <!-- ======== Start Media ======== -->
    <section class="media flow-h flow-h">
        <div class="container">
            <div class="row">
                <!-- Box-1 -->
                <div class="col-md-6">
                    <div class="box d-flex align-items-center">
                        <div class="image"><img src="{{ asset('front/img/media-1.png') }}" alt="Lupa" /> </div>
                        <h2>Aumento de trafico web</h2>
                    </div>
                </div>
                <!-- Box-2 -->
                <div class="col-md-6">
                    <div class="box d-flex align-items-center">
                        <div class="image"><img src="{{ asset('front/img/media-2.png') }}" alt="Globo" /></div>
                        <h2 class="text-capitalize">Alcance internacional</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Media ======== -->

    <!-- ======== Start Clients ======== -->
    <section class="clients flow-h">
        <div class="container">
            <div class="slick-slider-clients d-flex justify-content-between ">
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/css.svg') }}" alt="Css logo"
                        class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/html.svg') }}" alt="html logo"
                        class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/javascript.svg') }}"
                        alt=" javascript logo" class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/jquery.svg') }}"
                        alt="jquery logo" class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/js.svg') }}" alt="js logo"
                        class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/laravel.svg') }}"
                        alt="laravel logo" class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/mysql.svg') }}" alt="mysql logo"
                        class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/php.svg') }}" alt="php logo"
                        class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/Sass.svg') }}" alt="sass logo"
                        class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/wordpress.svg') }}"
                        alt="wordpress logo" class="img-fluid icon-tec" />
                </div>
                <div class="item d-flex align-items-center justify-content-center">
                    <img style="height: 100px;" src="{{ asset('front/Vectores/Icons-tec/bootstrap.svg') }}"
                        alt="bootstrap logo" class="img-fluid icon-tec" />
                </div>

            </div>
        </div>
    </section>
    <!-- ======== End Clients ======== -->

    <!-- ======== Start Contact ======== -->
    <section class="contact flow-h" id="contact">
        <div class="container">
            <div class="main">
                <div class="row">
                    <div class="col-lg-8 left p-3 p-md-5">
                        <h3>Enviar mensaje</h3>

                        <div id="insert_alert"></div>



                        <form id="form_contact" method="POST" action="{{-- {{ route('envio_email.client_contact_front') }} --}}">

                            @csrf

                            <div class="row">
                                <div class="col-sm-6">

                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre" />
                                </div>
                                <div class="col-sm-6">

                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Correo" />
                                </div>
                            </div>
                            <div class="form-group">

                                <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Mensaje"></textarea>
                            </div>
                            {{-- <div class="g-recaptcha" data-sitekey="6Ld0CuEgAAAAALsiUxgfPlwW2kFfFt4a2smgi-s5"></div> --}}
                            <br />
                            <button class="btn btn-block btn-lg-inline-block" type="submit">Enviar</button>
                        </form>
                    </div>
                    <!-- Left -->
                    <div class="col-lg-4">
                        <div class="right">
                            <h4> <span class="text-capitalize">Mantente</span> en contacto</h4>
                            <div class="info d-flex align-items-center">
                                <a class="text-white text-link" target="_blank"
                                    href="https://goo.gl/maps/PhwS8HjEyUBSCf8V7">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>Esq. Gradillas a San Jacinto, Av Este 2, Caracas 1012, Distrito Capital</span>
                                </a>
                            </div>
                            <div class="info d-flex align-items-center">

                                <i class="fa fa-chrome" aria-hidden="true"></i>
                                <span></span>

                                <a class="text-white text-link" target="_blank" href="https://walink.co/c9af79">
                                    <i class="fa fa-whatsapp " aria-hidden="true"></i>
                                    <span>+58 414-233-2912</span>
                                </a>
                            </div>
                            <div class="info d-flex align-items-center">
                                <a class="text-white text-link" target="_blank"
                                    href="https://www.instagram.com/fluxel_code">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <span>@fluxel_code</span>
                                </a>
                            </div>
                            <div class="info d-flex align-items-center">
                                <a class="text-white text-link" target="_blank"
                                    href="https://www.linkedin.com/in/fluxel-code-a42569247/">
                                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    <span>Contactanos en linkedin!</span>
                                </a>
                            </div>
                            <div class="info d-flex align-items-center">
                                <a class="text-white text-link" target="_blank" href="mailto:fluxel.code@gmail.com">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>fluxel.code@gmail.com</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======== End Contact ======== -->

    <!-- ======== Start Footer ======== -->
    <footer class="footer flow-h">
        <div class="container text-center text-white">
            <div class="content">
                <a href="#"><img class="icon-tec" src="{{ asset('front/Vectores/Logo/Artboard 35.svg') }}"
                        alt="Logo Fluxel-code" /></a>
                <p>© 2022 Fluxel-code. Todos los derechos recervados.</p>
            </div>
        </div>
    </footer>
    <!-- ======== End Footer ======== -->
    <script>
        let dataServer = @json($data['js']);
    </script>
@endsection
