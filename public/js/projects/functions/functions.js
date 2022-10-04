// * NOS PERMITE SABER SI EL INPUT QUE CONTIENE EL ID DEL PROJECTO REALMENTE TIENE UN ID VALIDO
// ? ESTO NOS SIRVE PAAR SABER SI ESTAMOS ACTUALIZANDO UN PROYECTO O LO ESTAMOS CREANDO
function get_project_id() {
    // * INPUT QUE CONTIENE EL ID DEL PROYECTO
    const element_project_id = document.getElementById("project_id");

    // * VALIDAMOS QUE EL ELEMENTO EXISTA
    if (!element_project_id) return null;

    // * RETORNAMOS EL VALOR DEL INPUT
    return element_project_id.value;
}

// * NOS PERMITE CAMBIAR EL VALOR DEL INPUT QUE CONTIENE EL ID DEL PROYECTO
function set_project_id(value_input = null) {
    // * INPUT QUE CONTIENE EL ID DEL PROYECTO
    const element_project_id = document.getElementById("project_id");

    // * VALIDAMOS QUE EL ELEMENTO EXISTA
    if (!element_project_id || !value_input) return null;

    // * CAMBIAMOS EL VALOR DEL INPUT POR EL PARAMETRO ENVIADO
    element_project_id.value = value_input;

    return true;
}

// * AGREGA UN EVENTO "CHANGE" A TODOS LOS ELEMENTOS QUE TENGAN LA CLASE "element_insert_data_async"
// ? ESTO NOS PERMITE GUARDAR REGISTROS CADA VEZ QUE CAMBIE DE VALOR UN INPUT
function event_element_insert_data_async() {
    // * ELEMENTOS AL QUE LE CAPTURAREMOS EL EVENTO CHANGE
    const element_insert_data_async = document.querySelectorAll(
        ".element_insert_data_async"
    );

    // * VALIDAMOS QUE HALLA AL MENOS UN ELEMENTO
    if (element_insert_data_async.length < 1) return null;

    // * EVENTO CHANGE
    $("#name_project").on("change", (e) => {
        // * FUNCION QUE MANDA LOS DATOS DE LOS INPUTS
        post_data_project(element_insert_data_async);
    });

    $("#categories").on("select2:select", function (e) {
        // * FUNCION QUE MANDA LOS DATOS DE LOS INPUTS
        post_data_project(element_insert_data_async);
    });

    // * EVENTO BLUR DE LA LIBRERIA summernote
    $(description_project).on("summernote.blur", function (e) {
        // * FUNCION QUE MANDA LOS DATOS DE LOS INPUTS
        post_data_project(element_insert_data_async);
    });
}

async function post_data_project(element_insert_data_async = null) {
    if (!element_insert_data_async) return null;

    // * DECLARAMOS UN OBJETO VACIO PARA POSTERIORMENTE AGREGARLE LOS VALORES CORRESPONDIENTES QUE SE DESEAN ENVIAR
    const obj_params = {};

    // * MAPEAMOS LA INFO DE LOS INPUTS DE FORMA QUE NOS DE UN FORMATO DE VALUE Y KEY
    const values_with_keys = Array.from(element_insert_data_async)
        .map((inp) => {
            return {
                value: $(inp).val(),
                key: inp.name.replace("[]", ""),
            };
        })
        .forEach((obj) => {
            // * AGREGAMOS LOS PARAMETROS AL OBJETO
            obj_params[obj.key] = obj.value;
        });
    // * AÑADIMOS EL DI DEL PROYECTO PARA SABER SI ACTUALIZAMOS O CREAMOS UN PROYECTO
    obj_params["project_id"] = get_project_id();

    try {
        // * SOLICITUD HTTP POST (ENVIAMOS LOS DATOS DE LOS CAMPOS)
        const { data } = await axios.post(route_change_or_create, obj_params);
        console.log(data);
        // * EXTRAEMOS EL ID DEL PROYECTO
        const project_id = data.project.id || null;

        // * VALIDAMOS QUE EL ID SEA VERDADERO
        if (project_id) {
            // * ACTUALIZAMOS EL INPUT QUE CONTIENE EL ID DEL PROYECTO
            set_project_id(project_id);
        }
    } catch (error) {
        console.log(error);
    }
}

function set_count_status_projects(data) {
    if (
        trash_projects_count &&
        eraser_projects_count &&
        complete_projects_count
    ) {
        trash_projects_count.textContent = data.projects_status.trash_projects;
        eraser_projects_count.textContent =
            data.projects_status.eraser_projects;
        complete_projects_count.textContent =
            data.projects_status.complete_projects;
    }
}
