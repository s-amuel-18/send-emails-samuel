$(function () {
    const form_send_emails = document.getElementById("form_send_emails");

    form_send_emails.addEventListener("submit", async (e) => {
        e.preventDefault();
        let validForm =
            Object.keys($(form_send_emails).validate().invalid).length > 0
                ? true
                : false;

        if (validForm) return false;

        const submiter = e.submitter;

        submiter.disabled = true;

        const params = {
            subject: e.target.subject.value,
            body_email: e.target.body_email.value,
        };

        const resp = await send_emails(urlHttpSendEmail, params, submiter);
        submiter.disabled = false;
    });
});
