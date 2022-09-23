$(function () {
    // inicializar select2
    $(".select2").select2();

    // * funcion para envio de formulario
    $(function () {
        $(".form_disabled_button_send").on("submit", function (e) {
            // * VALIDAR FORM
            if (!$(e.target).valid()) return null;

            var button_submit = e.originalEvent.submitter;
            button_submit.disabled = true;
        });
    });
});
