$(function () {
    let img_front_exist = document.getElementById("img_front_exist");

    // * de esta forma se tomaran todos los input asta los que sean display none
    // ! en caso de no usarlo pueden ocurrir errores con los inputs que sean display none
    $.validator.setDefaults({
        ignore: [],
    });

    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            if (!img_front_exist || element.value) {
                return this.optional(element) || element.files[0].size <= param;
            }
            return true;
        },
        "El peso de la imagen sobre pasa el limite {0}"
    );
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
                required: (element) => {
                    return !img_front_exist;
                },
                extension: "jpg,jpeg,png",
                filesize: 4000000,
            },
            "images[]": {
                required: true,
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
    const form_valid = $("#form_new_project").validate(obj_config);

    $(description_project).summernote();
});
