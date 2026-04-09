@extends('Front.includes.master')

@section('content')
    @include('Front.Gallery_v.content')
@endsection

@push('js')
    <script>
        // JS faylından əvvəl datanı window obyektinə yükləyirik
        window.instaConfig = {
            ajaxUrl: "{{ route('instagram.ajax') }}",
            nextCursor: "{{ $next_cursor ?? '' }}",
            translations: {
                more_details: "{{ $siteContent['home_more_details']->value ?? 'Daha Ətraflı..' }}",
                video: "{{ $siteContent['home_in_video']->value ?? 'Video' }}",
                default_caption: "{{ $siteContent['home_instagram_post']->value ?? '' }}"
            }
        };
    </script>
    <script src="{{asset("assets")}}/js/instagram.js"></script>
@endpush
