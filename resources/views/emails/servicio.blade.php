@extends('emails.template.layout')

@section('styles')
    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <style>
        .p-2 {
            padding: 10px;
        }

        .mt-3 {
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .body {
            background: #000000;
            width: 100%;
            font-family: 'Roboto', sans-serif;
        }

        .body_email {
            max-width: 90%;
            margin: auto;
            padding: 50px 0;
            color: rgba(35, 232, 124, 0.9);
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
            text-align: left;
            /* font-family: 'Roboto', sans-serif; */

        }

        .body_email_tittle {
            font-weight: 900;

        }

        .body_buttos {
            width: 100%;
        }



        .w-100 {
            width: 100%;
        }

        .btn {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #000;
            background: #fff;
            text-align: center;
            border: 2px solid #fff;
            border-radius: 5px;
        }

        .bg-primary {
            background: #23e87c;

        }

        .btn-primary {
            background: #23e87c;
            border: 2px solid #23e87c !important;
            color: #0B0D23 !important;
        }

        .btn-outline-primary {
            background: transparent;
            border: 2px solid #23e87c !important;
            color: #23e87c !important;
        }

        .footer_email {
            padding: 20px 0;

        }

        .text-container {
            max-width: 90%;
            margin: auto
        }

    </style>
@endsection

@section('content')
    <div class="">
        <div class="banner_content">
            <a target="_black" href="{{ $info["link_principal"] }}">
                <img src="{{ asset('images/email-assets/banner-servicio.png') }}" alt="banner Samuel"
                    class="banner">
            </a>
        </div>


        <div class="body">
            <div class="body_email ">


                {{-- body --}}
                {!! $info["body"] !!}

                <div class="body_buttos mt-3">
                    <table class="w-100 body_buttos_table">
                        <tr class="">
                            <td style="padding: 6px">
                                <a target="_black"
                                    href="https://negociaecuador.com/samuel-graterol-dev/portafolio/view_curriculum"
                                    class="btn btn-outline-primary">Descargar CV</a>
                            </td>
                            <td style="padding: 6px">
                                <a target="_black" href="{{ $info["link_principal"] }}" class="btn btn-primary">Ver Portafolio</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="footer_email bg-primary w-100  text-center">
                <div class="text-container">
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td style="width: 40px;" class="">
                                    <a target="_black" href="{{ $info["link_principal"] }}">
                                        <img src="{{ asset('images/email-assets/gmail-dark.png') }}"
                                            class="w-100" alt="logo">
                                    </a>
                                </td>
                                <td></td>
                                <td style="width: 80px;" class="">
                                    <div>
                                        <div class="">
                                            <h3 style="margin: 0">Contactame</h3>
                                            <table class="w-100" style="width: 70px; margin-left: auto">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 33%; padding: 3px">
                                                            <a target="_black" href="https://wa.me/584242805116">
                                                                <img class="w-100"
                                                                    src="{{ asset('images/email-assets/ws.png') }}"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td style="width: 33%; padding: 3px">
                                                            <a target="_black" href="https://github.com/s-amuel-18">
                                                                <img class="w-100"
                                                                    src="{{ asset('images/email-assets/github.png') }}"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td style="width: 33%; padding: 3px">
                                                            <a target="_black" href="mailto:samuelgraterol12@gmail.com">
                                                                <img class="w-100"
                                                                    src="{{ asset('images/email-assets/gmail-dark.png') }}"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection
