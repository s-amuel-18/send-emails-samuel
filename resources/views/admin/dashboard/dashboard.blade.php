@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content_2')

    @include('admin.components.alerts.send_emails')

    <div class="row">
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
                {{-- tabla de usuarios --}}
                <x-adminlte-small-box id="emails_sent_today" title="{{ $enviados_hoy }}" text="Envios de hoy"
                    icon="fas fa-mail-bulk" theme="indigo" url="envio-email/redaccion-detallada" url-text="Enviar Correos" />
            </div>
        @endcan

    </div>

    <div class="row">
        @can('user.index')
            <div class="col-md-3 table-responsive">
                @include('admin.dashboard.components.users')
            </div>
        @endcan

        @can('requirements.store')
            <div class="col-md-9 table-responsive">
                @include('admin.dashboard.components.requirements')
            </div>
        @endcan


    </div>

@stop


@section('js')

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

@stop
