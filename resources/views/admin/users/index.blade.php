@extends('layouts.app')
@section('plugins.Datatables', true)

@section('title', 'Administrador de usuarios')

@section('content_header')
    <h1>Administrador De Usuarios</h1>
@stop

@section('content_2')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Registro De Usuarios</h3>
                    <div class="card-tools">

                        @can('user.create')
                            <a href="{{ route('user.create') }}" class="btn btn-outline-light not-hover btn-tool">
                                <i class="fas fa-user-plus"></i> <span class="d-none d-md-inline-block ml-1"> Crear usuario</span>
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <table
                        class="datatable table table-light table-striped table-hover text-nowrap table-valign-middle w-100">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nombre De Usuario</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Actualizacion</th>
                                <th>Creacion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $i => $user)
                                <tr>
                                    <td> {{ $i + 1 }} </td>
                                    <td> {{ $user->id }} </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width: 27px; height: 27px;"
                                                class="mr-2 bg-{{ $user->color }} d-flex justify-content-center align-items-center rounded-circle">
                                                <i class="fa fa-user" style="font-size: 12px"></i>
                                            </div>
                                            {{ $user->username }}
                                        </div>
                                    </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td>
                                        @if ($user->roles->count() > 0)
                                            @foreach ($user->roles as $rol)
                                                <span class="badge badge-primary">{{ $rol->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge badge-danger">Sin Rol</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{ $user->updated_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                    <td style="width: 110px">


                                        @can('user.edit')
                                            <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-user-edit"></i>
                                            </a>
                                        @endcan

                                        @can('user.destroy')
                                            @if (auth()->user()->id == $user->id)
                                                <button data-toggle="tooltip" data-placement="top"
                                                    title="No puedes Eliminar Tu propio Usuario" type="submit"
                                                    class="btn btn-outline-danger btn-sm disabled">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <form class="d-inline"
                                                    onsubmit="return confirm('Realmente Deseas Eliminar Este Usuario')"
                                                    action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">

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
            let datatableOptions = {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                "order": [
                    [8, "DESC"]
                ],
                "responsive": true,
                "fixedHeader": true,
                "scrollX": true,
                "bPaginate": true,
                "sPaginationType": "numbers",
                "pageLength": 10,
                "lengthChange": true,
            };

            $(".datatable").DataTable(datatableOptions);
        })
    </script>
@stop
