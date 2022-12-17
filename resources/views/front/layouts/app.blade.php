<!DOCTYPE html>
<html lang="fr">

<head>
    @section("base")
        <base href="{{ url('/catalogue') }}/">
    @show
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @section("title") Accueil @show
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/color-01.css">
</head>

<body class="home-page home-01 ">

    <!-- mobile menu -->
    @include('front.partials.menu')
    <!-- end menu -->
    <!--header-->
    @include('front.partials.header')
    <!--end header-->

    @yield("content")

    <!--footer area-->
     @include('front.partials.footer')
    <!--end footer-->

    <script src="assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4"></script>
    <script src="assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/chosen.jquery.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>
    <script src="assets/js/functions.js"></script>
    @yield('scripts')
</body>

</html>
