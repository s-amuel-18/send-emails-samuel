@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Bootstrap-iconpicker', true)


@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>

@stop

@section('content_2')
    <div class="card card-body table-responsive">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="card-title">Servicios: <b class="text-muted">{{ $data['services']->count() }}</b></h3>


            <div class="">
                @if ($data['services']->count() > 0)
                    <a href="{{ route('pdf.services') }}" target="_blank" class="btn btn-sm btn-danger">
                        <i class="fas fa-file-pdf"></i> <span class="d-none d-md-inline-block ">Lista de Servicio</span>
                    </a>
                @endif
                <button type="button" class="btn btn-sm btn-primary  mx-2" data-toggle="modal" data-target="#modelId">
                    <i class="fas fa-plus"></i> <span class="d-none d-md-inline-block ">Crear categoria</span>
                </button>


                <a href="{{ route('service.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i> <span class="d-none d-md-inline-block ">Crear servicio</span>
                </a>

            </div>


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

                    @foreach ($data['services'] as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->user ? $service->user->username : 'Sin usuario' }}</td>
                            <td>{{ $service->name }}</td>
                            <td>
                                {{ number_format($service->price, 2) }} <i class="fas fa-dollar-sign text-success"></i>
                            </td>
                            <td>
                                <i class="{{ $service->category ? $service->category->icon_class : '' }}"></i>
                                {{ $service->category ? $service->category->name : 'Sin Categoría' }}
                            </td>

                            <td>{{ $service->created_at->format('Y-m-d H:i:s') }}</td>
                            <td style="width: 110px">
                                <a href="{{ route('service.edit', ['servicio' => $service->id]) }}"
                                    class="btn btn-outline-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form class="d-inline" onsubmit="return confirm('Realmente Deseas Eliminar Este servicio')"
                                    action="{{ route('service.destroy', ['servicio' => $service->id]) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
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

    <!-- Modal -->
    <div class="modal" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                data-search-text="Buscar icono" data-iconset="fontawesome5" data-rows="4" data-cols="6"
                                data-icon="fas fa-home" role="iconpicker"></button>
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
        <script>
            $(".table").DataTable();
        </script>
    @endpush
@stop
