@extends('layouts.app')
{{-- @section('plugins.Datatables', true) --}}

@section('title', 'Administrador De Cuerpos De Emails')

@section('content_header')
    <h1>Administrador De Cuerpos De Emails</h1>
@stop

@section('content_2')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Cuerpos De Emails</h3>
                    <div class="card-tools">

                        @can('bodyEmail.create')
                            <a href="{{ route('bodyEmail.create') }}" class="btn btn-outline-light btn-tool">
                                <i class="fas fa-plus"></i> <span class="d-none d-md-inline-block ml-1">Crear cuerpo Email </span>
                            </a>
                        @endcan

                    </div>
                </div>

                <div class="card-body table-responsive">

                    @if ($bodys->count() > 0)

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>nombre</th>
                                    <th>Creacion</th>
                                    <th>Btns</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($bodys as $i => $body)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $body->usuario ? $body->usuario->name : 'Sin Usuario' }}</td>
                                        <td>{{ $body->nombre }}</td>
                                        <td>
                                            {{ $body->created_at->diffForHumans() }}
                                        </td>
                                        <td style="width: 110px">
                                            @can('bodyEmail.edit')
                                                <a href="{{ route('bodyEmail.edit', ['body_email' => $body->id]) }}"
                                                    class="btn btn-outline-success btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can('bodyEmail.destroy')
                                                <form class="d-inline"
                                                    onsubmit="return confirm('Realmente Deseas Eliminar Este Usuario')"
                                                    action="{{ route('bodyEmail.destroy', ['body_email' => $body->id]) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </form>
                                            @endcan

                                        </td>
                                    </tr>
                                    <tr class="expandable-body d-none">
                                        <td colspan="5">
                                            <p style="display: none;">
                                                {!! $body->body !!}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <h3 class="text-center">No Hay registros <a href="{{ route('bodyEmail.create') }}">Crear Cuerpo
                                de email</a></h3>

                    @endif



                </div>

                <div class="d-flex justify-content-end">
                    {{ $bodys->links() }}
                </div>
            </div>
        </div>
    </div>



@stop


@section('js')
@stop
