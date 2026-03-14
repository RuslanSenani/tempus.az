<!-- Main Container -->
<div class="main-container">
    <!-- Header -->


    <div class="page-banner services-banner container-fluid no-padding img-trieangle">



        <div id="banner-slider" class="carousel slide" data-ride="carousel" data-interval="10000">
            <div class="carousel-inner" role="listbox">
                @foreach($abouts as $key => $about)
                    <div class="item {{ $key == 0 ? 'active' : '' }}">
                        <div class="banner-img">
                            <img src="{{ asset('storage/'.$about->image) }}" alt="banner">
                        </div>

                        <div class="banner-overlay-text">
                            <div class="container">
                                <h3>{{$siteContent['home_about_us']->value ?? ''}}</h3>
                                <p>

                                </p>

                                <ol class="breadcrumb">
                                    <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??'Home'}}</a></li>
                                    <li class="active">{{$siteContent['home_about_us']->value??''}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Page Banner -->

    <section id="about-section" class="py-5 mt-5 position-relative overflow-hidden">
        <div class="bg-circle-1"></div>
        <div class="bg-circle-2"></div>

        <div class="container position-relative">
            <div class="row align-items-stretch">

                <div class="col-lg-3 d-flex flex-column justify-content-center border-start-custom mb-4 mb-lg-0">
                    <div class="ps-4">
                        <h2 class="display-4 fw-bolder text-dark mb-0">
                            {{$siteContent['home_how_we_are']->value ?? 'Biz Kimik?'}}
                        </h2>
                        <div class="custom-underline mt-3"></div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-card glass-effect h-100 p-4 p-md-5 shadow-lg">
                        <div class="section-lead fs-5 text-secondary leading-relaxed">
                            {!! $setting->about_us ?? 'Haqqımızda məlumat tezliklə əlavə olunacaq.' !!}
                            {!! $setting->history ?? '' !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div
                            class="logo-grid-card h-100 d-flex flex-column justify-content-between p-4 shadow-sm bg-white rounded-4 border border-light">
                        <div class="logo-flex">
                            <img src="{{ asset('storage/' . $setting->logo) }}" class="brand-logo" alt="Logo 1"/>
                            <img src="{{ asset('storage/' . $setting->logo1) }}" class="brand-logo" alt="Logo 2"/>
                            <img src="{{ asset('storage/' . $setting->logo2) }}" class="brand-logo" alt="Logo 3"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="about-regional-section py-100">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="company-info pe-lg-5">

                        <div class="custom-blue-border text-muted fs-5">
                            {!! $setting->activity_zone ?? '' !!}
                        </div>
                        <div class=" mb-6">
                            <img src="{{asset('storage/'.$setting->active_zone_logo)}}"
                                 alt="Tempus Logo" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="region-card shadow-lg">
                        <h4 class="region-card-title">{{$siteContent['home_regional_units']->value??''}}</h4>
                        <div class="row custom-gutter">
                            @foreach($regions as $region)
                                <div class="col-sm-6 col-md-4">
                                    <div class="region-pill">
                                        <i class="bi bi-geo-alt-fill text-primary"></i>
                                        <span>{{$region}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="about-regional-section py-100">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="company-info pe-lg-5">
                        <img src="{{asset('storage/'.$setting->activities_logo)}}"
                             alt="" class="img-fluid">

                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="region-card shadow-lg">
                        <h4 class="region-card-title">{{$siteContent['home_about_activities']->value??''}}</h4>
                        <div class="row custom-gutter">
                            {!! $setting->activities??'' !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-12 mb-5 text-center">
                <h2 class="section-title fw-bold">{{$siteContent['home_therapeutic_activity']->value??''}}</h2>
                <div class="title-divider mx-auto"></div>
            </div>

            @php
                $half = ceil($categories->count() / 2);
            @endphp

            <div class="col-lg-6">
                <div class="therapeutic-card shadow-sm">
                    <ul class="list-unstyled mb-0">

                        @foreach($categories as $index => $item)

                            @if($index == $half)
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="therapeutic-card shadow-sm">
                    <ul class="list-unstyled mb-0">
                        @endif

                        <li class="therapeutic-item {{ $item->is_otc ? 'highlight-item' : '' }}">
                            @if($item->is_otc)
                                <i class="bi bi-patch-check-fill text-success me-2"></i>
                            @endif
                            <span><a href="{{route('category-details',$item->id)}}">{{ $item->name }}</a></span>
                        </li>

                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-mission-wrapper">
        <section class="mission-section"
                 style="background: url('{{asset('storage/'.$setting->mission_vision_logo)}}') no-repeat center center;background-size: cover;
    min-height: 450px;
    display: flex;
    align-items: center;
    padding: 60px 0;
    font-family: sans-serif;">
            <div class="container">
                <div class="row">


                    <div class="col-lg-6">
                        <div class="card h-100 border-0 shadow-lg custom-mission-card">
                            <div class="card-body p-5">

                                <h1 class="fw-bold mb-3">{{$siteContent['home_our_mission']->value ?? 'Missiyamız'}}</h1>
                                <div class="description-text">
                                    {!! $setting->mission ?? '' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card h-100 border-0 shadow-lg custom-vision-card">
                            <div class="card-body p-5">

                                <h1 class="fw-bold mb-3">{{$siteContent['home_our_vision']->value ?? 'Vizionumuz'}}</h1>
                                <div class="description-text">
                                    {!! $setting->vision ?? '' !!}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>


</div><!-- Main Container -->
