<!-- Main Container -->
<div class="main-container">
    <!-- Header -->

    <!-- Page Banner -->
    <div class="page-banner about-banner container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <h3>{{$siteContent['home_about_us']->value ?? ''}}</h3>
            <p>
                @foreach($abouts as $about)
                    {{$about->title}}
                @endforeach
            </p>

            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li class="active">About Us</li>
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

    <!-- Who We Are -->
    <div class="container-fluid no-paddding who-we-are">
        <!-- Container -->
        <div class="container">
            <div class="who-we-are-block">
                <!-- Section Header -->
                <div class="section-header">
                    <h3>Who we are</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium,</p>
                    <p>totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
                </div><!-- Section Header /- -->
            </div>
        </div><!-- Container /- -->
    </div><!-- Who We Are /- -->

    <!-- Service Section -->
    <div id="service-section" class="container-fluid no-padding service-section service-section2">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Service -->
                <div class="col-md-8 col-sm-12 col-xs-12 service">
                    <div class="section-header">
                        <h3>About Maxi Health</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="service-block">
                                <div class="service-block-icon">
                                    <i><img src="../../../../../assets/images/ambulance.png" alt="ambulance"/></i>
                                    <i><img src="../../../../../assets/images/ambulance-white.png"
                                            alt="ambulance-white"/></i>
                                </div>
                                <div class="service-block-content">
                                    <h3>Emergency services</h3>
                                    <p>Dolor sit amet consecdi pisicing eliam sed do eiusmod tempornu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="service-block">
                                <div class="service-block-icon">
                                    <i><img src="../../../../../assets/images/heart-ic.png" alt="heart-ic"/></i>
                                    <i><img src="../../../../../assets/images/heart-ic-white.png" alt="heart-ic-white"/></i>
                                </div>
                                <div class="service-block-content">
                                    <h3>Qualified Doctors</h3>
                                    <p>Dolor sit amet consecdi pisicing eliam sed do eiusmod tempornu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="service-block">
                                <div class="service-block-icon">
                                    <i><img src="../../../../../assets/images/phone.png" alt="phone"/></i>
                                    <i><img src="../../../../../assets/images/phone-white.png" alt="phone-white"/></i>
                                </div>
                                <div class="service-block-content">
                                    <h3>24/7 support</h3>
                                    <p>Dolor sit amet consecdi pisicing eliam sed do eiusmod tempornu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="service-block">
                                <div class="service-block-icon">
                                    <i><img src="../../../../../assets/images/appoinment-latter.png"
                                            alt="appoinment-latter"/></i>
                                    <i><img src="../../../../../assets/images/appoinment-latter-white.png"
                                            alt="appoinment-latter-white"/></i>
                                </div>
                                <div class="service-block-content">
                                    <h3>online appointment</h3>
                                    <p>Dolor sit amet consecdi pisicing eliam sed do eiusmod tempornu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Service /- -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <!-- Appointment Form -->
                    <form class="appoinment-form">
                        <h3><img src="../../../../../assets/images/appoinment.png" alt="appoinment"/>Appointment form
                        </h3>
                        <div class="form-group col-md-12 no-padding">
                            <input type="text" id="your-name" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group col-md-12 no-padding">
                            <input type="email" id="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group input-group col-md-12 no-padding">
                            <div class="col-md-7 no-padding">
                                <div class="col-md-6 col-sm-4 col-xs-4 no-left-padding">
                                    <select class="form-control">
                                        <option>Day</option>
                                        <option>Sunday</option>
                                        <option>Monday</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-4 no-left-padding">
                                    <select class="form-control">
                                        <option>Time</option>
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-4 col-xs-4 no-padding">
                                <select class="form-control">
                                    <option>Doctor Name</option>
                                    <option>Mr.XYZ</option>
                                    <option>Mr.ABC</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                            <textarea rows="4" id="textarea_message" class="form-control"
                                      placeholder="Your Message..."></textarea>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                            <input type="checkbox"><span>Send Email Notification</span>
                            <button type="submit" id="btn_submit" class="btn-submit pull-right">
                                <img src="../../../../../assets/images/heart-sm.png" alt="heart-sm">Submit
                            </button>
                        </div>
                    </form><!-- Appointment Form /- -->
                </div>
            </div>
        </div><!-- Container /- -->
    </div><!-- Service Section /- -->

    <!-- Team Section -->
    <div id="team-section" class="container-fluid no-paddding team-section">
        <div class="container">
            <div class="section-header">
                <h3>meet our doctors</h3>
                <p>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>
            </div>
            <div class="team-carousel">
                <div class="col-md-12 team-type">
                    <img src="../../../../../assets/images/doctor-1.jpg" alt="doctor-1"/>
                    <div class="member-content">
                        <div class="member-name">
                            <h6>Dr.Adaline Becka</h6>
                            <p>Dental Specialist</p>
                        </div>
                        <div class="member-contact">
                            <a title="Phone" href="#"><img src="../../../../../assets/images/ftr-phone.png"
                                                           alt="Phone"/></a>
                            <a title="Mail" href="#"><img src="../../../../../assets/images/ftr-email.png" alt="Email"/></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 team-type">
                    <img src="../../../../../assets/images/doctor-2.jpg" alt="doctor-2"/>
                    <div class="member-content">
                        <div class="member-name">
                            <h6>Dr.Adaline Becka</h6>
                            <p>Dental Specialist</p>
                        </div>
                        <div class="member-contact">
                            <a title="Phone" href="#"><img src="../../../../../assets/images/ftr-phone.png"
                                                           alt="Phone"/></a>
                            <a title="Mail" href="#"><img src="../../../../../assets/images/ftr-email.png" alt="Email"/></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 team-type">
                    <img src="../../../../../assets/images/doctor-3.jpg" alt="doctor-3"/>
                    <div class="member-content">
                        <div class="member-name">
                            <h6>Dr.Adaline Becka</h6>
                            <p>Dental Specialist</p>
                        </div>
                        <div class="member-contact">
                            <a title="Phone" href="#"><img src="../../../../../assets/images/ftr-phone.png"
                                                           alt="Phone"/></a>
                            <a title="Mail" href="#"><img src="../../../../../assets/images/ftr-email.png" alt="Email"/></a>
                        </div>
                    </div>
                </div>
            </div>
            <a title="View All Doctors" href="#">View All Doctors<i class="fa fa-plus"></i></a>
        </div>
    </div><!-- Team Section -->

    <!-- Testimonial Section -->
    <div id="testimonial-section" class="container-fluid no-padding testimonial-section">
        <div class="container">
            <div class="section-header">
                <h3>What Our Patients Are Saying</h3>
            </div>
            <!-- Testimonial Carousel -->
            <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <p>It’s really Awesome Theme & specialy made for Hospitality &amp; Medical, so this theme uniqe
                            elements use to create your dream website and help to promote your Business.</p>
                        <div class="testimonial-quote">
                            <i><img src="../../../../../assets/images/quote.png" alt="quote"></i>
                            <h4>San michle</h4>
                            <p>Cancer Patient - Newyork</p>
                        </div>
                    </div>
                    <div class="item">
                        <p>It’s really Awesome Theme & specialy made for Hospitality &amp; Medical, so this theme uniqe
                            elements use to create your dream website and help to promote your Business.</p>
                        <div class="testimonial-quote">
                            <i><img src="../../../../../assets/images/quote.png" alt="quote"></i>
                            <h4>San michle</h4>
                            <p>Cancer Patient - Newyork</p>
                        </div>
                    </div>
                    <div class="item">
                        <p>It’s really Awesome Theme & specialy made for Hospitality &amp; Medical, so this theme uniqe
                            elements use to create your dream website and help to promote your Business.</p>
                        <div class="testimonial-quote">
                            <i><img src="../../../../../assets/images/quote.png" alt="quote"></i>
                            <h4>San michle</h4>
                            <p>Cancer Patient - Newyork</p>
                        </div>
                    </div>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#testimonial-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#testimonial-carousel" data-slide-to="1"></li>
                    <li data-target="#testimonial-carousel" data-slide-to="2"></li>
                </ol>
            </div><!-- Testimonial Carousel /- -->
        </div>
    </div><!-- Testimonial Section /- -->

</div><!-- Main Container -->
