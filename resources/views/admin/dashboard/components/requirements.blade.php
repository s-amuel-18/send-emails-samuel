@section('plugins.Summernote', true)
@push('css')
    <style>
        .note-editable.card-block {
            min-height: 200px
        }
    </style>
@endpush



<div class="card card-light">
    <div class="card-header">
        <h3 class="card-title">Requerimientos</h3>
        <div class="card-tools">
            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#requirements_modal" type="button">
                <i class="fa fa-plus"></i>
                <span class="d-none d-md-inline-block ml-1">
                    Nueva Categoría
                </span>
            </button>
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#requirements_modal" type="button">
                <i class="fa fa-plus"></i>
                <span class="d-none d-md-inline-block ml-1">
                    Nuevo Requerimiento
                </span>
            </button>
        </div>
    </div>

    <div class="card-body table-responsive">

        @if ($data['requirements_count'] > 0)
            <div class="d-flex justify-content-end mb-3">
                <div class="col-md-3 offset-md-9" id="content_select_category">
                    <select data-placeholder="Filtro por categorias" class="w-100 select2 form-control" name="state"
                        id="filter_for_category">
                        <option value="">Filtro por categorias</option>
                        @foreach ($data['requirements_categories'] as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <table id="table_requirements"
                class="w-100 table table-light table-striped table-hover text-nowrap table-valign-middle">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Url Referencia</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                {{-- <tbody>

                        @foreach ($data['requirements'] as $requirement)
                            <tr>
                                <td>{{ $requirement->id }}</td>
                                <td>
                                    @include('admin.contact_email.components.datatable.user', [
                                        'user' => $requirement->user,
                                        'name' => true,
                                    ])
                                </td>
                                <td>@include('admin.contact_email.components.datatable.name_enterprice', [
                                    'name' => $requirement->name,
                                    'limit_name' => 20,
                                ])</td>
                                <td>
                                    <span style="font-size: 14px" class="badge bg-{{ $requirement->category->color }}">
                                        {{ $requirement->category->name }}
                                    </span>
                                </td>
                                <td>
                                    @include('admin.contact_email.components.datatable.web', [
                                        'url' => $requirement->url,
                                    ])
                                </td>
                                <td>
                                    @include('admin.contact_email.components.datatable.details', [
                                        'id' => $requirement->id,
                                        'class' => 'requirements_details',
                                        'route' => route('requirements.get_requirement', [
                                            'id' => $requirement->id,
                                        ]),
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </tbody> --}}
            </table>
        @else
            Sin Registros De Hoy
        @endif

    </div>
</div>


<div id="requirements_modal" class="modal " tabindex="-1" role="dialog" aria-labelledby="requerimientos"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requerimientos">Crear Nuevo Requerimiento</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form_requirements">
                    <div class="row">
                        {{-- nombre --}}
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" placeholder="Nombre" class="form-control" type="text"
                                    name="name">
                            </div>
                        </div>

                        {{-- Categoria --}}
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category_id">Categoría</label>
                                <input id="category_id" placeholder="Categoría" class="form-control" type="text"
                                    name="category_id">
                            </div>
                        </div>

                        {{-- url --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="url">Url De Referencia</label>
                                <input id="url" placeholder="Url De Referencia" class="form-control"
                                    type="text" name="url">
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="summernote" class="form-control" type="text" name="description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>




                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="details_modal" class="modal " tabindex="-1" role="dialog" aria-labelledby="detalles" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalles">Mas Detalles</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="insert_data_details">

            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    <script src="{{ asset('js/functions/templates.js') }}"></script>
    <script src="{{ asset('js/functions/helpers.js') }}"></script>
    <script src="{{ asset('js/emails/shippimg.js') }}"></script>
    <script>
        const insert_data_details = document.getElementById("insert_data_details");
        const filter_for_category = document.getElementById("filter_for_category");
        const appData = @json($data['js']);
        const requestData = @json($data['request']);
    </script>

    <script>
        const table = document.getElementById("table_requirements");

        let datatableOptions = {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
            },
            "clone": true,
            "dataType": "json",
            "order": [
                [0, "DESC"]
            ],
            "responsive": true,
            "scrollX": true,
            "bPaginate": true,
            "sPaginationType": "numbers",
            "pageLength": 10,
            "lengthChange": true,
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": appData["url_datatable_requirements"],
            "columns": [{
                    data: "id"
                },
                {
                    data: "created_at"
                },
                {
                    data: "username"
                },
                {
                    data: "name"
                },
                {
                    data: "category"
                },
                {
                    data: "url"
                },
                {
                    data: "details"
                },

            ],
        };

        if (requestData["search"]) {
            datatableOptions.search = {
                "search": requestData["search"],
            };
        }

        const datatable = $(table).DataTable(datatableOptions);
        // datatable.row.add([1, 2, 3, 5])
        $(filter_for_category).on("change", e => {
            const value = e.target.value;
            datatable.search(value).draw();

        })
        $(function() {});

        $(table).on("draw.dt", e => {
            $('[data-toggle="tooltip"]').tooltip();

            const obj_values_desc = [{
                    label: "Creador",
                    value: "user_created",
                },
                {
                    label: "Categoría",
                    value: "assigned_category",
                },
                {
                    label: "Nombre",
                    value: "name",
                },
                {
                    label: "Url",
                    value: `url`,
                    element_custom: `<a target="_blanck" href="%value%">%value%</a>`
                },
                {
                    label: "Descripción",
                    value: `description`,
                },
                {
                    label: "Fecha De Creacion",
                    value: "created_format",
                },
            ];


            event_detils(
                ".requirements_details",
                obj_values_desc
            );
        });
    </script>

    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

        })
    </script>
@endpush
