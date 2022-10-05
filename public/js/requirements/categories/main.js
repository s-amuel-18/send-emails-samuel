const category_delete = document.querySelectorAll(".category_delete");
const confir_delete_category = document.querySelectorAll(
    ".confir_delete_category"
);
const cancel_delete_category = document.querySelectorAll(
    ".cancel_delete_category"
);

const form_create_category = document.getElementById("form_create_category");

$(async function () {
    event_ahow_confirm_delete();
    cancel_delete_category_func();
    delete_category();
    await update_category();
});

$(function () {
    if (!form_create_category) return false;

    $(form_create_category).on("submit", async (e) => {
        e.preventDefault();

        const form = e.target;

        if (!$(form).valid()) return false;

        const url = form.action;
        const btn = document.querySelector("#submit_form_create_category");

        const data_insert = {
            name: form.name.value,
            type: category_type,
        };

        load_btn(btn, true);

        await post_category(url, data_insert);

        load_btn(btn, false);
        form.reset();
    });
});
