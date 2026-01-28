{{--<!-- Portfolio Section -->--}}
{{--<div class="portfolio-section container-fluid no-padding">--}}
{{--    <div class="section-padding"></div>--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">--}}
{{--                <div id="portfolio" class="">--}}

{{--                    <div class="container my-5">--}}
{{--                        <div class="row">--}}

{{--                            @foreach($partners as $partner)--}}
{{--                                <div class="col-6 col-md-3 col-lg-2">--}}
{{--                                    <div class="partner-card text-center">--}}
{{--                                        <div class="partner-logo-wrapper">--}}
{{--                                            <a href="#"><img--}}
{{--                                                    src="{{asset('storage/'.$partner->logo??'')}}"--}}
{{--                                                    alt="{{$partner->name}}"--}}
{{--                                                    class="img-fluid partner-logo">--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <h5 class="partner-title">{{$partner->name??''}}</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Pagination -->--}}
{{--        <nav class="ow-pagination">--}}
{{--            {{ $partners->links('partials.pagination', ['partners' => $partners]) }}--}}
{{--        </nav>--}}
{{--        <!-- Pagination /- -->--}}
{{--    </div>--}}
{{--    <div class="section-padding"></div>--}}
{{--</div><!-- Portfolio Section /- -->--}}

<div id="what-we-do-best" class="container-fluid no-padding what-we-do-best">
    <!-- What We Do Best Left -->

    <!-- What We Do Best Right -->
    <div class="col-md-12  no-padding">
        @foreach($partners as $partner)

            <div class="col-md-3 col-sm-4 col-6 mb-4">
                <div class="product-box">
                    <a href="#" class="product-link">
                        <div class="product-img-wrapper">
                            <img src="{{asset('storage/'.$partner->logo)}}"
                                 alt="{{$partner->name??''}}"
                                 class="img-fluid">
                        </div>
                        <div class="product-info text-center mt-2">
                            <h5 class="product-title">{{$partner->name}}</h5>
                        </div>
                    </a>
                </div>
            </div>

        @endforeach
    </div>

    <!-- Pagination -->
    <nav class="ow-pagination">
        {{ $partners->links('partials.pagination', ['routeName'=>'partners.page','pages' => $partners]) }}
    </nav>
    <!-- Pagination /- -->

    <!-- What We Do Best Right /- -->
</div>

