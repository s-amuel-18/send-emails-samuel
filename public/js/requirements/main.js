$(function () {
    submit_form_requirements(
        "#form_create_requirement",
        "#insert_alert_requirements"
    );

    submit_form_requirements(
        "#form_edit_requirement",
        "#insert_alert_requirements_edit"
    );

    // show modals
    $("#requirements_modal").on("show.bs.modal", (e) => {
        const btn = e.relatedTarget;
        const modal = e.delegateTarget;

        if (requirements_categories.length < 1) {
            e.preventDefault();
            there_are_no_categories();
        }
    });
    $("#requirements_modal_edit").on("show.bs.modal", (e) => {
        const btn = e.relatedTarget;
        const modal = e.delegateTarget;

        if (requirements_categories.length < 1) {
            e.preventDefault();
            there_are_no_categories();
        }
    });

    // hidden modals
    $("#requirements_modal").on("hidden.bs.modal", (e) => {
        $("#select_category_id_create").val("").trigger("change");
    });
    $("#requirements_modal_edit").on("hidden.bs.modal", (e) => {
        $("#edit_select_category_id").val("").trigger("change");
    });
});
