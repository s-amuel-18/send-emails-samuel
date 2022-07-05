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
            <a href="{{ route('managment.index') }}" class="btn btn-outline-primary btn-sm ">
                <i class="fa fa-coins"></i>
                <span class="d-none d-md-inline">Administracion De Ingresos</span>
            </a>
            <a href="#" class="btn btn-outline-primary btn-sm active">
                <i class="fa fa-arrow-down"></i>
                <span class="d-none d-md-inline">Deudas y consultas</span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Deudas</h3>
                    <div class="card-tools">

                        <a href="{{ route('debt.consult_debts_view') }}" class="btn btn-outline-light not-hover btn-tool">
                            <i class="fa fa-briefcase"></i>
                            <span class="d-none d-md-inline">Consulta Para Prestamo</span>
                        </a>

                        <a href="http://127.0.0.1:8000/user/create" class="btn btn-outline-light not-hover btn-tool">
                            <i class="fas fa-arrow-down"></i>
                            <span class="d-none d-md-inline">Nueva Deuda</span>
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                        <thead class="">
                            <tr>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop
