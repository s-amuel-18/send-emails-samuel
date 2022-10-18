function delete_testimony_item_html(btn = null) {
    if (!btn) return null;

    const item = btn.parentElement.parentElement.parentElement.parentElement;

    const container_items = item.parentElement;

    container_items.removeChild(item);
}

function delete_testimony(btn = null) {
    if (!btn) return null;

    btn.disabled = true;

    const url = btn.dataset.url;

    axios
        .delete(url)
        .then((resp) => {
            const { data } = resp;
            const { message } = data;

            toastr.success(message || "Registrado correctamente");

            btn.disabled = false;

            delete_testimony_item_html(btn);
        })
        .catch((err) => {
            console.log(err);
            const { message } = err.response.data;

            toastr.error(message || "Ha ocurrido un error");

            btn.disabled = false;
        });
}
