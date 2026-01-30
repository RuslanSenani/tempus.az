<!-- Page Banner -->
<div class="page-banner about-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$siteContent['home_preparations']->value ?? ''}}</h3>

        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_preparations']->value??''}}</li>
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


<!-- What We Do Best -->
<div id="what-we-do-best" class="container-fluid no-padding what-we-do-best">
    <!-- What We Do Best Left -->

    <!-- What We Do Best Right -->

    @foreach($preparations as $preparation)
        @php
            $count = $preparations->count();
            $col = match($count) {
                1 => 12,
                2 => 6,
                3 => 4,
                default => 3,
            };
        @endphp
        <div class="col-md-{{$col}} col-sm-4 col-6 mb-4">
            <div class="product-box">
                <a href="{{route('preparation-detail',$preparation->id)}}" class="product-link">
                    <div class="product-img-wrapper">
                        <img src="{{asset('storage/'.$preparation->image)}}"
                             alt="Urifar"
                             class="img-fluid">
                    </div>
                    <div class="product-info text-center mt-2">
                        <h1 class="product-title mt-2"
                            style="display: inline-block; border-bottom: 2px solid #007bff; padding-bottom: 5px; font-size: 20px;">
                            {{$preparation->category->name}}
                        </h1>
                        <h6 class="product-title mt-2">{{$preparation->name}}</h6>
                    </div>
                </a>
            </div>
        </div>

    @endforeach


    <!-- Pagination -->
    <nav class="ow-pagination">
        {{ $preparations->links('partials.pagination', ['routeName'=>'preparation.page','pages' => $preparations]) }}
    </nav>
    <!-- Pagination /- -->
    <!-- What We Do Best Right /- -->
</div>
<!-- What We Do Best /- -->
