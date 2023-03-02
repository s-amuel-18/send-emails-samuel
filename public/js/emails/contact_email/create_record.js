$(function () {
    const contact_email = document.getElementById("contact_email");
    const error_msg_email = document.getElementById("error_msg_email");
    // const form = document.querySelector("#create_contact");
    // const submit_contact_form = document.querySelector("#submit_contact_form");
    let form_valid = true;

    $(contact_email).on("change", (e) => {
        const value = contact_email.value;
        if (value.length < 1) {
            $(contact_email).removeClass("is-valid");
            $(contact_email).removeClass("is-invalid");
            return false;
        }

        axios.get(appData.url_exist_email + "?email=" + value).then((resp) => {
            const data = resp.data;
            if (!data.contact_data) {
                form_valid = true;
                $(contact_email).addClass("is-valid");
                $(contact_email).removeClass("is-invalid");
                $(error_msg_email).addClass("d-none");
                $(error_msg_email).removeClass("d-block");
                error_msg_email.innerHTML = "";
                return null;
            }

            form_valid = false;
            $(contact_email).addClass("is-invalid");
            $(error_msg_email).removeClass("d-none");
            $(error_msg_email).addClass("d-block");
            error_msg_email.innerHTML =
                "<strong>El email ya está registrado</strong>";
        });
    });
});
