@extends('layouts.app')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)

@section('title', 'Administrador de Emails')

@section('content_header')
    <h1>Administrador De Emails</h1>
@stop

@section('content_2')
    @error('excel_file')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $message }}
        </div>
    @enderror

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
        <div class="col-12 col-md-3">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Emails De Hoy</h3>
                    <div class="card-tools font-weight-bold  text-success mx-2">
                        <span class="">{{ $contact_emails_today_count }}</span>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
            </div>
        </div>
        {{-- </div> --}}

        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Contactos: <b class="text-muted">{{ $contact_emails_all_counts }}</b></h3>
                    <div class="card-tools">

                        @can('contact_email.estadisticas')
                            <a href="{{ route('contact_email.estadisticas') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-chart-pie"></i><span class="d-none d-md-inline-block ml-1">Estadisticas de
                                    Emails </span>
                            </a>
                        @endcan

                        @can('contact_email.create')
                            <a href="{{ route('contact_email.create') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Nuevo email </span>
                            </a>
                        @endcan

                    </div>
                </div>

                <div class="card card-body">
                    <div class="d-flex justify-content-between flex-wrap flex-column flex-md-row">
                        <div class="d-flex gap-5px flex-wrap">
                            @foreach ($data['users_with_record'] as $user)
                                {{-- <div class=""> --}}
                                <label for="user-filter-{{ $user->id }}" class="label_active cursor-pointer d-block"
                                    data-placement="top" data-toggle="tooltip" title="{{ $user->username }}">
                                    @include('admin.contact_email.components.datatable.user', [
                                        'user' => $user,
                                        'size' => [
                                            'width' => '30px',
                                            'height' => '30px',
                                        ],
                                    ])
                                    <input value="{{ $user->username }}" class="d-none" type="radio" name="user-filter"
                                        id="user-filter-{{ $user->id }}"
                                        {{ ($data['request']['username'] ?? null) == $user->username ? 'checked' : '' }}>
                                </label>
                                {{-- </div> --}}
                            @endforeach
                            {{-- {{ $data['request']['username'] }} --}}
                        </div>

                        <div class="d-flex justify-content-end">
                            <form action="{{ route('contactEmail.import_excel') }}" enctype="multipart/form-data"
                                method="POST" id="form_import_excel">

                                <input type="file" name="excel_file" accept=".xlsx, .Xls, .csv" id="excel_file"
                                    class="d-none">

                                @csrf

                                <label for="excel_file" class="btn btn-secondary btn-sm mr-2">
                                    <i class="fa fa-file-import"></i>
                                    <span class="d-none d-md-inline">Importar
                                        Excel</span>
                                </label>

                            </form>
                            <div class="">

                                <a href="{{ route('contactEmail.export_excel') }}" class="btn btn-success  btn-sm mr-2"
                                    type="button">
                                    <i class="fa fa-file-excel"></i>
                                    <span class="d-none d-md-inline">Exportar
                                        Excel</span></a>
                            </div>
                        </div>

                    </div>

                    @if ($contact_emails_all_counts > 0)
                        <div class="">
                            <table id="table_contact_emails"
                                class="w-100 table table-light table-striped table-hover text-nowrap table-valign-middle">
                                <thead class="">
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Empresa</th>
                                        <th>Email</th>
                                        <th>Envios</th>
                                        <th>Sitio Web</th>
                                        <th>Whatsapp</th>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>Creacion</th>
                                        <th>Actualizacion</th>
                                        <th>btns</th>
                                    </tr>
                                </thead>
                            </table>
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



@stop

@push('js')
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>
    <script src="{{ asset('js/functions/helpers.js') }}"></script>
    <script src="{{ asset('js/emails/contact_email/records.js') }}"></script>
    <script>
        const excel_file = document.getElementById("excel_file");
        const form_import_excel = document.getElementById("form_import_excel");
        const table = document.getElementById("table_contact_emails");
        const appData = @json($data['js']);
        const requestData = @json($data['request']);


        $(function() {
            $(excel_file).on("change", e => {
                form_import_excel.submit();
            })

            let datatableConfig = {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                },
                "dataType": "json",
                "order": [
                    [9, "DESC"]
                ],
                "responsive": true,
                "scrollX": true,
                // "pagingType": "full",
                "bPaginate": true,
                "sPaginationType": "numbers",
                "pageLength": 10,
                "lengthChange": true,
                "processing": true,
                "fixedHeader": true,
                "serverSide": true,
                "searching": true,
                "ajax": {
                    "url": appData["url_datatable"],
                    "data": function(data) {
                        data.username = $(`input[name="user-filter"]:checked`).val() ?? null;
                        data.date_filter = requestData["date_filter"] ?? null;
                    }
                },
                "columns": [{
                        data: "id"
                    },
                    {
                        data: "username"
                    },
                    {
                        data: "nombre_empresa"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "envios"
                    },
                    {
                        data: "url"
                    },
                    {
                        data: "whatsapp"
                    },
                    {
                        data: "facebook"
                    },
                    {
                        data: "instagram"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        data: "actions"
                    },
                ],
            };

            if (requestData["search"]) {
                datatableConfig.search = {
                    "search": requestData["search"],
                };
            }

            const datatable = $(table).DataTable(datatableConfig);
            $(`input[name="user-filter"]`).on("change", e => {

                datatable.ajax.reload();
            })
        })

        $(table).on("draw.dt", e => {
            edit_inline_input();
            event_type_alternative("a.contact_alternative_btn");
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endpush
