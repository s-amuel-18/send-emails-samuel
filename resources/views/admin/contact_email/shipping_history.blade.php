@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Moment', true)
@section('plugins.Inputmask', true)
@section('plugins.Tempusdominus-bootstrap-4', true)

@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@section('content_2')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Historial</h3>
                    <div class="card-tools">

                        @can('contact_email.estadisticas')
                            <a href="{{ route('contact_email.estadisticas') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-chart-pie"></i><span class="d-none d-md-inline-block ml-1">Estadisticas de
                                    Emails </span>
                            </a>
                        @endcan

                        @can('contact_email.create')
                            <a href="{{ route('contact_email.index') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-table"></i><span class="d-none d-md-inline-block ml-1">Registros </span>
                            </a>
                        @endcan

                    </div>
                </div>

                <div class="card card-body">
                    <div class="d-flex justify-content-end flex-wrap flex-column flex-md-row gap-5px align-items-md-center">
                        <div class="d-flex gap-5px flex-wrap py-2 ">
                            <div class="">
                                <label for="user-filter-0" class="label_active cursor-pointer d-block mb-0"
                                    data-placement="top" data-toggle="tooltip" title="Mostrar todos los usuarios">

                                    <div style="width: 30px ; height: 30px;"
                                        class=" bg-light d-flex justify-content-center align-items-center rounded-circle">
                                        <i class="fa fa-users" style="font-size: 12px"></i>
                                    </div>
                                    <input value="" class="d-none" type="radio" name="user-filter"
                                        id="user-filter-0" checked>
                                </label>
                            </div>
                            @foreach ($data['users_with_sent_email'] as $user)
                                <div class="">
                                    <label for="user-filter-{{ $user->id }}"
                                        class="label_active cursor-pointer d-block mb-0" data-placement="top"
                                        data-toggle="tooltip" title="{{ $user->username }}">
                                        @include('admin.contact_email.components.datatable.user', [
                                            'user' => $user,
                                            'size' => [
                                                'width' => '30px',
                                                'height' => '30px',
                                            ],
                                        ])
                                        <input value="{{ $user->username }}" class="d-none" type="radio"
                                            name="user-filter" id="user-filter-{{ $user->id }}"
                                            {{ ($data['request']['username'] ?? null) == $user->username ? 'checked' : '' }}>
                                    </label>
                                </div>
                            @endforeach
                            {{-- {{ $data['request']['username'] }} --}}
                        </div>

                        <div class="d-flex justify-content-end py-2 ">
                            {{-- * filtro por fecha --}}
                            <div class="mr-2">
                                <div class="input-group date" id="date_filter" data-target-input="nearest">
                                    <input type="text" class="d-none- form-control form-control-sm datetimepicker-input"
                                        data-target="#date_filter" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask />

                                    <div class="input-group-append" data-target="#date_filter" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    @if ($data['shipping_history_count'] > 0)
                        <div class="">
                            <table id="table_contact_emails"
                                class="w-100 table table-light table-striped table-hover text-nowrap table-valign-middle">
                                <thead class="">
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th>Correo electrónico</th>
                                        <th>Asunto</th>
                                        <th>Grupo De Envio</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                            </table>
                            {{-- <div class="mt-3 d-flex justify-content-end">
                                {{ $contact_emails->onEachSide(0)->links() }}
                            </div> --}}
                        </div>
                    @else
                        <div class="alert alert-light" role="alert">
                            No se encontraron resultados <a class="text-primary"
                                href="{{ route('contact_email.create') }} ">Crear Nuevo
                                Contacto</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="details_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="detalles" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
@stop

@push('js')
    <script src="{{ asset('js/functions/templates.js') }}"></script>
    <script src="{{ asset('js/functions/helpers.js') }}"></script>
    <script>
        const requestData = @json($data['request']);
        const appData = @json($data['js']);
        const insert_data_details = document.getElementById("insert_data_details");
        const details_modal = document.getElementById("details_modal");
    </script>
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    <script src="{{ asset('js/emails/shippimg.js') }}"></script>
    <script>
        const table = document.getElementById("table_contact_emails");

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
            fixedHeader: true,
            "scrollX": true,
            // "pagingType": "full",
            "bPaginate": true,
            "sPaginationType": "numbers",
            "pageLength": 20,
            "lengthChange": true,
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": {
                "url": appData["url_datatable"],
                "data": function(data) {

                    data.username = $(`input[name="user-filter"]:checked`).val() ?? null;
                    data.email = requestData["email"] ?? null;
                    // data.date_filter = requestData["date_filter"] ?? null;
                    data.date_filter = $('#date_filter').data().datetimepicker._datesFormatted[0] ??
                        null;
                }
            },
            "columns": [{
                    data: "created_at"
                },
                {
                    data: "username"
                },
                {
                    data: "email"
                },
                {
                    data: "subject"
                },
                {
                    data: "group_send"
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

        $(function() {
            var now = new Date();
            $('#date_filter').datetimepicker({
                format: 'DD/MM/YYYY',
                defaultDate: appData.date_filter_parse || null,
            });

            const datatable = $(table).DataTable(datatableOptions);

            $(`input[name="user-filter"]`).on("change", e => {
                // alert("dsa");
                datatable.ajax.reload();
            })
            $('#date_filter').on("change.datetimepicker", e => {
                // console.log(e.date);
                datatable.ajax.reload();
            })
        });

        $(table).on("draw.dt", e => {
            $('[data-toggle="tooltip"]').tooltip();

            const obj_values_desc = [{
                    label: "Email",
                    value: "email",
                },
                {
                    label: "Usuario Redactor",
                    value: "username",
                },
                {
                    label: "Asunto",
                    value: "subject",
                },
                {
                    label: "Descripcion",
                    value: "body",
                },
                {
                    label: "Fecha de envio",
                    value: "created_format",
                },
            ];


            event_detils(
                ".more_details",
                obj_values_desc
            );
        });
    </script>
@endpush
