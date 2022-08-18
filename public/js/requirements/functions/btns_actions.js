// functions delete
async function confirm_delete(id, btn) {
    Swal.fire({
        allowOutsideClick: false,
        allowEscapeKey: false,
        title: "Eliminando...",
        html: "En este momento se está eliminando un requerimiento",
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();

            const obj_params = {
                params: {
                    id: id,
                },
            };

            const resp = axios
                .delete(appData["url_destroy_requirement"], obj_params)
                .then((resp) => {
                    Swal.close();
                    // datatable.ajax.reload();

                    const { data } = resp;

                    Swal.fire(
                        "Eliminado Correctamente",
                        data.message || "Eliminado correctamente",
                        "success"
                    );

                    let hijo = btn.parentElement.parentElement;
                    btn.parentElement.parentElement.parentElement.removeChild(
                        hijo
                    );
                })
                .catch((err) => {
                    const message = err.response.data.message;

                    Swal.fire(
                        "Error",
                        message || "Ha ocurrido un error",
                        "error"
                    );

                    console.log(err);
                });
        },
    });
}

function delete_requirement(btn) {
    const id = btn.dataset.id;

    load_btn(btn, true);

    if (!appData["url_destroy_requirement"]) {
        Swal.fire("Error", "Ha ocurrido un error iterno.");

        return false;
    }

    if (!id && !appData["url_destroy_requirement"]) {
        Swal.fire(
            "Error de identificacion",
            "Ha ocurrido un error al intentar acceder al identificador del requerimiento",
            "error"
        );

        return false;
    }

    Swal.fire({
        title: "¿Realmente deseas eliminar este elemento?",
        text: "Al eliminar este elemento no podrás recuperarlo, ¿realmente deseas eliminar este elemento?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Canceclar",
    }).then(async (result) => {
        if (result.isConfirmed) {
            const resp = await confirm_delete(id, btn);
            console.log(resp);
        }
        load_btn(btn, false);
    });
}
// end functions delete

async function get_data_requirement(url) {
    try {
        const { data } = await axios.get(url);
        return data;
    } catch (error) {
        console.log(error);
    }
}

// functions edit
async function edit_requirement(btn) {
    const id = btn.dataset.id;
    const url_get_requirements = btn.dataset.url;
    const url_update_requirements = btn.dataset.url_edit;

    $(summernote_edit_requirements).summernote("reset");

    if (!url_update_requirements && !url_get_requirements) return false;

    load_btn(btn, true);

    const data_requirements = await get_data_requirement(url_get_requirements);

    load_btn(btn, false);

    const name = data_requirements.name;
    const category_id = data_requirements.category_id;
    const url = data_requirements.url;
    const description = data_requirements.description || "";

    form_edit_requirement.name.value = name;
    form_edit_requirement.category_id.value = category_id;
    form_edit_requirement.url.value = url;
    form_edit_requirement.action = url_update_requirements;
    // form_edit_requirement.description.value = description;

    const option_exist = $(edit_select_category_id).find(
        "option[value='" + category_id + "']"
    );
    console.log(option_exist.length);
    if (option_exist.length > 0) {
        $(edit_select_category_id).val(category_id).trigger("change");
    }

    $(summernote_edit_requirements).summernote("editor.pasteHTML", description);

    $(requirements_modal_edit).modal("show");
}
// end functions edit

// if ($('#mySelect2').find("option[value='" + data.id + "']").length) {
//     $('#mySelect2').val(data.id).trigger('change');
