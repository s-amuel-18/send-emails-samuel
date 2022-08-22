<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



    @yield('styles')

    <style>
        .b-red {
            border: 2px solid red;
        }

        .container_email {
            max-width: 576px;
            margin: auto;
            box-sizing: border-box
        }

        .banner_content {
            width: 100%;
        }

        .banner {
            width: 100%;
            margin: 0;
            display: block;
        }

        p {
            margin-bottom: 10px;
        }

        .btn-notification {
            position: relative;
        }

        .btn-notification>.badge {
            background: #000 !important;
            font-size: 10px;
            font-weight: 400;
            position: absolute;
            right: -10px;
            top: -3px;
        }
    </style>
</head>

<body>

    <div class="" style="background: #000"></div>
    <div class="container_email">
        @yield('content')
    </div>

    @push('js')
        <script src="{{ asset('js/main.js') }}"></script>
    @endpush
</body>

</html>
