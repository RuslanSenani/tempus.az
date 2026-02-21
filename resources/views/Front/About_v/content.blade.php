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
                                <h1>{{$siteContent['home_about_us']->value ?? ''}}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Page Banner -->

    <div id="about-section" class="container py-5 my-5">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="about-title-box">
                    <h2 class="display-5 fw-bold mt-2">{{$siteContent['home_how_we_are']->value ?? 'Biz Kimik?'}}</h2>
                    <div class="title-line"></div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="about-content-card shadow-sm p-4 p-md-5 border-0">
                    <div class="about-text-wrapper">
                        {!! $setting->about_us ?? 'Haqqımızda məlumat tezliklə əlavə olunacaq.' !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container my-5 py-5">

        <div class="row g-4 align-items-stretch">

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-lg custom-vision-card">
                    <div class="card-body p-5">
                        <div class="icon-box mb-4">
                            <i class="fas fa-eye fa-3x text-primary"></i> </div>
                        <h1 class="fw-bold mb-3">{{$siteContent['home_our_vision']->value ?? 'Vizionumuz'}}</h1>
                        <div class="description-text">
                            {!! $setting->vision ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-lg custom-mission-card">
                    <div class="card-body p-5">
                        <div class="icon-box mb-4">
                            <i class="fas fa-bullseye fa-3x text-success"></i> </div>
                        <h1 class="fw-bold mb-3">{{$siteContent['home_our_mission']->value ?? 'Missiyamız'}}</h1>
                        <div class="description-text">
                            {!! $setting->mission ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div><!-- Main Container -->
