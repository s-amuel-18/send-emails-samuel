function submit_form_requirements(form, alert_element = null) {
    const form_create_requirement = document.querySelector(form);
    const insert_alert_requirements = document.querySelector(alert_element);

    if (!form_create_requirement) return false;

    $(form_create_requirement).on("submit", (e) => {
        e.preventDefault();

        const form = e.target;

        if (!$(form).valid()) return false;

        const submiter = e.target.querySelector("[type='submit']");

        const name = form.name.value;
        const category_id = form.category_id.value;
        const url = form.url.value;
        const description = form.description.value;
        const url_store = form_create_requirement.action;
        const private = form_create_requirement.private;

        let obj_params = {
            name,
            category_id,
            url,
            description: description.length > 0 ? description : null,
        };

        if (private) {
            obj_params["private"] = private.checked ? 1 : 0;
        }

        load_btn(submiter, true);

        axios
            .post(url_store, obj_params)
            .then((resp) => {
                const { data } = resp;
                console.log(data);
                if (insert_alert_requirements) {
                    const message = data.message;
                    let template_alert = alert_message(message, "success");
                    insert_alert_requirements.innerHTML = template_alert;
                }

                datatable.ajax.reload();

                load_btn(submiter, false);

                $("#edit_select_category_id").val("").trigger("change");
                form.reset();
                $(summernote).summernote("reset");
            })
            .catch((err) => {
                const data = err.response.data;

                let errors = [];

                for (const key in data.errors) {
                    if (Object.hasOwnProperty.call(data.errors, key)) {
                        const element = data.errors[key];
                        element.forEach((el) => {
                            errors.push(el);
                        });
                    }
                }

                if (insert_alert_requirements) {
                    const message = data.message;
                    console.log(message);
                    let template_alert = alert_message(
                        message,
                        "danger",
                        errors
                    );
                    insert_alert_requirements.innerHTML = template_alert;
                }

                load_btn(submiter, false);

                console.log(err);
            });
    });
}
