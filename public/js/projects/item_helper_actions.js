function template_item_helper(number) {
    if (!number) return null;

    return `
    <div class="item_help_project" data-number_item="${number}">
        <div class="row ">
            <div class="col-4 form-group">
                <input required type="text" class="form-control form-control-sm"
                    name="item_help[name][${number}]" placeholder="Nombre artículo"
                    >
            </div>
            <div class="col-4 form-group">
                <input required type="text" class="form-control form-control-sm"
                    placeholder="Descripción artículo" name="item_help[description][${number}]"
                    >
            </div>
            <div class="col-3 form-group">
            <select required class="form-control form-control-sm"
                name="item_help[template][${number}]" id="">
                <option value="">Plantilla</option>
                <option value="<a href='%item%'>%item%</a>">Link</option>
                <option value="<p class='mb-0'>%item%</p>">Parrafo</option>
            </select>
            </div>
            <div class="col-1">
                <button class="delete_item_helper_project w-100 btn btn-outline-danger btn-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    `;
}

function event_delete_item_helper() {
    const delete_item_helper_project = document.querySelectorAll(
        ".delete_item_helper_project"
    );

    $(delete_item_helper_project).on("click", (e) => {
        const btn = e.delegateTarget;
        const item = btn.parentElement.parentElement.parentElement;
        const parent = item.parentElement;
        parent.removeChild(item);
    });
}

$(function () {
    const item_helper_project = document.getElementById("item_helper_project");
    const insert_items_help_project = document.getElementById(
        "insert_items_help_project"
    );

    $(item_helper_project).on("click", (e) => {
        // * determinamos cuantos itmes tenemos
        const item_help_project =
            document.querySelectorAll(".item_help_project");

        const count_items = item_help_project.length;

        const template = template_item_helper(count_items + 1);
        insert_items_help_project.innerHTML += template;

        event_delete_item_helper();
    });

    event_delete_item_helper();
});
