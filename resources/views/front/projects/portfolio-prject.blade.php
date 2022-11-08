@extends('front.layouts.app-portfolio')

<div class="container mt-md-5 pt-md-5" style="min-height: 80vh; ">
    <div class="row no-gutters">
        <!-- * header info project -->
        <!-- * imagenes del proyecto -->
        <div class="col-md-8 p-3 pl-md-0 pr-md-4">
            <div id="project_images_carousel" class="carousel slide carousel-custom" data-ride="carousel">
                <ol class="carousel-indicators">

                    @for ($i = 0; $i < $data['project']->imagesExist->count(); $i++)
                        <li class="mx-2 {{ $i == 0 ? 'active' : '' }}" data-target="#project_images_carousel"
                            data-slide-to="{{ $i }}" aria-current="location">
                        </li>
                    @endfor

                </ol>
                <div class="carousel-inner">
                    @foreach ($data['project']->imagesExist as $i => $img)
                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                            <div class="content_img_100x60">
                                <div class="content bg-gray-light content-img-project">
                                    <div class="lazy-load" data-src="{{ asset('storage/' . $img->url) }}"
                                        data-alt="Slider"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
                <a class="carousel-control-prev item-arrow-custom" href="#project_images_carousel" data-slide="prev"
                    role="button">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next item-arrow-custom" href="#project_images_carousel" data-slide="next"
                    role="button">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- * imagenes del proyecto end -->

        <!-- * Informacion adicional del proyecto -->
        <div class="col-md-4 p-3 ">
            @foreach ($data['project']->itemHelp as $item)
                <div class="mb-3 ">
                    <h4 class="h5">{{ $itemHelp->name }}</h4>
                    <p>{!! $itemHelp->templateHtml !!}</p>
                </div>
            @endforeach
        </div>
        <!-- * Informacion adicional del proyecto -->
        <!-- * header info project end-->

        <!-- * descripcion del proyecto -->
        <div class="col-md-12 p-3 mb-4">
            <h3 class="  mb-3">{{ $data['project']->name }}</h3>

            <div class="">
                {!! $data['project']->description !!}
            </div>
        </div>
        <!-- * descripcion del proyecto end -->

        <!-- * ultimos proyectos -->
        @if ($data['last_projects']->count())
            <div class="col-12">
                <div class="dizme_tm_section" id="portfolio">
                    <div class="dizme_tm_news py-0">
                        <div class="">
                            <div class="">
                                <h3 class="mb-3 ">Últimos proyectos</h3>
                            </div>
                            <div class="news_list portfolio-container py-3">
                                <ul class="row">

                                    @foreach ($data['last_projects'] as $project_last)
                                        <li class="col-md-6 py-3 py-md-3 mb-3 mb-md-0 col-lg-4 wow fadeInUp w-100"
                                            data-wow-duration="1s">
                                            <div class="list_inner">
                                                <div class="image">
                                                    <a
                                                        href="{{ route('project.front.show', ['slug' => $project_last->slug]) }}">
                                                        <div class="content-lazy-load-img content_img_100x60">
                                                            <div class="content">
                                                                @if ($project_last->frontImageExist)
                                                                    <span
                                                                        data-src="{{ asset('storage/' . $project_last->frontImageExist) }}"
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
                                                                {{-- <span
                                                                data-src="{{ asset('storage/' . $project_last->frontImageExist) }}"
                                                                data-alt="some alt text"
                                                                class="content_img_100x60 lazy-load">
                                                                <div class="content bg-gray-light"></div>
                                                            </span> --}}

                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="details">
                                                    <span class="category">
                                                        <a
                                                            href="#">{{ $project_last->categories()->first()->name }}</a></span>
                                                    <h3 class="title">
                                                        <a
                                                            href="{{ route('project.front.show', ['slug' => $project_last->slug]) }}">
                                                            {{ $project_last->name }}
                                                        </a>
                                                    </h3>
                                                </div>


                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
        <!-- * ultimos proyectos end -->
    </div>


</div>

@if ($data['contact_info']->whatsapp_url ?? null)
    <a target="_blanck" href="{{ $data['contact_info']->whatsapp_url }}" class="btn btn_fixed whatsapp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>
@endif
