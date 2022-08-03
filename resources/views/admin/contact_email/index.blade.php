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
                    <div class="row">

                        <div class="col-12 col-md-3">
                            <div class="card card-outline card-primary   mx-3">
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
                    </div>

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
                        <form action="{{ route('contact_email.index') }}" method="GET">
                            <div class=" input-group input-group-sm" style="width: 150px;">

                                <input type="text" name="search" class="form-control float-right" placeholder="Buscar"
                                    value="{{ $search }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default ">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                    @if ($contact_emails->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                                <thead class="">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Empresa</th>
                                        <th>Usuario</th>
                                        <th>Estado</th>
                                        <th>Email</th>
                                        <th>Envios</th>
                                        <th>Contacts</th>
                                        <th>Creacion</th>
                                        <th>btns</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($contact_emails as $i => $email)
                                        <tr>
                                            <td> {{ $email->id }} </td>
                                            <td> {{ Str::limit($email->nombre_empresa, 15, '...') }} </td>
                                            <td> {{ $email->usuario ? $email->usuario->username : 'Sin Usuario' }} </td>
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
                                            <td>{{ $email->envios_count }}</td>
                                            <td>
                                                <a target="_blanck" href="{{ $email->whatsapp }}"
                                                    class="btn btn-success btn-sm {{ !$email->whatsapp ? 'disabled' : '' }}">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>

                                                <a target="_blanck" href="{{ $email->facebook }}"
                                                    class="btn bg-purple btn-sm {{ !$email->facebook ? 'disabled' : '' }}">
                                                    <i class="fab fa-facebook"></i>
                                                </a>

                                                <a target="_blanck" href="{{ $email->instagram }}"
                                                    class="btn btn-secondary btn-sm {{ !$email->instagram ? 'disabled' : '' }}">
                                                    <i class="fab fa-instagram"></i>
                                                </a>

                                                <a target="_blanck" href="{{ $email->url }}"
                                                    class="btn btn-info btn-sm {{ !$email->url ? 'disabled' : '' }}">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>

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

                                </tbody>
                            </table>
                            {{-- <div class="mt-3 d-flex justify-content-end">
                                {{ $contact_emails->onEachSide(0)->links() }}
                            </div> --}}
                        </div>
                        <div class="pl-3">
                            <div class="mt-3 d-flex justify-content-end">
                                {{ $contact_emails->onEachSide(-1)->links() }}
                            </div>

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

        $(excel_file).on("change", e => {
            form_import_excel.submit();
        })
    </script>
@endpush
