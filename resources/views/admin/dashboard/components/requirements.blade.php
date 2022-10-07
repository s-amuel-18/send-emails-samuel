@section('plugins.Summernote', true)
@section('plugins.Sweetalert2', true)
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
            <button class="btn btn-notification btn-warning btn-sm" data-toggle="modal" data-target="#categories_modal"
                type="button">
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
            <form action="" id="form_filter_requirements">
                <div class="row no-gutters mb-3 mb-md-0">
                    {{-- * filtro de Registros privados --}}

                    <div class="col-md-8 offset-md-0">
                        <div class="form-group d-flex justify-content-end align-items-center" style="height: 40px">

                            <div class="form-check px-4">
                                <input class="form-check-input" type="radio" name="private_status"
                                    id="private_status_all" checked="" value="0">
                                <label class="form-check-label" for="private_status_all">Mostrar todos</label>
                            </div>

                            <div class="form-check px-4">
                                <input class="form-check-input" type="radio" name="private_status"
                                    id="private_status_private" value="1">
                                <label class="form-check-label" for="private_status_private">Privados</label>
                            </div>

                        </div>
                    </div>

                    {{-- * categorías --}}
                    <div class="col-md-4" id="content_select_category">
                        <select data-placeholder="Filtro por categorias"
                            class="w-100 select2 form-control select2_categories" name="state"
                            id="filter_for_category" style="width: 100%">
                            <option value="">Filtro por categorias</option>
                            <option value="0">Todas las categorias</option>
                            @foreach ($data['requirements_categories'] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </form>

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
                        <th></th>
                        {{-- <th></th>
                        <th></th> --}}
                    </tr>
                </thead>

            </table>
        @else
            Sin Registros De Hoy
        @endif

    </div>
</div>

@include('admin.requirements.components.modal_created')
@include('admin.requirements.components.modal_edit')
@include('admin.requirements.components.modal_details')
@include('admin.requirements.components.modal_categories', [
    'category' => $data['requirements_categories'],
])

@push('js')
    <script>
        const insert_data_details = document.getElementById("insert_data_details");
        const filter_for_category = document.getElementById("filter_for_category");
        const appData = @json($data['js']);
        const requestData = @json($data['request']);
        const summernote = document.getElementById('summernote');
        const summernote_edit_requirements = document.getElementById('summernote_edit_requirements');
        const table = document.getElementById("table_requirements");
        const requirements_modal_edit = document.getElementById("requirements_modal_edit");
        const form_edit_requirement = document.getElementById("form_edit_requirement");
        const edit_select_category_id = document.getElementById("edit_select_category_id");
        const user_logged = @json(auth()->user());
        const form_filter_requirements = document.getElementById("form_filter_requirements");

        let requirements_categories = @json($data['requirements_categories']);

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
            "pageLength": 5,
            "lengthChange": true,
            "processing": true,
            "serverSide": true,
            "retrieve": false,
            "searching": true,
            "ajax": {
                "url": appData["url_datatable_requirements"],
                "data": function(data) {

                    data.filter_private = form_filter_requirements.private_status.value || 0;
                    data.id_category = $(filter_for_category).val() || null;
                }
            },
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

        let datatable = null;
    </script>
    <script src="{{ asset('js/requirements/validation.js') }}"></script>
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    <script src="{{ asset('js/functions/templates.js') }}"></script>
    <script src="{{ asset('js/functions/helpers.js') }}"></script>
    <script src="{{ asset('js/emails/shippimg.js') }}"></script>
    <script src="{{ asset('js/requirements/functions/forms.js') }}"></script>
    <script src="{{ asset('js/requirements/categories/funtions.js') }}"></script>
    <script src="{{ asset('js/requirements/functions/btns_actions.js') }}"></script>
    <script src="{{ asset('js/requirements/main.js') }}"></script>
    <script src="{{ asset('js/requirements/functions/categories.js') }}"></script>
    <script src="{{ asset('js/requirements/categories/main.js') }}"></script>
    <script>
        $(function() {
            // textarea custom initialization
            $(summernote).summernote()
            $(summernote_edit_requirements).summernote()

            // * datatabke init
            datatable = $(table).DataTable(datatableOptions);

            // filter for categorr
            $(filter_for_category).on("change", e => {
                const value = e.target.value;

                // datatable.ajax.reload();
                if ($(filter_for_category).val()) {
                    datatable.ajax.reload();
                }

            })
            // filter for categorr
            $(form_filter_requirements.private_status).on("change", e => {
                const value = e.target.value;
                datatable.ajax.reload();
            })
        });

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
@endpush
