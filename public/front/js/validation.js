$(function () {
    // VALIDACION
    $("#form_contact").validate({
        rules: {
            nombre: {
                required: true,
            },
            email: {
                email: true,
                required: true,
            },
            comment: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: "Introducir nombre",
            },
            email: {
                required: "Introduzca la dirección de correo electrónico",
                email: "Ingrese una dirección de correo electrónico válida.",
            },
            comment: {
                required: "Introduzca el mensaje a enviar",
            },
        },
    });
});

