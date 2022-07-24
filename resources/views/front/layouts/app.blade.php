<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap 4.1.3 -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" />
    <!-- Animate Css -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/animate.css') }}" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/plugins/slick-theme.css') }}" />
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('front/css/plugins/magnific-popup.css') }}" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}" />
    <!--~~~~~~~~~~~~~~ Animate ~~~~~~~~~~~~~~~-->
    <link rel="stylesheet" href="{{ asset('front/js/animate.css/animete.css') }}">
    <!--~~~~~~~~~~~~~~~~ wow ~~~~~~~~~~~~~~~~~-->
    <script src="{{ asset('front/js/wow.js/wow.min.js') }}"></script>
    {{-- flagsicon --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet"
        type="text/css" />
    {{-- Easy Country Picker --}}
    <link rel="stylesheet" href="{{ asset('front/css/plugins/country-picker-flags/css/countrySelect.min.css') }}">

    <title>Fluxel Code</title>
</head>

<body>

    @yield('content')

    <!-- ======== Java Script ======== -->
    <script src="{{ asset('front/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <!-- Bootstrap 4.1.3 -->
    <script src="{{ asset('front/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('front/js/plugins/slick.min.js') }}"></script>
    <!-- Couner Up-->
    <script src="{{ asset('front/js/plugins/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins/jquery.counterup.min.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('front/js/plugins/wow.min.js') }}"></script>
    <!-- Magnific Popup-->
    <script src="{{ asset('front/js/plugins/magnific-popup.min.js') }}"></script>
    <!-- Main Js-->
    <script src="{{ asset('front/js/main.js') }}"></script>

    {{-- jquery validator --}}
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/localization/messages_es.min.js') }}"></script>
    <script src="{{ asset('front/js/validation.js') }}"></script>
    {{-- recaptcha --}}
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
    <script src="{{ asset('front/js/recaptcha.js') }}"></script>
    <!-- Google Translate -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="{{ asset('front/js/google-translate.js') }}"></script>
    {{-- Easy Country Picker --}}
    <script src="{{ asset('front/js/plugins/countrySelect.min.js') }}"></script>
    {{-- axios --}}
    <script src="{{ asset('js/Plugins/axios.min.js') }}"></script>

    <script>
        var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0, // distance to the element when triggering the animation (default is 0)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true, // act on asynchronously loaded content (default is true)
            callback: function(box) {
                // the callback is fired every time an animation is started
                // the argument that is passed in is the DOM node being animated
            },
            scrollContainer: null, // optional scroll container selector, otherwise use window,
            resetAnimation: true, // reset animation on end (default is true)
        });
        wow.init();
    </script>

    @yield('js')
</body>

</html>
