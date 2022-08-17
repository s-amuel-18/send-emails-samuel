@extends('layouts.app')
@section('plugins.Datatables', true)

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
    {{-- <style>
        @media screen and (max-width: 400px) {

            li.page-item {

                display: none;
            }

            .page-item:first-child,
            .page-item:nth-child(2),
            .page-item:nth-last-child(2),
            .page-item:last-child,
            .page-item.active,
            .page-item.disabled {

                display: block;
            }
        }
    </style> --}}
    <div class="row">
        {{-- <div class="row"> --}}

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
                    <div class="d-flex justify-content-end ">


                        <form action="{{ route('contactEmail.import_excel') }}" enctype="multipart/form-data" method="POST"
                            id="form_import_excel">

                            <input type="file" name="excel_file" accept=".xlsx, .Xls" id="excel_file" class="d-none">

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
                                {{-- <tbody>

                                    @foreach ($contact_emails as $i => $email)
                                        <tr>
                                            <td> {{ $email->id }} </td>
                                            <td> {{ Str::limit($email->nombre_empresa, 15, '...') }} </td>
                                            <td>
                                                @if ($email->usuario)
                                                    <div style="width: 27px; height: 27px;"
                                                        class="bg-{{ $email->usuario->color_by_id() }} d-flex justify-content-center align-items-center rounded-circle"
                                                        data-placement="top" data-toggle="tooltip" data-placement="top"
                                                        title="{{ $email->usuario->username }}">
                                                        <i class="fa fa-user" style="font-size: 12px"></i>
                                                    </div>
                                                @else
                                                    <div style="width: 27px; height: 27px;"
                                                        class="bg-danger d-flex justify-content-center align-items-center rounded-circle">
                                                        <i class="fa fa-times" style="font-size: 12px"></i>
                                                    </div>
                                                @endif

                                            <td>
                                                <span
                                                    class="badge badge-{{ $email->envios_count > 0 ? 'success' : 'danger' }}">{{ $email->envios_count > 0 ? 'Enviado' : 'Sin Enviar' }}</span>
                                            </td>
                                            <td>

                                                @if ($email->email)
                                                    <span>{{ $email->email }}</span>
                                                @else
                                                    <b class="text-danger">Sin Email</b>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $email->envios_count > 0 ? 'success' : 'danger' }}">{{ $email->envios_count }}</span>
                                            </td>
                                            <td>
                                                @if ($email->url)
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        href="{{ $email->url }}">{{ Str::limit($email->url, 30) }}</a>
                                                @else
                                                    -------
                                                @endif
                                            </td>
                                            <td>
                                                @if ($email->whatsapp)
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        href="{{ $email->whatsapp }}">{{ Str::limit($email->whatsapp, 30) }}</a>
                                                @else
                                                    -------
                                                @endif
                                            </td>
                                            <td>
                                                @if ($email->facebook)
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        href="{{ $email->facebook }}">{{ Str::limit($email->facebook, 30) }}</a>
                                                @else
                                                    -------
                                                @endif
                                            </td>
                                            <td>
                                                @if ($email->instagram)
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        href="{{ $email->instagram }}">{{ Str::limit($email->instagram, 30) }}</a>
                                                @else
                                                    -------
                                                @endif
                                            </td>
                                            <td>
                                                {{ $email->created_at->diffForHumans() }}
                                            </td>
                                            <td style="width: 110px">
                                                <a href="{{ route('contact_email.edit', ['contact_email' => $email->id]) }}"
                                                    class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form class="d-inline"
                                                    onsubmit="return confirm('Realmente Deseas Eliminar Este Email')"
                                                    action="{{ route('contact_email.destroy', ['contact_email' => $email->id]) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody> --}}
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



@stop

@push('js')
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
                "ajax": appData["url_datatable"],
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
        })

        $(table).on("draw.dt", e => {
            // setTimeout(() => {
            $('[data-toggle="tooltip"]').tooltip()
            // }, 1000);
        });
    </script>
@endpush
