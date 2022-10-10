@extends('layouts.app')

@section('title', $data['title'])

@section('content_header')
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
                    <x-preview-image idForm='form_upload_logo' idImg='preview_logo' idInput='input_logo'
                        title="Logo del sitio web"
                        description='La imagen que se suba se estará usando como logo del sitio web' />
                </div>
            </div>

            {{-- * datos de contacto y ubicaion --}}
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Datos de contacto</h3>
                </div>

                <div class="card card-body">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <h2 class="h5">Contactos</h2>
                            <p>Los datos ingresados serán mostrados de forma que el usuario pueda contactar de forma
                                sensilla con el sitio.</p>
                        </div>

                        <div class="col-md-6">
                            <form action="">
                                <div class="input-group mb-3">
                                    <input type="text" name="nombre_empresa" class="form-control " value=""
                                        placeholder="Numero telefonico" autofocus="">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-phone"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="nombre_empresa" class="form-control " value=""
                                        placeholder="Correo electronico" autofocus="">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-mail-bulk" style="font-size: 15px"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="nombre_empresa" class="form-control " value=""
                                        placeholder="Ubicacion" autofocus="">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-search-location"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn bg-purple font-weight-bold" type="button">Registrar
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
                    <x-preview-image idForm='form_upload_img_web_site' idImg='preview_img_web_site'
                        idInput='input_img_web_site' title="Imagen principal del sistio web"
                        description='La imagen que se suba aparecerá como principal en la pagina web del sitio' />

                    <div class="row no-gutters mt-3">
                        <div class="col-12">
                            <label for="">Dimenciones de la imagen</label>
                        </div>
                        <div class="col pr-3">
                            <input type="text" placeholder="Ancho de la imagen" class="form-control">
                        </div>
                        <div class="col ">
                            <input type="text" placeholder="Alto de la imagen" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            {{-- * redes sociales --}}
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Redes sociales</h3>
                </div>

                <div class="card card-body">


                </div>
            </div>
        </div>
    </div>

@stop


@section('js')

    <script></script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>



    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>


@stop
