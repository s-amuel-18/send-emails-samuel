// * validacion de formulario *
const form_create_social_media = document.getElementById(
    "form_create_social_media"
);
const select_icon_iconpicker = document.getElementById(
    "select_icon_iconpicker"
);
const insert_items_social_media = document.getElementById(
    "insert_items_social_media"
);
const create_social_media = document.getElementById("create_social_media");

$(function () {
    // * de esta forma se tomaran todos los input asta los que sean display none
    // ! en caso de no usarlo pueden ocurrir errores con los inputs que sean display none
    $.validator.setDefaults({
        ignore: [],
    });

    const obj_config = {
        rules: {
            url: {
                required: true,
                url: true,
            },
        },
        errorClass: "invalid-feedback",
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    };

    // * VALIDACION
    const form_valid = $(form_create_social_media).validate(obj_config);
});

// * validacion de formulario end*

// * functions *
function template_social_media(social_media_data) {
    return `
    <div class="mb-3 row no-guetters" data-id="${social_media_data.id}" id="social_media_${social_media_data.id}"
    >
        <div class="col-4 col-sm-3 col-lg-2  ">
            <a href="${social_media_data.url}" target="_blanck" class="btn-sm btn btn-secondary w-100">
                <i class="${social_media_data.icon} icon_social"></i>
            </a>
        </div>

        <div class="d-flex align-items-center col-2 col-sm-3 col-lg-6 col-xl-8" style="overflow: hidden">
            <p class="mb-0 url_social" style="white-space: nowrap">${social_media_data.url}</p>
        </div>

        <div class="col-3 col-lg-2 col-xl-1">
            <button class="update_social_media w-100 btn-sm btn btn-outline-success" type="button"
                data-url="${social_media_data.routeGetSocialMedia}">
                <i class="fa fa-edit"></i>
            </button>
        </div>
        <div class="col-3 col-lg-2 col-xl-1">
            <button class="delete_social_media w-100 btn-sm btn btn-outline-danger" type="button"
                data-url="${social_media_data.routeDelete}">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
    `;
}

function insert_data_update_in_form(social_media_data) {
    if (!form_create_social_media) return null;

    const icon = social_media_data.icon || "fab fa-facebook";

    form_create_social_media.action =
        social_media_data.routeUpdate ||
        data_serverz["route_create_social_media_async"];

    form_create_social_media.url.value = social_media_data.url || "";
    form_create_social_media.icon.value = icon;
    form_create_social_media.id_social_media.value = social_media_data.id || 0;

    $(select_icon_iconpicker).iconpicker("setIcon", icon);
}

function event_delete_social_media() {
    const delete_social_media = document.querySelectorAll(
        ".delete_social_media"
    );

    $(delete_social_media).on("click", (e) => {
        const btn = e.delegateTarget;
        const url = btn.dataset.url;

        if (!url) return null;
        btn.disabled = true;

        axios
            .delete(url)
            .then((resp) => {
                const { data } = resp;
                const { message } = data;
                toastr.success(message || "Registrado eliminado correctamente");
                btn.disabled = false;

                const element_remove = btn.parentElement.parentElement;
                const parent_items = element_remove.parentElement;

                parent_items.removeChild(element_remove);
            })
            .catch((err) => {
                btn.disabled = false;

                const data = err.response.data;
                const message = data.message;

                toastr.success(message || "Ha ocurrido un error");

                console.log(err);
            });
    });
}

function event_update_social_media() {
    const update_social_media = document.querySelectorAll(
        ".update_social_media"
    );

    $(update_social_media).on("click", (e) => {
        const btn = e.delegateTarget;
        const url = btn.dataset.url;

        if (!url) return null;

        btn.disabled = true;

        axios
            .get(url)
            .then((resp) => {
                const { data } = resp;
                const { social_media } = data;

                insert_data_update_in_form(social_media);

                btn.disabled = false;
            })
            .catch((err) => {
                btn.disabled = false;

                const data = err.response.data;
                const message = data.message;

                toastr.error(message || "Ha ocurrido un error");

                console.log(err);
            });
    });
}

function reset_form_create_social() {
    const icon = "fab fa-facebook";
    const action_url = form_create_social_media.dataset.action_default;

    $(select_icon_iconpicker).iconpicker("setIcon", icon);
    form_create_social_media.reset();
    form_create_social_media.icon.value = icon;
    form_create_social_media.action = action_url;
}

// * functions end *

// * eventos *

// ? envio de formulario
$(form_create_social_media).on("submit", (e) => {
    e.preventDefault();

    if (
        !$(form_create_social_media).valid() ||
        form_create_social_media.action.length < 1
    )
        return null;

    const form = e.target;
    const url = form.url.value;
    const icon = form.icon.value;
    const method = form.id_social_media.value == 0 ? "post" : "put";

    const params = {
        url,
        icon,
    };

    create_social_media.disabled = true;

    axios[method](form.action, params)
        .then((resp) => {
            const { data } = resp;
            const { message } = data;

            if (form_create_social_media.id_social_media.value == 0) {
                $(insert_items_social_media).append(
                    template_social_media(data.social_media)
                );

                event_delete_social_media();
                event_update_social_media();
            } else {
                const id_social =
                    form_create_social_media.id_social_media.value;
                const element_item = document.getElementById(
                    "social_media_" + id_social
                );

                const icon_element = element_item.querySelector(".icon_social");
                const parent_icon_element = icon_element.parentElement;
                parent_icon_element.href = data.social_media.url;
                $(parent_icon_element).html(
                    "<i class='" + data.social_media.icon + " icon_social'></i>"
                );

                const url_element = element_item.querySelector(".url_social");
                url_element.textContent = data.social_media.url;

                form_create_social_media.id_social_media.value = 0;
            }

            reset_form_create_social();

            toastr.success(message || "Registrado con exito");
            create_social_media.disabled = false;
        })
        .catch((err) => {
            console.log(err);

            create_social_media.disabled = false;

            const data = err.response.data;
            const message = data.message;
            let errors = "";

            for (const key in data.errors) {
                if (Object.hasOwnProperty.call(data.errors, key)) {
                    const element = data.errors[key];
                    element.forEach((el) => {
                        errors += el + "\n";
                    });
                }
            }

            toastr.error(message + ", " + errors || "Ha ocurrido un error");
        });
});

// ? icon event
$(select_icon_iconpicker).on("change", (e) => {
    const input_select_icon = document.getElementById("input_select_icon");
    const icon = e.icon;

    if (!input_select_icon || !icon) return null;

    input_select_icon.value = icon;
});

// * eventos end *

// * ejecucion de funcion para eliminar redes sociales
event_delete_social_media();
event_update_social_media();
