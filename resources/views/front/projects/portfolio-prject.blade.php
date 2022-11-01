@extends('front.layouts.app-portfolio')

<div class="container mt-md-5 pt-md-5" style="min-height: 80vh; ">
    <div class="row no-gutters">
        <!-- * header info project -->
        <!-- * imagenes del proyecto -->
        <div class="col-md-8 p-3 pl-md-0 pr-md-4">
            <div id="project_images_carousel" class="carousel slide carousel-custom" data-ride="carousel">
                <ol class="carousel-indicators">

                    @for ($i = 0; $i < $data['project']->imagesExist->count(); $i++)
                        <li class="{{ $i == 0 ? 'active' : '' }}" data-target="#project_images_carousel"
                            data-slide-to="{{ $i == 0 ? 'active' : '' }}" aria-current="location">
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
            <div class="mb-3 ">
                <h4 class="h5  ">M Lorem, ipsum dolor.</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="mb-3 ">
                <h4 class="h5 ">M Lorem, ipsum dolor.</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="mb-3 ">
                <h4 class="h5 ">M Lorem, ipsum dolor.</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="mb-3 ">
                <h4 class="h5 ">M Lorem, ipsum dolor.</h4>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <!-- * Informacion adicional del proyecto -->
        <!-- * header info project end-->

        <!-- * descripcion del proyecto -->
        <div class="col-md-12 p-3 mb-4">
            <h3 class="  mb-3">Lorem ipsum dolor sit amet consectetur.</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatem est officia ullam quaerat ad
                suscipit velit repudiandae at veritatis, repellendus, recusandae sapiente totam laudantium
                molestiae assumenda eius ratione obcaecati laborum!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto temporibus, dolor
                consequuntur atque voluptatem nesciunt dicta quae dolores eos voluptates, tempora incidunt
                consectetur, a impedit dignissimos aspernatur ullam quibusdam debitis exercitationem sunt
                perspiciatis. Quas nulla minima nemo, fugit, laboriosam officiis possimus excepturi odio labore
                consequatur accusantium facilis eos aut eligendi voluptatibus pariatur consequuntur perspiciatis
                distinctio maxime corrupti consectetur. Accusantium repudiandae sed veniam eveniet nesciunt
                quidem tenetur minima exercitationem obcaecati est?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore exercitationem tempore reiciendis
                ab repellendus molestias amet! Architecto libero recusandae commodi deserunt accusantium,
                blanditiis porro illum deleniti quasi accusamus. Exercitationem dolor ex magnam accusantium qui
                molestias magni totam. Autem qui quasi quis magnam optio incidunt odit aut, officia error
                perspiciatis dolor omnis laudantium minus, voluptatibus sint laborum quo hic reprehenderit,
                adipisci quaerat eaque perferendis mollitia possimus recusandae. Deserunt deleniti perferendis,
                dicta maiores quo numquam veritatis nostrum labore praesentium voluptate in velit dolor corrupti
                amet distinctio iusto voluptates rerum! Dolores mollitia sunt dolorum neque ad necessitatibus,
                unde nisi sed inventore iure doloremque.</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique, praesentium adipisci?
                Quibusdam dignissimos odit id sapiente? Accusantium quod aspernatur excepturi voluptatum aliquam
                cum doloremque provident. Velit sed praesentium deserunt, fugiat facere natus itaque excepturi
                architecto quas nihil? Mollitia recusandae quis cupiditate quod perferendis. Eos corrupti
                deserunt ab distinctio fuga. Laborum!</p>
        </div>
        <!-- * descripcion del proyecto end -->

        <!-- * ultimos proyectos -->
        <div class="col-12">
            <div class="dizme_tm_section" id="portfolio">
                <div class="dizme_tm_news py-0">
                    <div class="">
                        <div class="">
                            <h3 class="mb-3 ">Últimos proyectos</h3>
                        </div>
                        <div class="news_list portfolio-container py-3">
                            <ul class="row">

                                @foreach ($data['last projects'] as $project)
                                    <li class="col-md-6 py-3 py-md-3 mb-3 mb-md-0 col-lg-4 wow fadeInUp w-100"
                                        data-wow-duration="1s">
                                        <div class="list_inner">
                                            <div class="image">
                                                <a href="">
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
                                                            {{-- <span
                                                                data-src="{{ asset('storage/' . $project->frontImageExist) }}"
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
                                                        href="#">{{ $project->categories()->first()->name }}</a></span>
                                                <h3 class="title">
                                                    <a
                                                        href="{{ route('project.front.show', ['slug' => $project->slug]) }}">
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
                </div>
            </div>
        </div>
        <!-- * ultimos proyectos end -->
    </div>


</div>

@if ($data['contact_info']->whatsapp_url ?? null)
    <a target="_blanck" href="{{ $data['contact_info']->whatsapp_url }}" class="btn btn_fixed whatsapp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>
@endif
