<div class="page-banner services-banner container-fluid no-padding img-trieangle">
    <div id="banner-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="banner-img custom-banner-height">
                    <img src="{{ asset('storage/'.$preparation->image) }}"
                         class="d-block w-100"
                         style="height: auto; display: block;"
                         alt="{{$preparation->image_alt_text??''}}">

                    <div class="banner-overlay-text"
                         style="position: absolute; top: 30%; left: 0; transform: translateY(-50%); width: 100%; z-index: 2;">
                        <div class="container">
                            <h1 class="d-none d-md-block" style="color: #fff; margin-bottom: 10px;">
                            </h1>

                            <div class="entry-title-area modern-glass-card">
                                <h2 class="main-title" style="color: #fff;">
                                    {{ $preparation->name }}
                                </h2>
                                <div class="post-meta-custom">
                                    <span style="color: #eee;">{{ $preparation->title }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid no-padding page-content">
    <div class="container-fluid px-lg-5">
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12 blog-area">
                <article class="blog-post-list single-post">


                    <div class="entry-content" style="clear: both; padding-top: 10px; line-height: 0.1;">
                        {!! $preparation->description !!}
                    </div>

                </article>
            </div>

            <div class="col-md-3 col-sm-12 col-xs-12 widget-area">
                <aside class="widget widget-categories" style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
                    <h3 class="widget-title">{{$siteContent['home_preparation_category']->value??'Kateqoriya'}}</h3>
                    <ul class="categories-type">
                        @foreach($allCategories as $category)
                            <li>
                                <a href="{{route('category-details',$category->id)}}">
                                    {{$category->name}}
                                    <span class="pull-right">( {{$category->preparations_count}} )</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</div>


{{--<!-- Page Content -->--}}
{{--<div class="container-fluid no-padding page-content">--}}
{{--    <!-- Container -->--}}
{{--    <div class="container">--}}
{{--        <!-- Row -->--}}
{{--        <div class="row">--}}
{{--            <!-- Blog Area -->--}}
{{--            <div class="col-md-9 col-sm-8 col-xs-12 blog-area">--}}
{{--                <article class="blog-post-list single-post col-md-12 col-sm-12 col-xs-12">--}}
{{--                    <div class="entry-header">--}}
{{--                        <div class="entry-cover">--}}
{{--                            <img src="{{asset('storage/'.$preparation->image)}}"--}}
{{--                                 alt="{{$preparation->image_alt_text ?? 'Image'}}"/>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="entry-content">--}}
{{--                        {!! $preparation->description !!}--}}
{{--                    </div>--}}
{{--                </article>--}}


{{--            </div><!-- Blog Area /- -->--}}

{{--            <!-- Widget Area -->--}}
{{--            <div class="col-md-3 col-sm-4 col-xs-12 widget-area no-left-padding">--}}


{{--                <!-- Widget Categories -->--}}
{{--                <aside class="widget widget-categories">--}}
{{--                    <h3 class="widget-title">{{$siteContent['home_preparation_category']->value??'Kateqoriya'}}</h3>--}}
{{--                    <ul class="categories-type">--}}
{{--                        @foreach($allCategories as $category)--}}
{{--                            <li><a href="{{route('category-details',$category->id)}}"--}}
{{--                                   title="Ambulance">{{$category->name}}--}}
{{--                                    <span>( {{$category->preparations_count}} )</span></a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </aside><!-- Categories /- -->--}}

{{--            </div>--}}
{{--            <!-- Widget Area /- -->--}}
{{--        </div><!-- Row /- -->--}}
{{--    </div><!-- Container /- -->--}}
{{--</div><!-- Page Content /- -->--}}

