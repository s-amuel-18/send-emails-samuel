function load_btn(btn, load = false) {
    const btn_load = btn;
    const load_item = btn_load.querySelector(".load_item");
    const normal_item = btn_load.querySelector(".normal_item");

    if (!load_item || !normal_item) return false;

    if (load) {
        normal_item.classList.add("d-none");
        load_item.classList.remove("d-none");
    } else {
        normal_item.classList.remove("d-none");
        load_item.classList.add("d-none");
    }

    btn_load.disabled = load;
    return load;
}

function alert_message(message = null, color = "light", list_arr = null) {
    if (!message) return false;

    let template_list = ``;

    if (list_arr) {
        let list = ``;

        list_arr.forEach((item) => {
            list += `<li>${item}</li>`;
        });

        template_list = `<ul>${list}</ul>`;
    } else {
        template_list = ``;
    }

    let template = `
    <div class="alert alert-${color} alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        ${message}
        ${template_list}
        </div>
    `;

    return template;
}

function delete_child(child) {
    const parent = child.parentElement;
    parent.removeChild(child);
}

function newTap(url = null) {
    if (!url) return null;
    // Abrir nuevo tab
    var win = window.open(url, "_blank");
    // Cambiar el foco al nuevo tab (punto opcional)
    win.focus();
}

function disabled_element(element, disabled = false) {
    if (!element) return false;

    if (disabled) {
        element.classList.add("disabled");
    } else {
        element.classList.remove("disabled");
    }

    element.disabled = disabled;
}

function edit_inline_input() {
    const edit_inline_input = document.querySelectorAll(".edit_inline_input");

    $(edit_inline_input).on("keyup", (e) => {
        const input = e.target;
        const url = input.dataset.url || null;
        const element_obj = input.dataset.element_obj || null;

        if (!url || !element_obj) {
            console.log("faltan argumentos");
            return null;
        }

        // *  detectamos si la tecla ENTER fue precionada
        // * - Esto se realiza para que el evento de actualizacion solo se realice cuando se preciona la TECLA ENTER
        if (e.which != 13) return null; //! salimos de la funcion

        // ? enviamos los datos que se desan actualizar
        let params = {
            [element_obj]: input.value,
        };
        console.log(params);
        // return null;
        axios
            .patch(url, params)
            .then((resp) => {
                const { data } = resp;

                toastr.success(
                    data.message || "La actualización se realizó con exito"
                );

                console.log(data);
            })
            .catch((err) => {
                console.log(err);
                let message = err.response.data.message;
                Swal.fire(
                    "Error",
                    message || "Ha ocurrido un error, intentalo mas tarde",
                    "error"
                );
            });
    });

    $(edit_inline_input).on("blur", (e) => {
        const input = e.target;
        const value_init = input.dataset.value_init || null;

        // * validamos que el elemento tenga un valor inicial por defecto
        if (!value_init) return null; // ! no tiene valor iniciañ

        input.value = value_init; // * asignamos ese valor incial al input en caso de que no se halla actualizado.
    });
}

function pagination_async(
    selector_element = null,
    function_them = null,
    function_catch = null
) {
    if (selector_element) return null;

    const container_pagination = document.querySelector(selector_element);

    if (!container_pagination) {
        console.error(
            "No se encontró elemento con selector 'selector_element'"
        );
    }

    $(container_pagination).on("click", (e) => {
        if (
            e.target.classList.contains("page-link") &&
            !e.target.classList.contains("active")
        ) {
            e.preventDefault();

            const btn = e.target;
            const url = btn.href;

            axios
                .get(url)
                .then((resp) => {
                    function_them(resp);
                })
                .catch((err) => {
                    function_catch(err);
                });
        }
    });
}
