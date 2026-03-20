<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card h-100 shadow-sm border-0 overflow-hidden">
        <a href="{{ $post['permalink'] }}" target="_blank" class="d-block">
            <div style="position: relative; padding-top: 100%;"> {{-- 1:1 Kvadrat format --}}
                <img src="{{ $post['imageSrc'] }}"
                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                     alt="Instagram Post">

                @if($post['media_type'] === 'VIDEO')
                    <div
                        style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                        <i class="fa fa-play"></i>
                    </div>
                @endif
            </div>
        </a>
        <div class="card-body d-flex flex-column">
            <p class="card-text text-muted flex-grow-1" style="font-size: 14px; line-height: 1.4;">
                {!!   Str::limit($post['caption'] ?? $siteContent['home_instagram_post']->value??'', 80) !!}
            </p>
            <a href="{{ $post['permalink'] }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                {{$siteContent['home_link_to_instagram']->value??''}}
            </a>
        </div>
    </div>
</div>


