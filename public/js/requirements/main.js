$(function () {
    submit_form_requirements(
        "#form_create_requirement",
        "#insert_alert_requirements"
    );

    submit_form_requirements(
        "#form_edit_requirement",
        "#insert_alert_requirements_edit"
    );

    $("#requirements_modal").on("hidden.bs.modal", (e) => {
        $("#select_category_id_create").empty().trigger("change");
    });
    $("#requirements_modal_edit").on("hidden.bs.modal", (e) => {
        $("#edit_select_category_id").empty().trigger("change");
    });
});
