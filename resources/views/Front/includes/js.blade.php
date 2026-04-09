<!-- JQuery v1.11.3 -->
<script src="{{asset("assets")}}/js/jquery.min.js"></script>

<!-- Library - Modernizer -->
<script src="{{asset("assets")}}/libraries/modernizr/modernizr.js"></script>

<!-- Library - Bootstrap v3.3.5 -->
<script src="{{asset("assets")}}/libraries/bootstrap/bootstrap.min.js"></script><!-- Bootstrap JS File v3.3.5 -->

<!-- jQuery Easing v1.3 -->
<script src="{{asset("assets")}}/js/jquery.easing.min.js"></script>

<!-- Library - jQuery.appear -->
<script src="{{asset("assets")}}/libraries/appear/jquery.appear.js"></script>

<!-- Library - OWL Carousel V.2.0 beta -->
<script src="{{asset("assets")}}/libraries/owl-carousel/owl.carousel.min.js"></script>

<!-- jQuery For Number Counter -->
<script src="{{asset("assets")}}/libraries/number/jquery.animateNumber.min.js"></script>

<!-- Library - Isotope Portfolio Filter -->
<script src="{{asset("assets")}}/libraries/isotope/isotope.pkgd.min.js"></script>

<!-- Library - Magnific Popup - v1.0.0 -->
<script src="{{asset("assets")}}/libraries/magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- Library - Google Map API -->
{{--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>--}}

<!-- Library - Theme JS -->
<script src="{{asset("assets")}}/js/functions.js"></script>

<script src="{{asset("assets")}}/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const translations = {
        more_details: "{{ $siteContent['home_more_details']->value ?? 'Daha Ətraflı..' }}",
        video: "{{ $siteContent['home_in_video']->value ?? 'Video' }}",
        default_caption: "{{ $siteContent['home_instagram_post']->value ?? '' }}"
    };
    let nextCursor = "{{ $next_cursor??'' }}";
    let isLoading = false;

    function loadMoreInstagram() {
        if (isLoading || !nextCursor) return;

        // Düyməni gizlət, spinner-i göstər
        isLoading = true;
        $('#load-more-btn').hide();
        $('#loading-spinner').fadeIn();

        $.ajax({
            url: "{{ route('instagram.ajax') }}",
            type: "GET",
            data: {after: nextCursor},
            success: function (response) {
                console.log("Gələn post sayı:", response.posts.length);
                console.log("Növbəti kod (Next Cursor):", response.next_cursor);
                if (response.posts && response.posts.length > 0) {
                    let newItems = '';

                    response.posts.forEach(function (post) {
                        let caption = post.caption ? post.caption : translations.default_caption;

                        if (caption.length > 80) {
                            caption = caption.substring(0, 80) + '...';
                        }

                        let videoBadge = post.media_type === 'VIDEO'
                            ? ''
                            : '';

                        newItems += `
<div class="col-6 col-md-4 col-lg-3 mb-4 insta-col">
    <div class="card border-0 shadow-sm overflow-hidden h-100">
        <a href="${post.permalink}" target="_blank" class="d-block">
            <div class="insta-card-container">
                ${videoBadge}
                <img src="${post.imageSrc}" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">

                ${post.media_type === 'VIDEO' ? `
                    <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.5); color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                        <i class="fa fa-play"></i> ${translations.video}
                    </div>
                ` : ''}
            </div>
        </a>
        <div class="card-body p-2 d-none d-md-block d-flex flex-column">
            <p class="insta-caption text-muted mb-0">
                ${caption}
            </p>
            <a href="${post.permalink}" target="_blank" class="btn btn-sm btn-outline-primary mt-auto">
                ${translations.more_details}
            </a>
        </div>
    </div>
</div>`;
                    });

                    $('#instagram-wrapper').append(newItems);
                    nextCursor = response.next_cursor;
                    if (!nextCursor) {
                        console.warn("API daha çox post göndərməyi dayandırdı.");
                    }
                }

                isLoading = false;
                $('#loading-spinner').hide();

                // Əgər növbəti səhifə varsa, düyməni yenidən göstər
                if (nextCursor) {
                    $('#load-more-btn').fadeIn();
                } else {
                    $('#load-more-btn').remove(); // Daha post yoxdursa düyməni tam sil
                    $('#loading-spinner').html('<p class="text-muted mt-3">Bütün paylaşımlar yükləndi</p>').show();
                }
            },
            error: function () {
                isLoading = false;
                $('#loading-spinner').hide();
                $('#load-more-btn').show();
                alert("Məlumat yüklənərkən xəta baş verdi.");
            }
        });
    }
</script>


{{-- PDF.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const wrapper = document.getElementById("pdfWrapper");
        const loading = document.getElementById("loading");
        const pageInfo = document.getElementById("pageInfo");

        // ƏGƏR PDF elementləri bu səhifədə yoxdursa, aşağıdakı kodları İŞLƏTMƏ
        if (!wrapper || !loading) {
            return;
        }

        // PDF JS Worker mütləq təyin olunmalıdır
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const url = "{{ isset($preparation) && $preparation->pdf ? asset('storage/' . $preparation->pdf) : '' }}";

        if (!url) {
            // Elementin mövcudluğunu yoxlayıb sonra daxilinə yazırıq
            loading.innerText = "{{$siteContent['home_not_found_pdf']->value??''}}";
            return;
        }

        let pdfDoc = null;
        const scale = 2.0;

        {{--function loadPdf() {--}}
        {{--    loading.style.display = "block";--}}

        {{--    pdfjsLib.getDocument(url).promise.then(function (pdf) {--}}
        {{--        pdfDoc = pdf;--}}
        {{--        loading.style.display = "none";--}}

        {{--        // pageInfo elementi varsa yazdır--}}
        {{--        if (pageInfo) {--}}
        {{--            pageInfo.innerText = "{{$preparation->name??''}}";--}}
        {{--        }--}}

        {{--        renderAllPages();--}}
        {{--    }).catch(function (error) {--}}
        {{--        console.error("PDF yükləmə xətası:", error);--}}
        {{--        loading.innerText = "{{$siteContent['home_download_error_pdf']->value??''}}";--}}
        {{--    });--}}
        {{--}--}}



        // PDF yüklənmə hissəsi
        function loadPdf() {
            loading.style.display = "block";

            const loadingTask = pdfjsLib.getDocument({
                url: url,
                // Şrift xətalarını azaltmaq üçün Google-un cMap-larını istifadə edirik
                cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                cMapPacked: true,
            });

            loadingTask.promise.then(function (pdf) {
                pdfDoc = pdf;
                loading.style.display = "none";
                if (pageInfo) {
                    pageInfo.innerText = "{{$preparation->name??''}}";
                }
                renderAllPages();
            }).catch(function (error) {
                console.error("PDF yükləmə xətası:", error);
                loading.innerText = "{{$siteContent['home_download_error_pdf']->value??''}}";
            });
        }

        async function renderAllPages() {
            wrapper.innerHTML = "";
            for (let i = 1; i <= pdfDoc.numPages; i++) {
                await renderSinglePage(i);
            }
        }

        function renderSinglePage(num) {
            return pdfDoc.getPage(num).then(function (page) {
                const viewport = page.getViewport({scale: scale});
                const canvas = document.createElement("canvas");
                const context = canvas.getContext("2d");

                canvas.className = "pdf-page-canvas";
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                wrapper.appendChild(canvas);

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                return page.render(renderContext).promise;
            });
        }

        loadPdf();
    });
</script>

