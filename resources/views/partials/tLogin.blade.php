<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/equation/html/semi-dark-menu/auth-boxed-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Feb 2024 03:03:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>SignIn Boxed | EQUATION - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="https://designreset.com/equation/html/src/assets/img/favicon.ico"/>
    <link href="{{ asset('/layouts/semi-dark-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/layouts/semi-dark-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/layouts/semi-dark-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/layouts/semi-dark-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="../src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/layouts/semi-dark-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/src/assets/css/dark/authentication/auth-boxed.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                @yield('content')
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>

<!-- Mirrored from designreset.com/equation/html/semi-dark-menu/auth-boxed-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Feb 2024 03:03:24 GMT -->
</html>