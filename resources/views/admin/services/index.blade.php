@extends('layouts.app')


@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@section('content_2')
    <div class="card card-body table-responsive">
        <div class="d-flex justify-content-end mb-3">
            <form action="" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Buscar" value="">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

            </form>
        </div>


        <div class="">
            <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Servicio</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Creacion</th>
                        <th>Botones</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td>
                            1
                        </td>
                        <td>branmarvel</td>
                        <td>
                            Maquetacion de pagina
                        </td>
                        <td>
                            295 <i class="fas fa-dollar-sign text-success"></i>
                        </td>
                        <td>
                            <i class="fas fa-window-maximize"></i> Front-end
                        </td>

                        <td>Hace 1 hora</td>
                        <td style="width: 110px">
                            <a href="" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este servicio')"
                                action="" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </form>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>branmarvel</td>
                        <td>
                            Diseño de pagina
                        </td>
                        <td>
                            295 <i class="fas fa-dollar-sign text-success"></i>
                        </td>
                        <td>
                            <i class="fas fa-window-maximize"></i> Front-end
                        </td>

                        <td>Hace 1 hora</td>
                        <td style="width: 110px">
                            <a href="" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este servicio')"
                                action="" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </form>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>branmarvel</td>
                        <td>
                            Sistema
                        </td>
                        <td>
                            295 <i class="fas fa-dollar-sign text-success"></i>
                        </td>
                        <td>
                            <i class="fas fa-database"></i> Back-end
                        </td>

                        <td>Hace 1 hora</td>
                        <td style="width: 110px">
                            <a href="" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este servicio')"
                                action="" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </form>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>branmarvel</td>
                        <td>
                            Video/Animación
                        </td>
                        <td>
                            295 <i class="fas fa-dollar-sign text-success"></i>
                        </td>
                        <td>
                            <i class="fas fa-window-maximize"></i> Front-end
                        </td>

                        <td>Hace 1 hora</td>
                        <td style="width: 110px">
                            <a href="" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este servicio')"
                                action="" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </form>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>



@stop
