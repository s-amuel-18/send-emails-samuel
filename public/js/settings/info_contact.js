$(function () {
    const form_info_contact = document.getElementById("form_info_contact");
    const form_submit_info_contact = document.getElementById(
        "form_submit_info_contact"
    );

    // * de esta forma se tomaran todos los input asta los que sean display none
    // ! en caso de no usarlo pueden ocurrir errores con los inputs que sean display none
    $.validator.setDefaults({
        ignore: [],
    });

    const obj_config = {
        rules: {
            location: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone: {
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
    };

    // * VALIDACION
    const form_valid = $(form_info_contact).validate(obj_config);

    $(form_info_contact).on("submit", (e) => {
        e.preventDefault();

        if (!$(form_info_contact).valid()) return null;
        form_submit_info_contact.disabled = true;
        const form = e.target;

        const params = {
            location: form.location.value,
            email: form.email.value,
            phone: form.phone.value,
        };

        axios
            .post(data_server["route_contact_info_async"], params)
            .then((resp) => {
                const { data } = resp;
                const { message } = data;
                toastr.success(message || "Registrado con exito");

                form_submit_info_contact.disabled = false;
            })
            .catch((err) => {
                console.log(err);

                const data = err.response.data;
                const message = data.message;
                let errors = "";

                for (const key in data.errors) {
                    if (Object.hasOwnProperty.call(data.errors, key)) {
                        const element = data.errors[key];
                        element.forEach((el) => {
                            errors += el + "\n";
                        });
                    }
                }

                toastr.error(message + ", " + errors || "Ha ocurrido un error");

                form_submit_info_contact.disabled = false;
            });
    });
});
