@extends('front.layouts.app-portfolio')

@push('css')
@endpush
<!-- HERO -->
<div class="dizme_tm_section" id="home">
    <div class="dizme_tm_hero">
        <div class="background" data-img-url="{{ asset('assets-portfolio/img/banners/back.png') }}">
        </div>
        <div class="container">
            <div class="content ">
                <div class="details">
                    <div class="hello">
                        <h3 class="orangeText">Hola, soy</h3>
                    </div>
                    <div class="name">
                        <h3>Samuel Graterol</h3>
                    </div>
                    <div class="job">
                        <p>Un <span class="purpleText">Programador </span> de <span class="purpleText">Venezuela,
                                Caracas</span></p>
                    </div>
                    <div class="text">
                        <p>Con más de tres años desarrollando
                            sitios web y dos años realizando sistemas de todo tipo, puedo decir que soy un
                            desarrollador muy completo y dedicado a su trabajo.</p>
                    </div>
                    <div class="button">
                        <div class="dizme_tm_button ">
                            <a class="anchor button-custom" href="{{ route('home') }}#about">{{--  --}}
                                <span>Sobre Mi</span>
                            </a>
                        </div>
                        <div class="social">
                            <ul class="d-flex align-items-center">
                                @foreach ($data['social_media'] ?? [] as $social)
                                    <li class="mr-3">
                                        <a target="_blanck" href="{{ $social->url }}"><i
                                                class="h5 mb-0 {{ $social->icon }}""></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="avatar">
                    <div class="image">

                        <img data-src="{{ asset('assets-portfolio/img/fotos-samuel/avatar.png') }}"
                            data-alt="some alt text" class="lazy-load"
                            src="{{ asset('assets-portfolio/img/fotos-samuel/avatar-load.png') }}" alt="" />
                        <span class="skills laravel anim_moveBottom">
                            <img class="svg" src="{{ asset('assets-portfolio/img/icons-proming/github.svg') }}"
                                alt="" />
                        </span>
                        <span class="skills javascript anim_moveBottom">
                            <img class="svg" src="{{ asset('assets-portfolio/img/icons-proming/javascript.svg') }}"
                                alt="" />
                        </span>
                        <span class="skills github anim_moveBottom">
                            <img class="svg" src="{{ asset('assets-portfolio/img/icons-proming/laravel.svg') }}"
                                alt="" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="dizme_tm_down">
            <a class="anchor" href="{{ route('home') }}#about">
                <svg width="26px" height="100%" viewBox="0 0 247 390" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
                    <path id="wheel" d="M123.359,79.775l0,72.843"
                        style="fill:none;stroke:#000;stroke-width:20px;" />
                    <path id="mouse"
                        d="M236.717,123.359c0,-62.565 -50.794,-113.359 -113.358,-113.359c-62.565,0 -113.359,50.794 -113.359,113.359l0,143.237c0,62.565 50.794,113.359 113.359,113.359c62.564,0 113.358,-50.794 113.358,-113.359l0,-143.237Z"
                        style="fill:none;stroke:#000;stroke-width:20px;" />
                </svg>
            </a>
        </div>
    </div>
</div>
<!-- HERO -->

<!-- PROCESS -->
<div class="dizme_tm_section">
    <div class="dizme_tm_process">
        <div class="container">
            <div class="list">
                <ul>
                    <li class="wow fadeInUp" data-wow-duration="1s">
                        <div class="list_inner">
                            <div class="icon">
                                <span>
                                    <img class="brush" src="{{ asset('assets-portfolio/img/brushes/process/1.png') }}"
                                        alt="" />
                                    <img class="svg"
                                        src="{{ asset('assets-portfolio/img/svg/process/code-color.png') }}"
                                        alt="" />
                                </span>
                            </div>
                            <div class="title">
                                <h3 class="text-capitalize">Programador web</h3>
                            </div>
                            <div class="text">
                                <p>Enfoco mis energías en desarrollar sitios web funcionales donde su principal
                                    objetivo sea facilitar y optimizar procesos laborales.</p>
                            </div>
                        </div>
                    </li>
                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="list_inner">
                            <div class="icon">
                                <span>
                                    <img class="brush" src="{{ asset('assets-portfolio/img/brushes/process/2.png') }}"
                                        alt="" />
                                    <img class="svg"
                                        src="{{ asset('assets-portfolio/img/svg/process/interface-color.png') }}"
                                        alt="" />
                                </span>
                            </div>
                            <div class="title">
                                <h3 class="text-capitalize">Desarrollador de interfaces</h3>
                            </div>
                            <div class="text">
                                <p>Disfruto maquetar, comenzó como un pasatiempo y gracias a esto hoy puedo
                                    desarrollar rápida y efectivamente un sitio web totalmente responsivo.</p>
                            </div>
                        </div>
                    </li>
                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                        <div class="list_inner">
                            <div class="icon">
                                <span>
                                    <img class="brush" src="{{ asset('assets-portfolio/img/brushes/process/3.png') }}"
                                        alt="" />
                                    <img class="svg"
                                        src="{{ asset('assets-portfolio/img/svg/process/teacher-color.png') }}"
                                        alt="" />
                                    <!-- <i class="fa fa-user svg"></i> -->
                                </span>
                            </div>
                            <div class="title">
                                <h3 class="text-capitalize">Instructor</h3>
                            </div>
                            <div class="text">
                                <p>Comparto mis conocimientos, me preocupa realmente la educación, si puedo
                                    ayudar a alguien en su preparación lo haré.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /PROCESS -->

<!-- ABOUT -->
<div class="dizme_tm_section py-5" id="about">
    <div class="dizme_tm_about">
        <div class="container">
            <div class="wrapper">
                <div class="left">
                    <div class="image">
                        <img data-src="{{ asset('assets-portfolio/img/fotos-samuel/computadora.png') }}"
                            data-alt="some alt text" class="lazy-load"
                            src="{{ asset('assets-portfolio/img/fotos-samuel/blanco.png') }}" alt="" />

                        <div class="numbers year">
                            <div class="wrapper">
                                <h3>+<span class="dizme_tm_counter" data-from="0" data-to="3"
                                        data-speed="2000">0</span></h3>
                                <span class="name">Años De<br />Experiencia</span>
                            </div>
                        </div>
                        <div class="numbers project">
                            <div class="wrapper">
                                <h3>+<span class="dizme_tm_counter" data-from="0" data-to="100"
                                        data-speed="2000">0</span></h3>
                                <span class="name">Proyectos<br />Realizados</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="title wow fadeInUp" data-wow-duration="1s">
                        <span>Más Sobre mi</span>
                        <h3>Soy autodidacta, siempre en búsqueda de nuevos retos</h3>
                    </div>
                    <div class="text wow fadeInUp" data-wow-duration="1s">
                        <p>Desde mis comienzos como programador he conseguido formar parte de agencias
                            maravillosas, colaborado con personas muy talentosas y asesorado a colegas que
                            iniciaron su ruta como programadores. Soy disciplinado, confiado y naturalmente
                            apasionado por mi trabajo, considero que la responsabilidad y disciplina han sido
                            dos puntos clave, tanto en mi desarrollo personal como laboral.</p>
                    </div>
                    <div class="dizme_tm_button wow fadeInUp" data-wow-duration="1s">
                        <a class="button-custom anchor"
                            href="{{ route('home') }}#contact"><span>Contactame</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="brush_1 wow fadeInLeft" data-wow-duration="1s"><img
                src="{{ asset('assets-portfolio/img/brushes/about/1.png') }}" alt="" />
        </div>
        <div class="brush_2 wow fadeInRight" data-wow-duration="1s"><img
                src="{{ asset('assets-portfolio/img/brushes/about/2.png') }}" alt="" />
        </div>
    </div>
</div>
<!-- /ABOUT -->

@if ($data['projects']->count() > 0)
    <!-- portfolio -->
    <div class="dizme_tm_section" id="portfolio">
        <div class="dizme_tm_news py-5 my-5">
            <div class="container">
                <div class="dizme_tm_main_title" data-align="center">
                    <span>Mis proyectos asombrosos</span>
                    <h3>Proyectos recientes, ¿quieres ver más?
                        Contáctame.</h3>
                </div>
                <div class="news_list portfolio-container">
                    <ul class="row">
                        @foreach ($data['projects'] as $project)
                            <li class="p-3 col-sm-6 col-lg-4 wow fadeInUp w-100" data-wow-duration="1s">
                                <div class="list_inner">
                                    <div class="image">
                                        <a href="{{ route('project.front.show', ['slug' => $project->slug]) }}">
                                            <div class="content-lazy-load-img content_img_100x60">
                                                <div class="content">
                                                    @if ($project->frontImageExist)
                                                        <span
                                                            data-src="{{ asset('storage/' . $project->frontImageExist) }}"
                                                            data-alt="some alt text"
                                                            class="content_img_100x60 lazy-load">
                                                            <div class="content bg-gray-light"></div>
                                                        </span>
                                                    @else
                                                        <div
                                                            class="h-100 w-100 bg-gray-light d-flex justify-content-center align-items-center">
                                                            <i class="fa fa-image text-muted h1"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    @endif


                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <span class="category">
                                            <a href="">{{ $project->categories()->first()->name }}</a></span>
                                        <h3 class="title">
                                            <a href="{{ route('project.front.show', ['slug' => $project->slug]) }}">
                                                {{ $project->name }}
                                            </a>
                                        </h3>
                                    </div>


                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="brush_1 wow zoomIn" data-wow-duration="1s"><img
                    src="{{ asset('assets-portfolio/img/brushes/news/1.png') }}" alt="" /></div>
            <div class="brush_2 wow zoomIn" data-wow-duration="1s"><img
                    src="{{ asset('assets-portfolio/img/brushes/news/2.png') }}" alt="" /></div>
        </div>
    </div>
    <!-- /portfolio -->
@endif

<!-- SKILLS -->
<div class="dizme_tm_section py-5 mb-4">
    <div class="dizme_tm_skills">
        <div class="container">
            <div class="wrapper">
                <div class="left">
                    <div class="dizme_tm_main_title wow fadeInUp" data-wow-duration="1s" data-align="left">
                        <span>Programar es mi día a día</span>
                        <h3>Desarrollo habilidades para mantenerme actualizado</h3>
                        <p>Me especializo en las tecnologías más solicitadas del mercado, constante mente
                            investigo nuevas herramientas que me ayuden en mis desarrollos y disfruto del
                            proceso de aprendizaje, así que me adapto fácilmente a nuevos lenguajes de
                            programación.</p>
                    </div>
                    <div class="dodo_progress wow fadeInUp" data-wow-duration="1s">
                        <div class="row no-gutters">
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-html content-icon-skill">
                                        <i class="fab fa-html5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-css content-icon-skill">
                                        <i class="fab fa-css3 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-js content-icon-skill">
                                        <i class="fab fa-js text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-bootstrap content-icon-skill">
                                        <i class="fab fa-bootstrap text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-php content-icon-skill">
                                        <i class="fab fa-php text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-laravel content-icon-skill">
                                        <i class="fab fa-laravel text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-php  content-icon-skill">
                                        <i class="fa fa-database text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 col-md-1 col-lg p-2 p-md-1">
                                <div class="content-responsive content-responsive-square">
                                    <div class="content color-git content-icon-skill">
                                        <i class="fab fa-git text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right d-flex justify-content-center justify-content-md-start">
                    <div class="">
                        <img data-src="{{ asset('assets-portfolio/img/fotos-samuel/skills-avatar.png') }}"
                            data-alt="some alt text" class="lazy-load"
                            src="{{ asset('assets-portfolio/img/fotos-samuel/skills-avatar-load.png') }}"
                            alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /SKILLS -->

@if ($data['testimonies']->count() > 0)
    <!-- TESTIMONIALS -->
    <div class="dizme_tm_section pt-5 mt-4" id="testimonies">
        <div class="dizme_tm_testimonials">
            <div class="dizme_tm_main_title" data-align="center">
                <span>Testimonio</span>
                <h3>Que dicen mis clientes</h3>
                <p>Algunas de las personas con las que he trabajado</p>
            </div>
            <div class="list_wrapper">
                <div class="total">
                    <div class="in">
                        <ul class="owl-carousel owl-theme">
                            @foreach ($data['testimonies'] as $testimony)
                                <li>
                                    <div class="icon">
                                        <img class="svg"
                                            src="{{ asset('assets-portfolio/img/svg/testimonials/quote.svg') }}"
                                            alt="" />
                                    </div>
                                    <div class="text">
                                        <p>{!! $testimony->review !!}</p>
                                    </div>
                                    <div class="short">
                                        <div class="image">
                                            <!-- <div class="main" data-img-url=""></div> -->
                                            <div class="rounded-circle overflow-hidden bg-gray-light"
                                                style="width: 60px; height: 60px;">

                                                @if ($testimony->image)
                                                    <div data-src="{{ asset('storage/' . $testimony->image->url) }}"
                                                        data-alt="testimonio"
                                                        class="lazy-load content-responsive-square  bg-gray-light">
                                                    </div>
                                                @else
                                                    <img src="{{ asset('assets-portfolio/img/icons-proming/profile.png') }}"
                                                        alt="">
                                                @endif

                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3>{{ $testimony->name }}</h3>
                                            <span>{{ $testimony->position }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="left_details">
                        <div class="det_image one wow fadeIn" data-wow-duration="1s"
                            data-img-url="{{ $data['images_testimonies'][0] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <div class="det_image two wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s"
                            data-img-url="{{ $data['images_testimonies'][1] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <div class="det_image three wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s"
                            data-img-url="{{ $data['images_testimonies'][2] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <div class="det_image four wow fadeIn" data-wow-duration="1s" data-wow-delay="0.6s"
                            data-img-url="{{ $data['images_testimonies'][3] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <span class="circle green animPulse"></span>
                        <span class="circle yellow animPulse"></span>
                        <span class="circle border animPulse"></span>
                    </div>
                    <div class="right_details">
                        <div class="det_image one wow fadeIn" data-wow-duration="1s"
                            data-img-url="{{ $data['images_testimonies'][4] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <div class="det_image two wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s"
                            data-img-url="{{ $data['images_testimonies'][5] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <div class="det_image three wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s"
                            data-img-url="{{ $data['images_testimonies'][6] ?? asset('assets-portfolio/img/icons-proming/profile.png') }}">
                        </div>
                        <span class="circle yellow animPulse"></span>
                        <span class="circle purple animPulse"></span>
                        <span class="circle border animPulse"></span>
                    </div>
                </div>
            </div>
            <div class="brush_1 wow fadeInRight" data-wow-duration="1s"><img
                    src="{{ asset('assets-portfolio/img/brushes/testimonials/1.png') }}" alt="" /></div>
        </div>
    </div>
    <!-- /TESTIMONIALS -->
@endif

<!-- PARTNERS -->
<div class="dizme_tm_section">
    <div class="dizme_tm_partners">
        <div class="container">
            <div class="partners_inner">
                <ul>
                    <li class="wow fadeIn d-flex align-items-center" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="list_inner px-2">
                            <div data-src="{{ asset('assets-portfolio/img/logos-emoresas/fumimark_logo.png') }}"
                                data-alt="Logo empresa" class="lazy-load content_img_100x30 ">
                                <div class="content bg-gray-light"></div>
                            </div>
                            <a class="dizme_tm_full_link" href="{{ route('home') }}#"></a>
                        </div>
                    </li>
                    <li class="wow fadeIn d-flex align-items-center" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="list_inner px-2">
                            <div data-src="{{ asset('assets-portfolio/img/logos-emoresas/logo-3x.png') }}"
                                data-alt="Logo empresa" class="lazy-load content_img_100x30 ">
                                <div class="content bg-gray-light"></div>
                            </div>
                            <a class="dizme_tm_full_link" href="{{ route('home') }}#"></a>
                        </div>
                    </li>
                    <li class="wow fadeIn d-flex align-items-center" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="list_inner px-2">
                            <div data-src="{{ asset('assets-portfolio/img/logos-emoresas/poder-judicial-virtual2.png') }}"
                                data-alt="Logo empresa" class="lazy-load content_img_100x30 ">
                                <div class="content bg-gray-light"></div>
                            </div>
                            <a class="dizme_tm_full_link" href="{{ route('home') }}#"></a>
                        </div>
                    </li>
                    <li class="wow fadeIn d-flex align-items-center" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="list_inner px-2">
                            <div data-src="{{ asset('assets-portfolio/img/logos-emoresas/logo-avi.svg') }}"
                                data-alt="Logo empresa" class="lazy-load content_img_100x30 ">
                                <div class="content bg-gray-light"></div>
                            </div>
                            <a class="dizme_tm_full_link" href="{{ route('home') }}#"></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="brush_1 wow fadeInLeft" data-wow-duration="1s"><img
                src="{{ asset('assets-portfolio/img/brushes/partners/1.png') }}" alt="" /></div>
    </div>
</div>
<!-- /PARTNERS -->

<!-- CONTACT -->
<div class="dizme_tm_section" id="contact">
    <div class="dizme_tm_contact mb-0 pt-5">
        <div class="container">
            <div class="dizme_tm_main_title" data-align="center">
                <span>Contáctame</span>
                <h3>¿Tienes un proyecto en mente?</h3>
                <p>Podemos reunirnos y discutir sobre tus requerimientos, contácteme.</p>
            </div>
            <div class="contact_inner">
                @if ($data['contact_info'] ?? null)
                    <div class="left wow fadeInLeft" data-wow-duration="1s">
                        <ul>
                            @if ($data['contact_info']->location ?? null)
                                <li>
                                    <div class="list_inner">
                                        <div class="icon orangeBackground">
                                            <i class="icon-location orangeText"></i>
                                        </div>
                                        <div class="short">
                                            <h3>Dirección</h3>
                                            <span>{{ $data['contact_info']->location ?? '' }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            @if ($data['contact_info']->phone_number ?? null)
                                <li>
                                    <div class="list_inner">
                                        <div class="icon purpleBackground">
                                            <i class="icon-phone purpleText"></i>
                                        </div>
                                        <div class="short">
                                            <h3>Teléfono</h3>
                                            <span>{{ $data['contact_info']->phone_number ?? null }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            @if ($data['contact_info']->email ?? null)
                                <li>
                                    <div class="list_inner">
                                        <div class="icon greenBackground">
                                            <i class="icon-mail-1 greenText"></i>
                                        </div>
                                        <div class="short">
                                            <h3>Correo electrónico</h3>
                                            <span><a
                                                    href="{{ route('home') }}#">{{ $data['contact_info']->email ?? null }}</a></span>
                                        </div>
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </div>
                @endif
                <div class="{{ $data['contact_info'] ?? null ? 'right' : 'w-100' }} right wow fadeInRight"
                    data-wow-duration="1s">
                    <div class="fields">
                        <div id="insert_alert"></div>
                        <form method="post" class="contact_form" id="form_contact" autocomplete="off">
                            <div class="returnmessage"
                                data-success="Your message has been received, We will contact you soon."></div>
                            <div class="empty_notice"><span>Please Fill Required Fields</span></div>
                            <div class="input_list">
                                <ul>
                                    <li><input id="name" name="nombre" type="text" placeholder="Nombre" />
                                    </li>
                                    <li><input id="email" name="email" type="text"
                                            placeholder="Correo Electrónico" /></li>
                                    <!-- <li><input id="phone" type="number" placeholder="Your Phone" /></li>
           <li><input id="subject" type="text" placeholder="Subject" /></li> -->
                                </ul>
                            </div>
                            <div class="message_area">
                                <textarea name="comment" id="message" placeholder="Escribe tu mensaje"></textarea>
                            </div>
                            <div class="dizme_tm_button d-flex justify-content-end">
                                <span>
                                    {{-- <button class="btn btn-primary" disabled type="button">Text</button> --}}
                                    <button type="submit" class="button-custom" id="send_message"><span>Contactar
                                            ahora</span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="brush_2 wow fadeInRight" data-wow-duration="1s"><img
                        src="{{ asset('assets-portfolio/img/brushes/contact/2.png') }}" alt="" />
                </div>
            </div>


        </div>
        <div class="brush_1 wow fadeInLeft" data-wow-duration="1s"><img
                src="{{ asset('assets-portfolio/img/brushes/contact/1.png') }}" alt="" /></div>
    </div>
</div>

@if ($data['contact_info']->whatsapp_url ?? null)
    <a target="_blanck" href="{{ $data['contact_info']->whatsapp_url }}" class="btn btn_fixed whatsapp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>
@endif
<!-- /CONTACT -->

@push('js')
    <script>
        let dataServer = @json($data['js']);
    </script>
    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    {{-- * jquery validator --}}
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/localization/messages_es.min.js') }}"></script>
    <script src="{{ asset('front/js/validation.js') }}"></script>
    {{-- * funcion de form --}}
    <script src="{{ asset('front/js/recaptcha.js') }}"></script>
@endpush
