@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', $data['title'] ?? 'Proyectos')

@section('content_header')
    <h1>{{ $data['title'] ?? 'Proyectos' }}</h1>
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
                    <h3 class="card-title">{{ $data['title'] ?? 'Proyectos' }}</h3>
                    <div class="card-tools">

                        @if ($data['page'] != 'index')
                            <a href="{{ route('project.index') }}" class="btn btn-outline-light text-primary btn-tool">
                                <i class="fas fa-home"></i><span class="d-none d-md-inline-block ml-1">Inicio</span>
                            </a>
                        @endif

                        @if ($data['page'] != 'trash')
                            <a href="{{ route('project.trash_projects') }}"
                                class="btn btn-outline-light text-danger btn-tool">
                                <i class="fas fa-trash"></i><span class="d-none d-md-inline-block ml-1">Papelera</span>
                            </a>
                        @endif

                        @if ($data['categories'] ?? null)
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#categories_modal">
                                <i class="fas fa-plus"></i>
                                <span class="d-none d-md-inline-block ml-1">Categorías</span>
                            </button>
                        @endif
                        <a href="{{ route('project.create') }}" class="btn btn-outline-light btn-tool">
                            <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Nuevo Proyecto </span>
                        </a>

                    </div>
                </div>

                <div class="card card-body">

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
                                            {{-- * id del proyecto --}}
                                            <td>{{ $project->id }}</td>

                                            {{-- * usuario creador --}}
                                            <td style="width: 200px">
                                                @include('admin.contact_email.components.datatable.user', [
                                                    'user' => $project->user,
                                                    'name' => true,
                                                ])
                                            </td>

                                            {{-- * img miniatura del proyecto --}}
                                            <td>
                                                <a href="">
                                                    <div class="content_img_100x60 bg-gray-light">
                                                        <div class="content">
                                                            @if (!$project->image_front_page)
                                                                <i class="fas fa-image text-muted "></i>
                                                            @else
                                                                <img src="{{ asset($project->image_front_page) }}"
                                                                    class="w-100 h-100" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>

                                            {{-- * Nombre del proyecto --}}
                                            <td style="width: 250px">
                                                <div class="" data-toggle="tooltip" data-placement="top"
                                                    title="{{ $project->slug }}">
                                                    <b>{{ Str::limit($project->name, 25) }}</b>
                                                </div>
                                            </td>

                                            {{-- * boton de publicacion --}}
                                            <td style="width: 110px">
                                                <button {{ $project->trash ? 'disabled' : '' }}
                                                    class="published_project btn-published btn {{ $project->published ? 'public' : '' }} btn-sm btn-rounded font-weight-bold"
                                                    type="button"
                                                    data-url="{{ route('project.published', ['project' => $project->id]) }}"
                                                    data-published="{{ $project->published }}">

                                                    <span class="normal_item">
                                                        <span class="text-public">
                                                            <i class="fa fa-check"></i>
                                                            Publico
                                                        </span>

                                                        <span class="text-private">
                                                            Privado
                                                        </span>
                                                    </span>
                                                    <span class="load_item d-none">
                                                        Cargando
                                                        <span style="width: .9rem; height: .9rem;"
                                                            class=" spinner-border spinner-border-sm" role="status">
                                                        </span>
                                                    </span>

                                                </button>
                                            </td>

                                            {{-- * categorias --}}
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

                                            {{-- * Fecha de creacion --}}
                                            <td>
                                                @include('admin.contact_email.components.datatable.created_at',
                                                    ['created_parser' => $project->created_at])
                                            </td>

                                            {{-- * fecha de actualizacion --}}
                                            <td>
                                                @include('admin.contact_email.components.datatable.created_at',
                                                    ['created_parser' => $project->updated_at])
                                            </td>

                                            {{-- * botones para ver y eliminar proyecto --}}
                                            <td>
                                                @if ($data['page'] == 'trash')
                                                    <button
                                                        data-url="{{ route('project.out_trash', ['project' => $project->id]) }}"
                                                        class="out_trash_project btn btn-outline-info btn-sm">
                                                        <span class="normal_item">
                                                            <i class="fas fa-trash-restore"></i>

                                                        </span>
                                                        <span class="load_item d-none">
                                                            <span style="width: .9rem; height: .9rem;"
                                                                class="text-info spinner-border spinner-border-sm"
                                                                role="status">
                                                            </span>
                                                        </span>
                                                    </button>
                                                @endif
                                                @if ($project->slug ?? null)
                                                    <a href="{{ route('project.show', ['slug_name' => $project->slug]) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endif
                                                <a href="" class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button data-id="{{ $project->id }}"
                                                    data-url="{{ $data['type_destroy'] == 'delete' ? $project->routeDelete : $project->routeTrash }}"
                                                    class="btn_delete_project btn btn-outline-danger btn-sm" type="button">

                                                    <span class="normal_item">
                                                        <i class="fa fa-trash"></i>
                                                    </span>
                                                    <span class="load_item d-none">
                                                        <span style="width: .9rem; height: .9rem;"
                                                            class="text-danger spinner-border spinner-border-sm"
                                                            role="status">
                                                        </span>
                                                    </span>
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
                                href="{{ route('project.create') }} ">Crear Nuevo
                                proyecto</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($data['categories'] ?? null)
        @include('admin.requirements.components.modal_categories', [
            'categories' => $data['categories'],
            'category_type' => $data['js']['category_type'],
        ])
    @endif
@stop

@push('js')
    {{-- * variables globales --}}
    <script>
        // * selectores
        const btns_delete_project = document.querySelectorAll(".btn_delete_project");
        const out_trash_project = document.querySelectorAll(".out_trash_project");

        const appData = @json($data['js'] ?? []);
        const type_destroy = @json($data['type_destroy'] ?? 'trash');
        const requestData = @json($data['request'] ?? []);
        let requirements_categories = null;

        let config_datatable = {
            "responsive": true,
            "scrollX": true,
            "bPaginate": true,
            "sPaginationType": "numbers",
        };
    </script>

    {{-- * axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    {{-- * funciones de ayuda "helpers" --}}
    <script src="{{ asset('js/functions/helpers.js') }}"></script>

    {{-- * archivos para la funcion de las categorias --}}
    <script src="{{ asset('js/requirements/categories/funtions.js') }}"></script>
    <script src="{{ asset('js/requirements/functions/categories.js') }}"></script>
    <script src="{{ asset('js/requirements/categories/main.js') }}"></script>

    {{-- * funciones para los proyectos --}}
    <script src="{{ asset('js/projects/functions/btn_actions.js') }}"></script>
    <script src="{{ asset('js/projects/main.js') }}"></script>
    <script>
        $(function() {
            const project_datatable = $(".datatable").DataTable(config_datatable);
            $('[data-toggle="tooltip"]').tooltip()
            event_delete_project(project_datatable);
            event_out_trash_project(project_datatable);

        });
    </script>
@endpush
