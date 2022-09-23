// * nos modifica los estilos del boton "publicar proyecto" dependiendo de si esta o no publicado.
function published_element(btn, published = 0) {
    if (!btn) return null;

    // * si el published es true
    if (published) {
        // * le agregamos la clase "public"
        btn.classList.add("public");
    } else {
        // * le removemos la clase "public"
        btn.classList.remove("public");
    }

    btn.dataset.published = published;
}

// * Peticion http PUT nos permite actualizar el published
async function published_axios(url, params) {
    try {
        const { data } = await axios.put(url, params);
        const message = data.message.message;
        const type = data.message.type;

        toastr[type](message || "La actualización se realizó con exito");

        return data.record;
    } catch (error) {
        let { message } = err.response.data.message;
        toastr[type](message || "La actualización se realizó con exito");

        return null;
    }
}

// * agrega el evento de click al boton publicar proyecto
function published() {
    const btns = document.querySelectorAll(".published_project");

    $(btns).on("click", async (e) => {
        const btn = e.delegateTarget;
        const url = btn.dataset.url;
        const published = Number(btn.dataset.published == 1 ? 0 : 1);

        const params = {
            published,
        };

        load_btn(btn, true);

        const resp = await published_axios(url, params);
        const publisher = resp.published;

        published_element(btn, publisher || 0);

        load_btn(btn, false);
    });
}

// * evento que agrega el evento CLICK al boton "delete project"
function event_delete_project(project_datatable) {
    $(btns_delete_project).on("click", async function (e) {
        const btn = e.delegateTarget;
        const id = btn.dataset.id;
        const url = btn.dataset.url;

        if (!btn || !url) return null;

        load_btn(btn, true);

        if (type_destroy == "delete") {
            // * ALERTA DE CONFIRMACION
            const confirm = await Swal.fire({
                title: "¿Realmente deseas eliminar este proyecto?",
                text: "Al eliminar este proyecto no podrás recuperarlo, ¿realmente deseas eliminar este elemento?",
                icon: "warning",
                showCancelButton: true,
                customClass: {
                    confirmButton: "bg-primary",
                    cancelButton: "bg-light text-dark",
                },
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "Canceclar",
            });

            // * VALIDACION EN CASO DE QUE SE CONFIRME
            if (!confirm.isConfirmed) return null;
        }

        // * ELIMINAMOS PROYECTO (PETICION HTTP)
        const delete_data = await delete_project(url);

        // * SI SE ELIMINA CORRECTAMENTE
        if (delete_data.delete) {
            const row = btn.parentElement.parentElement;
            // * FUNCION PARA ELIMINAR FILA DE LA TABLA DATATABLE
            project_datatable.row(row).remove().draw();

            // * ALERTA DE PROYECTO ELIMINADO CORRECTAMENE
            toastr[delete_data.type_message || "success"](delete_data.message);
        } else {
            toastr[delete_data.type_message || "error"](delete_data.message);
        }

        load_btn(btn, false);
    });
}

async function delete_project(url) {
    if (!url) return null;

    try {
        const { data } = await axios.delete(url);
        return {
            delete: true,
            data: data,
            error: false,
            message: data.message.message || "Eliminado correctamente.",
            type_message: data.message.type || "success",
        };
    } catch (err) {
        console.log(err);
        return {
            delete: false,
            error: err,
            message:
                err.response.data.message?.message ||
                err.response.data.message ||
                "Error",
            type_message: err.response.data.message?.type,
        };
    }
}

// * evento que Restaura un proyecto (lo saca de papelera)
function event_out_trash_project(project_datatable) {
    $(out_trash_project).on("click", async function (e) {
        const btn = e.delegateTarget;
        const id = btn.dataset.id;
        const url = btn.dataset.url;

        if (!btn || !url) return null;

        load_btn(btn, true);

        // * ELIMINAMOS PROYECTO (PETICION HTTP)
        const delete_data = await out_trash_project_async(url);

        // * SI SE ELIMINA CORRECTAMENTE
        if (delete_data.delete) {
            const row = btn.parentElement.parentElement;
            // * FUNCION PARA ELIMINAR FILA DE LA TABLA DATATABLE
            project_datatable.row(row).remove().draw();

            // * ALERTA DE PROYECTO ELIMINADO CORRECTAMENE
            toastr[delete_data.type_message || "success"](delete_data.message);
        } else {
            toastr[delete_data.type_message || "error"](delete_data.message);
        }

        load_btn(btn, false);
    });
}

async function out_trash_project_async(url) {
    if (!url) return null;

    try {
        const { data } = await axios.put(url);
        return {
            delete: true,
            data: data,
            error: false,
            message: data.message.message || "Eliminado correctamente.",
            type_message: data.message.type || "success",
        };
    } catch (err) {
        return {
            delete: false,
            error: err,
            message: err.response.data.message.message,
            type_message: err.response.data.message.type,
        };
    }
}
