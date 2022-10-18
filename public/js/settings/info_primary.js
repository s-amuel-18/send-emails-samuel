$(function () {
    const inputs_info = document.querySelectorAll(
        ".event_input_change_info_primary"
    );

    $(inputs_info).on("change", (e) => {
        const inputs_arr = Array.from(inputs_info);

        if (inputs_arr.length < 1) return null;

        const params = {};

        inputs_arr.forEach((inp) => {
            if (inp.name && inp.value) {
                params[inp.name] = inp.value;
            }
        });

        axios
            .post(data_server["route_info_primary_async"], params)
            .then((resp) => {
                const { data } = resp;
                const { message } = data;
                toastr.success(message || "Registrado con exito");
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
            });
    });
});
