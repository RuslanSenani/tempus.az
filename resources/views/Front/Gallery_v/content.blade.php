<!-- Page Banner -->
<div class="page-banner contact-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$siteContent['home_media']->value??''}}</h3>

        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_media']->value??''}}</li>
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
</div>
<!-- Page Banner /- -->


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
