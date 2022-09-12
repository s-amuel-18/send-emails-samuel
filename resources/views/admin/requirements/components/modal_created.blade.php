<div id="requirements_modal" class="modal " tabindex="-1" role="dialog" aria-labelledby="requerimientos" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requerimientos">Crear Nuevo Requerimiento</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="insert_alert_requirements"></div>

                <form method="POST" action="{{ $data['js']['url_store_requirement'] }}" id="form_create_requirement">
                    @csrf
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
                                <div class=" w-100 bg-danger">
                                    <select data-placeholder="Seleccionar Categoría"
                                        class="select2 form-control select2_categories" name="category_id"
                                        style="width: 100%" id="select_category_id_create">
                                        <option value="">Seleccionar Categoría</option>
                                        @foreach ($data['requirements_categories'] as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
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

                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="private"
                                    value="1">
                                <label for="customCheckbox2" class="custom-control-label">Registro privado (solo lo
                                    puedes ver tú)</label>
                            </div>
                        </div>

                    </div>




                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <span class="normal_item">
                                Registrar
                            </span>
                            <span class="load_item d-none">
                                Enviando
                                <div style="width: .8rem; height: .8rem;"
                                    class=" spinner-border spinner-border-sm text-white" role="status"></div>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
