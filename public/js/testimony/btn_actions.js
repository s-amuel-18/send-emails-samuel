function delete_testimony_item_html(btn = null) {
    if (!btn) return null;

    const item = btn.parentElement.parentElement.parentElement.parentElement;

    const container_items = item.parentElement;

    container_items.removeChild(item);
}

async function delete_testimony(btn = null) {
    if (!btn) return null;

    // * ALERTA DE CONFIRMACION
    const confirm = await Swal.fire({
        title: "¿Realmente deseas eliminar este testimonio?",
        text: "Al eliminar este testimonio no podrás recuperarlo, ¿realmente deseas eliminar este testimonio?",
        icon: "warning",
        showCancelButton: true,
        customClass: {
            confirmButton: "bg-primary",
            cancelButton: "bg-light text-dark",
        },
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Canceclar",
    });

    // * VALIDACION EN CASO DE QUE SE CONFIRME
    if (!confirm.isConfirmed) {
        return null;
    }

    btn.disabled = true;

    const url = btn.dataset.url;

    axios
        .delete(url)
        .then((resp) => {
            const { data } = resp;
            const { message } = data;

            toastr.success(message || "Eliminado correctamente");

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

// * esta funcion nos permite guardar en la base de datos que la url ya ha sido copiada
function copy_url_testimony(element) {
    const btn = element;
    const url = btn.dataset.url;
    const clipboard_target = btn.dataset.clipboardTarget;
    const input_url = document.querySelector(clipboard_target);

    btn.disabled = true;

    if (!url || !input_url) return null;

    axios
        .put(url)
        .then((resp) => {
            const { data } = resp;
            const { testimony_request } = data;

            btn.dataset.url = testimony_request.route_update_send;
            input_url.value = testimony_request.route_testimony_token;

            btn.disabled = false;
        })
        .catch((err) => {
            console.log(err);
            btn.disabled = false;
        });
}
