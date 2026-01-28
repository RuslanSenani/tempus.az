<header class="header-main">
    <!-- Top Header -->

    <!-- Top Header /- -->

    <!-- Logo Block -->
    <div class="middle-header container-fluid no-padding">
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-md-3 logo-block pull-left">
                    @if($setting && $setting->logo)
                        <img src="{{ asset('storage/Logo/' . $setting->logo) }}" alt="Logo"/>
                    @else
                        <img src="{{ asset('assets/images/default-logo.png') }}" alt="Logo"/>
                    @endif
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
                    <ul class="nav navbar-nav d-flex align-items-center w-100">

                        <li class="{{ request()->routeIs('home') ? 'active' : '' }} px-1">
                            <a href="{{route('home')}}">{{$siteContent['home_home']->value??'Əsas Səhifə'}}</a>
                        </li>

                        <li class="{{ request()->routeIs('about-us') ? 'active' : '' }} px-1">
                            <a href="{{route('about-us')}}">{{$siteContent['home_about_us']->value??'Hakkımızda'}}</a>
                        </li>


                        <li class="dropdown px-1 custom-hover-dropdown">
                            <a href="{{ route('all-categories') }}" class="dropdown-toggle">
                                {{ $siteContent['home_preparation_category']->value ?? 'Kateqoriya' }}
                                <i class="fa fa-angle-down"></i>
                            </a>

                            <ul class="dropdown-menu">
                                @foreach($allCategories as $category)
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                           href="{{route('category-details',$category->id)}}">
                                            {{ $category->name }}
                                            @if($category->preparations->count() > 0)
                                                <i class="fa fa-angle-right d-none d-md-block"></i>
                                                <i class="fa fa-angle-down d-md-none"></i>
                                            @endif
                                        </a>

                                        @if($category->preparations->count() > 0)
                                            <ul class="dropdown-menu submenu">
                                                @foreach($category->preparations as $preparation)
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="{{route('preparation-detail',$preparation->id)}}">
                                                            {{ $preparation->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="px-1">
                            <a href="{{route('preparation')}}">{{$siteContent['home_preparation']->value??'Preparatlar'}} </a>
                        </li>
                        <li class="px-1">
                            <a href="#">{{$siteContent['home_partners']->value??'Partnyorlar'}} </a>
                        </li>

                        <li class="dropdown px-1">
                            <a href="#" class="dropdown-toggle"
                               data-toggle="dropdown">{{$siteContent['home_other']->value??'Digər'}}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">{{ $siteContent['home_vacancy']->value ?? 'Vakansiya' }}</a>
                                </li>
                                <li>
                                    <a href="#">{{ $siteContent['home_medical_information']->value ?? 'Tibbi Məlumat' }}
                                    </a>
                                </li>
                                <li class="px-1">
                                    <a href="#">{{$siteContent['home_contact']->value??'Əlaqə'}} </a>
                                </li>
                            </ul>
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

                        <li class="ml-auto d-flex align-items-center fixed-right-item">
                            <div class="dropdown language-switcher px-6 custom-hover-dropdown">
                                @php $displayCode = app()->getLocale(); @endphp
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe mr-1"></i>
                                    <span class="font-weight-bold">{{ strtoupper($displayCode) }}</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                @if($languages->count() > 1)
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @foreach($languages as $lang)
                                            @if($displayCode !== $lang->code)
                                                <li>
                                                    <a href="{{ route('lang.switch', $lang->code) }}"
                                                       class="dropdown-item">
                                                        {{ strtoupper($lang->code) }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </nav>
</header>
