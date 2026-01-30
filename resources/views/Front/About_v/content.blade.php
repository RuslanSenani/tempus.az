<!-- Main Container -->
<div class="main-container">
    <!-- Header -->

    <!-- Page Banner -->
    <div class="page-banner about-banner container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <h3>{{$siteContent['home_about_us']->value ?? 'Hakkımızda'}}</h3>
            <p>
                @foreach($abouts as $about)
                    {{$about->title}}
                @endforeach
            </p>

            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??'Əsas Səhifə'}}</a></li>
                <li class="active">{{$siteContent['home_about_us']->value ?? 'Hakkımızda'}}</li>
            </ol>
        </div><!-- Container /- -->
        <!-- Shape -->
        <div class="banner-shape container-fluid no-padding">
            <div class="col-md-6 col-sm-6 col-xs-6 shape-left no-padding">
                <div class="left-shape-blue">
                    <svg width="100%" height="100%">
                        <clipPath id="clipPolygon2" clipPathUnits="objectBoundingBox">
                            <polygon points="0 0, 0 100, 120 100, 0 0"></polygon>
                        </clipPath>
                    </svg>
                </div>
                <div class="left-shape">
                    <svg width="100%" height="100%">
                        <clipPath id="clipPolygon1" clipPathUnits="objectBoundingBox">
                            <polygon points="0 0, 0 100, 100 100, 0 0"></polygon>
                        </clipPath>
                    </svg>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 shape-right no-padding">
                <div class="right-shape-blue">
                    <svg width="100%" height="100%">
                        <clipPath id="clipPolygon3" clipPathUnits="objectBoundingBox">
                            <polygon points="1 0.2, 0 1, 0 0.835, 1 0"></polygon>
                        </clipPath>
                    </svg>
                </div>
                <div class="right-shape">
                    <svg width="100%" height="100%">
                        <clipPath id="clipPolygon4" clipPathUnits="objectBoundingBox">
                            <polygon points="1 0, 0 1, 100 100, 100 0"></polygon>
                        </clipPath>
                    </svg>
                </div>
            </div>
        </div><!-- Shape -->
    </div><!-- Page Banner /- -->

    <!-- Who We Are -->
    <div class="container-fluid no-paddding who-we-are">
        <!-- Container -->
        <div class="container">
            <div class="who-we-are-block">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>{{$siteContent['home_how_we_are']->value??'Biz Kimik'}}</h3>
                </div><!-- Section Header /- -->
            </div>
        </div><!-- Container /- -->
    </div><!-- Who We Are /- -->

    <!-- Service Section -->
    <div id="service-section" class="container-fluid no-padding service-section service-section2">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Service -->
                <div class="col-md-12 col-sm-12 col-xs-12 service">
                    <div class="section-header">
                        <p>
                            {!! $setting->about_us??''!!}
                        </p>
                    </div>
                </div><!-- Service /- -->

            </div>
        </div><!-- Container /- -->
    </div><!-- Service Section /- -->

    <!-- Team Section -->
    <div id="team-section" class="container-fluid no-paddding team-section">
        <div class="container">
            <div class="section-header">
                <h3>{{$siteContent['home_our_vision']->value??'Vizion'}}</h3>
                <p>
                    {!! $setting->vision??'' !!}
                </p>
            </div>
        </div>
    </div><!-- Team Section -->

    <!-- Testimonial Section -->
    <div id="testimonial-section" class="container-fluid no-padding testimonial-section">
        <div class="container">
            <div class="section-header">
                <h3>{{$siteContent['home_our_mission']->value??'Missya'}}</h3>
            </div>
            <!-- Testimonial Carousel -->
            <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <p>

                            {!! $setting->mission??'' !!}
                        </p>

                    </div>

                </div>
            </div><!-- Testimonial Carousel /- -->
        </div>
    </div><!-- Testimonial Section /- -->

</div><!-- Main Container -->
