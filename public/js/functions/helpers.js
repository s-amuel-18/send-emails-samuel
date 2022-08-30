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

function delete_child(child) {
    const parent = child.parentElement;
    parent.removeChild(child);
}

function newTap(url = null) {
    if (!url) return null;
    // Abrir nuevo tab
    var win = window.open(url, "_blank");
    // Cambiar el foco al nuevo tab (punto opcional)
    win.focus();
}

function disabled_element(element, disabled = false) {
    if (!element) return false;

    if (disabled) {
        element.classList.add("disabled");
    } else {
        element.classList.remove("disabled");
    }

    element.disabled = disabled;
}

function edit_inline_input() {
    const edit_inline_input = document.querySelectorAll(".edit_inline_input");

    $(edit_inline_input).on("change", (e) => {
        const input = e.target;
        const url = input.dataset.url || null;
        const element_obj = input.dataset.element_obj || null;

        if (!url || !element_obj) return null;

        console.log(url, element_obj);
    });
}
