@extends('layouts.app')
@section('plugins.Datatables', true)
{{-- @section('plugins.Sweetalert2', true) --}}
@section('plugins.Summernote', true)
@section('plugins.Select2', true)

@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@push('css')
    {{-- * estilos de input file custom --}}
    <link rel="stylesheet" href="{{ asset('css/plugins/filepond/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/upload-images.css') }}">
    {{-- * estilos de input file custom end --}}

    <style>
        .note-editable.card-block {
            min-height: 200px
        }
    </style>
@endpush

@section('content_2')
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
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">{{ $data['title'] }}</h3>
                </div>

                <div class="card card-body">



                    <form class="form_disabled_button_send" action="{{ route('project.store') }}" method="POST"
                        id="form_new_project" enctype="multipart/form-data">
                        @csrf
                        <input id="project_id" type="hidden" name="project_id" value="{{ $data['project']->id ?? 0 }}">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- * nombre del proyecto --}}
                                        <div class="form-group">
                                            <label for="name_project">Nombre del proyecto</label>
                                            <input id="name_project" class="element_insert_data_async form-control"
                                                type="text" name="name" placeholder="Nombre del proyecto"
                                                value="{{ $data['project']->name ?? '' }}">
                                        </div>
                                        {{-- * nombre del proyecto end --}}
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="categories_project">Categorias</label>
                                            <select name="categories[]" id="categories"
                                                class="element_insert_data_async w-100 select2 form-control" multiple>
                                                @foreach ($data['categories'] as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($data['pluck_categories'] ?? null) {{ in_array($category->id, $data['pluck_categories']) ? 'selected' : '' }} @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="description_project">Description</label>
                                    <textarea required class="element_insert_data_async form-control" name="description" id="description_project"
                                        rows="10">
                                        {{ $data['project']->description ?? '' }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Articulos de ayuda</label>
                                    <div id="insert_items_help_project">

                                        @if ($data['project']->itemHelp ?? null)
                                            @foreach ($data['project']->itemHelp as $key => $item_help)
                                                <div class="item_help_project" data-number_item="{{ $key + 1 }}">
                                                    <div class="row">
                                                        <div class="col-4 form-group">
                                                            <input required type="text"
                                                                class="form-control form-control-sm"
                                                                name="item_help[name][{{ $key + 1 }}]"
                                                                placeholder="Nombre artículo"
                                                                value="{{ $item_help->name }}">
                                                        </div>
                                                        <div class="col-4 form-group">
                                                            <input required type="text"
                                                                class="form-control form-control-sm"
                                                                placeholder="Descripción artículo"
                                                                name="item_help[description][{{ $key + 1 }}]"
                                                                value="{{ $item_help->description }}">
                                                        </div>
                                                        <div class="col-3 form-group">
                                                            <select required class="form-control form-control-sm"
                                                                name="item_help[template][{{ $key + 1 }}]">
                                                                <option value="">Plantilla</option>
                                                                <option
                                                                    {{ $item_help->template == "<a href='%item%'>%item%</a>" ? 'selected' : '' }}
                                                                    value="<a href='%item%'>%item%</a>">Link</option>
                                                                <option
                                                                    {{ $item_help->template == "<p class='mb-0'>%item%</p>" ? 'selected' : '' }}
                                                                    value="<p class='mb-0'>%item%</p>">Parrafo</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-1">
                                                            <button
                                                                class="delete_item_helper_project w-100 btn btn-outline-danger btn-sm"
                                                                type="button">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="item_help_project" data-number_item="1">
                                                <div class="row">
                                                    <div class="col-4 form-group">
                                                        <input required type="text" class="form-control form-control-sm"
                                                            name="item_help[name][1]" placeholder="Nombre artículo">
                                                    </div>
                                                    <div class="col-4 form-group">
                                                        <input required type="text" class="form-control form-control-sm"
                                                            placeholder="Descripción artículo"
                                                            name="item_help[description][1]">
                                                    </div>
                                                    <div class="col-3 form-group">
                                                        <select required class="form-control form-control-sm"
                                                            name="item_help[template][1]">
                                                            <option value="">Plantilla</option>
                                                            <option value="<a href='%item%'>%item%</a>">Link</option>
                                                            <option value="<p class='mb-0'>%item%</p>">Parrafo</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-1">
                                                        <button
                                                            class="delete_item_helper_project w-100 btn btn-outline-danger btn-sm"
                                                            type="button">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    <button class="w-100 btn btn-outline-primary btn-sm" type="button"
                                        id="item_helper_project">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>

                                <div class="form-group">

                                    <div class="row ">
                                        <div class="col-md-6 py-3 py-md-0">
                                            <div
                                                class="content_img_100x60 position-relative d-flex justify-content-center align-items-center bg-gray-light">


                                                <div class="preview-image">
                                                    <img data-load_img="{{ asset('images/helpers/img_gris.png') }}"
                                                        src="{{ $data['project']->image_front_page ?? null ? '/storage/' . $data['project']->image_front_page : asset('images/helpers/img_gris.png') }}"
                                                        id="preview_image_front_project" alt="subir imagen">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 py-3 py-md-0 ">
                                            <h2 class="h5">Foto miniatura</h2>
                                            <p>Aparecerá como portada del proyecto y se reducirña su peso de forma que no
                                                tarde
                                                en cargar la imagen.</p>
                                            <div class="">
                                                <input required accept="image/png, image/jpg, image/jpeg" type="file"
                                                    name="image_front_page" class="d-none" id="image_front_page">
                                                @if ($data['project']->image_front_page ?? null)
                                                    <input type="hidden" name="img_front_exist" value="1"
                                                        id="img_front_exist">
                                                @endif

                                                <label for="image_front_page" class="btn bg-purple">
                                                    <i class="fa fa-file-image"></i> Subir imagen
                                                </label>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="filepond">Imagenes del proyecto</label>

                                    {{-- * input file images --}}
                                    <input type="file" class="filepond" id="filepond_test"
                                        accept="image/png, image/jpg, image/jpeg" multiple data-max-file-size="3MB"
                                        data-max-files="4" />

                                    {{-- * zona donde se arrastran los archivos --}}
                                    <div id="dropzone"
                                        style="border: 2px dashed black; background: limegreen; padding: 25px;height:100vh; margin: 25px 0; display: none; position">
                                        🎯 Drop files here!
                                    </div>
                                    {{-- * input file images end --}}

                                </div>


                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn bg-purple" type="submit">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    {{-- * variables globales --}}
    <script>
        const description_project = document.getElementById("description_project");
        const appData = @json($data['js'] ?? []);
        const images_project = @json($data['project']->images ?? []);
        const route_upload_img = @json(route('project.upload_image'));
        const route_upload_img_delete = @json(route('project.upload_image_delete'));
        const route_change_or_create = @json(route('project.change_or_create_data_project'));
        const asset_route = @json(asset(''));
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>

    {{-- * funciones de subida de imagenes multiples --}}
    <script src="{{ asset('js/Plugins/filepond/filepond-plugin-file-encode.min.js') }}"></script>

    <script src="{{ asset('js/Plugins/filepond/filepond-plugin-file-validate-size.min.js') }}"></script>

    <script src="{{ asset('js/Plugins/filepond/filepond-plugin-image-exif-orientation.min.js') }}"></script>

    <script src="{{ asset('js/Plugins/filepond/filepond-plugin-image-preview.min.js') }}"></script>

    <script src="{{ asset('js/Plugins/filepond/filepond.min.js') }}"></script>

    <script src="{{ asset('js/projects/functions/upload_images.js') }}"></script>

    {{-- * funcion que nos permite previsualizar una imagen como front del proyecto --}}
    <script src="{{ asset('js/projects/upload_image_preview_project.js') }}"></script>

    {{-- * funcion que nos permite crear y eliminar items helpers --}}
    <script src="{{ asset('js/projects/item_helper_actions.js') }}"></script>
    <script src="{{ asset('js/projects/functions/functions.js') }}"></script>

    {{-- * funcion de validacion de formulario --}}
    <script src="{{ asset('js/projects/validation.js') }}"></script>

    <script>
        event_element_insert_data_async();
    </script>
@endpush
