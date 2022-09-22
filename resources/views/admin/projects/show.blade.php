@extends('layouts.app')

@section('title', $data['title'] ?? 'Proyecto')

@section('content_header')
    <h1>{{ $data['title'] ?? 'Proyecto' }}</h1>
@stop

@push('css')
@endpush

@section('content_2')
    <div class="container">
        <div class="row">
            <div class="col-12 pb-2">
                @if ($data['project']->categories()->count())

                    @foreach ($data['project']->categories as $category)
                        <span class="mx-1">
                            @include('admin.contact_email.components.datatable.badge', [
                                'color' => $category->color,
                                'text' => $category->name,
                            ])
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
                                    <img class="d-block w-100" src="{{ asset($img->url) }}" alt="">
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



                <div class="mt-4">
                    <button
                        class="published_project btn-published btn {{ $data['project']->published ? 'public' : '' }} btn-sm btn-rounded font-weight-bold"
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
                            Cargando
                            <span style="width: .9rem; height: .9rem;" class=" spinner-border spinner-border-sm"
                                role="status">
                            </span>
                        </span>

                    </button>
                </div>
            </div>

            <div class="col-md-4">
                @foreach ($data['project']->itemHelp as $itemHelp)
                    <div class="p-2">
                        <div class="">
                            <h5 class="font-weight-bold mb-1">{{ $itemHelp->name }}</h5>
                            {!! $itemHelp->templateHtml !!}
                        </div>
                    </div>
                @endforeach


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
    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>


    {{-- * variables globales --}}
    <script>
        const appData = @json($data['js'] ?? []);
    </script>
    {{-- * funciones para los proyectos --}}
    <script src="{{ asset('js/projects/functions/btn_actions.js') }}"></script>
    <script src="{{ asset('js/projects/main.js') }}"></script>
@endpush
