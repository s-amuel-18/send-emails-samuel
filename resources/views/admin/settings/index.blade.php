@extends('layouts.app')
@section('plugins.Bootstrap-iconpicker', true)

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
                    <x-preview-image delafultImage="{{ $data['logo_img']->logoRouteStorage }}" idForm='form_upload_logo'
                        idImg='preview_logo' idInput='input_logo' title="Logo del sitio web"
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
                    <div class="mb-3">
                        <form class=" ">
                            <div class="row no-guetters ">
                                <div class="col-4 col-sm-3 col-lg-2  ">
                                    <span class="input-group-append">
                                        <button id="iconpicker" class="w-100 btn bg-purple" data-search="true"
                                            data-search-text="Buscar icono" data-iconset="fontawesome5" data-rows="4"
                                            data-cols="6" data-icon="fas fa-home" role="iconpicker"></button>
                                    </span>
                                </div>

                                <div class="col-5 col-sm-6 col-lg-8 col-xl-9">
                                    <input class="form-control w-100" type="text" name=""
                                        placeholder="Url de la red social o contacto">
                                </div>

                                <div class="col-3 col-lg-2 col-xl-1">
                                    <button class="w-100 btn btn-outline-primary" type="submit">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="">
                        <label for="">Redes redes sociales</label>
                        <div class="">
                            <a href="" class="btn btn-primary">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="" class="btn btn-primary">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="" class="btn btn-primary">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="" class="btn btn-primary">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <h5>Upload Images</h5>
        <form method="post">
            <input type="file" name="image" class="image">
        </form>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
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
                                    <img id="image" class="img-fluid">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
@stop


@push('js')
    <script>
        const data_server = @json($data['js']);
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * cropper js --}}
    <script src="{{ asset('vendor/cropperjs/cropper.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>

    {{-- * eventos para enviar imagenes al servidor --}}
    <script src="{{ asset('js/settings/upload_images.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    <script>
        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;
        const option = {
            aspectRatio: 16 / 9, // * esto nos permite darle la relacion de aspecto para declarar un patron
            viewMode: 3,
            crop: function(event) {
                console.log(event.detail);
            }
        };

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                bs_modal.modal('show');
            };


            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        bs_modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, option);
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "upload.php",
                        data: {
                            image: base64data
                        },
                        success: function(data) {
                            bs_modal.modal('hide');
                            alert("success upload image");
                        }
                    });
                };
            });
        });


        $(".sr-only").on("change", e => {
            option[e.target.name] = e.target.value;
            cropper.destroy()
            cropper = new Cropper(image, option);
        })
    </script>
@endpush
