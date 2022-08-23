function there_are_no_categories() {
    Swal.fire({
        title: "No hay categorías",
        text: "No tienes categorias registradas para los requerimientos, registra una categoría para poder crear un nuevo requerimiento",
        icon: "warning",
        customClass: {
            confirmButton: "bg-primary",
            cancelButton: "bg-light text-dark",
        },
    });
}

function add_categories_select2(select) {
    if (!select) return false;

    $(select).empty();

    requirements_categories.forEach((cat) => {
        let data = {
            id: cat.id,
            text: cat.name,
        };

        var newOption = new Option(data.text, data.id, false, false);
        $(select).append(newOption);
    });

    $(select).val(null).trigger("change");
}

function select2_categories_update() {
    const select2_categories = document.querySelectorAll(".select2_categories");

    select2_categories.forEach((select) => {
        add_categories_select2(select);
    });
}

function add_categorie_arr(categorie) {
    const categirie = categorie;
    requirements_categories = [...requirements_categories, categirie];
    select2_categories_update();
    return requirements_categories;
}

function remove_cateogire_arr(categorie_id) {
    const cat_find = requirements_categories.filter((cate) => {
        return cate.id != categorie_id;
    });

    requirements_categories = [...cat_find];
    select2_categories_update();
    return requirements_categories;
}

function update_categorie_arr(categorie_id, new_categore) {
    // console.log(categorie_id);
    // console.log(new_categore);
    // return false;

    remove_cateogire_arr(categorie_id);
    add_categorie_arr(new_categore);
    select2_categories_update();
}
