@extends('layouts.app')
@section('plugins.Select2', true)


@section('title', $data['title'])

@section('content_header')
    <h1>Editar Servicio "{{ $data['service']->name }}"</h1>
@stop

@section('content_2')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Formulario de edicion</h3>
                </div>

                <div class="card-body ">
                    <form class="form_disabled_button_send"
                        action="{{ route('service.update', ['servicio' => $data['service']->id]) }}" method="POST">

                        @method('PUT')
                        @csrf

                        <div class="row">


                            {{-- Nombre servicio --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="text" name="name"
                                        class="form-control form-control-sm  @error('name') is-invalid @enderror"
                                        value="{{ old('name') ?? $data['service']->name }}"
                                        placeholder="Nombre del servicio" autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-hand-holding-usd"></span>
                                        </div>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            {{-- precio --}}

                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="number" name="price"
                                        class="form-control form-control-sm  @error('price') is-invalid @enderror"
                                        value="{{ old('price') ?? $data['service']->price }}" placeholder="Precio">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-dollar-sign text-success"></i>
                                        </div>
                                    </div>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Categoria --}}


                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control select2 form-control-sm " name="category_id"
                                        id="category_id">
                                        <option>Seleccionar categoria</option>
                                        @foreach ($data['categories'] as $category)
                                            <option
                                                {{ (old('category_id') ?? ($data['service']->category->id ?? false)) == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="text-danger">
                                            <small>
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <button class="btn bg-purple btn-sm" type="submit">
                                    <i class="fas fa-plus-square"></i> Crear Nuevo Servicio
                                </button>
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
