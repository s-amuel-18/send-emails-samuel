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
        /* margin: 3cm 2cm 2cm; */
        font-family: 'Poppins';
    }

    .h-1 {
        font-weight: 900;
        color: #4f1593;
        text-align: center;
        line-height: 0.5;
    }

    .h-1-2 {
        font-size: large
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

    .table {
        padding: 5%;
    }

    .td-1 {
        width: 50%;
        text-align: justify;
        font-size: 16px;

    }


    .td-2 {
        width: 50%;
        padding-left: 5%;

    }

    .td-3 {
        width: 50%;
        text-align: justify;
        font-size: 16px;
        padding-right: 10%;

    }

    .page-break {
        page-break-after: always;
    }

    /* header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;

    } */

    footer {
        position: fixed;
        bottom: 3cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;

    }
</style>

<body>
    <header>
        <img src="{{ public_path('images\pdf_assets\header.png') }}" width="100%">
    </header>

    <main>
        <div class="">
            <h1 class="h-1">
                FLUXEL-CODE

            </h1>
            <h3 class="h-3">
                Empresa de programacion y diseño web

            </h3>

        </div>
        <table class="table">
            <tr>
                <td class="td-1">
                    <p>En Fluxel-Code te ayudamos a impulsar tu comercio, nos consideramos una agencia en aumento y en
                        constante
                        desarrollo. Somos una agencia digital de desarrollo web y sistema, donde ofrecemos servicios
                        como;
                        Utilización de sistemas, Creación de aplicativos web, Maquetación, Desarrollo de páginas web,
                        Creación
                        de
                        logos, Edición de imágenes y videos.
                        Entre las empresas con las que hemos trabajado se encuentran Avimark , Fumimark, BM ENVÍOS,
                        entre otras.
                        No
                        obstante, nos agradaría continuar expandiéndose y ofrendando nuestros propios servicios a nuevos
                        clientes.
                    </p>
                </td>
                <td class="td-2">
                    <img src="{{ public_path('images\pdf_assets\logo_fluxel.png') }}" width="100%">
                </td>
            </tr>
        </table>
        <div class="page-break"></div>

        <div class="">
            <h1 class="h-1">
                Proyectos
            </h1>
            <h3 class="h-3">
                Creaciones y seguimientos
            </h3>
        </div>
        <br>
        <br>

        <img src="{{ public_path('images\pdf_assets\paginas.png') }}" width="100%">

        <div class="page-break"></div>

        {{-- <br><br><br><br><br><br><br><br> --}}
        <br><br>
        <h1 class="h-1">
            Descripción de las actividades <br>
        </h1>
        <h1 class="h-1 h-1-2"> realizadas por FLUXEL-CODE</h1>

        <table class="table">
            <tr>
                <td class="td-3">
                    <div class="">
                        <br><br><br>
                        <h4 class="h-5">Desarrollo de sistemas financieros informático</h4>
                        <p>Impulsamos la gestión de sistemas financieros que pueden ayudarte a llevar un registro de
                            manera
                            optimizada y eficiente. Estos sistemas financieros hacen un mejor seguimiento del manejo de
                            recursos,
                            empleados, entre otros de acuerdo a la necesidad de tu empresa.</p>
                    </div>
                </td>
                <td class="td-3">
                    <div class="">
                        <h4 class="h-5">Creación de Logos </h4>
                        <p>Diseñamos su logo a partir de una iniciativa. Ofreciéndole una diversidad de propuestas para
                            que
                            quede
                            satisfecho con un producto de calidad que se adapte a las necesidades de nuestros propios
                            clientes.
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td-3">
                    <div class="">
                        <br>
                        <h4 class="h-5">Desarrollo Web </h4>
                        <p>Nos encargamos de maquetar su página web, así como de la implementación de cambios de una
                            página ya
                            existente. (sería bueno incluir con cuáles lenguajes se trabaja).</p>
                    </div>
                </td>

                <td class="td-3">
                    <div class="">
                        <h4 class="h-5">Edición de Video </h4>
                        <p>Le damos vida a sus ideas editando videos de casi todo tipo ya sea para un canal de YouTube,
                            alguna
                            otra
                            red social, un podcast, entrevista, cursos online, publicidad, etc.</p>
                    </div>
                </td>
            </tr>
        </table>
    </main>
    <footer>
        <img src="{{ public_path('images\pdf_assets\footer.png') }}" width="100%">

    </footer>



</body>

</html>
