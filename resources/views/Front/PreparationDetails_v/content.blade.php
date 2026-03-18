<section class="product-banner position-relative overflow-hidden py-5" style="background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            min-height: 400px; display: flex; align-items: center;">

    <div class="position-absolute top-0 start-0 w-100 h-100 z-n1">
        <img src="{{ asset('storage/'.$preparation->image) }}"
             alt="{{$preparation->image_alt_text??''}}"
             class="w-100 h-100 object-fit-cover shadow-sm"
             style="object-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-white opacity-25"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">

                <div class="content-box p-4 p-md-5 shadow-sm"
                     style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-radius: 15px; border: 1px solid rgba(255,255,255,0.3);">

                    <h1 class="fw-bold fs-3 text-dark mb-3">
                        {!! $preparation->name !!}
                    </h1>

                    @if(isset($preparation->official_document))
                        <div class="mt-4">
                            <a href="{{ asset('storage/' . $preparation->official_document) }}"
                               target="_blank"
                               class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 py-2 shadow-sm"
                               style="border-radius: 50px; background-color: #4C70B5; border: none;">
                                <span
                                    class="fw-bold"
                                    style="color: white;!important;">{{ $siteContent['home_view_loyal_document']->value ?? 'Qeydiyyat vəsiqəsi' }} </span>
                            </a>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</section>


{{-- Blog + Sidebar container --}}
<div class="container-fluid no-padding page-content" id="mainContent">
    <div class="container-fluid px-3 px-lg-5">
        <div class="row">

            {{-- Blog content --}}
            <div class="col-lg-9 col-md-12 col-12 blog-area mb-4">

                <div id="pdfContainer"
                     style="width:100%; max-width:1000px; margin:0 auto; padding:10px; background: #2098df;">
                    <div id="pageInfo"
                         style="color: white; margin-bottom: 10px; text-align: center; font-family: sans-serif;"></div>

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
