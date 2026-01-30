document.addEventListener('DOMContentLoaded', function () {
    var langWrapper = document.getElementById('customLang');

    if (langWrapper) {
        // Düyməyə klikləyəndə
        langWrapper.addEventListener('click', function (e) {
            // Əgər keçid linkinə (AZ, EN, RU) kliklənibsə, menyunu toggle eləmə (qoy keçid etsin)
            if (e.target.tagName === 'A') return;

            e.preventDefault();
            e.stopPropagation();
            this.classList.toggle('active');
        });
    }

    // Səhifənin istənilən başqa yerinə klikləyəndə menyunu bağla
    document.addEventListener('click', function (e) {
        if (langWrapper && !langWrapper.contains(e.target)) {
            langWrapper.classList.remove('active');
        }
    });
});


