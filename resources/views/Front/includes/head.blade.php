

    @if(app()->environment('production'))
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-450PZVJBPW"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-450PZVJBPW');
        </script>
    @endif

    <!-- Google tag (gtag.js) -->

    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{$setting->company_name??'Tempus'}}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    @php
        $faviconUrl = "#";
        $type = 'image/x-icon';


        if($setting && $setting->logo) {
            $faviconUrl = asset('storage/' . $setting->logo);
            $extension = pathinfo($setting->logo, PATHINFO_EXTENSION);
            $type = ($extension == 'ico') ? 'image/x-icon' : 'image/' . $extension;
        }
    @endphp

    <link rel="shortcut icon" type="{{$type}}" href="{{ $faviconUrl }}"/>
    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="32x32" href="{{ $faviconUrl }}">
    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $faviconUrl }}">
    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="{{ $faviconUrl }}">
    <!-- Library - Loader CSS -->


    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/loader/loaders.min.css">

    <!-- Library - Google Font Familys -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:wght@400;700&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">


    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/bootstrap/bootstrap.min.css">

    <!-- Font Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/fonts/elegant-icons.css">

    <!-- Library - OWL Carousel V.2.0 beta -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/owl-carousel/owl.theme.css">

    <!-- Library - Animate CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/animate/animate.min.css">

    <!-- Library - Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/magnific-popup/magnific-popup.css">

    <!-- Custom - Common CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/plugins.css">
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/navigation-menu.css">

    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/all-ie-only.css"/>
    <![endif]-->

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/shortcodes.css">

    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/css/custom.css">


    <!--[if lt IE 9]>
    <script src="{{asset("assets")}}/js/html5/respond.min.js"></script>
    <![endif]-->

