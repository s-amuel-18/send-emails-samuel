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
            <button type="button" class="btn btn-primary mr-auto" data-toggle="modal" data-target="#modelId">
                Crear categoria
            </button>
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

    <!-- Button trigger modal -->


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
                    <div class="bs-example text-center" style="padding-bottom: 24px;">
                        <div class="row">
                            <div class="col-md-3">
                                <div id="button" class="highlight text-center" data-position="left"
                                    style="padding-top: 120px; padding-bottom: 20px;">
                                    <a class="btn btn-secondary"><i class="fas fa-chart-area"></i>
                                        Nombre de la categoria</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <form class="form" role="form">
                                    <div class="form-group row">
                                        <label for="btn-text" class="col-sm-2 control-label">Texto: </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="btn-text"
                                                placeholder="Nombre de la categoria" value="Nombre de la categoria">
                                        </div>
                                    </div>
                                    <div class="form-group row flex-wrap">
                                        <label for="btn-color" class="col-sm-2 control-label">Color: </label>
                                        <div class="col-sm-10">
                                            <div id="btn-colors" class="btn-group d-flex flex-wrap">
                                                <button name="color" type="button" class="btn btn-primary"
                                                    value="btn-primary">Primary</button>
                                                <button name="color" type="button" class="btn btn-secondary"
                                                    value="btn-secondary">Secondary</button>
                                                <button name="color" type="button" class="btn btn-success"
                                                    value="btn-success">Success</button>
                                                <button name="color" type="button" class="btn btn-danger"
                                                    value="btn-danger">Danger</button>
                                                <button name="color" type="button" class="btn btn-warning"
                                                    value="btn-warning">Warning</button>
                                                <button name="color" type="button" class="btn btn-info"
                                                    value="btn-info">Info</button>
                                                <button name="color" type="button" class="btn btn-light"
                                                    value="btn-light">Light</button>
                                                <button name="color" type="button" class="btn btn-dark"
                                                    value="btn-dark">Dark</button>
                                                <button name="color" type="button" class="btn btn-link"
                                                    value="btn-link">Link</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="btn-color" class="col-sm-2 control-label">Icono: </label>
                                        <div class="col-sm-10">
                                            <div id="btn-icon" data-icon="fas fa-chart-area"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="btn-color" class="col-sm-2 control-label">Posicion del icono: </label>
                                        <div class="col-sm-10">
                                            <div id="btn-icon-positions" class="btn-group">
                                                <button class="btn btn-secondary" value="left" type="button"><span
                                                        class="fas fa-arrow-left"></span> Izquierda</button>
                                                <button class="btn btn-secondary" value="right" type="button">Derecha
                                                    <span class="fas fa-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center ">

                        <form action="" method="POST">
                            <label for="result">Presionar para crear la categoria</label>
                            <button id="result" type="submit" class="btn btn-outline-primary"></button>
                        </form>
                        {{-- <pre>
                            <code id="result" class="html"></code>
                        </pre> --}}

                    </div>
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
