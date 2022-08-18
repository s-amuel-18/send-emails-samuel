<div id="requirements_modal_edit" class="modal " tabindex="-1" role="dialog" aria-labelledby="requerimientos"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requerimientos">Editar Requerimiento</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="insert_alert_requirements_edit"></div>

                <form method="POST" action="{{ $data['js']['url_store_requirement'] }}" id="form_edit_requirement">
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
                                    <select id="edit_select_category_id" data-placeholder="Seleccionar Categoría"
                                        class="select2 form-control" name="category_id" style="width: 100%">
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
                                <textarea id="summernote_edit_requirements" class="form-control" type="text" name="description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>




                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" type="submit">
                            <span class="normal_item">
                                Editar
                            </span>
                            <span class="load_item d-none">
                                Editando
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
