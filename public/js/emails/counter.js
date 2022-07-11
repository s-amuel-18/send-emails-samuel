$(function () {




})


function counter(date) {
    if (!date) return false;

    let hora = date["hora"];
    let dia = date["dia"];
    let minutos = date["minutos"];
    let segundos = date["segundos"];
    let contador = document.getElementById('cuenta');
    let content_counter = document.getElementById('content_counter');

    if (content_counter.classList.contains("d-none")) {
        content_counter.classList.remove("d-none")
    }

    simplyCountdown("#cuenta", {
        year: 2022, // Requerido
        month: 7, // Requerido
        day: dia, // Requerido
        hours: hora, // El Default es 0 [0-23] integer
        minutes: minutos, // Default is 0 [0-59] integer
        seconds: segundos, // Default is 0 [0-59] integer
        words: {
            //Palabras que se muestran en el contador
            days: "Días",
            hours: "Horas",
            minutes: "Mins",
            seconds: "Segs",
            pluralLetter: "s", //letra que se utiliza para el prural
        },
        plural: true, //Usar plurales
        inline: false, //Poner en "true" para que quede inline asi : 24 days, 4 hours, 2 minutes, 5 seconds
        inlineClass: "simply-countdown-inline", //span de clase en caso que inline = true
        enableUtc: false, //Utilizar UTC como default

        onEnd: function () {

            document.getElementById('select_alert_new_email').classList.remove('d-none');
            contador.classList.add('d-none');
            contador.classList.remove('d-flex');

            return false;
            //Poner aqui la funcion que se ejecute al terminar el contador
        },

        refresh: 1000, // default se refresca cada segundo
        sectionClass: "simply-section", //section css clase para modificar el estilo
        amountClass: "simply-amount", // amount css clase para modificar el estilo
        wordClass: "simply-word", // word css clase para modificar el estilo
        zeroPad: true, // poner 0 antes de cada numero
        countUp: false, //contar hacia arriba
    });

    // Puedes hacer init con un objeto Javascript.
    let myElement = document.querySelector(".my-countdown");
    simplyCountdown(myElement, {
        /* options */
    });

    let multipleElements = document.querySelectorAll(".my-countdown");
    simplyCountdown(multipleElements, {
        /* options */
    });
}
