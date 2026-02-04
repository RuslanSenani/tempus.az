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


{{--<div class="page-banner services-banner container-fluid no-padding img-trieangle" >--}}
{{--    <div id="banner-slider" class="carousel slide" data-ride="carousel" data-interval="10000">--}}
{{--        <div class="carousel-inner" role="listbox">--}}
{{--            @foreach($abouts as $key => $about)--}}
{{--                <div class="item {{ $key == 0 ? 'active' : '' }}">--}}
{{--                    <div class="banner-img">--}}
{{--                        <img  src="{{ asset('storage/'.$about->image) }}" alt="banner">--}}
{{--                    </div>--}}

{{--                    <div class="banner-overlay-text">--}}
{{--                        <div class="container">--}}
{{--                            <h1>{{$siteContent['home_about_us']->value ?? ''}}</h1>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<!-- Message Borad -->
<div id="message-borad" class="container-fluid no-padding message-borad">
    <!-- Container -->
    <div class="container">
        <div class="row">
            <!-- Emargency Case -->
            <div class="col-md-6 col-sm-6 emargency-case">
                <div class="col-md-6 message-block no-left-padding">
                    <h3>{{$siteContent['home_preparations']->value??'Preparatlar'}}</h3>
                    <a href="{{route('preparation')}}">{{$siteContent['home_more_details']->value??'Daha Ətraflı

'}}<i class="fa fa-caret-right"></i></a>
                </div>
                <div class="col-md-6 message-block no-right-padding">
                    <h3>{{$siteContent['home_medical_information']->value??'Tibbi Məlumatlar'}}</h3>
                    <a href="{{route('medical-info')}}">{{$siteContent['home_more_details']->value??'Daha Ətraflı'}}<i
                            class="fa fa-caret-right"></i></a>
                </div>
            </div><!-- Emargency Case /- -->
            <!-- Opening Hours -->
            <div class="col-md-6 col-sm-6 opening-hours">

                <div class="col-md-6 message-block">
                    <h3>{{$siteContent['home_online_sales']->value??'Onlayn Satış'}}</h3>
                    <a href="{{route('contact')}}">{{$siteContent['home_contact_us']->value??'Bizimlə əlaqə saxlayın'}}
                        <i
                            class="fa fa-caret-right"></i></a>
                </div>
                <div class="col-md-6 message-block no-padding">
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
        <div class="section-header">
            <h3>{{$siteContent['home_about_us']->value??''}}</h3>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="image-stack">
                    <div class="image-stack__item image-stack__item--top">
                        <img
                            src="{{asset('assets')}}/images/closeup-view-pharmacist-hand.jpg"
                            alt="Pharmacist" class="img-fluid shadow rounded">
                    </div>
                    <div class="image-stack__item image-stack__item--bottom">
                        <img
                            src="{{asset('assets')}}/images/portrait-doctor.jpg"
                            alt="Doctor" class="img-fluid shadow rounded">
                    </div>
                    <div class="decorative-box shadow-sm"></div>
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5">

                <h1 class="display-5 fw-bold mb-4">
                    <span
                        style="color: #71C0DF; font-style: italic;">{{$siteContent['home_company_name']->value??'Tempus MMC'}}</span>
                    <span
                        style="color: #4C70B5;">{{$siteContent['home_company_title']->value??'Azərbaycanda “Şirkətlər Qrupu”nun bir hissəsidir.'}}</span>
                </h1>
                <div class="about-text text-muted mb-4">
                    <p> {!! $setting->mission !!}</p>
                    <p> {!! $setting->vision !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="call-out" class="container-fluid no-padding call-out">
    <!-- Container -->
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
    </div><!-- Container /- -->
</div><!-- Call Out /- -->

<!-- What We Do Best -->
<div id="what-we-do-best" class="container-fluid no-padding what-we-do-best">
    <div class="section-header" style="margin-bottom: 10px;">
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
                        <i><img src="{{asset("storage/".$category->image)}}" alt="{{$category->slug??''}}"/></i>
                        <h5>{{$category->name}}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- What We Do Best Right /- -->
</div><!-- What We Do Best /- -->


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


<div class="container-fluid no-padding latest-news">
    <!-- Container -->
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <h3>{{$siteContent['home_medical_information']->value??'Medical Informasiya'}}</h3>
        </div><!-- Section Header /- -->
        <div class="row">
            @foreach($medicalInfos as $medicalInfo)

                <article class="col-md-6 col-sm-12 col-xs-12">
                    <div class="entry-header">
                        <div class="entry-cover">
                            <img src="{{asset('storage/'.$medicalInfo->image??'')}}" alt="latest-news"/>
                            <a href="{{route('medical-info-details',$medicalInfo->id)}}" class="read-more"><i
                                    class="fa fa-link"></i>{{$siteContent['home_read_more']->value??'Ətraflı Oxu'}}
                            </a>
                        </div>
                    </div>
                    <div class="entry-content">
                        <p>
                            {!! \Illuminate\Support\Str::words(strip_tags($medicalInfo->content),50,'...')??''  !!}
                        </p>

                    </div>
                </article>
            @endforeach
        </div>
    </div><!-- Container /- -->
</div><!-- Latest News /- -->


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
                        <i class="statistics-icon"><img alt="statistics-icon"
                                                        src="{{asset("assets")}}/images/icon-1.png"></i>
                        <div class="statistics-content">
                            <span data-statistics_percent="{{$statistic->preparation_count??''}}"
                                  id="statistics_count-1">{{$statistic->title??''}}</span>
                            <p>{{$statistic->preparation??''}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="statistics-box">
                        <i class="statistics-icon"><img alt="statistics-icon"
                                                        src="{{asset("assets")}}/images/icon-2.png"></i>
                        <div class="statistics-content">
                            <span data-statistics_percent="{{$statistic->customer_count??''}}"
                                  id="statistics_count-2">{{$statistic->customer_count??''}}</span>
                            <p>{{$statistic->customer??''}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="statistics-box">
                        <i class="statistics-icon"><img alt="statistics-icon"
                                                        src="{{asset("assets")}}/images/icon-3.png"></i>
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




















{{--<div class="container-fluid no-padding department-section">--}}
{{--    <div class="we-are-best col-md-6 col-sm-12 no-padding">--}}
{{--        <div class="section-header">--}}
{{--            <h3>Why We Are Best</h3>--}}
{{--            <p>Accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum delaut eniti atque--}}
{{--                corrupti quos dolores et quas.</p>--}}
{{--        </div>--}}
{{--        <div class="we-are-best-block">--}}
{{--            <div class="we-are-best-icon">--}}
{{--                <img src="{{asset("assets")}}/images/dp-icon-1.png" alt="dp-icon-1"/>--}}
{{--            </div>--}}
{{--            <div class="we-are-best-content">--}}
{{--                <h3>Free Medical Counseling</h3>--}}
{{--                <p>Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores euas molestias excepturi sint--}}
{{--                    occaecati cupiditate.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="we-are-best-block">--}}
{{--            <div class="we-are-best-icon">--}}
{{--                <img src="{{asset("assets")}}/images/dp-icon-2.png" alt="dp-icon-2"/>--}}
{{--            </div>--}}
{{--            <div class="we-are-best-content">--}}
{{--                <h3>Well Experienced Doctors</h3>--}}
{{--                <p>Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores euas molestias excepturi sint--}}
{{--                    occaecati cupiditate.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="we-are-best-block">--}}
{{--            <div class="we-are-best-icon">--}}
{{--                <img src="{{asset("assets")}}/images/dp-icon-3.png" alt="dp-icon-3"/>--}}
{{--            </div>--}}
{{--            <div class="we-are-best-content">--}}
{{--                <h3>Online Bill Payment</h3>--}}
{{--                <p>Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores euas molestias excepturi sint--}}
{{--                    occaecati cupiditate.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-6 col-sm-12 departments no-padding">--}}
{{--        <div class="departments-bg">--}}
{{--            <img src="{{asset("assets")}}/images/departments-bg.jpg" alt="departments-bg"/>--}}
{{--        </div>--}}
{{--        <div class="section-header">--}}
{{--            <h3>Hospital Departments</h3>--}}
{{--        </div>--}}
{{--        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading" role="tab" id="dept-heading1">--}}
{{--                    <h4 class="panel-title">--}}
{{--                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dept-type-1"--}}
{{--                           aria-expanded="true">--}}
{{--                            Ophthalmology Clinic<i class="fa fa-plus pull-right"></i>--}}
{{--                        </a>--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div id="dept-type-1" class="panel-collapse collapse in" role="tabpanel"--}}
{{--                     aria-labelledby="dept-heading1">--}}
{{--                    <div class="panel-img">--}}
{{--                        <img src="{{asset("assets")}}/images/panel-img-1.jpg" alt="panel-img"/>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <p>Blanditiis praesentium voluptatum delniti atque corrupti quos dlores quas molestias excepturi--}}
{{--                            sint occaecati cupiditate non provident siili sunt in culpa qui officia deserunt.</p>--}}
{{--                        <a href="#">More Details<i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading" role="tab" id="dept-heading2">--}}
{{--                    <h4 class="panel-title">--}}
{{--                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"--}}
{{--                           href="#dept-type-2" aria-expanded="false">--}}
{{--                            Cardiac Clinic<i class="fa fa-plus pull-right"></i>--}}
{{--                        </a>--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div id="dept-type-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dept-heading2">--}}
{{--                    <div class="panel-img">--}}
{{--                        <img src="{{asset("assets")}}/images/panel-img-1.jpg" alt="panel-img"/>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <p>Blanditiis praesentium voluptatum delniti atque corrupti quos dlores quas molestias excepturi--}}
{{--                            sint occaecati cupiditate non provident siili sunt in culpa qui officia deserunt.</p>--}}
{{--                        <a href="#">More Details<i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading" role="tab" id="dept-heading3">--}}
{{--                    <h4 class="panel-title">--}}
{{--                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"--}}
{{--                           href="#dept-type-3" aria-expanded="false">--}}
{{--                            Outpatient Surgery<i class="fa fa-plus pull-right"></i>--}}
{{--                        </a>--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div id="dept-type-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dept-heading3">--}}
{{--                    <div class="panel-img">--}}
{{--                        <img src="{{asset("assets")}}/images/panel-img-1.jpg" alt="panel-img"/>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <p>Blanditiis praesentium voluptatum delniti atque corrupti quos dlores quas molestias excepturi--}}
{{--                            sint occaecati cupiditate non provident siili sunt in culpa qui officia deserunt.</p>--}}
{{--                        <a href="#">More Details<i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading" role="tab" id="dept-heading4">--}}
{{--                    <h4 class="panel-title">--}}
{{--                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"--}}
{{--                           href="#dept-type-4" aria-expanded="false">--}}
{{--                            Pediatric Clinic<i class="fa fa-plus pull-right"></i>--}}
{{--                        </a>--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div id="dept-type-4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dept-heading4">--}}
{{--                    <div class="panel-img">--}}
{{--                        <img src="{{asset("assets")}}/images/panel-img-1.jpg" alt="panel-img"/>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <p>Blanditiis praesentium voluptatum delniti atque corrupti quos dlores quas molestias excepturi--}}
{{--                            sint occaecati cupiditate non provident siili sunt in culpa qui officia deserunt.</p>--}}
{{--                        <a href="#">More Details<i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading" role="tab" id="dept-heading5">--}}
{{--                    <h4 class="panel-title">--}}
{{--                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"--}}
{{--                           href="#dept-type-5" aria-expanded="false">--}}
{{--                            Gynaecological Clinic<i class="fa fa-plus pull-right"></i>--}}
{{--                        </a>--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div id="dept-type-5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dept-heading5">--}}
{{--                    <div class="panel-img">--}}
{{--                        <img src="{{asset("assets")}}/images/panel-img-1.jpg" alt="panel-img"/>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <p>Blanditiis praesentium voluptatum delniti atque corrupti quos dlores quas molestias excepturi--}}
{{--                            sint occaecati cupiditate non provident siili sunt in culpa qui officia deserunt.</p>--}}
{{--                        <a href="#">More Details<i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading" role="tab" id="dept-heading6">--}}
{{--                    <h4 class="panel-title">--}}
{{--                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"--}}
{{--                           href="#dept-type-6" aria-expanded="false">--}}
{{--                            Ophthalmology Clinic<i class="fa fa-plus pull-right"></i>--}}
{{--                        </a>--}}
{{--                    </h4>--}}
{{--                </div>--}}
{{--                <div id="dept-type-6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dept-heading6">--}}
{{--                    <div class="panel-img">--}}
{{--                        <img src="{{asset("assets")}}/images/panel-img-1.jpg" alt="panel-img"/>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        <p>Blanditiis praesentium voluptatum delniti atque corrupti quos dlores quas molestias excepturi--}}
{{--                            sint occaecati cupiditate non provident siili sunt in culpa qui officia deserunt.</p>--}}
{{--                        <a href="#">More Details<i class="fa fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<div class="container-fluid no-padding latest-news">--}}
{{--    <!-- Container -->--}}
{{--    <div class="container">--}}
{{--        <!-- Section Header -->--}}
{{--        <div class="section-header">--}}
{{--            <h3>Recent tips & News</h3>--}}
{{--            <a href="#">view More Post<i class="fa fa-plus"></i></a>--}}
{{--        </div><!-- Section Header /- -->--}}
{{--        <div class="row">--}}
{{--            <article class="col-md-6 col-sm-12 col-xs-12">--}}
{{--                <div class="entry-header">--}}
{{--                    <div class="entry-cover">--}}
{{--                        <a href="blog-post.html"><img src="{{asset("assets")}}/images/latest-news-1.jpg"--}}
{{--                                                      alt="latest-news"/></a>--}}
{{--                        <a href="blog-post.html" class="read-more"><i class="fa fa-link"></i>Read More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="entry-content">--}}
{{--                    <div class="entry-meta">--}}
{{--                        <a href="#"><i class="fa fa-comment-o"></i>Comments<span>(12)</span></a>--}}
{{--                        <a href="#"><i class="fa fa-heart-o"></i>Favorite<span>(11)</span></a>--}}
{{--                        <a href="#"><i class="fa fa-share-alt"></i>Share Post<span>(12)</span></a>--}}
{{--                    </div>--}}
{{--                    <h3 class="entry-title"><a href="blog-post.html">Latest Blog new Slider Image Post</a></h3>--}}
{{--                    <div class="post-meta">--}}
{{--                        <a href="#" title="25th sep 2015" class="post-date">25th sep 2015</a> by--}}
{{--                        <a href="#" title="Mathov" class="post-admin">Mathov</a> in Hospital--}}
{{--                    </div>--}}
{{--                    <p>Voluptatem accusantium dolormque laudantium sa tota rem aperiam, eaque ipsa dicta sunt explicabo--}}
{{--                        nemo enim ipsam [...] </p>--}}
{{--                </div>--}}
{{--            </article>--}}
{{--            <article class="col-md-6 col-sm-12 col-xs-12">--}}
{{--                <div class="entry-header">--}}
{{--                    <div class="entry-cover">--}}
{{--                        <a href="blog-post.html"><img src="{{asset("assets")}}/images/latest-news-2.jpg"--}}
{{--                                                      alt="latest-news"/></a>--}}
{{--                        <a href="blog-post.html" class="read-more"><i class="fa fa-link"></i>Read More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="entry-content">--}}
{{--                    <div class="entry-meta">--}}
{{--                        <a href="#"><i class="fa fa-comment-o"></i>Comments<span>(18)</span></a>--}}
{{--                        <a href="#"><i class="fa fa-heart-o"></i>Favorite<span>(16)</span></a>--}}
{{--                        <a href="#"><i class="fa fa-share-alt"></i>Share Post<span>(13)</span></a>--}}
{{--                    </div>--}}
{{--                    <h3 class="entry-title"><a href="blog-post.html">Plan the most effective strategy</a></h3>--}}
{{--                    <div class="post-meta">--}}
{{--                        <a href="#" title="30th sep 2015" class="post-date">30th sep 2015</a> by--}}
{{--                        <a href="#" title="Mathov" class="post-admin">Mathov</a> in Hospital--}}
{{--                    </div>--}}
{{--                    <p>Voluptatem accusantium dolormque laudantium sa tota rem aperiam, eaque ipsa dicta sunt explicabo--}}
{{--                        nemo enim ipsam [...] </p>--}}
{{--                </div>--}}
{{--            </article>--}}
{{--        </div>--}}
{{--    </div><!-- Container /- -->--}}
{{--</div>--}}
