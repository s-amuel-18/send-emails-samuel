@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
{{-- @section('plugins.Datatables', true) --}}

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Formulario Nuevo Usuario</h3>
                </div>

                <div class="card-body ">
                    <form action="{{ route('user.store') }}" method="POST">

                        @csrf

                        <div class="row">
                            {{-- Name field --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}"
                                        autofocus>

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Username --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username') }}" placeholder="Username">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email field --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password field --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('adminlte::adminlte.password') }}">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Confirm password field --}}
                            <div class="col-md-3">
                                <div class="input-group mb-3 ">
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="{{ __('adminlte::adminlte.retype_password') }}">

                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="form-group d-flex flex-wrap">

                                    @foreach ($roles as $rol)
                                        <div class="form-check m-2">
                                            <input id="role_{{ $rol->id }}" class="form-check-input" type="checkbox" name="roles[]"
                                                value="{{ $rol->id }}">
                                            <label for="role_{{ $rol->id }}" class="form-check-label">{{ $rol->name }}</label>
                                        </div>
                                    @endforeach

                                </div>

                            </div>


                            {{-- Register button --}}
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit"
                                        class="btn  {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                                        <span class="fas fa-user-plus"></span>
                                        Crear Nuevo Usuario
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
