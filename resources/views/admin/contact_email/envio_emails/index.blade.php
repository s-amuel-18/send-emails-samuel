@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.Summernote', true)
@section('plugins.Select2', true)
{{-- @section('plugins.IcheckBootstrap', true) --}}


@section('title', 'Envio De emails')

@section('content_header')
    <h1>Envio De emails</h1>
@stop

<style>
    .note-editable.card-block {
        /* font-weight:  */
        min-height: 360px
    }

</style>


@section('content')

    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">Envio De emails</h3>
        </div>

        <div class="card-body ">

            <form action="{{ route('envio_email.crear_informacio') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-4">

                        {{-- nombre --}}
                        <div class="form-group">
                            <label for="nombre_user">Nombre Del Remitente</label>
                            <input id="nombre_user" value="{{ isset(auth()->user()->name) ? auth()->user()->name : '' }}"
                                class="form-control @error('nombre_remitente') is-invalid @enderror" type="text"
                                name="nombre_remitente">

                            @error('nombre_remitente')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- cyerpo de mensaje --}}
                        <div class="form-group">
                            <label for="select_body">Seleccionar Cuerpo De Mensaje Existente</label>
                            <br>
                            <select id="select_body" class="form-control select2 @error('select_body') is-invalid @enderror"
                                name="select_body">
                                <option value="">-- Seleccionar Cuerpo --</option>

                                @foreach ($bodysEmail as $body)
                                    <option value="{{ $body->id }}">
                                        {{ Str::limit($body->nombre, 30) }}</option>
                                @endforeach

                            </select>

                            @error('select_body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- cyerpo de mensaje --}}
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input @error("check_emails") is-invalid @enderror" type="checkbox" id="customCheckbox2" value="1"
                                    name="check_emails">
                                <label for="customCheckbox2" class="custom-control-label">Seleccionar los ultimos 200 Emails
                                    Sin Enviar</label>
                            </div>
                            @error('check_emails')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- cyerpo de mensaje --}}
                        <div class="form-group">
                            <div style="max-height: 200px; overflow-y: scroll">

                                <label for="">Seleccionar email</label>

                                <table class="table table">
                                    <tbody>

                                        @foreach ($emails as $email)
                                            <tr>
                                                <td style="width: 10px">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="email_{{ $email->id }}" value="{{ $email->id }}"
                                                            name="emails[]">
                                                        <label for="email_{{ $email->id }}"
                                                            class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <label style="font-weight: normal"
                                                        for="email_{{ $email->id }}">{{ $email->email }}</label>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>




                    </div>


                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea id="summernote" name="body" class=" @error('body') is-invalid @enderror">{{ old('body') }}</textarea>

                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" type="submit">Enviar Correo</button>
                    </div>
                </div>
            </form>

        </div>
    </div>



@stop


@section('js')

    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
            $('.select2').select2()
        })
    </script>

@stop
