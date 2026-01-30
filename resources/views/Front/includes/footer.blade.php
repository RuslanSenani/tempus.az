
<footer class="footer-main container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <!-- Contact Detail -->
        <div class="contact-details">
            <div class="col-md-4 col-sm-4 address-box detail-box">
                <i><img src="{{asset("assets")}}/images/ftr-location.png" alt="Loactaion"/></i>
                <h4>{{$siteContent['home_tempus_adrress']->value??'Addresimiz'}}</h4>
                <p>{{$setting->address??''}}</p>
            </div>
            <div class="col-md-4 col-sm-4 phone-box detail-box">
                <i><img src="{{asset("assets")}}/images/ftr-phone.png" alt="Phone"/></i>
                <h4>{{$siteContent['home_contact']->value??'Əlaqə'}}</h4>
                <p><a href="tel:{{$setting->phone_1??''}}">{{$setting->phone_1??''}}</a></p>
                <p><a href="tel:{{$setting->fax_1??''}}">{{$setting->fax_1??''}}</a></p>
            </div>
            <div class="col-md-4 col-sm-4 mail-box detail-box">
                <i><img src="{{asset("assets")}}/images/ftr-email.png" alt="Email"/></i>
                <h4>{{$siteContent['home_electron_address']->value??''}}</h4>
                <p><a href="mailto:{{$setting->email??''}}">{{$setting->email??''}}</a></p>
            </div>
        </diV><!-- Contact Detail /- -->

        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <aside class="widget widget-about">
                    <h3>
                        @if($setting && $setting->logo)
                            <img src="{{ asset('storage/Logo/' . $setting->logo) }}" class="img-responsive main-logo"
                                 alt="Logo"/>
                        @else
                            <img src="{{ asset('assets/images/default-logo.png') }}" class="img-responsive main-logo"
                                 alt="Logo"/>
                        @endif
                    </h3>
                </aside>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">

            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <aside class="widget widget-links">
                    <h3 class="widget-title">{{$siteContent['home_preparation_category']->value??'Kateqoriya'}}</h3>
                    <ul>
                        @foreach($allCategories as $category)
                            <li><a href="{{route('category-details',$category->id)}}"
                                   title="Prostheses">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </aside>
            </div>

        </div>
    </div><!-- Container /- -->
    <!-- Bottom Footer -->
    <div class="container-fluid no-padding bottom-footer">
        <p>&copy; 2015 Maxi Health. All Rights Reserved.</p>
    </div><!-- Bottom Footer /- -->
</footer>
