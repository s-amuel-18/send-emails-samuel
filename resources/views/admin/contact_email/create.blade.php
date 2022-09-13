@extends('layouts.app')
{{-- @section('plugins.Datatables', true) --}}

@push('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/country-picker-flags/css/countrySelect.min.css') }}">
@endpush

@section('title', 'Nuevo Email')

@section('content_header')
    <h1>Nuevo Email</h1>
@stop

@section('content_2')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Formulario Nuevo Email</h3>

                </div>

                <div class="card-body ">
                    <form class="form_disabled_button_send" action="{{ route('contact_email.store') }}" method="POST">

                        @csrf
                        <div class="row">

                            <div class="col-12 col-md-3">
                                <div class="card card-outline card-primary   mx-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Tus registros de hoy</h3>
                                        <div class="card-tools font-weight-bold  text-success mx-2">
                                            <span class="">{{ $contact_emails_today_count }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">
                                    {{-- Nombre Empresa --}}
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="text" name="nombre_empresa"
                                                class="form-control @error('nombre_empresa') is-invalid @enderror"
                                                value="{{ old('nombre_empresa') }}" placeholder="Nombre De La Empresa"
                                                autofocus>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-business-time"></span>
                                                </div>
                                            </div>

                                            @error('nombre_empresa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- url --}}
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="text" name="url"
                                                class="form-control @error('url') is-invalid @enderror"
                                                value="{{ old('url') }}" placeholder="Pagina De Contacto o de referencia"
                                                autofocus>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-external-link-square-alt"></span>
                                                </div>
                                            </div>

                                            @error('url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- email --}}
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="Correo Electronico" autofocus>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-mail-bulk"></span>
                                                </div>
                                            </div>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- whatsapp --}}
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="text" name="whatsapp"
                                                class="form-control @error('whatsapp') is-invalid @enderror"
                                                value="{{ old('whatsapp') }}" placeholder="whatsapp" autofocus>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fab fa-whatsapp"></span>
                                                </div>
                                            </div>

                                            @error('whatsapp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- instagram --}}
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="text" name="instagram"
                                                class="form-control @error('instagram') is-invalid @enderror"
                                                value="{{ old('instagram') }}" placeholder="instagram" autofocus>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fab fa-instagram"></span>
                                                </div>
                                            </div>

                                            @error('instagram')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- facebook --}}
                                    <div class="col-md-6">
                                        <div class="input-group mb-3 ">
                                            <input type="text" name="facebook"
                                                class="form-control @error('facebook') is-invalid @enderror"
                                                value="{{ old('facebook') }}" placeholder="facebook" autofocus>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fab fa-facebook"></span>
                                                </div>
                                            </div>

                                            @error('facebook')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="col-md-6 ">
                                    <div class="input-group ">
                                        <input class="form-control" name="country_selector" id="country_selector" readonly
                                            type="text" value="Anguilla">
                                    </div>
                                </div> --}}
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <label for="descripcion">Descripcion</label> --}}
                                    <textarea id="descripcion" class="form-control" name="descripcion" style="height: 146.5px;">{{ old('descripcion') }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn bg-purple btn-sm" type="submit">
                                    <i class="fas fa-mail-bulk"></i> Crear Nuevo Registro
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>

    </div>



@stop


@push('js')
    <script src="{{ asset('js/Plugins/countrySelect.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins/countryselect main.js') }}"></script>
@endpush
