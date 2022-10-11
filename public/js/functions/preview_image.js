function create_image(form, img_item) {
    const formData = new FormData(form);
    const file = formData.get(img_item);

    if (!file.size || false) {
        return null;
    }

    const image = URL.createObjectURL(file);

    return image;
}

function event_change_imput_file(form, tagImage) {
    // * para poder trocar a imagem antes de enviar
    const input_file = document.querySelectorAll(".listener_input_file");

    // * evento de cambio de imagen
    $(input_file).on("change", (e) => {
        const input = e.target;

        if (!input.value) return null;

        // * extraemos el data que contiene el id del form
        const idForm = input.dataset.id_form || null;
        // * extraemos el data que contiene el id de la img donde se va a previsualizar la imagen
        const idImg = input.dataset.id_img || null;

        // * validamos que esxistan estos data
        if (!idForm || !idImg) return null;

        const form = document.querySelector("#" + idForm);
        const tagImage = document.querySelector("#" + idImg);

        // * validamos que los elementos realmente existan en el html
        if (!form || !tagImage) return null;

        // * creamos el form data
        const formData = new FormData(form);

        // * extraemos el data load_img
        const img_load = tagImage.dataset.load_img || "";

        // * llamamos a la funcion que nos entrega la url de la imagen
        let img = create_image(form, "image") || img_load;

        // * agregamos la url de la imagen al scr
        tagImage.setAttribute("src", img);
    });
}

// * esto lo podemos integrar cuando enviemos imagenes por ajax
// form.addEventListener('submit', event => {
//     event.preventDefault()
//     const formData = new FormData(event.currentTarget)
//     renderName(formData)
//     // renderImage(formData) //visuzliza apenas depois de
// })

// https://www.youtube.com/watch?v=j8X_BP9Y5VA
event_change_imput_file();
