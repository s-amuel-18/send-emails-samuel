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

function load_btn(e, load = false) {
    const more_details = e.delegateTarget;
    const load_item = more_details.querySelector(".load_item");
    const details_mormal = more_details.querySelector(".details_mormal");

    if (!load_item || !details_mormal) return false;

    if (load) {
        details_mormal.classList.add("d-none");
        load_item.classList.remove("d-none");
    } else {
        details_mormal.classList.remove("d-none");
        load_item.classList.add("d-none");
    }

    more_details.disabled = load;
    return load;
}

function event_detils() {
    const more_details = document.querySelectorAll(".more_details");

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

                insert_data_details.innerHTML = template(data);

                $(details_modal).modal("show");
            })
            .catch((err) => {
                console.log(err);
                load_btn(e, false);
            });
    });
}
