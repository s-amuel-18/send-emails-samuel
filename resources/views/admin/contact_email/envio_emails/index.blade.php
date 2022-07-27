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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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



                        {{-- Email select --}}
                        <div class="form-group">
                            <label for="">Seleccionar email</label><br>
                            <select class="select2_ajax form-control" name="email" multiple="multiple">
                            </select>

                            @error('emails')
                                {{-- <span class="invalid-feedback" role="alert"> --}}
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                {{-- </span> --}}
                            @enderror



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
                        <button class="btn bg-purple btn-sm" type="submit">Enviar Correo</button>
                    </div>
                </div>
            </form>

        </div>
    </div>




@stop


@section('js')

    <script>
        const dataServer = @json($data['js']);

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

            let varAuxEventfovcusOut = 0;

            $('.select2_ajax').select2({
                maximumSelectionLength: 1,
                ajax: {
                    url: dataServer["url_get_contact_email"],

                    data: function(params) {
                        var query = {
                            search: params.term,
                            format_select: true
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function(data, {
                        term
                    }) {
                        const search = term;

                        if (data.results.length < 1) {
                            return {
                                results: [{
                                    "id": search,
                                    "text": search,
                                }]
                            };

                        } else {
                            return {
                                results: data.results
                            };

                        }

                        // Transforms the top-level key of the response object from 'items' to 'results'
                    }
                }
            });

        })
    </script>

@stop
