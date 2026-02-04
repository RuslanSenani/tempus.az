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


document.getElementById('live-search').addEventListener('input', function () {
    let currentLang = document.documentElement.lang || 'az';
    let query = this.value;
    let resultsDiv = document.getElementById('search-results');

    if (query.length > 2) {
        fetch(`/live-search?query=${encodeURIComponent(query)}`, {
            // encodeURIComponent təhlükəsizlik üçündür
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                resultsDiv.innerHTML = '';

                // let trans = response.not_found;
                if (data && data.length > 0) {
                    resultsDiv.style.display = 'block';

                    data.forEach(item => {
                        // 1. Datanı təhlükəsiz şəkildə obyektə çevir (əgər string kimi gəlibsə)
                        let nameObj = (typeof item.name === 'string') ? JSON.parse(item.name) : item.name;
                        let titleObj = (typeof item.title === 'string') ? JSON.parse(item.title) : item.title;

                        // 2. Aktiv dilə uyğun mətni götür, yoxdursa 'az' dilini, o da yoxdursa boş string göstər
                        let displayName = nameObj[currentLang] || nameObj['az'] || 'Adsız';
                        let displayTitle = titleObj[currentLang] || titleObj['az'] || '';

                        // 3. HTML-ə yerləşdir
                        let resultItem = document.createElement('a');
                        resultItem.className = 'list-group-item list-group-item-action border-0 py-3';
                        resultItem.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">${displayName}</h6>
                                <small class="text-muted">${displayTitle}</small>
                            </div>
                            <i class="fa fa-chevron-right small text-muted"></i>
                        </div>
                        `;
                        resultsDiv.appendChild(resultItem);
                    });
                } else {
                    resultsDiv.style.display = 'block';
                    resultsDiv.innerHTML = '<div class="list-group-item text-muted">tapilmadi</div>';
                }
            })
            .catch(error => console.error('Xəta:', error));
    } else {
        resultsDiv.style.display = 'none';
    }
});


// Mobildə default bootstrap klikini deaktiv edib, öz idarəmizə alırıq
if (window.innerWidth < 992) {
    document.querySelectorAll('.custom-hover-dropdown .dropdown-toggle').forEach(el => {
        el.removeAttribute('data-bs-toggle'); // Bootstrap-ın müdaxiləsini silirik

        el.addEventListener('click', function(e) {
            const menu = this.nextElementSibling;
            if (!menu.classList.contains('show')) {
                e.preventDefault();
                menu.classList.add('show');
                this.parentElement.classList.add('show');
            }
        });
    });
}
