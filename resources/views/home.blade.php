@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
@section('plugins.Datatables', true)

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')

    <div class="row">

        @can('contact_email.index')
            <div class="col-md-3 col-6">
                {{-- Registros de hoy --}}
                <x-adminlte-small-box title="{{ $registros_de_hoy }}" text="Registros De Hoy" icon="fas fa-mail-bulk"
                    theme="success" url="contact-email/" url-text="Ver Registros" />
            </div>
        @endcan

        @can('contact_email.estadisticas')
            <div class="col-md-3 col-6">
                {{-- Registros Totales --}}
                <x-adminlte-small-box title="{{ $total_registros }}" text="Registros Totales" icon="fas fa-mail-bulk"
                    theme="primary" url="contact-email/estadisticas" url-text="Ver Registros" />
            </div>
        @endcan

        @can('envio_email.index')
            <div class="col-md-3 col-6">
                {{-- Correos sin enviar --}}
                <x-adminlte-small-box title="{{ $correos_sin_enviar }}" text="Correos Sin Enviar" icon="fas fa-mail-bulk"
                    theme="danger" url="envio-email" url-text="Enviar Correos" />
            </div>
        @endcan

        @can('envio_email.index')
            <div class="col-md-3 col-6">
                {{-- usuarios --}}
                <x-adminlte-small-box title="{{ $enviados_hoy }}" text="Envios de Hoy" icon="fas fa-mail-bulk" theme="indigo"
                    url="user" url-text="Enviar Correos" />
            </div>
        @endcan

    </div>

    <div class="row">

        @can('user.index')

            <div class="col-md-6 table-responsive">

                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios Con Registros De Hoy</h3>
                        <div class="card-tools">

                            @can('user.create')
                                <a href="{{ route('contact_email.estadisticas') }}"
                                    class="btn btn-outline-light not-hover btn-tool">
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
                                    <th>Cantidad</th>
                                    <th>Correos Enviados</th>
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
                                        <td>
                                            @if ($usr->emailEnviado->count() > 0)
                                                <span class="badge badge-primary"
                                                    style="background: #6610f2">{{ $usr->emailEnviado->where('created_at', '=', "date($date)")->count() }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>



            </div>

        @endcan

        @can('contact_email.index')

            <div class="col-md-6 table-responsive">

                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Registros De Hoy</h3>
                        <div class="card-tools">

                            @can('contact_email.create')
                                <a href="{{ route('contact_email.create') }}"
                                    class="btn btn-outline-light not-hover btn-tool">
                                    <i class="fas fa-plus"></i>
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        @if ( $registros_de_hoy_completo->count() > 0 )
                        <table class="table table-light table-striped table-hover text-nowrap table-valign-middle datatable">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Empresa</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Contacttos</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($registros_de_hoy_completo as $i => $registro)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $registro->nombre_empresa }}</td>
                                        <td>{{ $registro->usuario->username }}</td>
                                        <td>{{ $registro->email }}</td>
                                        <td>
                                            {{-- whatsapp --}}
                                            @if ($registro->whatsapp)
                                                <a target="_blanck" href="{{ $registro->whatsapp }}" class="btn btn-success btn-sm ">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @endif

                                            {{-- facebook --}}
                                            @if ($registro->facebook)
                                                <a target="_blanck" href="{{ $registro->facebook }}"
                                                    class="btn btn-primary btn-sm ">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            @endif

                                            {{-- instagram --}}
                                            @if ($registro->instagram)
                                                <a target="_blanck" href="{{ $registro->instagram }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            @endif

                                            {{-- url --}}
                                            @if ($registro->url)
                                                <a target="_blanck" href="{{ $registro->url }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        @else
                            Sin Registros De Hoy
                        @endif

                    </div>
                </div>



            </div>

        @endcan

    </div>

@stop


@section('js')

<script>
    $(".datatable").DataTable();
</script>

@stop
