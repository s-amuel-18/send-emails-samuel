@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
@section('plugins.Datatables', true)

@section('title', 'Crear Rol')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">Formulario Nuevo Usuario</h3>
            </div>

            <div class="card-body ">
                <form action="{{ route('role.store') }}" method="POST">

                    @csrf

                    <div class="row">
                        {{-- Name field --}}
                        <div class="col-md-3">
                            <div class="input-group mb-3 ">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="Nombre Del Rol"
                                    autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span
                                            class="fas fa-suitcase-rolling"></span>
                                    </div>
                                </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="d-flex flex-wrap">
                                @foreach ($permissions as $permission)
                                    <div class="form-check m-2 ">
                                        <input id="{{ "permission_" . $permission->id }}" class="form-check-input @error('permissions') is-invalid @enderror" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                        <label for="{{ "permission_" . $permission->id }}" class="form-check-label">{{ $permission->description }}</label>
                                    </div>
                                @endforeach

                            </div>

                            @error('permissions')
                            {{-- <button class="btn btn-primary" type="button">Text</button> --}}

                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                        @enderror

                        </div>

                        {{-- Register button --}}
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                    class="btn  {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                    <span class="fas fa-suitcase-rolling"></span>
                                    Crear Nuevo Rol
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


@section('js')

@stop
