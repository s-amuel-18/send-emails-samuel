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
    labelMaxTotalFileSize: "El tamaño total máximo del archivo es {filesize}",
    labelFileTypeNotAllowed: "Archivo de tipo no válido",
    fileValidateTypeLabelExpectedTypes: "Espera {allButLastType} o {lastType}",
    imageValidateSizeLabelFormatError: "Tipo de imagen no compatible",
    imageValidateSizeLabelImageSizeTooSmall: "La imagen es demasiado pequeña",
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

// Select the file input and use create() to turn it into a pond
const d = FilePond.create(document.querySelector("#filepond"), {
    acceptedFileTypes: ["image/jpg", "image/png", "image/jpeg"],
    storeAsFile: true,
});

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
