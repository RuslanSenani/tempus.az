<header class="header-main">
    <!-- Top Header -->
    <div class="top-header container-fluid no-padding">
        <!-- Container -->

        <div class="container-fluid p-0 text-right">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end align-items-center py-2 pr-3">
                        <div class="dropdown custom-lang-dropdown">
                            <button class="btn btn-link dropdown-toggle lang-btn" type="button" id="langSelector"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-globe mr-1"></i>
                                <span class="current-lang-text">{{ strtoupper(app()->getLocale()) }}</span>
                                <i class="fa fa-angle-down ml-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0"
                                 aria-labelledby="langSelector">
                                @foreach($languages as $lang)
                                    @if(app()->getLocale() !==$lang->code)
                                        <a class="dropdown-item @if(app()->getLocale() == $lang->code) active @endif d-flex align-items-center"
                                           href="{{ route('lang.switch', $lang->code) }}">
                                            <span class="lang-code">{{ strtoupper($lang->code) }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
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
                    <a href="#" title="Logo"><img src="{{asset("assets")."/Logo".$setting->logo??''}}" alt="Logo"/></a>
                </div>
                <div class="col-md-9 text-right pull-right">
                    <div class="location">
                        <h3><img src="{{asset("assets")}}/images/location-ic.png"
                                 alt="Location"/> {{$siteContent['home_our_location']->value??''}}</h3>
                        <p>{{$setting->address??''}}</p>
                    </div>
                    <div class="phone">
                        <h3><img src="{{asset("assets")}}/images/phone-ic.png" alt="phone"/> {{$setting->phone_1??''}}
                        </h3>
                        <p>{{$siteContent['home_call_us']->value??''}}</p>
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
                    <ul class="nav navbar-nav d-flex justify-content-between w-100">
                        <li class="active px-1"><a
                                    href="index.html">{{$siteContent['home_home']->value??'Əsas Səhifə'}}</a></li>
                        <li class="px-1"><a href="about.html">{{$siteContent['home_about_us']->value??'Hakkımızda'}}</a>
                        </li>
                        <li class="px-1"><a
                                    href="departments.html">{{$siteContent['home_preparations']->value??'Preparatlar'}}</a>
                        </li>
                        <li class="px-1"><a
                                    href="gallery.html">{{$siteContent['home_partners']->value??'Partnyorlar'}} </a>
                        </li>

                        <li class="dropdown px-1">
                            <a href="#" class="dropdown-toggle"
                               data-toggle="dropdown">{{$siteContent['home_other']->value??'Digər'}} <i
                                        class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">{{ $siteContent['home_vacancy']->value ?? 'Vakansiya' }}</a>
                                </li>
                                <li>
                                    <a href="#">{{ $siteContent['home_medical_information']->value ?? 'Tibbi Məlumat' }}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="px-1"><a href="gallery.html">{{$siteContent['home_contact']->value??'Əlaqə'}} </a>
                        </li>


                        <li class="px-1 search-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-search"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" style="min-width: 250px; padding: 10px;">
                                <li>
                                    <form action="#" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="query" class="form-control"
                                                   placeholder="{{$siteContent['home_search']->value??'Axtarış edin...'}}">
                                            <span class="input-group-btn">
                                              <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
