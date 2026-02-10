<div class="page-banner services-banner container-fluid no-padding img-trieangle">
    <div id="banner-slider" class="carousel slide" data-ride="carousel" >
        <div class="carousel-inner" role="listbox">
            @foreach($medicalInfos as $medicalInfo)
                <div class="item active">
                    <div class="banner-img custom-banner-height">
                        <img src="{{ asset('storage/'.$medicalInfo->image) }}"
                             class="d-block w-100"
                             alt="{{$medicalInfo->image_alt_text??''}}">
                    </div>

                    <div class="banner-overlay-text"
                         style="position: absolute; top: 50%; left: 0; transform: translateY(-50%); width: 100%; z-index: 2;">
                        <div class="container">
                            <h1 class="d-none d-md-block" style="color: #fff; margin-bottom: 10px;">
                            </h1>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


{{--<!-- Page Banner -->--}}
{{--<div class="page-banner services-banner container-fluid no-padding img-trieangle">--}}

{{--    <img src="../../../../../assets/images/latest-news-1.jpg" class="banner-img" alt="">--}}

{{--    <div class="container position-relative">--}}
{{--        <h3>{{$siteContent['home_medical_information']->value??''}}</h3>--}}
{{--        <ol class="breadcrumb">--}}
{{--            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>--}}
{{--            <li class="active">{{$siteContent['home_medical_information']->value??''}}</li>--}}
{{--        </ol>--}}
{{--    </div>--}}

{{--</div>--}}

{{--<!-- Page Banner /- -->--}}


<!-- Latest News -->
<div class="container-fluid no-padding latest-news">
    <!-- Container -->
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <h3>Recent tips & News</h3>
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
