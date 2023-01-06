$(function () {
    // This will set `ignore` for all validation calls
    jQuery.validator.setDefaults({
        // This will ignore all hidden elements alongside `contenteditable` elements
        // that have no `name` attribute
        ignore: ":hidden, [contenteditable='true']:not([name])",
    });

    const obj_config = {
        rules: {
            name: {
                required: true,
            },
            category_id: {
                required: true,
            },
            url: {
                required: false,
                url: true,
            },
        },
        messages: {
            name: {
                required:
                    "Introduzca el nombre con el que se identificará el requerimiento.",
            },
            category_id: {
                required: "Seleccione la categoría correspondiente.",
            },
            url: {
                required:
                    "Introduzca una url, es necesaria una url de referencia.",
                url: "Debes introducir una Url valida.",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    };

    // VALIDACION
    $("#form_create_requirement").validate(obj_config);
    $("#form_edit_requirement").validate(obj_config);
});
