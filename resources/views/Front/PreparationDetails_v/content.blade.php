<div class="page-banner services-banner container-fluid no-padding img-trieangle">
    <div id="banner-slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="banner-img custom-banner-height">
                    <img src="{{ asset('storage/'.$preparation->image) }}"
                         class="img-responsive"
                         alt="{{$preparation->image_alt_text??''}}">

                    <div class="banner-overlay-text" style="position: absolute; top: 40%; left: 0; transform: translateY(-50%); width: 100%; z-index: 2;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-9 col-xs-8">
                                    <div class="entry-title-area modern-glass-card">
                                        <h2 class="main-title" style="color: #fff; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                                            {{ $preparation->name }}
                                        </h2>
                                        <div class="post-meta-custom">
                                            <span style="color: #eee; font-size: 1.1rem;">{{ $preparation->title }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-4 text-right">
                                    <a href="#" class="btn-goster">Göstər</a>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <div class="banner-overlay-text"--}}
{{--                         style="position: absolute; top: 40%; left: 0; transform: translateY(-50%); width: 100%; z-index: 2;">--}}
{{--                        <div class="container">--}}
{{--                            <div class="entry-title-area modern-glass-card">--}}
{{--                                <h2 class="main-title" style="color: #fff; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">--}}
{{--                                    {{ $preparation->name }}--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta-custom">--}}
{{--                                    <span style="color: #eee; font-size: 1.1rem;">{{ $preparation->title }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>





{{--<div class="page-banner services-banner container-fluid no-padding img-trieangle">--}}
{{--    <div id="banner-slider" class="carousel slide" data-ride="carousel">--}}
{{--        <div class="carousel-inner" role="listbox">--}}
{{--            <div class="item active">--}}
{{--                <div class="banner-img custom-banner-height">--}}
{{--                    <img src="{{ asset('storage/'.$preparation->image) }}"--}}
{{--                         class="d-block w-100"--}}
{{--                         style="height: auto; display: block;"--}}
{{--                         alt="{{$preparation->image_alt_text??''}}">--}}

{{--                    <div class="banner-overlay-text"--}}
{{--                         style="position: absolute; top: 30%; left: 0; transform: translateY(-50%); width: 100%; z-index: 2;">--}}
{{--                        <div class="container">--}}
{{--                            <h1 class="d-none d-md-block" style="color: #fff; margin-bottom: 10px;">--}}
{{--                            </h1>--}}

{{--                            <div class="entry-title-area modern-glass-card">--}}
{{--                                <h2 class="main-title" style="color: #fff;">--}}
{{--                                    {{ $preparation->name }}--}}
{{--                                </h2>--}}
{{--                                <div class="post-meta-custom">--}}
{{--                                    <span style="color: #eee;">{{ $preparation->title }}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}







{{-- Blog + Sidebar container --}}
<div class="container-fluid no-padding page-content" id="mainContent">
    <div class="container-fluid px-3 px-lg-5">
        <div class="row">

            {{-- Blog content --}}
            <div class="col-lg-9 col-md-12 col-12 blog-area mb-4">

                <div id="pdfContainer" style="width:100%; max-width:1000px; margin:0 auto; padding:10px; background: #2098df;">
                    <div id="pageInfo" style="color: white; margin-bottom: 10px; text-align: center; font-family: sans-serif;"></div>

                    <div id="pdfWrapper" style="display:flex; flex-direction:column; gap:15px; align-items: center;">
                    </div>

                    <div id="loading" style="text-align:center; padding:50px; color: white; font-family: sans-serif;">
                        <div class="spinner"></div>
                    </div>
                </div>



            </div>

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-12 col-12 widget-area mb-4">
                <aside class="widget widget-categories bg-light p-3 rounded">
                    <h3 class="widget-title">
                        {{$siteContent['home_preparation_category']->value??'Kateqoriya'}}
                    </h3>
                    <ul class="categories-type list-unstyled">
                        @foreach($allCategories as $category)
                            <li class="mb-2">
                                <a href="{{route('category-details',$category->id)}}"
                                   class="d-flex justify-content-between">
                                    <span>{{$category->name}}</span>
                                    <span>({{$category->preparations_count}})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            </div>

        </div>
    </div>
</div>
