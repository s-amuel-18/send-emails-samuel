// * funcion
$(function () {
    // * Traducciones
    const labels_es_ES = {
        labelIdle:
            'Arrastra y suelta tus archivos o <span class = "filepond--label-action"> Examinar <span>',
        labelInvalidField: "El campo contiene archivos inválidos",
        labelFileWaitingForSize: "Esperando tamaño",
        labelFileSizeNotAvailable: "Tamaño no disponible",
        labelFileLoading: "Cargando",
        labelFileLoadError: "Error durante la carga",
        labelFileProcessing: "Cargando",
        labelFileProcessingComplete: "Carga completa",
        labelFileProcessingAborted: "Carga cancelada",
        labelFileProcessingError: "Error durante la carga",
        labelFileProcessingRevertError: "Error durante la reversión",
        labelFileRemoveError: "Error durante la eliminación",
        labelTapToCancel: "toca para cancelar",
        labelTapToRetry: "tocar para volver a intentar",
        labelTapToUndo: "tocar para deshacer",
        labelButtonRemoveItem: "Eliminar",
        labelButtonAbortItemLoad: "Abortar",
        labelButtonRetryItemLoad: "Reintentar",
        labelButtonAbortItemProcessing: "Cancelar",
        labelButtonUndoItemProcessing: "Deshacer",
        labelButtonRetryItemProcessing: "Reintentar",
        labelButtonProcessItem: "Cargar",
        labelMaxFileSizeExceeded: "El archivo es demasiado grande",
        labelMaxFileSize: "El tamaño máximo del archivo es {filesize}",
        labelMaxTotalFileSizeExceeded: "Tamaño total máximo excedido",
        labelMaxTotalFileSize:
            "El tamaño total máximo del archivo es {filesize}",
        labelFileTypeNotAllowed: "Archivo de tipo no válido",
        fileValidateTypeLabelExpectedTypes:
            "Espera {allButLastType} o {lastType}",
        imageValidateSizeLabelFormatError: "Tipo de imagen no compatible",
        imageValidateSizeLabelImageSizeTooSmall:
            "La imagen es demasiado pequeña",
        imageValidateSizeLabelImageSizeTooBig: "La imagen es demasiado grande",
        imageValidateSizeLabelExpectedMinSize:
            "El tamaño mínimo es {minWidth} × {minHeight}",
        imageValidateSizeLabelExpectedMaxSize:
            "El tamaño máximo es {maxWidth} × {maxHeight}",
        imageValidateSizeLabelImageResolutionTooLow:
            "La resolución es demasiado baja",
        imageValidateSizeLabelImageResolutionTooHigh:
            "La resolución es demasiado alta",
        imageValidateSizeLabelExpectedMinResolution:
            "La resolución mínima es {minResolution}",
        imageValidateSizeLabelExpectedMaxResolution:
            "La resolución máxima es {maxResolution}",
    };

    // *pasamos las traducciones
    FilePond.setOptions(labels_es_ES);

    /*
    We want to preview images, so we need to register the Image Preview plugin
    */
    FilePond.registerPlugin(
        // validates the size of the file
        FilePondPluginFileValidateSize,

        // corrects mobile image orientation
        FilePondPluginImageExifOrientation,

        // previews dropped images
        FilePondPluginImagePreview
    );

    var dragTimer;
    $(document).on("dragover", function (e) {
        var dt = e.originalEvent.dataTransfer;
        if (
            dt.types &&
            (dt.types.indexOf
                ? dt.types.indexOf("Files") != -1
                : dt.types.contains("Files"))
        ) {
            $("#dropzone").show();
            window.clearTimeout(dragTimer);
        }
    });
    $(document).on("dragleave", function (e) {
        dragTimer = window.setTimeout(function () {
            $("#dropzone").hide();
        }, 25);
    });

    // * CREAMOS UN NUEVO ARRAY QUE CONTENGA EL FORMATO DEL OBJETO DE CONFIGURACION DESEADO PARA MOSTRAR LAS IMAGENES QUE ESTAN EN EL SERVIDOR
    // ? "images_project" CONTIENE RUTA DE LAS IMAGENES
    const images_project_options = images_project.map((img_data) => {
        return {
            // * VALIDAMOS QUE TENGA UNA RUTA
            source: "/storage/" + img_data.url || null,

            options: {
                metadata: {
                    id_server_image: img_data.id || null, // * CREAMOS UN METADATA PARA IDENTIFICAR LAS IMAGENES QUE YA ESTAN SUBIDAS AL SERVER
                },
            },
        };
    });

    // * INPUT SUBIDA DE IMAGEN
    const fildpondElement = document.getElementById("filepond_test");

    // * OMSTAMCIA DE CREACOPM E INICIO DE LIBRERÍA
    const pond = FilePond.create(fildpondElement, {
        acceptedFileTypes: ["image/jpg", "image/png", "image/jpeg"], // * EXTENCIONES QUE PODEMOS ACEPTAR
        files: images_project_options, // * ARRAY CON DATOS FORMATEADOS PARA MOSTRAR IMAGENES QUE ESTAN SUBIDAS EN EL SERVER
    });

    // * OBJETO DE OPCIONES ADICIONALES
    const options_fildpond = {
        server: {
            // * FUNCION QUE SE EJECUTA CUANDO SE SUBE UNA IMAGEN
            process: (
                fieldName, // * NAME DEL INPUT
                file, // * ARCHIVO QUE SE QUIERE SUBIR
                metadata, // * METADATOS ASOCIADOS A LA IMAGEN (DE AQUÍ SABREMOS SI LA IMAGEN YA ESTÁ SUBIDA EN EL SERVIDOR)
                load, // * FUNCION DE IMAGEN CARGADA
                error, // * FUNCION PARA ERROR AL SUBIR LA IMAGEN
                progress, // * FUNCION DE EN PROCESO (SE DEBE INVESTIGAR MAS DE ESTO)
                abort, // * FUNCION QUE ABORTA LA SUBIDA DE LA IMAGEN
                transfer, // ! NO SE SABE PARA QUE SIRVE
                options // ! NO SE SABE PARA QUE SIRVE
            ) => {
                // * VALIDAMOS QUE LA IMAGEN TENGA UN METADATA
                // ? DE ESTA FORMA NOS ASEGURAMOS DE QUE LA IMAGEN YA SE HALLA SUBIDO AL SERVIDOR
                if (metadata.id_server_image || false) {
                    // * CARGAMOS LA IMAGEN
                    load(metadata.id_server_image);
                    return {
                        abort: () => {
                            abort();
                        },
                    };
                }

                // * creamos un form data para el envio de imagenes
                const formData = new FormData();
                // * AGREGAMOS LA IMAGEN LA FORM DATA
                formData.append("image", file, file.name);
                formData.append("project_id", get_project_id());

                axios
                    .post(route_upload_img, formData)
                    .then(({ data }) => {
                        // * RUTA DE LA IMAGEN
                        const { route_file } = data;
                        const { project } = data;
                        const { image_create } = data;

                        // * VALIDAMOS QUE SE HALLA ENVIADO DATOS DEL PROYECTO DESDE EL SERVIDOR
                        if (project) {
                            // * ACTUALIZAMOS EL ID DEL PROYECTO
                            set_project_id(project.id); // ? ESTA FUNCION ESTÁ EN "public\js\projects\functions\functions.js"
                        }

                        // * VALIDAMOS QUE SE HALLA ENVIADO DATOS DE image_create DESDE EL SERVIDOR
                        if (image_create) {
                            // * CARGAMOS LA IMAGEN CON EL ID DEL PROYECTO
                            load(image_create.id);
                        } else {
                            error("Ha ocurrido un error");
                        }

                        console.log(data);
                    })
                    .catch((err) => {
                        // * ERROR AL SUBIR LA IMAGEN
                        const data = err.response.data;
                        const message = data.message;
                        let errors = "";

                        for (const key in data.errors) {
                            if (Object.hasOwnProperty.call(data.errors, key)) {
                                const element = data.errors[key];
                                element.forEach((el) => {
                                    errors += el + "\n";
                                });
                            }
                        }
                        toastr.error(
                            message + ", " + errors || "Ha ocurrido un error"
                        );
                        error("Ha ocurrido un error, " + errors);
                    });

                return {
                    abort: () => {
                        abort();
                    },
                };
            },

            // * FUNCION QUE SE EJECUTA AL ELIMINAR UNA IMAGEN
            revert: (
                image_id, // * identificador de la base de datos
                load, // * FUNCION DE CARGA DE LA IMAGEN
                error // * FUNCION PARA ERROR AL SUBIR LA IMAGEN
            ) => {
                axios
                    .delete(route_upload_img_delete, {
                        params: {
                            image_id, // * RUTA DE LA IMAGEN QUE QUEREMOS ELIMINAR
                        },
                    })
                    .then(({ data }) => {
                        console.log(data);
                        // * TERMINAMOS LA CARGA DE ELIMINAR LA IMAGEN
                        load();
                    })
                    .catch((err) => {
                        // * ERROR AL ELIMINAR LA IMAGEN
                        error("Ha ocurrido un error");
                    });
            },
        },
    };

    // * AGREGAMOS EL OBJETO DE CONFIGURACION AL FilePond
    FilePond.setOptions(options_fildpond);
});
