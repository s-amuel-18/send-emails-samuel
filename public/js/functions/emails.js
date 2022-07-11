function show_loader_sende() {
    const send_emails_loader = document.getElementById("send_emails_loader");
    const send_emails_progress = document.getElementById("send_emails_progress");
    const send_emails_progress_text = document.getElementById("send_emails_progress_text");

    if (send_emails_loader) {
        if (!send_emails_loader.classList.contains("loading-show")) {
            send_emails_loader.classList.remove("loading-hidden")
            send_emails_loader.classList.add("loading-show")
        }
    }
}

function hide_loader_sende() {
    const send_emails_loader = document.getElementById("send_emails_loader");
    const send_emails_progress = document.getElementById("send_emails_progress");
    const send_emails_progress_text = document.getElementById("send_emails_progress_text");
    if (send_emails_loader) {
        if (send_emails_loader.classList.contains("loading-show")) {
            send_emails_loader.classList.remove("loading-show")
            send_emails_loader.classList.add("loading-hidden")
        }
    }
}



async function send_emails(url = null, params, submiter = null) {
    const insert_text_error = document.getElementById("insert_text_error");
    const select_alert_new_email = document.getElementById("select_alert_new_email");
    const emails_sent_today = document.querySelector("#emails_sent_today .inner h3");


    if (!url) {
        alert("No se pasó parametro 'url' en la funcion 'send_emails'");
    }

    try {
        show_loader_sende()
        const resp = await axios.post(url, params);

        const data = resp.data;

        console.log(resp);

        if (emails_sent_today && data.emails_sent_today) {

            emails_sent_today.textContent = data.emails_sent_today;
        }


        if (insert_text_error) {
            insert_text_error.textContent = "";
        }

        if (data.success_email_send) {

            if (send_emails_progress && data.percentage) {
                send_emails_progress.style.width = data.percentage + "%";
            }
            if (send_emails_progress_text && data.percentage) {
                send_emails_progress_text.textContent = data.percentage + "%";
            }
            insert_text_error.textContent = "";
            send_emails(url, params);
        } else {
            hide_loader_sende()

            if (submiter) {
                submiter.disabled = false;
            }

            insert_text_error.textContent = data.message.message;

            if (data.times_last_email) {
                select_alert_new_email.classList.add("d-none")
                counter(data.times_last_email);

            }



            return resp;
        }
    } catch (err) {

        console.log(err);
        if (insert_text_error) {
            // let message_error = err.response.data.message;
            // insert_text_error.textContent = message_error;
        }
        // console.log(JSON.stringify(err));

    }


}
