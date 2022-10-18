$(function () {
    // * input donde se sube la img del logo
    const input_logo = document.getElementById("input_logo");
    const preview_logo = document.getElementById("preview_logo");
    const btn_label_input_logo = document.querySelector(
        "label[for='input_logo']"
    );

    function uploading_img(uploading = false) {
        const btn_disabled = btn_label_input_logo.nextElementSibling;

        if (!btn_disabled && !btn_disabled.classList.contains("load_btn"))
            return null;

        if (uploading) {
            btn_label_input_logo.classList.add("d-none");
            btn_disabled.classList.remove("d-none");
        } else {
            btn_label_input_logo.classList.remove("d-none");
            btn_disabled.classList.add("d-none");
        }
    }

    // * evento al subir la img del logo
    $(input_logo).on("change", (e) => {
        const form_upload_logo = document.getElementById("form_upload_logo");

        // * validar si existe el formulario y si el input está vacio
        if (!form_upload_logo || !e.target.value) return null;

        uploading_img(true);

        // * crear form data
        const formData = new FormData(form_upload_logo);

        axios
            .post(data_server["route_upload_logo_async"], formData)
            .then((resp) => {
                uploading_img(false);

                // * mensaje del servidor
                const { message } = resp.data;

                toastr.success(message || "Subido correctamente");
            })
            .catch((err) => {
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

                const imgload = preview_logo.dataset.load_img;
                if (imgload) {
                    preview_logo.src = imgload;
                }

                uploading_img(false);
            });
    });
});
