function alertMessage(obj) {
    return `<div class="alert alert-${obj.color} alert-dismissible fade show" role="alert">
            ${obj.text}
            <button style="width: fit-content" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>`;
}

$(function () {
    $("#form_contact").on("submit", function (e) {
        e.preventDefault();
        // console.log(Object.keys($("#form_contact").validate().invalid));
        let validForm = $("#form_contact").valid();
        console.log(validForm);
        if (!validForm /* || grecaptcha.getResponse() == "" */) return false;

        const form = e.target;

        let objParams = {
            nombre: form.nombre.value,
            comment: form.comment.value,
            email: form.email.value,
        };
        console.log(objParams);
        var button_submit = e.originalEvent.submitter;
        button_submit.disabled = true;

        const insert_alert = document.getElementById("insert_alert");

        axios
            .post(dataServer["url_post_contact_message"], objParams)
            .then((resp) => {
                let data = resp.data;
                console.log(data);
                button_submit.disabled = false;

                console.log(data);

                let alertMessageVar = alertMessage({
                    color: "success",
                    text: data.message,
                });

                insert_alert.innerHTML = alertMessageVar;
            })
            .catch((err) => {
                console.log(err);
                let alertMessageVar = alertMessage({
                    color: "danger",
                    text: err.response.data.message,
                });
                insert_alert.innerHTML = alertMessageVar;
                button_submit.disabled = false;
            });
    });
});
