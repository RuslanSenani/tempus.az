<!-- Page Banner -->
<div class="page-banner services-banner container-fluid no-padding img-trieangle">

    <img src="{{asset('storage/'.$medicalInfo->image??'')}}" class="banner-img" alt="">

    <div class="container position-relative">
        <h3>{{$siteContent['home_medical_information']->value??''}}</h3>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_medical_information']->value??''}}</li>
        </ol>
    </div>

</div>

<!-- Page Banner /- -->


<!-- Latest News -->
<div class="container-fluid no-padding latest-news">
    <!-- Container -->
    <div class="container">
        <!-- Section Header -->
        <div class="section-header">
            <h3>{{$medicalInfo->title??''}}</h3>
        </div><!-- Section Header /- -->
        <div class="row">
            <article class="col-md-12 col-sm-12 col-xs-12">

                <div class="entry-content">
                    <p>{!! $medicalInfo->content??'' !!}</p>
                </div>
            </article>
        </div>
    </div><!-- Container /- -->
</div><!-- Latest News /- -->
