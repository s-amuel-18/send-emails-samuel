$(function () {
    const testimony_modal = document.getElementById("testimony");
    const insert_review = document.getElementById("insert_review");
    $(testimony_modal).on("show.bs.modal", (e) => {
        const relatedTarget = e.relatedTarget;

        if (!relatedTarget.classList.contains("show_testimony_btn"))
            return null;

        const btn = relatedTarget;
        const url = btn.dataset.url;

        axios
            .get(url)
            .then((resp) => {
                const { data } = resp;
                const { review } = data.testimony;

                insert_review.textContent = review || "Sin descripcion";
            })
            .catch((err) => {
                console.log(err);
            });
    });
});
