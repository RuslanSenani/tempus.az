<!-- Page Banner -->

<div class="page-banner services-banner container-fluid no-padding img-trieangle">
    <div id="banner-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            @foreach($abouts as $key => $about)
                <div class="item {{ $key == 0 ? 'active' : '' }}">
                    <div class="banner-img custom-banner-height">
                        <img src="{{ asset('storage/'.$about->image) }}" class="d-block w-100" alt="banner">
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


<!-- Message Borad -->
<div id="message-borad" class="container-fluid no-padding message-borad">
    <!-- Container -->
    <div class="container">
        <div class="row">
            <!-- Emargency Case -->
            <div class="col-md-6 col-sm-6 emargency-case">
                <div class="col-md-6 message-block no-left-padding">
                    <h3>{{$siteContent['home_preparations']->value??'Preparatlar'}}</h3><a
                        href="{{route('preparation')}}">{{$siteContent['home_more_details']->value??'Daha Ətraflı'}}
                        <i class="fa fa-caret-right"></i></a>
                </div>
                <div class="col-md-6 message-block no-right-padding">
                    <h3>{{$siteContent['home_media']->value??'Media'}}</h3>
                    <a href="{{route('media')}}">{{$siteContent['home_more_details']->value??'Daha Ətraflı'}}<i
                            class="fa fa-caret-right"></i></a>
                </div>
            </div>
            <!-- Opening Hours -->
            <div class="col-md-6 col-sm-6 opening-hours">


                <div class="col-md-12 message-block no-padding">
                    <h3>{{$siteContent['home_opening_hours']->value??'Açılış saatları'}}</h3>
                    <ul>
                        <li>{{$siteContent['home_opening_mon_fri']->value??'Bazar ertəsi - cümə'}}
                            <span class="pull-right">{{$siteContent['home_opening_mon_fri_time']->value??''}}</span>
                        </li>
                        <li>{{$siteContent['home_opening_sat']->value??'Şənbə'}}<span class="pull-right">
                                {{$siteContent['home_opening_sat_time']->value??''}}
                            </span>
                        </li>
                        <li>{{$siteContent['home_opening_sun']->value??'Bazar Günü'}}<span class="pull-right">
                                {{$siteContent['home_opening_sun_time']->value??''}}
                            </span></li>
                    </ul>
                </div>
            </div><!-- Opening Hours /- -->
        </div>
    </div><!-- Container /- -->
</div>


<!-- Message Borad /- -->
<section class="about-section py-5" style="margin-bottom: 50px;margin-top: 50px;">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-5 mb-lg-0">

                <div class="image-stack">
                    <div class="image-stack__item image-stack__item--top">
                        <img
                            src="{{asset('assets')}}/images/portrait-doctor.jpg"

                            alt="Pharmacist" class="img-fluid shadow rounded">
                    </div>
                    <div class="image-stack__item image-stack__item--bottom">
                        <img
                            src="{{asset('assets')}}/images/closeup-view-pharmacist-hand.jpg"
                            alt="Doctor" class="img-fluid shadow rounded">
                    </div>
                    <div class="decorative-box shadow-sm"></div>
                </div>
            </div>
            <div class="section-header" style="margin-bottom: 10px;">
                <h3>{{$siteContent['home_about_us']->value??''}}</h3>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0">

                <div class="about-card glass-effect h-100 p-4 p-md-5 shadow-lg">
                    <div class="section-lead fs-5 text-secondary leading-relaxed">
                        {!! $setting->about_us ?? 'Haqqımızda məlumat tezliklə əlavə olunacaq.' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="call-out" class="container-fluid no-padding call-out">
    <div class="container">
        <div class="call-out-content row">
            <div class="col-md-10 col-sm-9 col-xs-12">

            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <a href="{{route('about-us')}}">
                    {{$siteContent['home_more_details']->value??'Daha ətraflı '}}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- What We Do Best -->
<div id="what-we-do-best" class="container-fluid no-padding what-we-do-best">
    <div class="section-header" style="margin-bottom: 10px;margin-top: 10px;">
        <h3>{{$siteContent['home_preparation_category']->value??''}}</h3>
    </div>
    <div class="what-we-do-left col-md-4 no-padding">
        <img src="{{asset("assets")}}/images/what-we-do-best.jpg" alt="what-we-do-best">
    </div>


    <div class="col-md-8 what-we-do-right no-padding">

        @foreach($categories as $category)
            <div class="col-md-4 col-sm-4 col-xs-6 no-padding">
                <div class="what-we-do-block">
                    <img src="{{asset("assets")}}/images/what-we-do-best-block-bg.jpg" alt="what-we-do-best"/>
                    <div class="what-we-do-block-content">
                        <i> <a href="{{route('category-details',$category->id)}}">
                                <img src="{{asset("storage/".$category->image)}}" alt="{{$category->slug??''}}"/>
                            </a>
                        </i>
                        <h5>{{$category->name}}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- What We Do Best Right /- -->
</div>
<!-- What We Do Best /- -->


<div id="call-out" class="container-fluid no-padding call-out">
    <!-- Container -->
    <div class="container">
        <div class="call-out-content row">
            <div class="col-md-10 col-sm-9 col-xs-12">

            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <a href="{{route('all-categories')}}">
                    {{$siteContent['home_more_details']->value??'Daha ətraflı '}}
                </a>
            </div>
        </div>
    </div><!-- Container /- -->
</div><!-- Call Out /- -->


<!-- Portfolio Section -->
<div class="portfolio-section container-fluid no-padding">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                <div id="portfolio" class="">
                    @foreach($media as $med)
                        <div class="portfolio-item facilities col-md-4 col-sm-6">
                            <img src="../../../../../assets/images/portfolio-1.jpg" alt="Portfolio"/>
                            {{--                            <a href="../../../../../assets/images/portfolio-1.jpg" title=""><img--}}
                            {{--                                    src="../../../../../assets/images/plus.png" alt="portfolio-arrow"/></a>--}}
                            <div class="portfolio-item-hover">
                                <h3><a href="">{{$siteContent['home_more_details']->value??''}}</a></h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <nav class="ow-pagination">
            {{ $media->links('partials.pagination', ['routeName'=>'media.page','pages' => $media]) }}
        </nav>
        <!-- Pagination /- -->
    </div>
    <div class="section-padding"></div>
</div>
<!-- Portfolio Section /- -->

<!-- Counter Section -->
<div id="counter-section" class="container-fluid no-padding counter-section">
    <!-- Container -->
    <div class="container">
        <div class="col-md-6 col-sm-6 no-padding">
            <!-- Happy Customer -->
            <div class="happy-customer">
                <h3 class="block-title" style="font-size: 50px;"><span>{{$setting->phone_1??''}}</span></h3>
                <p>{{$statistic->title??''}}</p>
                <a href="tel:{{$setting->phone_1??''}}"><i
                        class="fa fa-phone"></i>{{$siteContent['home_contact_us']->value??''}}</a>
            </div><!-- Happy Customer /- -->
        </div>
        <div class="col-md-6 col-sm-6 no-padding">
            <!-- Counter App -->
            <div class="counter-app">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="statistics-box">

                        <div class="statistics-content">
                            <span data-statistics_percent="{{$statistic->preparation_count??''}}"
                                  id="statistics_count-1">{{$statistic->title??''}}</span>
                            <p>{{$statistic->preparation??''}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="statistics-box">

                        <div class="statistics-content">
                            <span data-statistics_percent="{{$statistic->customer_count??''}}"
                                  id="statistics_count-2">{{$statistic->customer_count??''}}</span>
                            <p>{{$statistic->customer??''}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="statistics-box">

                        <div class="statistics-content">
                            <span data-statistics_percent="{{$statistic->partner_count??''}}"
                                  id="statistics_count-3">{{$statistic->partner_count??''}}</span>
                            <p>{{$statistic->partner??''}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="statistics-box">

                    </div>
                </div>
            </div><!-- Counter App /- -->
        </div>
    </div><!-- Container /- -->
</div><!-- Counter Section /- -->

