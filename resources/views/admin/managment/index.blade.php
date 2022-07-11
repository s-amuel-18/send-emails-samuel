@extends('layouts.app')


@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@section('content_2')
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex align-items-center px-3">
            <h3 class="h5 mb-0 font-weight-bold">Menú</h3>
        </div>


        <div class="">
            <a href="#" class="btn btn-outline-primary btn-sm active">
                <i class="fa fa-coins"></i>
                <span class="d-none d-md-inline">Administracion De Ingresos</span>
            </a>
            <a href="{{ route('debt.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-arrow-down"></i>
                <span class="d-none d-md-inline">Deudas y consultas</span>
            </a>
        </div>
    </div>

    <div class="row">
        @foreach ($data['pays_time'] as $pay)
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


        <div class="col-md-6">
            <div class="card card-primary">

                @if ($data['income']->count() > 0)
                    <div class="card-header">
                        <h3 class="card-title">Ingresos ({{ number_format($data['porcentegeIncome'], 2) }}%)</h3>
                        <div class="card-tools">

                            <a href="{{ route('income.create') }}" class=" btn-tool">
                                <i class="fa fa-coins"></i> Nuevo Ingreso
                            </a>
                        </div>
                    </div>

                    <div class="card card-body table-responsive">
                        <table class=" table table-light table-striped table-hover text-nowrap table-valign-middle">
                            <thead class="">
                                <tr>
                                    <th>Ingreso</th>
                                    <th>Tiempo</th>
                                    <th>price</th>
                                    <th></th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($data['income'] as $income)
                                    <tr>

                                        <td>{{ Str::limit($income->name, 20) }}</td>
                                        <td>{{ $income->billingTime->name ?? 'sin' }}</td>
                                        <td>${{ number_format($income->price, 2) }}</td>
                                        <td style="width: 110px">

                                            <form
                                                onsubmit="return confirm(`¿Estas seguro de querer elimimar este elemento?`)"
                                                method="POST"
                                                action="{{ route('income.destroy', ['income' => $income->id]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('income.edit', ['income' => $income->id]) }}"
                                                    class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>




                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <p class="p-3 h4 text-muted">
                        @if ($data['spents']->count() > 0)
                            <i class="text-warning fa fa-exclamation-triangle"></i>
                        @endif
                        Sin Ingresos registrados <a class="d-inline" href="{{ route('income.create') }}">Crea un
                            nuevo ingreso</a>

                    </p>
                @endif

            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-danger">
                @if ($data['spents']->count() > 0)

                    <div class="card-header">
                        <h3 class="card-title">Gastos
                            ({{ number_format($data['porcentegeSpent'] > 100 ? '+100' : $data['porcentegeSpent'], 2) }}%)
                        </h3>
                        <div class="card-tools">


                            <a href="{{ route('spent.create') }}" class="btn-tool">
                                <i class="fa fa-arrow-down"></i> Nuevo Gasto
                            </a>
                        </div>
                    </div>

                    <div class="card card-body table-responsive">
                        <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                            <thead class="">
                                <tr>
                                    <th>Gasto</th>
                                    <th>Tiempo</th>
                                    <th>price</th>

                                    <th></th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($data['spents'] as $spent)
                                    <tr>

                                        <td>{{ Str::limit($spent->name, 20) }}</td>
                                        <td>{{ $spent->billingTime->name ?? 'sin' }}</td>
                                        <td>${{ number_format($spent->price, 2) }}</td>
                                        <td style="width: 110px">



                                            <form
                                                onsubmit="return confirm(`¿Estas seguro de querer elimimar este elemento?`)"
                                                method="POST"
                                                action="{{ route('spent.destroy', ['spent' => $spent->id]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ route('spent.edit', ['spent' => $spent->id]) }}"
                                                    class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>




                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <p class="p-3 h4 text-muted">
                        Sin Gastos registrados <a class="d-inline" href="{{ route('spent.create') }}">Crea un nuevo
                            ingreso</a>

                    </p>
                @endif
            </div>
        </div>
    </div>

@stop
