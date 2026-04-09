document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.getElementById("pdfWrapper");
    const loading = document.getElementById("loading");
    const pageInfo = document.getElementById("pageInfo");

    // Əgər elementlər yoxdursa, dayan
    if (!wrapper || !loading) return;

    // Config-i götürürük
    const config = window.pdfConfig;
    if (!config) return;

    // Worker mütləq təyin olunmalıdır
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    // Blade-dən gələn URL
    const url = config.url;

    if (!url) {
        loading.innerText = config.translations.notFound;
        return;
    }

    let pdfDoc = null;
    const scale = 2.0;

    function loadPdf() {
        loading.style.display = "block";

        const loadingTask = pdfjsLib.getDocument({
            url: url,
            cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
            cMapPacked: true,
        });

        loadingTask.promise.then(function (pdf) {
            pdfDoc = pdf;
            loading.style.display = "none";
            if (pageInfo) {
                pageInfo.innerText = config.preparationName;
            }
            renderAllPages();
        }).catch(function (error) {
            console.error("PDF yükləmə xətası:", error);
            loading.innerText = config.translations.error;
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
