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
    const query = this.value.trim();
    const resultsDiv = document.getElementById('search-results');
    const currentLang = document.documentElement.lang || 'az';
    if (query.length > 2) {
        console.log(window.location.origin + `/live-search?query=${encodeURIComponent(query)}`);

        fetch(window.location.origin + `/live-search?query=${encodeURIComponent(query)}`, {

            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
            .then(response => response.json())
            .then(data => {
                resultsDiv.innerHTML = '';
                resultsDiv.style.display = 'block';

                if (data && data.length > 0) {
                    data.forEach(item => {
                        // JSON obyektini təmizləyən funksiya

                        const getCleanText = (field) => {
                            if (!field) return '';
                            if (typeof field === 'object') {
                                return field[currentLang] || field['az'] || Object.values(field)[0] || '';
                            }
                            try {
                                const obj = JSON.parse(field);
                                return obj[currentLang] || obj['az'] || Object.values(obj)[0] || '';
                            } catch (e) {
                                return field;
                            }
                        };


                        const name = getCleanText(item.name);
                        const title = getCleanText(item.title);

                        const resultLink = document.createElement('a');
                        resultLink.className = 'search-item';
                        resultLink.href = `/preparation-detail/${item.id}`; // Sizin route-a uyğun dəyişin

                        resultLink.innerHTML = `
                        <h6>${name}</h6>
                        ${title ? `<small>${title}</small>` : ''}
                    `;
                        resultsDiv.appendChild(resultLink);
                    });
                } else {
                    resultsDiv.innerHTML = '<div class="not-found">Heç bir nəticə tapılmadı</div>';
                }
            })
            .catch(err => console.error('Xəta:', err));
    } else {
        resultsDiv.style.display = 'none';
    }
});

// Kənara kliklədikdə bağla
document.addEventListener('click', function (e) {
    if (!document.getElementById('searchForm').contains(e.target)) {
        document.getElementById('search-results').style.display = 'none';
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



