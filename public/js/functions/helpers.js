function load_btn(e, load = false) {
    const more_details = e.delegateTarget;
    const load_item = more_details.querySelector(".load_item");
    const details_mormal = more_details.querySelector(".details_mormal");

    if (!load_item || !details_mormal) return false;

    if (load) {
        details_mormal.classList.add("d-none");
        load_item.classList.remove("d-none");
    } else {
        details_mormal.classList.remove("d-none");
        load_item.classList.add("d-none");
    }

    more_details.disabled = load;
    return load;
}
