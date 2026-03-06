<!-- Page Banner -->
<div class="page-banner contact-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$siteContent['home_media']->value??''}}</h3>

        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_media']->value??''}}</li>
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
</div>
<!-- Page Banner /- -->


<div class="container mt-5">
    <div class="section-header" style="margin-bottom: 10px; margin-top: 30px;">

        <h3 class="text-center mb-5">{{$siteContent['home_insta_share']->value??''}}</h3>

    </div>


    <div class="row">
        @forelse($posts as $post)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100 shadow-sm overflow-hidden">
                    <a href="{{ $post['permalink'] }}" target="_blank" class="d-block">
                        @php
                            $imageSrc = ($post['media_type'] === 'VIDEO') ? ($post['thumbnail_url'] ?? $post['media_url']) : $post['media_url'];
                        @endphp

                        <div style="position: relative;">
                            <img src="{{ $imageSrc }}" class="instagram-card-img" alt="Instagram Post">

                            @if($post['media_type'] === 'VIDEO')
                                <div
                                    style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.5); color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                                    <i class="fa fa-play"></i> Video
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="card-body d-flex flex-column">
                        <p class="card-text text-muted flex-grow-1" style="font-size: 14px; line-height: 1.4;">
                            {{ Str::limit($post['caption'] ?? 'Instagram Post', 80) }}
                        </p>
                        <small class="text-primary mt-2"><a target="_blank" class="d-block"
                                                            href="{{$post['permalink']}}">{{$siteContent['home_more_details']??'Daha Ətraflı..'}}</a></small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">{{$siteContent['home_not_insta_share']->value??''}}</p>
            </div>
        @endforelse
    </div>
</div>


<!-- Portfolio Section -->
<div class="portfolio-section container-fluid no-padding">
    <div class="section-padding"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                <div id="portfolio" class="">

                    @foreach($media as $med)
                        <div class="portfolio-item facilities col-md-4 col-sm-6" style="margin-bottom: 40px;">


                            <div class="media-container" style="position: relative; overflow: hidden; height: 250px; border-radius: 8px; background: #000;">

                                @if($med->type === 'video' && !empty($med->video_url))
                                    @php
                                        $url = $med->video_url;
                                        $finalUrl = '';
                                        if (str_contains($url, 'youtu.be') || str_contains($url, 'youtube.com')) {
                                            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                                            $finalUrl = isset($match[1]) ? "https://www.youtube.com/embed/" . $match[1] : $url;
                                        }
                                        elseif (str_contains($url, 'tiktok.com')) {
                                            preg_match('/video\/(\d+)/', $url, $match);
                                            $finalUrl = isset($match[1]) ? "https://www.tiktok.com/embed/v2/" . $match[1] : $url;
                                        }
                                    @endphp
                                    <iframe width="100%" height="100%" src="{{ $finalUrl }}" frameborder="0" allowfullscreen style="width: 100%; height: 100%; object-fit: contain;"></iframe>
                                @elseif($med->type === 'image' && !empty($med->image_url))
                                    <img src="{{ asset('storage/' . $med->image_url) }}" alt="{{ $med->title }}" style="width: 100%; height: 100%; object-fit: cover;"/>
                                @endif


                                <div class="portfolio-item-hover" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
                                    <a href="{{ $med->type === 'video' ? $med->video_url : asset('storage/' . $med->image_url) }}"
                                       target="_blank"
                                       style="background: #fff; color: #000; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-weight: bold;">
                                        {{ $siteContent['home_more_details']->value ?? 'Ətraflı bax' }}
                                    </a>
                                </div>
                            </div>

                            {{-- 2. Mətn Hissəsi (Medianın Altında Sabit) --}}
                            <div class="portfolio-content-bottom" style="margin-top: 15px;">
                                <h3 style="font-size: 18px; font-weight: bold; margin-bottom: 8px; color: #333;">
                                    {{ $med->title }}
                                </h3>

                                @if($med->description)
                                    <div class="description" style="font-size: 14px; color: #666;">
                                        {!! $med->description !!}
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Pagination -->
        <nav class="ow-pagination">
            {{ $media->links('partials.pagination', ['routeName'=>'media.page','pages' => $media]) }}
        </nav>
        <!-- Pagination /- -->
    </div>
    <div class="section-padding"></div>
</div>
<!-- Portfolio Section /- -->
