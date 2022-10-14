// * validacion de formulario *
const form_create_social_media = document.getElementById(
    "form_create_social_media"
);
const select_icon_iconpicker = document.getElementById(
    "select_icon_iconpicker"
);
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
// ...
// * functions end *

// * eventos *

// ? envio de formulario
$(form_create_social_media).on("submit", (e) => {
    e.preventDefault();

    if (!$(form_create_social_media).valid()) return null;

    const form = e.target;
    const url = form.url.value;
    const icon = form.icon.value;

    const params = {
        url,
        icon,
    };

    axios
        .post(data_server["route_create_social_media_async"], params)
        .then((resp) => {
            console.log(resp);
        })
        .catch((err) => {
            console.log(err);
        });
});

$(select_icon_iconpicker).on("change", (e) => {
    const input_select_icon = document.getElementById("input_select_icon");
    const icon = e.icon;

    if (!input_select_icon || !icon) return null;

    input_select_icon.value = icon;
});

// * eventos end *
