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





<div class="container mt-5">

    <h2>{{ $preparation->title }}</h2>

    @if($preparation->pdf)

        {{-- Tam ekran genişlikdə button --}}
        <button class="pdf-open-btn mt-4 mb-3" onclick="openPdfViewer()">
            {{$siteContent['home_open_pdf']->value??''}}
        </button>

        {{-- PDF viewer canvas --}}
        <div id="pdfViewerContainer"
             style="display:none; margin-top:10px; width:100%; max-width:100%; overflow-x:auto;">
            <div class="mb-3 d-flex gap-2 flex-wrap">
                <button class="btn btn-success" onclick="zoomIn()">Zoom +</button>
                <button class="btn btn-warning" onclick="zoomOut()">Zoom -</button>
                <a href="{{ asset('storage/' . $preparation->pdf) }}" download
                   class="btn btn-info">{{$siteContent['home_download']->value??''}}</a>
                <button class="btn btn-secondary"
                        onclick="closePdfViewer()">{{$siteContent['home_exit_pdf']->value??''}}</button>
            </div>

            <div style="width:100%;">
                <canvas id="pdfCanvas" style="border:1px solid #ccc; width:100%; height:auto; display:block;"></canvas>
            </div>
        </div>

    @endif

</div>

{{-- Blog + Sidebar container --}}
<div class="container-fluid no-padding page-content" id="mainContent">
    <div class="container-fluid px-3 px-lg-5">
        <div class="row">

            {{-- Blog content --}}
            <div class="col-lg-9 col-md-12 col-12 blog-area mb-4">
                <article class="blog-post-list single-post">
                    <div class="entry-content pt-2">
                        {!! $preparation->description !!}
                    </div>
                </article>
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
