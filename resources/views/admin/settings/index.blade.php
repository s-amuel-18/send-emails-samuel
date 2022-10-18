@extends('layouts.app')
@section('plugins.Bootstrap-iconpicker', true)
@section('plugins.bs-custom-file-input', true)

@section('title', $data['title'])

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/cropperjs/cropper.min.css') }}">
@endpush

@section('content_header')
    {{-- * cropper js --}}
    <h1>{{ $data['title'] }}</h1>
@stop


@section('content_2')

    <div class="row">
        <div class="col-md-6">

            {{-- * Logo principal --}}
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Logo principal</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card card-body">
                    <x-preview-image delafultImage="{{ $data['logo_img']->logoRouteStorage ?? null }}"
                        idForm='form_upload_logo' idImg='preview_logo' idInput='input_logo' title="Logo del sitio web"
                        description='La imagen que se suba se estará usando como logo del sitio web' />
                </div>
            </div>

            {{-- * Informacion de contacto y ubicaion --}}
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Informacion de contacto</h3>
                </div>

                <div class="card card-body">
                    <div class="row no-gutters">
                        <div class="col-sm-6 pr-3">
                            <h2 class="h5">Contactos</h2>
                            <p>Los datos ingresados serán mostrados de forma que el usuario pueda contactar de forma
                                sensilla con el sitio.</p>
                        </div>


                        {{-- * form info de contacto --}}
                        <div class="col-sm-6">
                            <form action="" id="form_info_contact">
                                <div class="form-group">
                                    <div class="input-group ">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Numero telefonico" autofocus=""
                                            value="{{ $data['contact_info']->phone_number ?? '' }}">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-phone"></span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="input-group ">
                                        <input type="email" name="email" class="form-control "
                                            placeholder="Correo electronico" autofocus=""
                                            value="{{ $data['contact_info']->email ?? '' }}">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-mail-bulk" style="font-size: 15px"></span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="input-group ">
                                        <input type="text" name="location" class="form-control " placeholder="Ubicacion"
                                            autofocus="" value="{{ $data['contact_info']->location ?? '' }}">

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-search-location"></span>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <button id="form_submit_info_contact" class="btn bg-purple font-weight-bold"
                                        type="submit">Registrar
                                        contactos</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-6">
            {{-- * Imagen principal --}}
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Imagen principal</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card card-body">
                    <form action="">
                        <img id="img_preview_primary_image"
                            class="{{ !($data['info_primary']->routeImg ?? null) ? 'd-none' : '' }}"
                            src="{{ $data['info_primary']->routeImg ?? null }}" alt="" style="max-width: 200px">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <!-- <label for="customFile">Custom File</label> -->
                                    <label for="">Imagen principal</label>

                                    <div class="custom-file mb-0">
                                        <input accept="image/png, image/jpg, image/jpeg" type="file"
                                            class="mb-0 custom-file-input" id="image_primary_preview">
                                        <label class="mb-0 custom-file-label" for="customFile">Seleccionar imagen</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_site">Titulo principal</label>
                                    <input id="title_site" class="form-control event_input_change_info_primary"
                                        type="text" name="title" value="{{ $data['info_primary']->title ?? '' }}">
                                </div>
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="desc_site">Descripción principal (opcional)</label>

                            <textarea name="description" id="desc_site" class="event_input_change_info_primary form-control" rows="4">{{ $data['info_primary']->description ?? '' }}</textarea>
                        </div>

                    </form>
                </div>
            </div>

            {{-- * redes sociales --}}
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Redes sociales</h3>
                </div>

                <div class="card card-body">

                    @include('admin.settings.modules.social_media', [
                        'social_medias' => $data['social_medias'],
                    ])

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_crop_image" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Editar imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row no-gutters">
                            <div class="col-md-7 pr-3">
                                <div class="">
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image_primary_settings" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row no-gutters" data-toggle="buttons">
                                    <div class="col ">
                                        <label class="w-100 btn btn-primary active">
                                            <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio"
                                                value="1.7777777777777777">
                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                                title="" data-original-title="aspectRatio: 16 / 9">
                                                16:9
                                            </span>
                                        </label>

                                    </div>
                                    <div class="col ">
                                        <label class="w-100 btn btn-primary">
                                            <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio"
                                                value="1.3333333333333333">
                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                                title="" data-original-title="aspectRatio: 4 / 3">
                                                4:3
                                            </span>
                                        </label>

                                    </div>
                                    <div class="col ">
                                        <label class="w-100 btn btn-primary">
                                            <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio"
                                                value="1">
                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                                title="" data-original-title="aspectRatio: 1 / 1">
                                                1:1
                                            </span>
                                        </label>

                                    </div>
                                    <div class="col ">
                                        <label class="w-100 btn btn-primary">
                                            <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio"
                                                value="0.6666666666666666">
                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                                title="" data-original-title="aspectRatio: 2 / 3">
                                                2:3
                                            </span>
                                        </label>

                                    </div>
                                    <div class="col ">
                                        <label class="w-100 btn btn-primary">
                                            <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio"
                                                value="NaN">
                                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                                title="" data-original-title="aspectRatio: NaN">
                                                Free
                                            </span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crop">Enviar</button>
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

    {{-- * cropper js --}}
    <script src="{{ asset('vendor/cropperjs/cropper.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>

    {{-- * eventos para enviar imagenes al servidor --}}
    <script src="{{ asset('js/settings/upload_images.js') }}"></script>

    {{-- * funciones de cropper js para redimencionar la imagen principal --}}
    <script src="{{ asset('js/settings/cropper-js-funtion.js') }}"></script>

    {{-- * funciones para crear la informacion principal del sitio web --}}
    <script src="{{ asset('js/settings/info_primary.js') }}"></script>

    {{-- * funciones para crear la informacion de contacto  --}}
    <script src="{{ asset('js/settings/info_contact.js') }}"></script>

    {{-- * funciones para crear, eliminar y actualizar redes sociales  --}}
    <script src="{{ asset('js/settings/social_media.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            bsCustomFileInput.init();
        });
    </script>
@endpush
