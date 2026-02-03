<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--}}
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{$setting->company_name??'Tempus'}}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Standard Favicon -->
    @if($setting && $setting->logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/Logo/'.$setting->logo) }}"/>
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
    @endif

    <!-- For iPhone 4 Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('storage/Logo/'.$setting->logo??'')}}">

    <!-- For iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('storage/Logo/'.$setting->logo??'')}}">

    <!-- For iPhone: -->
    <link rel="apple-touch-icon-precomposed" href="{{asset('storage/Logo/'.$setting->logo??'')}}">

    <!-- Library - Loader CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets")}}/libraries/loader/loaders.min.css">

    <!-- Library - Google Font Familys -->
    <link href='{{asset("assets")}}/fonts.googleapis.com/css812c.css?family=PT+Sans:400,400italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <link href='{{asset("assets")}}/fonts.googleapis.com/csse491.css?family=Raleway:400,100,200,300,500,600,700,800,900'
          rel='stylesheet' type='text/css'>
    <link href='{{asset("assets")}}/fonts.googleapis.com/csse3e5.css?family=Montserrat:400,700' rel='stylesheet'
          type='text/css'>
    <link href='{{asset("assets")}}/fonts.googleapis.com/cssf60f.css?family=Philosopher:400,400italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <link
        href='{{asset("assets")}}/fonts.googleapis.com/css0733.css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>

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

</head>
