<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        font-family: sans-serif;
    }

    body {
        background-color: rgb(200, 200, 200);
        margin: 0;
    }

    html {
        box-sizing: border-box;
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
        height: 25px;
    }

    .img-100sq {
        width: 100px;
        m
        /* padding: 5px; */
    }

    .py-2 {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>

<body>
    <header>
        <h1 class="center">Header</h1>
    </header>

    <div class=" ">

        <div class="container-mail">

            <div class="logo d-flex">
                <a href=""><img class="img-100sq"
                        src="https://www.negociaecuador.com/brandon-prueba/fluxel_code_xl.png" alt="">
                </a>
            </div>
            <div class="card">
                <h5 class="title center">Lorem ipsum dolor sit amet.</h5>
                <div class="  t-gray">
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="logo center d-flex j-center ">
                <a class="py-2" href="">
                    <img class="img-40sq" src="https://www.negociaecuador.com/brandon-prueba/ws.png" alt="Whatsapp">
                </a>
                <a class="py-2" href=""><img class="img-40sq"
                        src="https://www.negociaecuador.com/brandon-prueba/gmail.png" alt="gmail">
                </a>
                <a class="py-2" href=""><img class="img-40sq"
                        src="https://www.negociaecuador.com/brandon-prueba/instagram.png" alt="instagram">
                </a>


            </div>

        </div>

    </div>

    <footer class="">
        <p class="t-gray center"> @ 2022 FLUXEL-CODE Todos los derechos reservados</p>
    </footer>


</body>

</html>
