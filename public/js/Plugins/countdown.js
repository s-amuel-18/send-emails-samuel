simplyCountdown("#cuenta", {
  year: 2023, // Requerido
  month: 7, // Requerido
  day: 4, // Requerido
  hours: 9, // El Default es 0 [0-23] integer
  minutes: 21, // Default is 0 [0-59] integer
  seconds: 0, // Default is 0 [0-59] integer
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

  onEnd: function () {
    //Poner aqui la funcion que se ejecute al terminar el contador
  },

  refresh: 1000, // default se refresca cada segundo
  sectionClass: "simply-section", //section css clase para modificar el estilo
  amountClass: "simply-amount", // amount css clase para modificar el estilo
  wordClass: "simply-word", // word css clase para modificar el estilo
  zeroPad: false, // poner 0 antes de cada numero
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
