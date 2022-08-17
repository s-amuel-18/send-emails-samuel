function template_info(arr_data = null) {
    if (!arr_data && arr_data.length > 0) return null;
    let template = ``;

    arr_data.forEach((data) => {
        if (!data.label) return false;

        const label = data.label;
        let value = "";

        if (data.element_custom && data.value) {
            value = data.element_custom.replaceAll("%value%", data.value);
        } else {
            value = data.value ? data.value : "sin " + data.label.toLowerCase();
        }

        template += `<div class="">
                        <h5 class="font-weight-bold h6">${label}</h5>
                        <p>${value}</p>
                    </div>`;
    });

    return template;
}
