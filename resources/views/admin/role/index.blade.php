@extends('layouts.app')
@section('plugins.Datatables', true)

@section('title', 'Administrador De Roles')

@section('content_header')
    <h1>Administrador De Roles</h1>
@stop

@section('content_2')


    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Registro De Roles</h3>
                    <div class="card-tools">

                        @can('role.create')
                            <a href="{{ route('role.create') }}" class="btn btn-outline-light not-hover btn-tool">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan

                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>cantidad De Permisos</th>
                                <th>actualizacion</th>
                                <th>Creacion</th>
                                <th>btns</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $i => $role)
                                <tr>
                                    <td> {{ $i + 1 }} </td>
                                    <td> {{ $role->id }} </td>
                                    <td> {{ $role->name }} </td>
                                    <td> {{ $role->permissions->count() }} </td>
                                    <td>
                                        <fecha-custom fecha="{{ $role->updated_at }}"></fecha-custom>
                                    </td>
                                    <td>
                                        <fecha-custom fecha="{{ $role->created_at }}"></fecha-custom>
                                    </td>
                                    <td style="width: 110px">


                                        @can('role.edit')
                                            <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('role.destroy')
                                            @php
                                                $delete_rol_target =
                                                    auth()
                                                        ->user()
                                                        ->roles->where('id', '=', $role->id)
                                                        ->count() > 0;
                                            @endphp

                                            @if ($delete_rol_target)
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="No puedes Eliminar El Rol Que Estas Usando" type="submit"
                                                    class="btn btn-outline-danger btn-sm disabled">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <form class="d-inline"
                                                    onsubmit="return confirm('Realmente Deseas Eliminar Este Rol')"
                                                    action="{{ $delete_rol_target ? '' : route('role.destroy', ['role' => $role->id]) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')


                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </form>
                                            @endif
                                        @endcan


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
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop
