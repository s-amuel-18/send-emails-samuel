$("#form_contact").on("submit", function (e) {
    let validForm =
        Object.keys($("#form_contact").validate().invalid).length > 0
            ? true
            : false;

    if (validForm) return false;

    if (grecaptcha.getResponse() == "") {
        e.preventDefault();
        alert("Falta verificación recaptcha");
    } else {
        alert("Gracias por contactarnos");
    }
});
