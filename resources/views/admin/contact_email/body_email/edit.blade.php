@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
@section('plugins.Summernote', true)

@section('title', 'Editar Cuerpo De Email')

@section('content_header')
    <h1>Editar Cuerpo De Email</h1>
@stop

<style>
    .note-editable.card-block {
        min-height: 300px
    }

</style>

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Editar Cuerpo De Email</h3>
                </div>

                <div class="card-body table-responsive">

                    <div class="col-md-6 offset-md-3">
                        <form class="form_disabled_button_send" action="{{ route("bodyEmail.update", ["body_email" => $bodyEmail->id]) }}" method="POST">
                            @csrf
                            @method("PUT")
                            {{-- Nombre --}}
                            <div class="input-group mb-3 ">
                                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre') ? old('nombre') : $bodyEmail->nombre }}" placeholder="Nombre" autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="far fa-file"></span>
                                    </div>
                                </div>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <textarea id="summernote" name="body" class=" @error('body') is-invalid @enderror"
                                >{!! old('body') ? old('body') : $bodyEmail->body !!}</textarea>

                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm" type="submit">Registrar</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>



@stop


@section('js')
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
        })
    </script>
@stop
