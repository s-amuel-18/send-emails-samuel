function load_btn(btn, load = false) {
    const btn_load = btn;
    const load_item = btn_load.querySelector(".load_item");
    const normal_item = btn_load.querySelector(".normal_item");

    if (!load_item || !normal_item) return false;

    if (load) {
        normal_item.classList.add("d-none");
        load_item.classList.remove("d-none");
    } else {
        normal_item.classList.remove("d-none");
        load_item.classList.add("d-none");
    }

    btn_load.disabled = load;
    return load;
}

function alert_message(message = null, color = "light", list_arr = null) {
    if (!message) return false;

    let template_list = ``;

    if (list_arr) {
        let list = ``;

        list_arr.forEach((item) => {
            list += `<li>${item}</li>`;
        });

        template_list = `<ul>${list}</ul>`;
    } else {
        template_list = ``;
    }

    let template = `
    <div class="alert alert-${color} alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        ${message}
        ${template_list}
        </div>
    `;

    return template;
}
