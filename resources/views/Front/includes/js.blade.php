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
    document.addEventListener('DOMContentLoaded', function() {

        const container = document.getElementById('pdfViewerContainer');
        const canvas = document.getElementById('pdfCanvas');
        const ctx = canvas.getContext('2d');
        const url = "{{ isset($preparation) && $preparation->pdf ? asset('storage/' . $preparation->pdf) : '' }}";

        let pdfDoc = null;
        let pageNum = 1;
        let scale = 2.0;
        let pdfLoaded = false;

        // PDF viewer açma funksiyası
        window.openPdfViewer = function() {
            // Body class əlavə edilir → mobil + desktop üçün mainContent gizlənir
            document.body.classList.add('pdf-preview-active');

            // PDF container görünür
            if(container) container.style.display = 'block';

            // PDF yüklənir yalnız bir dəfə
            if(!pdfLoaded){
                pdfjsLib.getDocument(url).promise.then(function(pdf) {
                    pdfDoc = pdf;
                    renderPage(pageNum);
                    pdfLoaded = true;
                });
            }
        };

        // PDF viewer bağlama funksiyası
        window.closePdfViewer = function() {
            document.body.classList.remove('pdf-preview-active');
            if(container) container.style.display = 'none';
        };

        // PDF-i canvas-da render et
        function renderPage(num) {
            pdfDoc.getPage(num).then(function(page) {

                const containerWidth = canvas.parentElement.clientWidth;

                // Responsive: mobil / desktop genişliyinə uyğun
                let viewport = page.getViewport({ scale: scale });
                if(viewport.width > containerWidth){
                    const ratio = containerWidth / viewport.width;
                    viewport = page.getViewport({ scale: scale * ratio });
                }

                // Retina / HD keyfiyyət
                const dpr = window.devicePixelRatio || 1;
                canvas.width = viewport.width * dpr;
                canvas.height = viewport.height * dpr;
                canvas.style.width = viewport.width + 'px';
                canvas.style.height = viewport.height + 'px';

                page.render({ canvasContext: ctx, viewport: viewport });
            });
        }

        // Zoom in / out funksiyaları
        window.zoomIn = function() {
            scale += 0.2;
            if(pdfDoc) renderPage(pageNum);
        };

        window.zoomOut = function() {
            scale = Math.max(0.5, scale - 0.2);
            if(pdfDoc) renderPage(pageNum);
        };

        // Window resize → mobil orientation zamanı canvas yenilənir
        window.addEventListener('resize', function() {
            if(pdfDoc) renderPage(pageNum);
        });

    });

</script>

