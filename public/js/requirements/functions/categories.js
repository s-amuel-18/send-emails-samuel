function reset_confirm_delete() {
    const normal_element = document.querySelectorAll(
        ".element_category_normal"
    );
    const delete_element = document.querySelectorAll(
        ".element_category_delete"
    );

    if (normal_element.length < 2 && delete_element.length < 2) return false;

    $(delete_element).css("display", "none");
    $(normal_element).css("display", "block");
}

function ahow_confirm_delete(id, show) {
    const normal_element = document.querySelectorAll(
        ".element_show_normal_" + id
    );
    const delete_element = document.querySelectorAll(
        ".element_show_delete_" + id
    );

    if (normal_element.length != 2 && delete_element.length != 2) return false;

    reset_confirm_delete();

    if (show) {
        $(normal_element).css("display", "none");
        $(delete_element).css("display", "block");
    } else {
        $(delete_element).css("display", "none");
        $(normal_element).css("display", "block");
    }
}

function delete_category() {
    const confir_delete_category = document.querySelectorAll(
        ".confir_delete_category"
    );
    if (confir_delete_category.length <= 0) return false;

    $(confir_delete_category).on("click", (e) => {
        const btn = e.delegateTarget;
        const id = btn.dataset.id;
        const url = btn.dataset.url;

        load_btn(btn, true);

        if (!url || !id) return false;

        axios
            .delete(url)
            .then((resp) => {
                const { data } = resp;
                const item_category = document.getElementById(
                    "item_category_" + id
                );

                if (!item_category) return false;

                delete_child(item_category);

                remove_cateogire_arr(data.data.id);
            })
            .catch((err) => {
                console.log(err);
                const message = err.response.data.message;

                Swal.fire("Error", message || "Ha ocurrido un error", "error");

                console.log(err);
            });
    });
}

function event_ahow_confirm_delete() {
    const category_delete = document.querySelectorAll(".category_delete");
    if (category_delete.length <= 0) return false;

    $(category_delete).on("click", (e) => {
        const id = e.delegateTarget.dataset.id;
        ahow_confirm_delete(id, true);
    });
}

function cancel_delete_category_func() {
    const cancel_delete_category = document.querySelectorAll(
        ".cancel_delete_category"
    );
    if (cancel_delete_category.length <= 0) return false;

    $(cancel_delete_category).on("click", (e) => {
        const id = e.delegateTarget.dataset.id;
        ahow_confirm_delete(id, false);
    });
}

function template_category_item(data) {
    const { id } = data;
    const { name } = data;
    return `
    <tr id="item_category_${id}">
        <td class="p-2">
            <div class="element_category_normal element_show_normal_${id}">

                <input data-value_init="${name}" data-id="${id}" data-url="http://127.0.0.1:8000/requerimientos/categoria/actualizar/${id}" type="text"
                    class="input_name_category form-control-category form-control form-control-sm" value="${name}">
            </div>

            <div style="display: none" class="element_category_delete element_show_delete_${id}">
                <b class="text-muted">¿Deseas eliminar esta categoría?</b>
            </div>
        </td>
        <td style="width: fit-content" class="p-2">
            <div class="element_category_normal element_show_normal_${id}">
                <div class=" d-flex justify-content-end ">
                    <button data-id="${id}" type="button" class="btn btn-outline-danger btn-sm category_delete"
                        id="category_${id}" style="border-width: 0">
                        <span class="normal_item">
                            <i class="fa fa-trash"></i>
                        </span>
                        <span class="load_item d-none">
                            <div style="width: .9rem; height: .9rem;"
                                class=" spinner-border spinner-border-sm text-danger" role="status">
                            </div>
                        </span>
                    </button>
                </div>
            </div>

            <div class="element_category_delete element_show_delete_${id}" style="display: none;">
                <div class="d-flex justify-content-end">
                    <button data-id="${id}" data-url="http://127.0.0.1:8000/requerimientos/categoria/${id}/eliminar"
                        style="border-width: 0" class="btn btn-outline-success btn-sm mr-1 confir_delete_category"
                        type="button">
                        <span class="normal_item">
                            <i class="fa fa-check"></i>
                        </span>
                        <span class="load_item d-none">
                            <div style="width: .9rem; height: .9rem;"
                                class=" spinner-border spinner-border-sm text-success" role="status">
                            </div>
                        </span>
                    </button>
                    <button data-id="${id}" style="border-width: 0"
                        class="btn btn-outline-danger btn-sm cancel_delete_category" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </td>
    </tr>
                          
    `;
}

async function post_category(url = null, data, type = "create") {
    if (!url) return false;

    await axios
        .post(url, data)
        .then((resp) => {
            const { data } = resp;

            toastr.success(data.message || "La accion fue exitosa");

            if (type == "create") {
                table_insert_categories.innerHTML += template_category_item(
                    data.data_insert
                );

                event_ahow_confirm_delete();
                cancel_delete_category_func();
                delete_category();
                update_category();
                add_categorie_arr(data.data_insert);
            } else if (type == "update") {
                update_categorie_arr(data.data_insert.id, data.data_insert);
            }
        })
        .catch((err) => {
            const message = err.response.data.message;
            const data = err.response.data;
            console.log(data);
            let temp_list = ``;

            for (const key in data.errors) {
                if (Object.hasOwnProperty.call(data.errors, key)) {
                    const element = data.errors[key];
                    element.forEach((el) => {
                        let list = `<li>${el}</li>`;
                        temp_list += list;
                    });
                }
            }

            Swal.fire(
                "Error",
                (message || "Ha ocurrido un error") + "<br>" + temp_list,
                "error"
            );

            console.log(err);
        });
}

function update_category() {
    const inputs_name_category = document.querySelectorAll(
        ".input_name_category"
    );

    $(inputs_name_category).on("keyup", async (e) => {
        // *  detectamos si la tecla ENTER fue precionada
        // * - Esto se realiza para que el evento de actualizacion solo se realice cuando se preciona la TECLA ENTER
        if (e.which != 13) return null; //! salimos de la funcion

        const input = e.delegateTarget;
        const id = input.dataset.id;
        const url = input.dataset.url;
        const name = input.value;
        // console.log({ name });
        await post_category(url, { name, id }, "update");
    });

    $(inputs_name_category).on("blur", (e) => {
        const input = e.target;
        const value_init = input.dataset.value_init || null;

        // * validamos que el elemento tenga un valor inicial por defecto
        if (!value_init) return null; // ! no tiene valor iniciañ

        input.value = value_init; // * asignamos ese valor incial al input en caso de que no se halla actualizado.
    });
}
