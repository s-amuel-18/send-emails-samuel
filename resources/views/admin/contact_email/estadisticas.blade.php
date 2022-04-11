@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
@section('plugins.Chartjs', true)

@section('title', 'Administrador de usuarios')

@section('content_header')
    <h1>Estadistica De Registros</h1>
@stop

@section('content')

    <div class="row">


        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Estadistica De Registros</h3>
                    <div class="card-tools">
                        <a href="{{ route('contact_email.index') }}" class="btn btn-outline-light btn-tool">
                            <i class="fas fa-mail-bulk"></i>
                        </a>
                        <a href="{{ route('contact_email.create') }}" class="btn btn-outline-light btn-tool">
                            <i class="fas fa-plus"></i>
                        </a>
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

                        <div class="col-lg-6">

                            <h4 class="h5 mb-3">Registros De Usuarios</h4>

                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>id</th>
                                        <th>usuario</th>
                                        <th>Cant. Registros</th>
                                        <th>Porcentaje</th>
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
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->emails_registros->count() }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $user->emails_registros->count() > $registros_promedio? 'success': ($user->emails_registros->count() <= $registros_promedio? 'warning': 'danger') }}">{{ number_format(($user->emails_registros->count() * 100) / $total_registros, 2) }}%</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>

                        <div class="col-lg-3">
                            <h4 class="h5 mb-3">Estadisticas De Usuarios</h4>
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>

                        <div class="col-lg-3">
                            <h4 class="h5 mb-3">Estadisticas De Envio De Correos</h4>
                            <canvas id="donutChartEmailsEstado"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
        let cantidades = [];
        let labels = [];
        let colors = [];

        data_users.forEach(el => {
            cantidades.push(el.cant_reg);
            labels.push(el.name);

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
