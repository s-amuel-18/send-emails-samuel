@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom/upload-images.css') }}">
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
                    <form action="" id="form_new_project">

                        {{-- * input file images --}}

                        {{-- The classic file input element we'll enhance to a file pond --}}
                        <input type="file" class="filepond" id="filepond" name="filepond" multiple
                            data-max-file-size="3MB" data-max-files="5" />

                        {{-- file upload itself is disabled in this pen --}}

                        <div id="dropzone"
                            style="border: 2px dashed black; background: limegreen; padding: 25px;height:100vh; margin: 25px 0; display: none; position">
                            🎯 Drop files here!
                        </div>
                        {{-- * input file images end --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    {{-- * variables globales --}}
    <script>
        // const appData = @json($data['js'] ?? []);
        // const requestData = @json($data['request'] ?? []);
        // let requirements_categories = null;
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>

    {{-- * funciones de subida de imagenes multiples --}}
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js">
    </script>
    <script
        src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="{{ asset('js/projects/functions/upload_images.js') }}"></script>
@endpush
