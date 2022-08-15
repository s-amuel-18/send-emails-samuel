@extends('layouts.app')
@section('plugins.Datatables', true)

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content_2')

    @include('admin.components.alerts.send_emails')

    <div class="row">

        {{-- @can('managment.index')

            @foreach ($pays_time as $pay)
                <div class="col-md-3 col-6">

                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $pay->name }}: <b>{{ $pay->spemts_sum_price ?? 0 }}$</b></h3>

                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                    </div>

                </div>
            @endforeach

            <div class="col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-coins"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ingresos Brutos</span>
                        <span class="info-box-number">${{ number_format($data['grossIncome'], 2) }}</span>
                    </div>

                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-arrow-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ingresos Netos</span>
                        <span class="info-box-number">${{ number_format($data['netIncome'], 2) }}</span>
                    </div>

                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-pink"><i class="fa fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ingresos Diarios</span>
                        <span class="info-box-number">${{ number_format($data['dailyEarnings'], 2) }}</span>
                    </div>

                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-arrow-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Gastos</span>
                        <span class="info-box-number">${{ number_format($data['totalSpents'], 2) }}</span>
                    </div>

                </div>
            </div>
        @endcan --}}

        @can('contact_email.index')
            <div class="col-md-3 col-6">
                {{-- Registros de hoy --}}
                <x-adminlte-small-box title="{{ $registros_de_hoy }}" text="Emails Registrados hoy" icon="fas fa-mail-bulk"
                    theme="success" url="contact-email/" url-text="Ver Registros" />
            </div>
        @endcan

        @can('contact_email.estadisticas')
            <div class="col-md-3 col-6">
                {{-- Registros Totales --}}
                <x-adminlte-small-box title="{{ $total_registros }}" text="total de emails registrados" icon="fas fa-mail-bulk"
                    theme="primary" url="contact-email/estadisticas" url-text="Ver Registros" />
            </div>
        @endcan

        @can('envio_email.index')
            <div class="col-md-3 col-6">
                {{-- Correos sin enviar --}}
                <x-adminlte-small-box title="{{ $correos_sin_enviar }}" text="Emails Sin Enviar" icon="fas fa-mail-bulk"
                    theme="danger" url="envio-email/redaccion-detallada" url-text="Enviar Correos" />
            </div>
        @endcan

        @can('envio_email.index')
            <div class="col-md-3 col-6">
                {{-- usuarios --}}
                <x-adminlte-small-box id="emails_sent_today" title="{{ $enviados_hoy }}" text="Ultimos emails enviados"
                    icon="fas fa-mail-bulk" theme="indigo" url="envio-email/redaccion-detallada" url-text="Enviar Correos" />
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
                                <a href="{{ route('contact_email.estadisticas') }}" class="btn btn-info btn-sm text-white ">
                                    <i class="fas fa-fw fa-mail-bulk"></i><span class="d-none d-md-inline-block ml-1">Estadistica
                                        de
                                        registros</span>
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="datatable table table-light table-striped table-hover text-nowrap table-valign-middle">
                            <thead class="">
                                <tr>
                                    <th>ID</th>
                                    <th>username</th>
                                    <th>Cantidad</th>
                                    <th>Correos Enviados</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($usr_registros_hoy as $i => $usr)
                                    <tr>
                                        <td>{{ $usr->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div style="width: 27px; height: 27px;"
                                                    class="mr-2 bg-{{ $usr->color }} d-flex justify-content-center align-items-center rounded-circle">
                                                    <i class="fa fa-user" style="font-size: 12px"></i>
                                                </div>
                                                <div class="">
                                                    {{ $usr->username }}
                                                </div>

                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('contact_email.index', ['search' => $usr->username]) }}">
                                                <span style="font-size: 16px"
                                                    class="badge  badge-{{ $usr->emails_registros_count > 0 ? 'success' : 'danger' }}">{{ $usr->emails_registros_count }}</span>
                                            </a>


                                        </td>
                                        <td>

                                            <a
                                                href="{{ route('contact_email.shipping_history', ['search' => $usr->username]) }}">
                                                <span class="badge bg-purple"
                                                    style="font-size: 16px">{{ $usr->email_enviado_count }}</span>
                                            </a>
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
                        <h3 class="card-title">Ultimos 5 Registros De Hoy</h3>
                        <div class="card-tools">

                            @can('contact_email.create')
                                <a href="{{ route('contact_email.create') }}" class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Nuevo email</span>
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        @if ($registros_de_hoy_take->count() > 0)
                            <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                                <thead class="">
                                    <tr>
                                        <th>Nombre Empresa</th>
                                        <th>Email</th>
                                        <th>Contacttos</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($registros_de_hoy_take as $i => $registro)
                                        <tr>
                                            <td>{{ Str::limit($registro->nombre_empresa, 20) }}</td>
                                            <td>{{ $registro->email }}</td>
                                            <td>
                                                {{-- whatsapp --}}
                                                @if ($registro->whatsapp)
                                                    <a target="_blanck" href="{{ $registro->whatsapp }}"
                                                        class="btn btn-success btn-sm ">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                @endif

                                                {{-- facebook --}}
                                                @if ($registro->facebook)
                                                    <a target="_blanck" href="{{ $registro->facebook }}"
                                                        class="btn bg-purple btn-sm ">
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
        // $(".datatable").DataTable({
        //     pageLength: 5,
        //     order: false,
        // });
    </script>

@stop
