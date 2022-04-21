$(function() {

    $(".form_disabled_button_send").on("submit", e => {
        // e.preventDefault();
        let button_submit = e.originalEvent.submitter;

        button_submit.disabled = true;
    });
});