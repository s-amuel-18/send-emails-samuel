@push('css')
    <style>
        .form-control-category {
            border-width: 0
        }

        .form-control-category:focus {
            border-width: 1px
        }

        .confirm_delete_category {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
        }
    </style>
@endpush

<div id="categories_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="Categorias" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Categorias">Categorías</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="d-flex mb-2">
                    <div class="w-100 px-1">
                        <form action="{{ route('requirements.category_store') }}" method="POST"
                            id="form_create_category">
                            @csrf
                            <input class="form-control form-control-sm" type="text" name="name"
                                placeholder="Nombre de la categoría">
                        </form>
                    </div>
                    <div class="px-2">
                        <button id="submit_form_create_category" form="form_create_category"
                            class="btn btn-outline-primary btn-sm" type="submit">
                            <span class="normal_item">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="load_item d-none">
                                <div style="width: .9rem; height: .9rem;"
                                    class=" spinner-border spinner-border-sm text-primary" role="status">
                                </div>
                            </span>
                        </button>
                    </div>
                </div>
                <table class="w-100 table table-light text-nowrap table-valign-middle no-footer">
                    <tbody id="table_insert_categories">
                        {{-- <tr>
                            <td class="p-2">

                            </td>
                            <td style="width: 50px" class="p-2">

                            </td>
                        </tr> --}}
                        @foreach ($data['requirements_categories'] as $category)
                            <tr id="item_category_{{ $category->id }}">
                                <td class="p-2">
                                    <div
                                        class="element_category_normal element_show_normal_{{ $category->id ?? false }}">

                                        <input data-id="{{ $category->id }}"
                                            data-url="{{ route('requirements.category_update', ['id' => $category->id ?? 0]) }}"
                                            data-value_init="{{ $category->name ?? false }}" type="text"
                                            class="input_name_category form-control-category form-control form-control-sm"
                                            value="{{ $category->name ?? false }}">
                                    </div>

                                    <div style="display: none"
                                        class="element_category_delete element_show_delete_{{ $category->id ?? 0 }}">
                                        <b class="text-muted">¿Deseas eliminar esta categoría?</b>
                                    </div>
                                </td>
                                <td style="width: fit-content" class="p-2">
                                    <div class="element_category_normal element_show_normal_{{ $category->id }}">
                                        <div class=" d-flex justify-content-end ">
                                            <x-delete class="category_delete" style="border-width: 0"
                                                id="category_{{ $category->id }}" type="button" size="sm"
                                                dataid="{{ $category->id }}" />
                                        </div>
                                    </div>

                                    <div class="element_category_delete element_show_delete_{{ $category->id }}"
                                        style="display: none;">
                                        <div class="d-flex justify-content-end">
                                            <button data-id="{{ $category->id }}"
                                                data-url="{{ route('requirements.category_delete', ['id' => $category->id]) }}"
                                                style="border-width: 0"
                                                class="btn btn-outline-success btn-sm mr-1 confir_delete_category"
                                                type="button">
                                                <span class="normal_item">
                                                    <i class="fa fa-check"></i>
                                                </span>
                                                <span class="load_item d-none">
                                                    <div style="width: .9rem; height: .9rem;"
                                                        class=" spinner-border spinner-border-sm text-success"
                                                        role="status">
                                                    </div>
                                                </span>
                                            </button>
                                            <button data-id="{{ $category->id }}" style="border-width: 0"
                                                class="btn btn-outline-danger btn-sm cancel_delete_category"
                                                type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        const table_insert_categories = document.getElementById("table_insert_categories");
    </script>
    <script src="{{ asset('js/requirements/categories/validation.js') }}"></script>
@endpush
