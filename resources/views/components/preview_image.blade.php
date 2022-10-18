{{-- * este componente require de este archivo "js/functions/preview_image.js" --}}
@dump($data)
@if ($id_form ?? null and $id_img ?? null and $id_input ?? null)
    <form id="{{ $id_form }}">

        <div class="row ">
            <div class="col-md-6 py-3 py-md-0">
                <div class="content_img_100x60 position-relative d-flex justify-content-center align-items-center bg-gray-light"
                    style="">


                    <div class="preview-image">
                        <img data-load_img="{{ asset('images/helpers/img_gris.png') }}"
                            src="{{ asset('images/helpers/img_gris.png') }}" id="{{ $id_img }}" alt="subir imagen">
                    </div>
                </div>
            </div>
            <div class="col-md-6 py-3 py-md-0 ">
                <h2 class="h5">{{ $title ?? '' }}</h2>
                <p>{{ $description ?? '' }}</p>
                <div class="">
                    <input required accept="image/png, image/jpg, image/jpeg" type="file" name="image_front_page"
                        class="d-none" id="{{ $id_input }}">

                    <label for="{{ $id_input }}" class="btn bg-purple">
                        <i class="fa fa-file-image"></i> Subir imagen
                    </label>

                </div>

            </div>
        </div>

    </form>

    @section('js')

        {{-- * funcion que nos permite previsualizar una imagen --}}
        <script src="{{ asset('js/functions/preview_image.js') }}"></script>


        <script>
            $(function() {
                const id_form = @json($id_form);
                const id_img = @json($id_img);
                const id_input = @json($id_input);
                const form_select_upload_img = document.getElementById(id_form);
                const preview_img = document.getElementById(id_img);
                const input = document.getElementById(id_input);
                console.log(id_form);
                event_change_imput_file(form_select_upload_img, preview_img, input);
            });
        </script>

    @stop
@endif
