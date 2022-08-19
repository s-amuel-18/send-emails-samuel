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
                required: true,
                url: true,
            },
        },
        messages: {
            name: {
                required: "El nombre es requerído",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback d-none");
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
    $("#form_create_category").validate(obj_config);
});
