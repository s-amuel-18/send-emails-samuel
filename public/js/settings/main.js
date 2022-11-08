$(function () {
    const published_item = document.querySelectorAll(".published_item");

    $(published_item).on("change", (e) => {
        const input_check = e.target;
        const url = input_check.dataset.url;

        if (!url) return null;

        const published = input_check.checked ? 1 : 0;

        axios
            .post(url, { published })
            .then((resp) => {
                const { data } = resp;
                toastr.success(data.message || "Publicado correctamente.");
            })
            .catch((err) => {
                const data = err.response.data;
                const message = data.message;
                toastr.error(message || "Error.");
                input_check.checked = false;
            });
    });
});
