<!-- Page Banner -->
<div class="page-banner services-banner container-fluid no-padding img-trieangle">

    <img src="../../../../../assets/images/latest-news-1.jpg" class="banner-img" alt="">

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
