@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
{{-- @section('plugins.Datatables', true) --}}

@section('title', 'Administrador de usuarios')

@section('content_header')
    <h1>Administrador De Usuarios</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registro De Usuarios</h3>
                    <div class="card-tools">
                        <a href="{{ route("user.create") }}" class="btn btn-tool">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>btns</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $i => $user)
                            <tr>
                                <td> {{ $i + 1 }} </td>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->username }} </td>
                                <td> {{ $user->email }} </td>
                                <td>
                                    <a href="{{ route("user.edit", ["user" => $user->id]) }}" class="btn btn-outline-success btn-sm">
                                        <i class="fa fa-user-edit"></i>
                                    </a>

                                    <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este Usuario')" action="{{ route("user.destroy", ["user" => $user->id]) }}" method="POST">

                                        @csrf
                                        @method("DELETE")
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
            </div>
            <!-- /.card -->
        </div>
    </div>



@stop


@section('js')

@stop
