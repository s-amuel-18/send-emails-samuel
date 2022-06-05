@extends('layouts.app')
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


@section('content_2')

    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">Envio De emails</h3>
        </div>

        <div class="card-body ">

            <form action="{{ route('envio_email.crear_informacio') }}" method="POST" class="form_disabled_button_send">
                @csrf

                <div class="row">

                    <div class="col-md-4">



                        {{-- asunto --}}
                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            <input id="asunto" class="form-control @error('asunto') is-invalid @enderror" type="text"
                                name="asunto" placeholder="Asunto De Email" value="{{ old('asunto') }}">

                            @error('asunto')
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

                        {{-- Check correos aleatorios --}}
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="hidden" name="check_emails" value="">

                                <input class="custom-control-input @error('check_emails') is-invalid @enderror"
                                    type="checkbox" id="customCheckbox2" value="1" name="check_emails"
                                    {{ old('check_emails') ? 'checked' : '' }}>
                                <label for="customCheckbox2" class="custom-control-label">Seleccionar los ultimos 200 Emails
                                    Sin Enviar </label>
                            </div>
                            @error('check_emails')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email select --}}
                        <div class="form-group">
                            <label for="">Seleccionar email</label><br>
                            <select class="select2-check" name="emails[]" multiple="multiple">

                                @foreach ($emails as $email)
                                    <option data-badge-color="{{ $email->estado == 0 ? 'danger' : 'success' }}"
                                        data-badge-text="{{ $email->estado == 0 ? 'Sin Enviar' : 'Enviado' }}"
                                        value="{{ $email->id }}">{{ $email->email }}</option>
                                @endforeach

                            </select>

                            @error('emails')
                                {{-- <span class="invalid-feedback" role="alert"> --}}
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                {{-- </span> --}}
                            @enderror



                            {{-- <div style="max-height: 200px; overflow-y: scroll">


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
                            </div> --}}


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

            $(".select2-check").select2({
                closeOnSelect: false,
                placeholder: "Seleccionar emails",
                allowHtml: true,
                allowClear: true,
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                tags: true // создает новые опции на лету
            });



            function iformat(icon, badge) {

                var originalOption = icon.element;
                if (!originalOption) {
                    return icon.text;
                }
                var originalOptionBadge = $(originalOption).data('badge-text');
                var color = $(originalOption).data('badge-color');


                return $('<div class="d-flex justify-content-between"><span>' + icon.text +
                    '</span><div class=""><span class="badge badge-' + color + '">' + originalOptionBadge +
                    '</span></div></div>');
            }
        })
    </script>

@stop
