<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de servicios</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />


</head>

<style>
    @page {
        margin: 0cm 0cm;
    }



    body {
        margin-top: 4cm;
        margin-bottom: 5cm;
        font-family: 'Poppins';
    }

    table {
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;

    }

    td,
    tr,
    th {
        text-align: center;
        vertical-align: center;
        border: solid 1px rgb(248, 248, 248);

    }


    th {
        padding: 0.4cm;
        background-color: rgb(240, 240, 240)
    }

    td {
        padding: 0.4cm;
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
        line-height: 1;
    }

    .h-1-2 {
        font-size: medium;
    }

    .h-3 {
        font-weight: 200;
        color: #4f1593;
        text-align: center;
        line-height: 1;
        margin-bottom: 1cm;
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
                    SERVICIOS
                </h1>
                <h3 class="h-3">
                    Lista de precios de servicios FLUXEL-CODE
                </h3>
            </div>
            <div class="">
                <table class="mx-5cm">

                    <thead>
                        <tr>
                            <th>Nombre </th>
                            <th>Precio</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data['services'] as $service)
                            <tr>
                                <td>
                                    {{ $service->name }}
                                </td>

                                <td>
                                    {{ $service->price }}$
                                </td>

                            <tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        {{-- <div class="page-break"></div> --}}
    </main>



</body>

</html>
