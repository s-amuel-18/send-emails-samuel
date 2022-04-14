@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
@section('plugins.Datatables', true)

@section('title', 'Dashboard')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')

    <div class="row">

        <div class="col-md-3">
            {{-- Registros de hoy --}}
            <x-adminlte-small-box title="{{ $registros_de_hoy }}" text="Correos Registrados Hoy" icon="fas fa-mail-bulk"
                theme="success" url="contact-email/estadisticas" url-text="Ver Correos" />
        </div>

        <div class="col-md-3">
            {{-- Registros Totales --}}
            <x-adminlte-small-box title="{{ $total_registros }}" text="Correos Registrados" icon="fas fa-mail-bulk"
                theme="primary" url="contact-email" url-text="Ver Correos" />
        </div>

        <div class="col-md-3">
            {{-- Correos sin enviar --}}
            <x-adminlte-small-box title="{{ $correos_sin_enviar }}" text="Correos Sin Enviar" icon="fas fa-mail-bulk"
                theme="danger" url="envio-email" url-text="Enviar Correos" />
        </div>

        <div class="col-md-3">
            {{-- usuarios --}}
            <x-adminlte-small-box title="{{ $usuarios_registrados }}" text="Usuarios Registrados" icon="fas fa-users"
                theme="purple" url="user" url-text="Ver Usuarios" />
        </div>
        {{-- <div class="col-md-3"></div> --}}
    </div>

    <div class="row">
        <div class="col-md-6 table-responsive">

            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Usuarios Con Registros De Hoy</h3>
                    <div class="card-tools">

                        @can('user.create')
                            <a href="{{ route('contact_email.estadisticas') }}" class="btn btn-outline-light not-hover btn-tool">
                                <i class="fas fa-user-plus"></i>
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>username</th>
                                <th>Canridad</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($usr_registros_hoy as $i => $usr)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $usr->id }}</td>
                                    <td>{{ $usr->username }}</td>
                                    <td>
                                        <span
                                            class="badge  badge-{{ $usr->cantidad_registros > 0 ? 'success' : 'danger' }}">{{ $usr->cantidad_registros }}</span>


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>

@stop


@section('js')

@stop
