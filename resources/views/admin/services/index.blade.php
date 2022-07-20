@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('Admin/css/bootstrap-iconpicker.min.css') }} ">
@endpush
@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>

@stop

@section('content_2')
    <div class="card card-body table-responsive">
        <div class="d-flex justify-content-end mb-3">
            <h3 class="card-title">Servicios: <b class="text-muted">1000</b></h3>

            <button type="button" class="btn btn-sm btn-primary ml-auto mr-3" data-toggle="modal" data-target="#modelId">
                <i class="fas fa-plus"></i> <span class="d-none d-md-inline-block ">Crear categoria</span>
            </button>


            <a href="{{ route('service.create') }}" class="btn btn-sm btn-success mr-3">
                <i class="fas fa-plus"></i> <span class="d-none d-md-inline-block ">Crear servicio</span>
            </a>

            <form action="" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Buscar"
                        value="">
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

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">
                    <form class="input-group">
                        <input type="text" class="form-control" placeholder="Nombre de la categoria">
                        <span class="input-group-append mx-3">
                            <button id="iconpicker" class="btn btn-outline-secondary" data-search="true"
                                data-search-text="Buscar icono" data-iconset="fontawesome5" data-rows="4"
                                data-cols="6" data-icon="fas fa-home" role="iconpicker"></button>
                        </span>

                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>



    @push('js')
        <script src="{{ asset('Admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
        <script src="{{ asset('Admin/js/iconpicker-costum.js') }}"></script>
    @endpush
@stop
