@extends('layouts.app')

@section('title', $data['title'] ?? 'Testimonio')




@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/rating/rating.css') }}">
@endpush

@section('content_2')

    <div class="container pt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">

            <div class="col-md-8">
                <div class="card card-light shadow ">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data['title'] ?? 'Testimonio' }}</h3>
                    </div>

                    <div class="card card-body">


                        <form method="POST" action="{{ route('testimony.store') }}" id="form_create_testimony"
                            enctype="multipart/form-data" class="form_disabled_button_send">
                            <div class="row">
                                @csrf
                                {{-- * Nombre --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_testimony">Nombre y apellido</label>
                                        <input id="name_testimony" placeholder="Nombre y apellido"
                                            class="form-control @error('name') is-invalid @enderror" type="text"
                                            name="name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                {{-- * Puesto de trabajo --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_testimony">Puesto de trabajo</label>
                                        <input id="position_testimony" placeholder="CEO de xxx xxxxx"
                                            class="form-control @error('position') is-invalid @enderror" type="text"
                                            name="position" value="{{ old('position') }}">
                                    </div>
                                </div>

                                {{-- * clasificación --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_testimony">Puntuación</label>
                                        <div id="rating" class="mt-md-2"></div>
                                    </div>
                                </div>

                                {{-- * Titulo --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_testimony">Titulo</label>
                                        <input id="title_testimony" placeholder="Buen trabajador"
                                            class="form-control @error('title') is-invalid @enderror" type="text"
                                            name="title" value="{{ old('title') }}">
                                    </div>
                                </div>

                                {{-- * Descriptcion --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="review_testimony">Reseña</label>
                                        <textarea class="form-control @error('review') is-invalid @enderror" name="review" id="review_testimony" rows="5"
                                            placeholder="Buen trabajador y excelente persona…">{{ old('review') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="img-preview-user img-preview-user-80">
                                            <label for="img_preview_testimonio"
                                                class="label-preview-img bg-purple cursor-pointer">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </label>

                                            <img src="{{ asset('images/helpers/img_gris.png') }}" alt=""
                                                class="img-preview" id="img_preview_testimoner">

                                            <div class="user-anonymous ">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <input id="img_preview_testimonio" data-id_form="form_create_testimony"
                                            data-id_img="img_preview_testimoner" accept="image/png, image/jpg, image/jpeg"
                                            type="file" name="image" class="listener_input_file d-none">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn bg-purple" type="submit">Crear testimonio</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card card-light shadow ">
                    <div class="card-header">
                        <h3 class="card-title">Solicitar testimonio</h3>
                    </div>

                    <div class="card card-body">
                        @if ($data['testimony_request'] ?? null)
                            <div class="">
                                <h5>Solicitar testimonio</h5>

                                <div class="d-flex">
                                    <input id="copy_url_tetimony" class="form-control flex-basis" type="text" readonly
                                        value="{{ route('testimony.token', ['token' => $data['testimony_request']->token]) }}">

                                    <button id="btn_copy" class="btn btn-success" type="button"
                                        data-clipboard-target="#copy_url_tetimony">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
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

    {{-- * clipboard --}}
    <script src="{{ asset('vendor/clipboard/clipboard.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>


    {{-- * funcion para input de rating stars --}}
    <script src="{{ asset('vendor/rating/rating.js') }}"></script>

    {{-- * funcion que nos permite previsualizar una imagen --}}
    <script src="{{ asset('js/functions/preview_image.js') }}"></script>

    {{-- * validacion de formulario --}}
    <script src="{{ asset('js/testimony/validation.js') }}"></script>

    <script>
        $(function() {
            new ClipboardJS("#btn_copy");

            rating.create({
                'selector': '#rating',
                "defaultRating": 4
            });
        })
    </script>
@endpush
