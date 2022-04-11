@extends('adminlte::page', ['use_ico_only' => true, 'use_full_favicon' => false])
@section('plugins.Datatables', true)

@section('title', 'Administrador de usuarios')

@section('content_header')
    <h1>Administrador De Emails</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Emails</h3>
                    <div class="card-tools">
                        <a href="{{ route('contact_email.estadisticas') }}" class="btn btn-outline-light btn-tool">
                            <i class="fas fa-chart-pie"></i>
                        </a>
                        <a href="{{ route('contact_email.create') }}" class="btn btn-outline-light btn-tool">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                        <thead class="">
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>Nombre Empresa</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th>Email</th>
                                <th>Contacts</th>
                                <th>Creacion</th>
                                <th>btns</th>
                            </tr>
                        </thead>
                        {{-- <tbody>

                            @foreach ($emails as $i => $email)
                                <tr>
                                    <td> {{ $i + 1 }} </td>
                                    <td> {{ Str::limit($email->nombre_empresa, 15, '...') }} </td>
                                    <td> {{ $email->usuario->username }} </td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $email->estado > 0 ? 'success' : 'danger' }}">{{ $email->estado > 0 ? 'Enviado' : 'Sin Enviar' }}</span>
                                    </td>
                                    <td>

                                        @if ($email->email)
                                            <span>{{ $email->email }}</span>
                                        @else
                                            <b class="text-danger">Sin Email</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a target="_blanck" href="{{ $email->whatsapp }}"
                                            class="btn btn-success btn-sm {{ !$email->whatsapp ? 'disabled' : '' }}">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>

                                        <a target="_blanck" href="{{ $email->facebook }}"
                                            class="btn btn-primary btn-sm {{ !$email->facebook ? 'disabled' : '' }}">
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
                                        <fecha-custom fecha="{{ $email->created_at }}"></fecha-custom>
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
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody> --}}
                    </table>



                </div>
            </div>
        </div>
    </div>



@stop


@section('js')
    <script>
        $(".table").DataTable({
            "ordering": false,
            // "pageLength": 20,
            "ajax": "{{ route("contact_email.datatable") }}",
            "columns": [
                {
                    "data": "word_nombre_empresa"
                },
                {
                    "data": "usuario"
                },
                {
                    "data": "estado"
                },
                {
                    "data": "valid_email"
                },
                {
                    "data": "links_buttons"
                },
                {
                    "data": "creacion"
                },
                {
                    "data": "actions"
                },
            ]
        });
    </script>
@stop
