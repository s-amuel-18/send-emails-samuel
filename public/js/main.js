$(function () {
    // inicializar select2
    $(".select2").select2();

    // funcion para envio de formulario
    $(function () {
        $(".form_disabled_button_send").on("submit", function (e) {
            // e.preventDefault();
            var button_submit = e.originalEvent.submitter;
            button_submit.disabled = true;
        });
    });
});
