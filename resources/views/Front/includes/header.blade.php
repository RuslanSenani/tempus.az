<header class="header-main">
    <!-- Top Header -->


    <div class="top-header container-fluid no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    Sol tərəf boşdur
                </div>


                <div class="col-md-5 text-right">
                    <ul class="header-social-and-lang">
                        <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>

                <div class="dropdown language-dropdown" id="langDropdownWrap">
                    <button class="btn btn-light d-flex align-items-center gap-2"
                            type="button"
                            id="langToggle">
                        <i class="fa-solid fa-earth-asia"></i>
                        <span id="currentLang">English</span>
                        <i class="fa fa-chevron-down ms-1 small"></i>
                    </button>

                    <ul class="dropdown-menu" id="langMenu">
                        <li><a class="dropdown-item" href="#">🇦🇿 Azərbaycan</a></li>
                        <li><a class="dropdown-item" href="#">🇬🇧 English</a></li>
                        <li><a class="dropdown-item" href="#">🇷🇺 Русский</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>


    <!-- Top Header /- -->


    <!-- Logo Block -->
    <div class="middle-header container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-md-3 logo-block pull-left">
                    <a href="#" title="Logo"><img src="{{ $setting->logo_url }}" alt="Logo"/></a>
                </div>
                <div class="col-md-9 text-right pull-right">
                    <div class="location">
                        <h3><img src="{{asset("assets")}}/images/location-ic.png" alt="Location"/> Our Location</h3>
                        <p>E44 - Web Corner, Melbourne - 18</p>
                    </div>
                    <div class="phone">
                        <h3><img src="{{asset("assets")}}/images/phone-ic.png" alt="phone"/> (+1)800 433 633</h3>
                        <p>Call Us Now- 24/7 Customer Support</p>
                    </div>
                </div>
            </div>
        </div><!-- Container -->
    </div><!-- Logo Block /- -->
    <!-- Navigation -->
    <nav class="navbar ow-navigation">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="team.html">Our Team</a></li>
                        <li><a href="departments.html">departments</a></li>
                        <li><a href="gallery.html">Gallery </a></li>
                        <li class="dropdown">
                            <a href="blog.html" class="dropdown-toggle" role="button" aria-haspopup="true"
                               aria-expanded="false">Blog</a>
                            <i class="ddl-switch fa fa-angle-down"></i>
                            <ul class="dropdown-menu">
                                <li><a href="blog-post.html">Blog Post</a></li>
                            </ul>
                        </li>
                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
