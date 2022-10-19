@extends('layouts.app')
@section('plugins.Sweetalert2', true)

@section('title', $data['title'] ?? 'Testimonios')

@push('css')
@endpush

@section('content_header')
    {{-- * cropper js --}}
    <h1>{{ $data['title'] ?? 'Testimonios' }}</h1>
@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/rating/rating.css') }}">
@endpush

@section('content_2')

    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">{{ $data['title'] ?? 'Testimonios' }}</h3>
            <div class="card-tools">
                <a href="{{ route('testimony.create') }}" class="btn btn-outline-light btn-tool">
                    <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Crear tertimonio</span>
                </a>
            </div>
        </div>

        <div class="card card-body">
            <div class="d-flex justify-content-end">
                <div class="mb-3">
                    <form action="{{ route('testimony.index') }}" class="form-inline">
                        <div class="mr-2">
                            <input type="search" placeholder="Buscar" class="form-control" name="search"
                                value="{{ request()->search ?? '' }}">
                        </div>
                        <button class="btn btn-primary" type="submit">
                            buscar
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-columns card-columns-custom">

                @foreach ($data['testimonies'] as $testimony)
                    <div class="card shadow">

                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="pr-2">
                                    @if ($testimony->image)
                                        <img width="40px" class="rounded-circle"
                                            src="{{ asset('storage/' . $testimony->image->url) }}" alt="">
                                    @else
                                        <div class="user-anonymous user-anonymous-40">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="">
                                    <p class="font-weight-bold text-muted mb-0">{{ $testimony->name }}</p>
                                    <small class="text-muted">{{ $testimony->position }}</small>
                                </div>

                            </div>

                        </div>

                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $testimony->title }}</h5>

                            <x-rating-stars rating="{{ $testimony->rating }}" />

                            <p class="card-text">{{ $testimony->review }}</p>

                            <span class="text-muted">
                                @include('admin.contact_email.components.datatable.created_at', [
                                    'created_parser' => $testimony->created_at,
                                ])
                            </span>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <button
                                        class="published_project btn-published btn {{ $testimony->published ? 'public' : '' }} btn-sm  font-weight-bold"
                                        type="button"
                                        data-url="{{ route('testimony.published', ['testimony' => $testimony->id]) }}"
                                        data-published="{{ $testimony->published }}">

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
                                            <span style="width: .9rem; height: .9rem;"
                                                class=" spinner-border spinner-border-sm" role="status">
                                            </span>
                                        </span>

                                    </button>

                                </div>

                                <div class="">

                                    <a href="{{ route('testimony.edit', ['testimony' => $testimony->id]) }}"
                                        class="btn btn-outline-success btn-sm" type="button">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-outline-danger btn-sm"
                                        data-url="{{ route('testimony.destroy', ['testimony' => $testimony]) }}"
                                        type="button" onclick="delete_testimony(this)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

            <div class="mt-4 d-flex justify-content-center" id="pagination_testimony">
                {{ $data['testimonies']->links() }}
            </div>
        </div>
    </div>

@stop


@push('js')
    <script>
        const data_server = @json($data['js'] ?? []);
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>

    {{-- * funcion para input de rating stars --}}
    <script src="{{ asset('vendor/rating/rating.js') }}"></script>

    {{-- * de aquí extraemos funcionalidad para publicar testimonios (de aqui solo reutilizamos funciones) --}}
    <script src="{{ asset('js/projects/functions/btn_actions.js') }}"></script>

    {{-- * funciones para manipular los testimonios --}}
    <script src="{{ asset('js/testimony/btn_actions.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            // pagination_async("#pagination_testimony");
            published();
            rating.create({
                'selector': '#rating',
                'outOf': 5,
            });
        })
    </script>
@endpush
