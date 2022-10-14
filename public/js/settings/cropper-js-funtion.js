const img_preview_primary_image = document.getElementById(
    "img_preview_primary_image"
);
const btn_crop = document.getElementById("crop");
var bs_modal = $("#modal_crop_image");
var image = document.getElementById("image_primary_settings");
var cropper, reader, file;
let crop_details = {};
const option = {
    aspectRatio: 16 / 9, // * esto nos permite darle la relacion de aspecto para declarar un patron
    viewMode: 3,
    crop: function (event) {
        crop_details = { ...event.detail };
    },
};

$("body").on("change", "#image_primary_preview", function (e) {
    var files = e.target.files;
    var done = function (url) {
        image.src = url;
        bs_modal.modal("show");
    };

    if (files && files.length > 0) {
        file = files[0];

        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

bs_modal
    .on("shown.bs.modal", function () {
        cropper = new Cropper(image, option);
    })
    .on("hidden.bs.modal", function () {
        cropper.destroy();
        cropper = null;
    });

$(btn_crop).click(function () {
    btn_crop.disabled = true;
    const image_primary_preview = document.getElementById(
        "image_primary_preview"
    );

    if (!image_primary_preview.value) return null;

    const formdata = new FormData();

    formdata.append("image", image_primary_preview.files[0]);
    formdata.append("width", crop_details.width);
    formdata.append("height", crop_details.height);
    formdata.append("x", crop_details.x);
    formdata.append("y", crop_details.y);

    axios
        .post(data_server["route_upload_img_primary_async"], formdata)
        .then((resp) => {
            const { data } = resp;
            const message = data.message;
            img_preview_primary_image.src = data.route_file;
            img_preview_primary_image.classList.remove("d-none");
            btn_crop.disabled = false;

            $(bs_modal).modal("hide");

            toastr.success(message || "Registrado con exito");
        })
        .catch((err) => {
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

            toastr.error(message + ", " + errors || "Ha ocurrido un error");

            btn_crop.disabled = false;
        });

    // canvas = cropper.getCroppedCanvas({
    //     width: 160,
    //     height: 160,
    // });

    // canvas.toBlob(function (blob) {
    //     url = URL.createObjectURL(blob);
    //     var reader = new FileReader();
    //     reader.readAsDataURL(blob);
    //     reader.onloadend = function () {
    //         var base64data = reader.result;

    //         $.ajax({
    //             type: "POST",
    //             dataType: "json",
    //             url: "upload.php",
    //             data: {
    //                 image: base64data,
    //             },
    //             success: function (data) {
    //                 bs_modal.modal("hide");
    //                 alert("success upload image");
    //             },
    //         });
    //     };
    // });
});

$(".sr-only").on("change", (e) => {
    option[e.target.name] = e.target.value;
    cropper.destroy();
    cropper = new Cropper(image, option);
});
