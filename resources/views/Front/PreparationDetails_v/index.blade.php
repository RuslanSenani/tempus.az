@extends('Front.includes.master')

@section('content')
    @include('Front.PreparationDetails_v.content')
@endsection


@push('js')
    {{-- PDF.js Ana Kitabxana --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <script>
        // JS faylından əvvəl datanı window obyektinə ötürürük
        window.pdfConfig = {
            url: "{{ (isset($preparation) && $preparation->pdf) ? asset('storage/' . $preparation->pdf) : '' }}",
            preparationName: "{{ $preparation->name ?? '' }}",
            translations: {
                notFound: "{{ $siteContent['home_not_found_pdf']->value ?? 'PDF tapılmadı' }}",
                error: "{{ $siteContent['home_download_error_pdf']->value ?? 'Yükləmə xətası' }}"
            }
        };
    </script>

    {{-- Sənin təmiz JS faylın --}}
    <script src="{{ asset('assets/js/pdf.js') }}"></script>
@endpush
