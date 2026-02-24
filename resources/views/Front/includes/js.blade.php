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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<!-- Library - Theme JS -->
<script src="{{asset("assets")}}/js/functions.js"></script>

<script src="{{asset("assets")}}/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- PDF.js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const wrapper = document.getElementById("pdfWrapper");
        const loading = document.getElementById("loading");
        const pageInfo = document.getElementById("pageInfo");

        // PDF JS Worker mütləq təyin olunmalıdır (render sürəti üçün)
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const url = "{{ isset($preparation) && $preparation->pdf ? asset('storage/' . $preparation->pdf) : '' }}";

        if (!url) {
            loading.innerText = "{{$siteContent['home_not_found_pdf']->value??''}}";
            return;
        }

        let pdfDoc = null;
        // Keyfiyyət üçün scale (2.0 aydın görüntü verir, mobil üçün idealdır)
        const scale = 2.0;

        function loadPdf() {
            loading.style.display = "block";

            pdfjsLib.getDocument(url).promise.then(function (pdf) {
                pdfDoc = pdf;
                loading.style.display = "none";
                pageInfo.innerText = "{{$preparation->name}}";

                // Bütün səhifələri ardıcıl render edirik
                renderAllPages();
            }).catch(function (error) {
                console.error("{{$siteContent['home_upload_error_pdf']->value??''}}", error);
                loading.innerText = "{{$siteContent['home_download_error_pdf']->value??''}}";
            });
        }

        async function renderAllPages() {
            wrapper.innerHTML = "";

            // Səhifələrin sırası pozulmasın deye async/await istifadə edirik
            for(let i = 1; i <= pdfDoc.numPages; i++){
                await renderSinglePage(i);
            }
        }

        function renderSinglePage(num) {
            return pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({ scale: scale });
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

