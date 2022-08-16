<div class="col-md-6 table-responsive">

    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">Requerimientos</h3>
            <div class="card-tools">
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
                <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Url De Referencia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                @include('admin.contact_email.components.datatable.user', [
                                    'user' => Auth::user(),
                                ])
                            </td>
                            <td>Lorem, ipsum.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            @else
                Sin Registros De Hoy
            @endif

        </div>
    </div>
</div>

<div id="requirements_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="requerimientos"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requerimientos">Crear Nuevo Requerimiento</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form_requirements">
                    {{-- nombre --}}
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name">
                    </div>

                    {{-- Categoria --}}
                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <input id="category_id" class="form-control" type="text" name="category_id">
                    </div>

                    {{-- url --}}
                    <div class="form-group">
                        <label for="url">Url De Referencia</label>
                        <input id="url" class="form-control" type="text" name="url">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea id="description" class="form-control" type="text" name="description" rows="5"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
