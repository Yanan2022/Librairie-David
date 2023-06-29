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

    <link rel="stylesheet" href="assets/css/loading.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclure jQuery UI Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
     <script>
        // Utilisez une bibliothèque JavaScript d'autocomplétion comme jQuery UI Autocomplete ou une autre de votre choix

        // Exemple avec jQuery UI Autocomplete
        $(function() {
            $('#autocomplete').autocomplete({
                source: function(request, response) {
                    // Effectuez une requête AJAX pour récupérer les suggestions d'autocomplétion
                    $.ajax({
                        url: '/autocomplete', // Remplacez cette URL par celle de votre route de recherche d'autocomplétion
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 2 // Définissez la longueur minimale pour déclencher l'autocomplétion
            });
        });
    </script>

</body>

</html>
