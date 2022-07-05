@extends('layouts.app')


@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@section('content_2')

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <form action="">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="name_debt">Nombre de la deuda</label>
                                <input id="name_debt" class="form-control" type="text" name="name_debt"
                                    placeholder="Nombre de la deuda">
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="count_mount">Cantidad Del prestamo</label>
                                <input id="count_mount" class="form-control" type="number" min="1"
                                    name="count_mount" placeholder="Nombre de la deuda">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="billing_time">Tiempos de pago</label>
                        <select class="form-control" name="billing_time" id="billing_time">
                            <option value="">-- Seleccionar Tiempo de pago --</option>

                            @foreach ($data['billing_times'] as $billingTime)
                                <option value="{{ $billingTime->id }}">{{ $billingTime->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">% de ingresos netos</label>
                        <div class="input-group mb-3">
                            <input type="number" min="1" max="100" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="crwarDeuda" value="option1">
                            <label for="crwarDeuda" class="custom-control-label">Registrar Deuda</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" type="submit">Consultar</button>
                    </div>

                </form>

            </div>

        </div>
        <div class="col-md-6 p-3"></div>
    </div>

@stop
