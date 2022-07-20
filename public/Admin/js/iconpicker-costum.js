$(function () {
    var show_result = function () {
        $("#result").text($("#button").html().trim());
    };

    show_result();

    $("#btn-text").on("focusout", function (e) {
        $(
            '#btn-icon-positions button[value="' +
                $("#button").data("position") +
                '"]'
        ).trigger("click");
        show_result();
    });

    $("#btn-colors button").on("click", function (e) {
        $("#button a")
            .removeClass(
                "btn-primary btn-secondary btn-success btn-danger btn-warning btn-info btn-light btn-dark btn-link"
            )
            .addClass($(this).val());
        show_result();
    });

    $("#btn-sizes button").on("click", function (e) {
        $("#button a").removeClass("btn-sm btn-lg").addClass($(this).val());
        show_result();
    });

    $("#btn-sizes a").on("click", function (e) {
        $("#button a").toggleClass("btn-block");
        show_result();
    });

    $("#btn-icon").iconpicker({
        rows: 5,
        cols: 6,
        align: "center",
        searchText: "Buscar icono",
    });

    $("#btn-icon").on("change", function (e) {
        $("#button a > i").attr("class", "").addClass(e.icon);
        show_result();
    });

    $("#btn-icon-positions button").on("click", function (e) {
        var icon = $("#button a > i");
        var text = $("#btn-text").val();
        $("#button a").empty();
        if ($(this).val() == "left") {
            $("#button a")
                .append(icon)
                .append(" " + text);
        } else {
            $("#button a")
                .append(text + " ")
                .append(icon);
        }
        $("#button").data("position", $(this).val());
        show_result();
    });
});
