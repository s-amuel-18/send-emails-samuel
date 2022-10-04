@extends('layouts.app')
@section('plugins.Sweetalert2', true)

@section('title', $data['title'] ?? 'Proyecto')

@section('content_header')
    <h1>{{ $data['title'] ?? 'Proyecto' }}</h1>
@stop

@push('css')
@endpush

@section('content_2')
    <div class="container">
        <div class="row">
            <div class="col-12 pb-3 d-flex justify-content-end">
                <div class="">
                    @can('project.published')
                        <button
                            class="published_project btn-published btn {{ $data['project']->published ? 'public' : '' }} btn-sm "
                            type="button" data-url="{{ route('project.published', ['project' => $data['project']->id]) }}"
                            data-published="{{ $data['project']->published }}">

                            <span class="normal_item">
                                <span class="text-public">
                                    <i class="fa fa-check"></i>
                                    Publico
                                </span>



                                <span class="text-private">
                                    Privado
                                </span>
                            </span>
                            <span class="load_item d-none">
                                <span style="width: .9rem; height: .9rem;" class=" spinner-border spinner-border-sm"
                                    role="status">
                                </span>
                                Cargando...
                            </span>
                        </button>
                    @endcan

                    @can('project.edit')
                        <a href="{{ route('project.edit', ['project' => $data['project']->id]) }}"
                            class="btn btn-success btn-sm" type="button">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    @endcan

                    @can('project.destroy')
                        <button data-redirect="{{ route('project.index') }}" data-id="{{ $data['project']->id }}"
                            data-url="{{ $data['project']->routeDelete }}" class="btn_delete_project btn btn-danger btn-sm"
                            type="button">

                            <span class="normal_item">
                                <i class="fa fa-trash"></i>
                                Eliminar
                            </span>
                            <span class="load_item d-none">
                                <span style="width: .9rem; height: .9rem;" class="text-danger spinner-border spinner-border-sm"
                                    role="status">
                                </span>
                                Eliminando...
                            </span>
                        </button>
                    @endcan
                </div>
            </div>
            <div class="col-12 pb-3">

            </div>
            <div class="col-md-8">
                @if ($data['project']->images->count() > 0)
                    <div id="carousel_project" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($data['project']->images as $i => $img)
                                <li class="{{ $i == 0 ? 'active' : '' }}" data-target="#carousel_project"
                                    data-slide-to="{{ $i }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">

                            {{-- * items carousel --}}
                            @foreach ($data['project']->images as $i => $img)
                                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset('storage/' . $img->url) }}" alt="">
                                </div>
                            @endforeach
                            {{-- * items carousel end --}}

                        </div>
                        <a class="carousel-control-prev" href="#carousel_project" data-slide="prev" role="button">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel_project" data-slide="next" role="button">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @else
                    <div class="content_img_100x60 bg-gray-light d-flex justify-content-center align-items-center">
                        <div class="m-0 h1 text-muted">Sin Imagenes</div>
                    </div>
                @endif

            </div>

            <div class="col-md-4">
                @foreach ($data['project']->itemHelp as $itemHelp)
                    <div class="p-2">
                        <div class="">
                            <h5 class="font-weight-bold mb-2">{{ $itemHelp->name }}</h5>
                            {!! $itemHelp->templateHtml !!}
                        </div>
                    </div>
                @endforeach

                <div class="p-2">
                    <h5 class="font-weight-bold mb-2">Categorías</h5>
                    @if ($data['project']->categories()->count())

                        @foreach ($data['project']->categories as $category)
                            <div class="d-inline-block pr-1">
                                @include('admin.contact_email.components.datatable.badge', [
                                    'color' => $category->color,
                                    'text' => $category->name,
                                ])

                            </div>
                        @endforeach
                    @else
                        <span class="mx-1">
                            @include('admin.contact_email.components.datatable.badge', [
                                'color' => 'light',
                                'text' => 'Sin categorias',
                            ])
                        </span>
                    @endif
                </div>
            </div>

            <div class="col-12 mt-4">
                <h2>{{ $data['project']->name }}</h2>
            </div>

            <div class="col-12 ">
                {!! $data['project']->description !!}
            </div>
        </div>

    </div>
@stop

@push('js')
    <script>
        const btns_delete_project = document.querySelectorAll(".btn_delete_project");
        const type_destroy = "delete";
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>


    {{-- * variables globales --}}
    <script>
        const appData = @json($data['js'] ?? []);
    </script>

    {{-- * funciones para los proyectos --}}
    <script src="{{ asset('js/projects/functions/functions.js') }}"></script>
    <script src="{{ asset('js/projects/functions/btn_actions.js') }}"></script>
    <script src="{{ asset('js/projects/main.js') }}"></script>

    <script>
        $(function() {
            event_delete_project();
        });
    </script>
@endpush
