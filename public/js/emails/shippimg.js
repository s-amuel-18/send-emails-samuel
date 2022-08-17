function template(data) {
    return `
    <div class="">
        <div class="">
            <h5 class="font-weight-bold h6">Email</h5>
            <p>${data.email}</p>
        </div>
        <div class="">
            <h5 class="font-weight-bold h6">Usuario Redactor</h5>
            <p>${data.username}</p>
        </div>
        <div class="">
            <h5 class="font-weight-bold h6">Asunto</h5>
            <p>${data.subject ? data.subject : "Sin asunto"}</p>
        </div>
        <div class="">
            <h5 class="font-weight-bold h6">Descripcion</h5>
            <p>${data.body ? data.body : "Sin descripcion"}</p>
        </div>
        <div class="">
            <h5 class="font-weight-bold h6">Fecha de envio</h5>
            <p>${data.created_format}</p>
        </div>
    </div>
    `;
}

function event_detils(select_btn, obj_params_template) {
    const more_details = document.querySelectorAll(select_btn);
    if (!more_details) return null;

    $(more_details).on("click", (e) => {
        const id_shipping = e.delegateTarget.dataset.id;
        const url = e.delegateTarget.dataset.url;
        load_btn(e, true);

        axios
            .get(url)
            .then((resp) => {
                const { data } = resp;

                load_btn(e, false);

                const data_insert = obj_params_template.map((item) => {
                    return {
                        label: item.label,
                        value: data[item.value],
                        element_custom: item.element_custom,
                    };
                });
                insert_data_details.innerHTML = template_info(data_insert);

                $(details_modal).modal("show");
            })
            .catch((err) => {
                console.log(err);
                load_btn(e, false);
            });
    });
}
