<!-- Page Banner -->
<div class="page-banner contact-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$siteContent['home_contact']->value??''}}</h3>

        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_contact']->value??''}}</li>
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


<!-- Container -->
<div class="container">
    <!-- Contact Us -->
    <div class="contact-us">
        <div class="col-md-4 col-sm-4">
            <div class="contact-block">
                <i class="fa fa-map-marker"></i>
                <span>{{$siteContent['home_tempus_adrress']->value??'Addresimiz'}}</span>
                <p>{{$setting->address??''}}</p>

            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="contact-block">
                <i class="fa fa-mobile"></i>
                <span>{{$siteContent['home_phone']->value??'Telefon'}}</span>
                <p><a href="tel:{{$setting->phone_1??''}}">{{$setting->phone_1??''}}</a></p>
                <p><a href="tel:{{$setting->fax_1??''}}">{{$setting->fax_1??''}}</a></p>

            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="contact-block">
                <i class="fa fa-envelope"></i>
                <span>Email</span>
                <p><a title="Mailto" href="mailto:{{$setting->email??''}}">{{$setting->email??''}}</a></p>
            </div>
        </div>
    </div><!-- Contact Us /- -->
</div><!-- Container /- -->

<!-- Map Section -->
<div class="map container-fluid no-padding">
    <div class="map-canvas" id="map-canvas-contact" data-lat="-37.818415" data-lng="144.989050"
         data-string="E-44, Design Street, Web Corner, Melbourne - 005" data-zoom="12"></div>
</div>
<!--  Map Section /- -->

<!-- Container -->
<div class="container">
    <!-- Enquiry Us -->
    <div class="leave-comment enquiry-us">
        <h3 class="section-heading">{{$siteContent['home_contact_us']->value??''}}</h3>
        <form id="contact-form" class="comment-form enquiry-form" method="POST" action="{{route('contact-us')}}">
            @csrf
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" name="contact_name" class="form-control" value="{{old('name')}}" id="name"
                               required/>
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail*</label>
                        <input type="email" name="contact_email" class="form-control" value="{{old('email')}}"
                               id="email" required/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number*</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{old('phone')}}" id="phone"
                               required/>
                    </div>
                    <div class="form-group">
                        <label for="message">Details</label>
                        <textarea class="form-control" name="contact_message" id="message">
                            {{old('message')}}
                        </textarea>

                    </div>
                    <div class="form-group">
                        <input type="submit" name="post">
                    </div>
                    <div id="alert-msg" class="alert-msg"></div>
                </div>

            </div>
        </form>
    </div><!-- Enquiry Us /- -->
</div><!-- Container /- -->
