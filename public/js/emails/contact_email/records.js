async function post_type_alternative(btn) {
    const id = btn.dataset.id;
    const url = btn.dataset.url;
    const type_contact = btn.dataset.type_contact_alternative;
    const badge = btn.querySelector(".badge");

    disabled_element(btn, true);

    const params = {
        type: type_contact,
    };

    await axios
        .post(url, params)
        .then((resp) => {
            const { data } = resp;

            if (badge) {
                badge.classList.remove("d-none");
                badge.textContent = data.count_shipping;
            }

            disabled_element(btn, false);
        })
        .catch((err) => {
            console.log(err);
            disabled_element(btn, false);
        });
}

function event_type_alternative(select_btn) {
    const contact_alternative_btn = document.querySelectorAll(select_btn);

    $(contact_alternative_btn).on("click", (e) => {
        e.preventDefault();
        const btn = e.delegateTarget;
        const href = btn.href;

        Swal.fire({
            title: "¿Contactaras a la siguiente empresa?",
            text: "Si deseas contactar la empresa presiona si, de esta forma se puede llevar un control de cuantas veces has contactado a esta empresa/agencia.",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            customClass: {
                confirmButton: "bg-primary",
                cancelButton: "bg-light text-dark",
            },
        }).then(async (result) => {
            console.log(result);
            if (result.isConfirmed) {
                await post_type_alternative(btn);
                newTap(href);
            }
            if (result.dismiss == "cancel") {
                newTap(href);
            }
        });
    });
}
