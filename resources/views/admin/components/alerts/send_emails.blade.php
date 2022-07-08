@can('envio_email.index')
<style>
#cuenta {
    display: flex;
    justify-content: center;
}

.simply-section {
    background: #fff;
    width: 90px;
    height: 90px;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.simply-amount {
    display: block;
    text-align: center!important;
    font-size: 30px;
    font-weight: 700;
}

.simply-word {
    font-weight: 300;
    font-size: 17px;
}

</style>

<div class="callout callout-warning {{ $puedo_enviar_emails['puedo_enviar_emails'] ? '' : 'd-none' }}"
    id="select_alert_new_email">
    <h5 class="text-capitalize">¡Ya puedes enviar nuevos emails!</h5>
    <p>Ya transcurrió el tiempo necesario para que puedas enviar nuevos emails, el limite de envios diarios es de
        100
        emails.</p>
    <div class="">
        <button class="btn btn-info btn-sm" type="button">Enviar Emails</button>
        <a href="{{ route('envio_email.index') }}">
            <button class="btn btn-light btn-sm" type="button">Enviar Emails</button>
        </a>
    </div>
</div>
<div class="container row">

    <div class="col-4 ml-2 cuenta  {{ $puedo_enviar_emails['puedo_enviar_emails'] ? 'd-none' : 'd-flex' }} "
        id="cuenta">
    </div>
</div>
@endcan

@push('js')
<script src="{{ asset('js/Plugins/simplyCountdown.min.js') }}"></script>
<script>
let dataServer = @json($puedo_enviar_emails['timesLastEmail'])

let hora = dataServer["hora"];
let dia = dataServer["dia"];
let minutos = dataServer["minutos"];
let segundos = dataServer["segundos"];
let contador = document.getElementById('cuenta');


simplyCountdown("#cuenta", {
    year: 2022, // Requerido
    month: 7, // Requerido
    day: dia, // Requerido
    hours: hora, // El Default es 0 [0-23] integer
    minutes: minutos, // Default is 0 [0-59] integer
    seconds: segundos, // Default is 0 [0-59] integer
    words: {
        //Palabras que se muestran en el contador
        days: "Día",
        hours: "Hora",
        minutes: "Minuto",
        seconds: "Segundo",
        pluralLetter: "s", //letra que se utiliza para el prural
    },
    plural: true, //Usar plurales
    inline: false, //Poner en "true" para que quede inline asi : 24 days, 4 hours, 2 minutes, 5 seconds
    inlineClass: "simply-countdown-inline", //span de clase en caso que inline = true
    enableUtc: false, //Utilizar UTC como default

    onEnd: function() {

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
</script>
@endpush
