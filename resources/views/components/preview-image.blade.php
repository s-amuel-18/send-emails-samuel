<div>
    {{-- * este componente require de este archivo "js/functions/preview_image.js" --}}
    @if ($idForm ?? null and $idImg ?? null and $idInput ?? null)
        <form id="{{ $idForm }}">

            <div class="row ">
                <div class="col-md-6 py-3 py-md-0">
                    <div class="content_img_100x60 position-relative d-flex justify-content-center align-items-center bg-gray-light"
                        style="">


                        <div class="preview-image">
                            <img data-load_img="{{ asset('images/helpers/img_gris.png') }}"
                                src="{{ asset('images/helpers/img_gris.png') }}" id="{{ $idImg }}"
                                alt="subir imagen">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-3 py-md-0 ">
                    <h2 class="h5">{{ $title ?? '' }}</h2>
                    <p>{{ $description ?? '' }}</p>
                    <div class="">
                        <input data-id_form="{{ $idForm }}" data-id_img="{{ $idImg }}" required
                            accept="image/png, image/jpg, image/jpeg" type="file" name="image_front_page"
                            class="listener_input_file d-none" id="{{ $idInput }}">

                        <label for="{{ $idInput }}" class="btn bg-purple">
                            <i class="fa fa-file-image"></i> Subir imagen
                        </label>

                    </div>

                </div>
            </div>

        </form>

        @section('js')

            {{-- * funcion que nos permite previsualizar una imagen --}}
            <script src="{{ asset('js/functions/preview_image.js') }}"></script>

        @stop
    @endif

</div>
