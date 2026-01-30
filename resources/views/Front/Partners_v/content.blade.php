
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

