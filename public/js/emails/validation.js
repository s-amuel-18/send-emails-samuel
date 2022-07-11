$(function () {
    // $.validator.setDefaults({
    //     submitHandler: async function (e) {
    //         // e.preventDefault();
    //         console.log(e.submit = false);
    //         return false;

    //         // const submiter = e.submitter;

    //         // submiter.disabled = true;

    //         // const params = {
    //         //     subject: e.target.subject.value,
    //         //     body_email: e.target.body_email.value,
    //         // };

    //         // const resp = await send_emails(urlHttpSendEmail, params, submiter);

    //     }
    // });

    // VALIDACION
    $("#form_send_emails").validate({
        rules: {
            subject: {
                required: true,
            },
            body_email: {
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
    });
});
