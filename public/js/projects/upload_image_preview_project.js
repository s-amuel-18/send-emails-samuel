const form = document.querySelector('#form_new_project')
const tagImage = document.querySelector('#preview_image_front_project')
const inputFile = document.querySelector('#image_front_page')

function create_image(form, img_item) {
    const formData = new FormData(form);
    const file = formData.get(img_item);

    if (!file.size || false) {
        return null;
    }

    const image = URL.createObjectURL(file);

    return image
}


//para poder trocar a imagem antes de enviar
inputFile.addEventListener('change', () => {
    const formData = new FormData(form)
    const img_load = tagImage.dataset.load_img;
    let img = create_image(form, 'image_front_page') || img_load;
    console.log(img);

    tagImage.setAttribute("src", img);
})

// * esto lo podemos integrar cuando enviemos imagenes por ajax
// form.addEventListener('submit', event => {
//     event.preventDefault()
//     const formData = new FormData(event.currentTarget)
//     renderName(formData)
//     // renderImage(formData) //visuzliza apenas depois de
// })



// https://www.youtube.com/watch?v=j8X_BP9Y5VA
