@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@push('css')
    <style>
        .btn-rounded {
            border-radius: 15px;
        }
    </style>
@endpush

@section('content_2')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">{{ $data['title'] }}</h3>
                    <div class="card-tools">


                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#categories_modal">
                            <i class="fas fa-plus"></i>
                            <span class="d-none d-md-inline-block ml-1">Categorías</span>
                        </button>
                        <a href="{{ route('contact_email.create') }}" class="btn btn-outline-light btn-tool">
                            <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Nuevo Proyecto </span>
                        </a>

                    </div>
                </div>

                <div class="card card-body table-responsive">

                    @if (($data['projects_count'] ?? 0) > 0)
                        <div class="">
                            <table id="table_projects"
                                class="w-100 datatable table table-light table-striped table-hover text-nowrap table-valign-middle">
                                <thead class="">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Image</th>
                                        <th>Nombre</th>
                                        <th>Publico</th>
                                        <th>Categoría</th>
                                        <th>Creacion</th>
                                        <th>Actualizacion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['projects'] as $project)
                                        <tr>
                                            <td>{{ $project->id }}</td>
                                            <td style="width: 200px">
                                                @include('admin.contact_email.components.datatable.user', [
                                                    'user' => $project->user,
                                                    'name' => true,
                                                ])
                                            </td>
                                            <td>
                                                <a href="">

                                                    <img src="{{ $project->image_front_page }}" alt=""
                                                        style="width: 100px">
                                                </a>
                                            </td>
                                            <td style="width: 250px">
                                                <div class="" data-toggle="tooltip" data-placement="top"
                                                    title="{{ $project->slug }}">
                                                    <b>{{ Str::limit($project->name, 25) }}</b>
                                                </div>
                                            </td>
                                            <td style="width: 110px">
                                                <button
                                                    class="btn {{ $project->published ? 'btn-primary' : 'btn-outline-primary' }} btn-sm btn-rounded font-weight-bold"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="publicar proyecto">
                                                    @if ($project->published)
                                                        <i class="fa fa-check"></i>
                                                        Publico
                                                    @else
                                                        Privado
                                                    @endif
                                                </button>
                                            </td>
                                            <td style=" white-space: normal;">
                                                @if ($project->categories()->count())
                                                    @foreach ($project->categories as $category)
                                                        @include('admin.contact_email.components.datatable.badge',
                                                            [
                                                                'color' => $category->color,
                                                                'text' => $category->name,
                                                            ])
                                                    @endforeach
                                                @else
                                                    @include('admin.contact_email.components.datatable.badge',
                                                        [
                                                            'color' => 'light',
                                                            'text' => 'Sin categorias',
                                                        ])
                                                @endif
                                            </td>
                                            <td>
                                                @include('admin.contact_email.components.datatable.created_at',
                                                    ['created_parser' => $project->created_at])
                                            </td>
                                            <td>
                                                @include('admin.contact_email.components.datatable.created_at',
                                                    ['created_parser' => $project->updated_at])
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button class="btn btn-outline-danger btn-sm" type="button">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-light" role="alert">
                            No se encontraron resultados <a class="text-primary"
                                href="{{ route('contact_email.create') }} ">Crear Nuevo
                                proyecto</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@include('admin.requirements.components.modal_categories', [
    'categories' => $data['categories'],
    'category_type' => $data['js']['category_type'],
])

@push('js')
    <script>
        const appData = @json($data['js'] ?? []);
        const requestData = @json($data['request'] ?? []);
        let requirements_categories = null;
    </script>
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    <script src="{{ asset('js/functions/helpers.js') }}"></script>
    <script src="{{ asset('js/requirements/categories/funtions.js') }}"></script>
    <script src="{{ asset('js/requirements/functions/categories.js') }}"></script>
    <script src="{{ asset('js/requirements/categories/main.js') }}"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $(".datatable").DataTable();
        });
    </script>
@endpush
