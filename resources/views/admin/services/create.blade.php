@extends('layouts.app')


@section('title', $data['title'])

@section('content_header')
    <h1>Nuevo Servicio</h1>
@stop

@section('content_2')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Formulario Nuevo Servicio</h3>
                </div>

                <div class="card-body ">
                    <form class="form_disabled_button_send" action="{{ route('contact_email.store') }}" method="POST">

                        @csrf

                        <div class="row">


                            {{-- Nombre servicio --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="text" name="nombre_servicio"
                                        class="form-control @error('nombre_servicio') is-invalid @enderror"
                                        value="{{ old('nombre_servicio') }}" placeholder="Nombre del servicio" autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-hand-holding-usd"></span>
                                        </div>
                                    </div>

                                    @error('nombre_servicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button class="btn bg-purple btn-sm" type="submit">
                                    <i class="fas fa-plus-square"></i> Crear Nuevo Servicio
                                </button>
                            </div>



                            {{-- precio --}}

                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="text" name="nombre_precio"
                                        class="form-control @error('nombre_precio') is-invalid @enderror"
                                        value="{{ old('nombre_precio') }}" placeholder="Precio" autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-dollar-sign text-success"></i>
                                        </div>
                                    </div>

                                    @error('nombre_precio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Categoria --}}


                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="" id="">
                                        <option>Seleccionar categoria</option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>


                        </div>

                </div>

                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>

    </div>


@stop
