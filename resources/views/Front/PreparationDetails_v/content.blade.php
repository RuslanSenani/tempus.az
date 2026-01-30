<!-- Page Banner -->
<div class="page-banner about-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$siteContent['home_preparations']->value ?? ''}}</h3>

        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_preparations_details']->value??''}}</li>
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


<!-- Page Content -->
<div class="container-fluid no-padding page-content">
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Blog Area -->
            <div class="col-md-9 col-sm-8 col-xs-12 blog-area">
                <article class="blog-post-list single-post col-md-12 col-sm-12 col-xs-12">
                    <div class="entry-header">
                        <div class="entry-cover">
                            <img src="{{asset('storage/'.$preparation->image)}}"
                                 alt="{{$preparation->image_alt_text ?? 'Image'}}"/>
                        </div>
                    </div>
                    <div class="entry-content">
                        {!! $preparation->description !!}
                    </div>
                </article>


            </div><!-- Blog Area /- -->

            <!-- Widget Area -->
            <div class="col-md-3 col-sm-4 col-xs-12 widget-area no-left-padding">


                <!-- Widget Categories -->
                <aside class="widget widget-categories">
                    <h3 class="widget-title">{{$siteContent['home_preparation_category']->value??'Kateqoriya'}}</h3>
                    <ul class="categories-type">
                        @foreach($allCategories as $category)
                            <li><a href="{{route('category-details',$category->id)}}"
                                   title="Ambulance">{{$category->name}}
                                    <span>( {{$category->preparations_count}} )</span></a>
                            </li>
                        @endforeach
                    </ul>
                </aside><!-- Categories /- -->

            </div><!-- Widget Area /- -->
        </div><!-- Row /- -->
    </div><!-- Container /- -->
</div><!-- Page Content /- -->

