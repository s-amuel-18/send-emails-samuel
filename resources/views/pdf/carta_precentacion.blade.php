<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carta De presentacion</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />


</head>

<style>
    @page {
        margin: 0cm 0cm;
    }



    body {
        margin-top: 5cm;
        margin-bottom: 5cm;
        font-family: 'Poppins';
    }

    td {
        text-align: center;
        vertical-align: center;
    }


    .mx-2cm {
        margin-left: 2cm;
        margin-right: 2cm;
    }

    .p-1 {
        padding: 1rem;
    }

    .w-100 {
        width: 100%;
    }

    .h-1 {
        font-weight: 900;
        color: #4f1593;
        text-align: center;
        line-height: 0.5;
    }

    .h-1-2 {
        font-size: medium;
    }

    .h-3 {
        font-weight: 200;
        color: #4f1593;
        text-align: center;
        line-height: 0.5;
    }

    .h-5 {
        font-weight: 900;
        color: #4f1593;
    }

    .td-1 {
        width: 60%;
        text-align: justify;

    }

    .td-1-2 {
        width: 35%;

    }

    .td-2 {
        width: 33%
    }

    .td-20px {
        min-width: 20px;
    }


    .page-break {
        page-break-after: always;
    }

    .page-break-before {
        page-break-before: always;
    }

    .page-break-inside {
        page-break-inside: avoid;
    }

    .page-container {
        margin-top: 4.5cm;
        margin-bottom: 5cm;
        height: 100vh;
        width: 100vw;
        display: table;
        text-align: center;
    }

    .center {

        text-align: center;

    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;

    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;

    }

    .bg-img {
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 8cm;
    }

    .sq-80 {
        width: 80px;
        height: 80px;
    }

    .logo-fluxel {
        width: 150px;
    }

    .logo-fluxel-h {
        margin-top: -0.5rem;
        padding: 2.5rem;
    }

    .logo-fluxel-f {
        margin-top: 4.5cm;
        margin-left: 15cm;
        margin-right: 3cm;
        padding: 2.5rem;

    }

    .border-red {
        border: 2px solid red;
    }

    .bg-red {
        background-color: red;
    }





    /* { @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }} */
</style>

<body>
    <header class="bg-img" style="background-image: url(https://www.fluxelcode.com/images/pdf_assets/header-4.png);">
        <div class="logo-fluxel-h"><img class="logo-fluxel"
                src="https://www.fluxelcode.com/images/pdf_assets/fluxel_code_xl.png" alt=""></div>
    </header>
    <footer class="bg-img" style="background-image: url(https://www.fluxelcode.com/images/pdf_assets/footer-4.png);">

        <div class="logo-fluxel-f"><img class="logo-fluxel"
                src="https://www.fluxelcode.com/images/pdf_assets/fluxel_code_xl.png" alt=""></div>
    </footer>


    <main class="">
        <section class="mx-2cm" id="intro">
            {{-- <br><br><br><br><br><br><br><br><br><br> --}}
            <div class="">
                <h1 class="h-1">
                    FLUXEL-CODE
                </h1>
                <h3 class="h-3">
                    Empresa de programacion y diseño web
                </h3>
            </div>
            <br><br><br>
            <div class="">
                <table class="">
                    <tr>
                        <td class="td-1">
                            <p>En Fluxel-Code te ayudamos a impulsar tu comercio, nos consideramos una agencia en
                                aumento y
                                en
                                constante
                                desarrollo. Somos una agencia digital de desarrollo web y sistema, donde ofrecemos
                                servicios
                                como;
                                Utilización de sistemas, Creación de aplicativos web, Maquetación, Desarrollo de páginas
                                web,
                                Creación
                                de
                                logos, Edición de imágenes y videos.
                                Entre las empresas con las que hemos trabajado se encuentran Avimark , Fumimark, BM
                                ENVÍOS,
                                entre otras.
                                No
                                obstante, nos agradaría continuar expandiéndose y ofrendando nuestros propios servicios
                                a
                                nuevos
                                clientes.
                            </p>
                        </td>
                        <td class="td-20px"></td>
                        <td class="td-1-2" style="
                        vertical-align: middle!important;">
                            <img src="https://www.fluxelcode.com/images/pdf_assets/logo_fluxel.png" width="100%">
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <div class="page-break"></div>

        <section id="proyectos">

            <div class="">
                <h1 class="h-1">
                    Proyectos
                </h1>
                <h3 class="h-3">
                    Creaciones y seguimientos
                </h3>
            </div>
            <div class="mx-2cm center">
                <p>Nosotros en Fluxel-code tenemos una amplia experiencia en la creacion de sistemas y paginas web,
                    tenemos aqui una representacion visual de lo que serian nuestros proyectos y creaciones.</p>
            </div>
            <br>
            <br>
            <img src="https://www.fluxelcode.com/images/pdf_assets/paginas.png" width="100%">
        </section>

        <div class="page-break"></div>
        <section class="mx-2cm" id="actividades">

            <h1 class="h-1">
                Descripción de las actividades <br>
            </h1>
            <h1 class="h-1 h-1-2"> realizadas por FLUXEL-CODE</h1>

            <table class="">
                <tr>
                    <td class="td-1">
                        <div class="">

                            <h4 class="h-5">Desarrollo de sistemas financieros</h4>
                            <p>Impulsamos la gestión de sistemas financieros que pueden ayudarte a llevar un registro de
                                manera
                                optimizada y eficiente. Estos sistemas financieros hacen un mejor seguimiento del manejo
                                de
                                recursos,
                                empleados, entre otros de acuerdo a la necesidad de tu empresa.</p>
                        </div>
                    </td>
                    <td class="td-20px"></td>
                    <td class="td-1">
                        <div class="">
                            <h4 class="h-5">Creación de Logos <br> </h4>
                            <p>Diseñamos su logo a partir de una iniciativa. Ofreciéndole una diversidad de propuestas
                                para
                                que
                                quede
                                satisfecho con un producto de calidad que se adapte a las necesidades de nuestros
                                propios
                                clientes.
                            </p>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="td-1">
                        <div class="">

                            <h4 class="h-5">Desarrollo Web </h4>
                            <p>Nos encargamos de maquetar su página web, así como de la implementación de cambios de una
                                página ya
                                existente. (sería bueno incluir con cuáles lenguajes se trabaja).</p>
                        </div>
                    </td>
                    <td class="td-20px"></td>
                    <td class="td-1">
                        <div class="">
                            <h4 class="h-5">Edición de Video </h4>
                            <p>Le damos vida a sus ideas editando videos de casi todo tipo ya sea para un canal de
                                YouTube,
                                alguna
                                otra
                                red social, un podcast, entrevista, cursos online, publicidad, etc.</p>
                        </div>
                    </td>
                </tr>
            </table>
        </section>

        <section class="mx-2cm" id="contactanos">
            <div class="page-container page-break-before ">


                <h1 class="h-1">CONTÁCTANOS </h1>
                <br><br>

                <div>
                    <table class="center  w-100">
                        <tr class="">

                            <td class="td-2  ">


                                <img class="sq-80" src="https://www.fluxelcode.com/images/pdf_assets/ws.png"
                                    alt="">
                                <br> <br>
                                {{-- <h1 class="h-1 h-1-2">+58 (xxxx) xxx-xx-xx</h1> --}}


                                <a class="text-white text-link" target="_blank" href="https://walink.co/c9af79">
                                    <h1 class="h-1 h-1-2 ">+58 (414) 233-2912</h1>
                                </a>


                            </td>

                            <td class="td-2 ">

                                <img class="sq-80" src="https://www.fluxelcode.com/images/pdf_assets/instagram.png"
                                    alt="">
                                <br> <br>

                                <a class="text-white text-link" target="_blank"
                                    href="https://www.instagram.com/fluxel_code">
                                    <h1 class="h-1 h-1-2 ">@Fluxel.code</h1>
                                </a>
                            </td>

                            <td class="td-2 ">

                                <img class="sq-80" src="https://www.fluxelcode.com/images/pdf_assets/gmail.png"
                                    alt="">
                                <br> <br>
                                <h1 class="h-1 h-1-2 ">fluxel.code@gmail.com</h1>

                            </td>


                        </tr>
                    </table>
                </div>


            </div>

        </section>
    </main>



</body>

</html>
