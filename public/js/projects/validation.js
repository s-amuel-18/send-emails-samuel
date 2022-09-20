$(function () {
    // * de esta forma se tomaran todos los input asta los que sean display none
    // ! en caso de no usarlo pueden ocurrir errores con los inputs que sean display none
    $.validator.setDefaults({
        ignore: []
    });
    const obj_config = {
        rules: {
            name: {
                required: true,
            },
            "categories[]": {
                required: true,
            },
            description: {
                required: true,
            },
            image_front_page: {
                required: true,
            },
            "images[]": {
                required: true,
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            console.log(element);
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
    const form_valid = $("#form_new_project").validate(obj_config);

    $(description_project).summernote({
        callbacks: {
            onChange: function (contents, $editable) {

                $(description_project).val($(description_project).summernote('isEmpty') ? "" : contents);

                form_valid.element($(description_project));
            }
        }
    });
});


