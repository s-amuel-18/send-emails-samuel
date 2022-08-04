<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fluxel Code</title>
</head>
<style>
    * {
        font-family: sans-serif;
        margin: 0;
        box-sizing: border-box;
        padding: 0;
    }


    .body {
        background-color: rgb(250, 250, 250);
        padding: 20px;
    }

    html {
        box-sizing: border-box;
    }

    p {
        margin-bottom: 7px;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    .center {
        text-align: center;
    }

    /* .p-15px {
        padding: 15px;
    } */

    .container-mail {
        max-width: 540px;
        background-color: white;
        margin: auto;
    }

    .m-auto {
        margin: auto;
    }

    .card {
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 30px;


    }


    .t-gray {
        color: gray;
    }

    .logo {
        height: 60px;
        vertical-align: middle;
        display: block;
        color: white;
        background-color: #672fa8;
    }

    .d-flex {
        display: flex;

        align-items: center;


    }

    .j-center {
        justify-content: center;
    }


    .img-40sq {
        /* width: 50px; */
        height: 20px;
    }

    .img-100sq {
        width: 70px;
        margin-left: 10px;
        /* padding: 5px; */
    }

    .py-2 {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<body>
    <div class="body">
        {{-- <header>
            <h1 class="center">Header</h1>
        </header> --}}

        <div class=" " style="margin: 50px 0">

            <div class="container-mail">

                <div class="logo d-flex">
                    <a href=""><img class="img-100sq"
                            src="https://www.negociaecuador.com/brandon-prueba/fluxel_code_xl.png" alt="">
                    </a>
                </div>
                <div class="card" style="padding: 30px; color: rgb(142, 142, 142)">

                    <div class="">
                        {!! $data['body'] !!}
                    </div>
                </div>
                <div class="logo center d-flex j-center ">
                    <a class="py-2" target="_blank" href="https://walink.co/c9af79">
                        <img class="img-40sq" src="https://www.negociaecuador.com/brandon-prueba/ws.png" alt="Whatsapp">
                    </a>
                    <a class="py-2" target="_blank" href="mailto:fluxel.code@gmail.com"><img class="img-40sq"
                            src="https://www.negociaecuador.com/brandon-prueba/gmail.png" alt="gmail">
                    </a>
                    <a class="py-2" target="_blank" href="https://www.instagram.com/fluxel_code"><img class="img-40sq"
                            src="https://www.negociaecuador.com/brandon-prueba/instagram.png" alt="instagram">
                    </a>


                </div>

            </div>

        </div>

        <footer class="">
            <p class="t-gray center"> @ 2022 FLUXEL-CODE Todos los derechos reservados</p>
        </footer>

    </div>


</body>

</html>
