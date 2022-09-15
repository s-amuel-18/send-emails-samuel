// * nos modifica los estilos del boton "publicar proyecto" dependiendo de si esta o no publicado.
function published_element(btn, published = 0) {
    if (!btn) return null;

    // * si el published es true
    if (published) {
        // * le agregamos la clase "public"
        btn.classList.add("public");
    } else {
        // * le removemos la clase "public"
        btn.classList.remove("public");
    }

    btn.dataset.published = published;
}

// * Peticion http PUT nos permite actualizar el published
async function published_axios(url, params) {
    try {
        const { data } = await axios.put(url, params);
        const message = data.message.message;
        const type = data.message.type;

        toastr[type](message || "La actualización se realizó con exito");

        return data.record;
    } catch (error) {
        let { message } = err.response.data.message;
        toastr[type](message || "La actualización se realizó con exito");

        return null;
    }
}

// * agrega el evento de click al boton publicar proyecto
function published() {
    const btns = document.querySelectorAll(".published_project");

    $(btns).on("click", async (e) => {
        const btn = e.delegateTarget;
        const url = btn.dataset.url;
        const published = Number(btn.dataset.published == 1 ? 0 : 1);

        const params = {
            published,
        };

        load_btn(btn, true);

        const resp = await published_axios(url, params);
        const publisher = resp.published;

        published_element(btn, publisher || 0);

        load_btn(btn, false);
    });
}
