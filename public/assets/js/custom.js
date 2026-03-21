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


// document.getElementById('live-search').addEventListener('input', function () {
//     const query = this.value.trim();
//     const resultsDiv = document.getElementById('search-results');
//     const currentLang = document.documentElement.lang || 'az';
//
//     // JSON formatında olan translatable datanı oxumaq üçün funksiya
//     const getCleanText = (field) => {
//         if (!field) return '';
//         // Əgər artıq obyekt kimidirsə
//         if (typeof field === 'object') {
//             return field[currentLang] || field['az'] || Object.values(field)[0] || '';
//         }
//         // Əgər string kimidirsə, JSON parse etməyə çalış
//         try {
//             const obj = JSON.parse(field);
//             return obj[currentLang] || obj['az'] || Object.values(obj)[0] || '';
//         } catch (e) {
//             return field;
//         }
//     };
//
//     if (query.length > 2) {
//         fetch(`/live-search?query=${encodeURIComponent(query)}`, {
//             headers: {'X-Requested-With': 'XMLHttpRequest'}
//         })
//             .then(response => response.json())
//             .then(data => {
//                 resultsDiv.innerHTML = '';
//                 resultsDiv.style.display = 'block';
//
//                 if (data.length > 0) {
//                     data.forEach(item => {
//                         const prepName = getCleanText(item.name);
//                         const catName = item.category ? getCleanText(item.category.name) : '';
//
//                         const resultLink = document.createElement('a');
//                         resultLink.className = 'search-item d-block p-2 text-decoration-none border-bottom';
//                         resultLink.href = `/preparation-detail/${item.id}`; // Route-u özünə görə düzəlt
//
//                         resultLink.innerHTML = `
//                         <div class="search-content">
//                             ${catName ? `<small class="text-primary text-uppercase" style="font-size: 10px; font-weight: bold;">${catName}</small>` : ''}
//                             <h6 class="mb-0 text-dark" style="font-size: 14px;">${prepName}</h6>
//                         </div>
//                     `;
//                         resultsDiv.appendChild(resultLink);
//                     });
//                 } else {
//                     resultsDiv.innerHTML = '<div class="p-3 text-muted small text-center">Nəticə tapılmadı</div>';
//                 }
//             })
//             .catch(err => console.error('Axtarış xətası:', err));
//     } else {
//         resultsDiv.style.display = 'none';
//     }
// });


const searchInput = document.getElementById('live-search');
const resultsDiv = document.getElementById('search-results');
const loader = document.getElementById('search-loader');
let searchTimeout;

// JSON Translatable üçün köməkçi
const getLangText = (data) => {
    const lang = document.documentElement.lang || 'az';
    if (!data) return '';
    if (typeof data === 'object') return data[lang] || Object.values(data)[0];
    try {
        const parsed = JSON.parse(data);
        return parsed[lang] || Object.values(parsed)[0];
    } catch {
        return data;
    }
};

searchInput.addEventListener('input', function () {
    const query = this.value.trim();
    clearTimeout(searchTimeout);

    if (query.length < 2) {
        resultsDiv.style.display = 'none';
        return;
    }

    loader.style.display = 'block';

    searchTimeout = setTimeout(() => {
        fetch(`/live-search?query=${encodeURIComponent(query)}`, {
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
            .then(res => res.json())
            .then(data => {
                loader.style.display = 'none';
                resultsDiv.innerHTML = '';

                if (data.length > 0) {
                    resultsDiv.style.display = 'block';
                    data.forEach(item => {
                        const name = getLangText(item.name);
                        const isCat = item.search_type === 'category';
                        const subLabel = isCat ? '' : (item.category ? getLangText(item.category.name) : '');

                        const a = document.createElement('a');
                        a.href = isCat ? `/category-details/${item.id}` : `/preparation-detail/${item.id}`;
                        a.className = 'search-item';
                        a.innerHTML = `
                        <span class="label-upper">${subLabel}</span>
                        <span class="title-lower">${name}</span>
                    `;
                        resultsDiv.appendChild(a);
                    });
                } else {
                    resultsDiv.innerHTML = '<div class="p-4 text-center text-muted">Heç bir nəticə tapılmadı.</div>';
                    resultsDiv.style.display = 'block';
                }
            })
            .catch(() => {
                loader.style.display = 'none';
            });
    }, 400); // 400ms serverə nəfəs almaq üçün kifayətdir
});

// Kənara toxunanda bağlamaq
document.addEventListener('click', (e) => {
    if (!e.target.closest('.search-container')) {
        resultsDiv.style.display = 'none';
    }
});

// Kənara kliklədikdə bağla
document.addEventListener('click', function (e) {
    if (!document.getElementById('live-search').contains(e.target) &&
        !document.getElementById('search-results').contains(e.target)) {
        document.getElementById('search-results').style.display = 'none';
    }
    // if (!document.getElementById('searchForm').contains(e.target)) {
    //     document.getElementById('search-results').style.display = 'none';
    // }
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



function closePopup(btn) {
    let popup = btn.closest('.my-popup');
    popup.style.transition = "0.4s";
    popup.style.transform = "translateX(120%)";
    setTimeout(() => popup.remove(), 400);
}

// 4 saniyə sonra avtomatik bağlansın
document.addEventListener('DOMContentLoaded', function () {
    const popups = document.querySelectorAll('.my-popup');
    popups.forEach(popup => {
        setTimeout(() => {
            if (popup) {
                popup.style.transition = "0.4s";
                popup.style.transform = "translateX(120%)";
                setTimeout(() => popup.remove(), 400);
            }
        }, 10000);
    });
});







