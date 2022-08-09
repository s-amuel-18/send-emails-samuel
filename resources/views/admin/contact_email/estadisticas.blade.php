@extends('layouts.app')
@section('plugins.Chartjs', true)
@section('plugins.Datatables', true)

@section('title', 'Estadistica De Registros')

@section('content_header')
    <h1>Estadistica De Registros</h1>
@stop

@section('content_2')

    <div class="row">


        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Estadistica De Registros</h3>
                    <div class="card-tools">

                        @can('contact_email.index')
                            <a href="{{ route('contact_email.index') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-mail-bulk"></i><span class="d-none d-md-inline-block ml-1">Registros de Emails
                                </span>
                            </a>
                        @endcan

                        @can('contact_email.create')
                            <a href="{{ route('contact_email.create') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Nuevo Email </span>
                            </a>
                        @endcan

                    </div>
                </div>

                <div class="card-body table-responsive">

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Registros Totales</h3>

                                            <div class="card-tools">
                                                <span class="badge badge-pill badge-success">{{ $total_registros }}</span>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Registros De Hoy</h3>

                                            <div class="card-tools">
                                                <span class="badge badge-pill badge-primary">{{ $registros_de_hoy }}</span>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                    </div>

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-xl-4 p-3">

                            <h4 class="h5 mb-3">Registros De Usuarios</h4>

                            <div style="max-height: 380px; overflow-y: scroll;">
                                <table class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            {{-- <th>id</th> --}}
                                            <th>usuario</th>
                                            <th>Cant. Registros</th>
                                            <th>Cant. Envios</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $i => $user)
                                            <tr>
                                                <td>
                                                    @if ($i + 1 == 1)
                                                        <i class="text-warning fas fa-chess-king"></i>
                                                    @else
                                                        {{ $i + 1 }}
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $user->id }}</td> --}}
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div style="width: 27px; height: 27px;"
                                                            class="mr-2 bg-{{ $user->color }} d-flex justify-content-center align-items-center rounded-circle">
                                                            <i class="fa fa-user" style="font-size: 12px"></i>
                                                        </div>
                                                        {{ $user->username }}

                                                    </div>
                                                </td>
                                                <td>
                                                    <span style="font-size: 16px"
                                                        class="badge badge-{{ $user->emails_registros_count > 0 ? 'success' : 'danger' }}">{{ $user->emails_registros_count }}</span>
                                                </td>
                                                <td>
                                                    <span style="font-size: 16px"
                                                        class="badge bg-{{ $user->email_enviado_count > 0 ? 'purple' : 'light' }}">{{ $user->email_enviado_count }}</span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>


                        </div>

                        <div class="col-xl-4 p-3">
                            <h4 class="h5 mb-3">Estadisticas De Usuarios</h4>
                            <canvas id="donutChart"
                                style="min-height: 380px; height: 380px; max-height: 380px; max-width: 100%;"></canvas>
                        </div>

                        <div class="col-xl-4 p-3">
                            <h4 class="h5 mb-3">Estadisticas De Envio De Correos</h4>
                            <canvas id="donutChartEmailsEstado"
                                style="min-height: 320px; height: 320px; max-height: 320px; max-width: 100%;"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@stop


@section('js')
    <script>
        //-------------
        //- DONUT CHART - Estadisticas usuarios
        //-------------
        let data_users = {!! $users !!};
        console.log(data_users);
        let cantidades = [];
        let labels = [];
        let colors = [];

        data_users.forEach(el => {
            cantidades.push(el.emails_registros_count);
            labels.push(el.username);

            let r = Math.floor(Math.random() * 255);
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);

            colors.push(`rgba(${r}, ${g}, ${b}, 04)`);
        });


        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: labels,
            datasets: [{
                data: cantidades,
                backgroundColor: colors,
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })



        //   estadisticas Emails
        var donutChartCanvas = $('#donutChartEmailsEstado').get(0).getContext('2d')
        var donutData = {
            labels: ["sin enviar", "enviados"],
            datasets: [{
                data: [{{ $emials_sin_enviar }}, {{ $emials_enviados }}],
                backgroundColor: ["red", "green"],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>



@stop
