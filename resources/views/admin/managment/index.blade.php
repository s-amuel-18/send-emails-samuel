@extends('layouts.app')
{{-- @section('plugins.Datatables', true) --}}

@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@section('content_2')
    <div class="row">
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
                        <h3 class="card-title">Ingresos</h3>
                        <div class="card-tools">

                            <a href="{{ route('contact_email.create') }}" class=" btn-tool">
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
                                        <td>{{ $income->billingTime->name }}</td>
                                        <td>${{ number_format($income->price, 2) }}</td>
                                        <td style="width: 110px">

                                            <form
                                                onsubmit="return confirm(`¿Estas seguro de querer elimimar este elemento?`)"
                                                method="POST"
                                                action="{{ route('income.delete', ['income' => $income->id]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <a href="http://127.0.0.1:8000/role/1/edit"
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
                        Sin Ingresos registrados <a class="d-inline" href="">Crea un nuevo ingreso</a>

                    </p>
                @endif

            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-danger">
                @if ($data['spents']->count() > 0)

                    <div class="card-header">
                        <h3 class="card-title">Gastos</h3>
                        <div class="card-tools">


                            <a href="{{ route('contact_email.create') }}" class="btn-tool">
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
                                        <td>{{ $spent->billingTime->name }}</td>
                                        <td>${{ number_format($spent->price, 2) }}</td>
                                        <td style="width: 110px">



                                            <form
                                                onsubmit="return confirm(`¿Estas seguro de querer elimimar este elemento?`)"
                                                method="POST"
                                                action="{{ route('spent.delete', ['spent' => $spent->id]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <a href="http://127.0.0.1:8000/role/1/edit"
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
                        Sin Gastos registrados <a class="d-inline" href="">Crea un nuevo ingreso</a>

                    </p>
                @endif
            </div>
        </div>
    </div>

@stop
