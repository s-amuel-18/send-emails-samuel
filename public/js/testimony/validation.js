// form_create_testimony
$(function () {
    // VALIDACION
    // * de esta forma se tomaran todos los input asta los que sean display none
    // ! en caso de no usarlo pueden ocurrir errores con los inputs que sean display none
    $.validator.setDefaults({
        ignore: [],
    });
    $("#form_create_testimony").validate({
        rules: {
            name: {
                required: true,
            },
            position: {
                required: true,
            },
            rating: {
                required: true,
            },
            title: {
                required: true,
            },
            review: {
                required: true,
            },
        },
        errorElement: "span",
        errorClass: "invalid-feedback",
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
        },
    });
});
