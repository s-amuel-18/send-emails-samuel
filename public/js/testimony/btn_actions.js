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
