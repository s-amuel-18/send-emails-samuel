@extends(isset($data['token']) ? 'layouts.public' : 'layouts.app')

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

        <div class="row {{ $data['token'] ?? null ? 'mt-5' : '' }}">

            <div class="col-md-8 offset-md-2">
                <div class="card card-light shadow ">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data['title'] ?? 'Testimonio' }}</h3>
                    </div>

                    <div class="card card-body">
                        <form method="POST" action="{{ $data['route_form'] }}" id="form_create_testimony"
                            enctype="multipart/form-data" class="form_disabled_button_send">
                            <div class="row">
                                @csrf
                                @method('put')
                                {{-- * Nombre --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_testimony">Nombre y apellido</label>
                                        <input id="name_testimony" placeholder="Nombre y apellido"
                                            class="form-control @error('name') is-invalid @enderror" type="text"
                                            name="name"
                                            value="{{ old('name') ? old('name') : $data['testimony']->name }}">
                                    </div>
                                </div>

                                {{-- * Puesto de trabajo --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position_testimony">Puesto de trabajo</label>
                                        <input id="position_testimony" placeholder="CEO de xxx xxxxx"
                                            class="form-control @error('position') is-invalid @enderror" type="text"
                                            name="position"
                                            value="{{ old('position') ? old('position') : $data['testimony']->position }}">
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
                                            name="title"
                                            value="{{ old('title') ? old('title') : $data['testimony']->title }}">
                                    </div>
                                </div>

                                {{-- * Descriptcion --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="review_testimony">Reseña</label>
                                        <textarea class="form-control @error('review') is-invalid @enderror" name="review" id="review_testimony" rows="5"
                                            placeholder="Buen trabajador y excelente persona…">{{ old('review') ? old('review') : $data['testimony']->review }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div
                                            class="img-preview-user img-preview-user-80 {{ $data['testimony']->image->route ?? null ? 'img-insert' : '' }} ">
                                            <label for="img_preview_testimonio"
                                                class="label-preview-img bg-purple cursor-pointer">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </label>

                                            <img src="{{ $data['testimony']->image->route ?? null }}" alt=""
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
                                {{-- @if (!($data['token'] ?? null))
                                @endif --}}
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="{{ $data['token'] ?? null ? 'w-100' : '' }} btn bg-purple"
                                    type="submit">Crear testimonio</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>

@stop


@push('js')
    <script>
        const data_server = @json($data['js'] ?? []);
        const rating_testimony = @json($data['testimony']->rating ?? null ? $data['testimony']->rating : 4);
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
                "defaultRating": rating_testimony
            });
        })
    </script>
@endpush
