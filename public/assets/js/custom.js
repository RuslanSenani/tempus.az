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


document.querySelectorAll('.custom-hover-dropdown .dropdown-toggle').forEach(el => {
    // Bootstrap-ın kliklə menyunu avtomatik bağlamasına mane oluruq
    el.removeAttribute('data-bs-toggle');

    el.addEventListener('click', function (e) {
        const parent = this.parentElement;
        const menu = this.nextElementSibling;
        const isMenuOpen = menu.classList.contains('show');

        if (!isMenuOpen) {
            // Əgər menyu açıq deyilsə:
            e.preventDefault(); // Linkə keçidi dayandır

            // Digər açıq dropdown-ları bağlayaq (opsional, daha səliqəli görünüş üçün)
            document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));

            // Bu menyunu açırıq
            menu.classList.add('show');
            parent.classList.add('show');
            this.setAttribute('aria-expanded', 'true');
        } else {
            // Əgər menyu artıq açıqdırsa (2-ci klik):
            // Default davranış (linkə keçid) baş verəcək.
            // Heç bir preventDefault() etmirik, ona görə də window.location.href-ə ehtiyac qalmır.
        }
    });
});

// Səhifədə boş yerə klikləyəndə menyunun bağlanması üçün (UX üçün vacibdir)
document.addEventListener('click', function (e) {
    if (!e.target.closest('.custom-hover-dropdown')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
            menu.classList.remove('show');
            menu.parentElement.classList.remove('show');
        });
    }
});



