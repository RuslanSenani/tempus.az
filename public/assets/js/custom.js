// document.addEventListener('DOMContentLoaded', function () {
//
//     const searchInput = document.getElementById('live-search');
//     const resultsDiv = document.getElementById('search-results');
//     const loader = document.getElementById('search-loader');
//     let searchTimeout;
//
//
//     searchInput.addEventListener('input', function () {
//
//         const query = this.value.trim();
//         const currentLang = document.documentElement.lang || 'az'; // HTML-dəki lang-ı götürürük
//         clearTimeout(searchTimeout);
//
//         if (query.length < 2) {
//             resultsDiv.style.display = 'none';
//             return;
//         }
//
//         loader.style.display = 'block';
//
//         searchTimeout = setTimeout(() => {
//             // DİQQƏT: URL-ə dil prefiksini əlavə etdik
//             fetch(`/${currentLang}/live-search?query=${encodeURIComponent(query)}`, {
//                 headers: {'X-Requested-With': 'XMLHttpRequest'}
//             })
//                 .then(res => res.json())
//                 .then(data => {
//                     loader.style.display = 'none';
//                     resultsDiv.innerHTML = '';
//
//                     if (data.length > 0) {
//                         resultsDiv.style.display = 'block';
//                         data.forEach(item => {
//                             const name = getLangText(item.name);
//                             const isCat = item.search_type === 'category';
//                             const subLabel = isCat ? '' : (item.category ? getLangText(item.category.name) : '');
//
//                             // Slug-ı götürürük (Controller-dən gələn string formatında)
//                             const slug = item.slug_text;
//
//                             const a = document.createElement('a');
//
//                             // Linkləri yeni prefiks və slug sisteminə uyğunlaşdırırıq
//                             // Kateqoriya: /az/allergen | Preparat: /az/preparation/butifar
//                             if (isCat) {
//                                 a.href = `/${currentLang}/${slug}`;
//                             } else {
//                                 a.href = `/${currentLang}/preparation/${slug}`;
//                             }
//
//                             a.className = 'search-item';
//                             a.innerHTML = `
//                             <span class="label-upper">${subLabel}</span>
//                             <span class="title-lower">${name}</span>
//                         `;
//                             resultsDiv.appendChild(a);
//                         });
//                     } else {
//                         resultsDiv.innerHTML = '<div class="p-4 text-center text-muted">Heç bir nəticə tapılmadı.</div>';
//                         resultsDiv.style.display = 'block';
//                     }
//                 })
//                 .catch(() => {
//                     loader.style.display = 'none';
//                 });
//         }, 400);
//     });
//
//
// // Kənara toxunanda bağlamaq
//     document.addEventListener('click', (e) => {
//
//         if (!e.target.closest('.search-container')) {
//             resultsDiv.style.display = 'none';
//         }
//     });
//
// // Kənara kliklədikdə bağla
//     document.addEventListener('click', function (e) {
//
//         if (!document.getElementById('live-search').contains(e.target) &&
//             !document.getElementById('search-results').contains(e.target)) {
//             document.getElementById('search-results').style.display = 'none';
//         }
//     });
//
//
//     document.querySelectorAll('.custom-hover-dropdown .dropdown-toggle').forEach(el => {
//
//         // Bootstrap-ın kliklə menyunu avtomatik bağlamasına mane oluruq
//         el.removeAttribute('data-bs-toggle');
//
//         el.addEventListener('click', function (e) {
//             const parent = this.parentElement;
//             const menu = this.nextElementSibling;
//             const isMenuOpen = menu.classList.contains('show');
//
//             if (!isMenuOpen) {
//                 // Əgər menyu açıq deyilsə:
//                 e.preventDefault(); // Linkə keçidi dayandır
//
//                 // Digər açıq dropdown-ları bağlayaq (opsional, daha səliqəli görünüş üçün)
//                 document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
//
//                 // Bu menyunu açırıq
//                 menu.classList.add('show');
//                 parent.classList.add('show');
//                 this.setAttribute('aria-expanded', 'true');
//             } else {
//                 // Əgər menyu artıq açıqdırsa (2-ci klik):
//                 // Default davranış (linkə keçid) baş verəcək.
//                 // Heç bir preventDefault() etmirik, ona görə də window.location.href-ə ehtiyac qalmır.
//             }
//         });
//     });
//
// // Səhifədə boş yerə klikləyəndə menyunun bağlanması üçün (UX üçün vacibdir)
//     document.addEventListener('click', function (e) {
//
//
//         if (!e.target.closest('.custom-hover-dropdown')) {
//             document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
//                 menu.classList.remove('show');
//                 menu.parentElement.classList.remove('show');
//             });
//         }
//     });
// });


document.addEventListener('DOMContentLoaded', function () {

    // 1. Elementlərin mövcudluğunu yoxlayırıq
    const searchInput = document.getElementById('live-search');
    const resultsDiv = document.getElementById('search-results');
    const loader = document.getElementById('search-loader');

    // Əgər axtarış inputu bu səhifədə yoxdursa, axtarışla bağlı hissəni işlətmə
    if (searchInput && resultsDiv) {
        let searchTimeout;

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();
            const currentLang = document.documentElement.lang || 'az';
            clearTimeout(searchTimeout);

            if (query.length < 2) {
                resultsDiv.style.display = 'none';
                return;
            }

            // Loader-in mövcudluğunu yoxlayıb sonra display veririk
            if (loader) loader.style.display = 'block';

            searchTimeout = setTimeout(() => {
                fetch(`/${currentLang}/live-search?query=${encodeURIComponent(query)}`, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                })
                    .then(res => res.json())
                    .then(data => {
                        if (loader) loader.style.display = 'none';
                        resultsDiv.innerHTML = '';

                        if (data.length > 0) {
                            resultsDiv.style.display = 'block';
                            data.forEach(item => {
                                // getLangText funksiyasının varlığından əmin ol (global funksiyadırsa)
                                const name = typeof getLangText === 'function' ? getLangText(item.name) : (item.name[currentLang] || item.name);
                                const isCat = item.search_type === 'category';
                                const subLabel = isCat ? '' : (item.category ? (typeof getLangText === 'function' ? getLangText(item.category.name) : item.category.name[currentLang]) : '');

                                const slug = item.slug_text;
                                const a = document.createElement('a');

                                if (isCat) {
                                    a.href = `/${currentLang}/${slug}`;
                                } else {
                                    a.href = `/${currentLang}/preparation/${slug}`;
                                }

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
                        if (loader) loader.style.display = 'none';
                    });
            }, 400);
        });

        // Kənara kliklədikdə bağlama (təkrarçılığı sildik və optimallaşdırdıq)
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !resultsDiv.contains(e.target)) {
                resultsDiv.style.display = 'none';
            }
        });
    }

    // 2. Dropdown Hissəsi (Burada da element yoxlaması edirik)
    const hoverDropdowns = document.querySelectorAll('.custom-hover-dropdown .dropdown-toggle');
    if (hoverDropdowns.length > 0) {
        hoverDropdowns.forEach(el => {
            el.removeAttribute('data-bs-toggle');

            el.addEventListener('click', function (e) {
                const parent = this.parentElement;
                const menu = this.nextElementSibling;

                if (!menu) return; // Əgər menyu yoxdursa davam etmə

                const isMenuOpen = menu.classList.contains('show');

                if (!isMenuOpen) {
                    e.preventDefault();
                    document.querySelectorAll('.dropdown-menu.show').forEach(m => {
                        m.classList.remove('show');
                        m.parentElement.classList.remove('show');
                    });

                    menu.classList.add('show');
                    parent.classList.add('show');
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });
    }

    // Dropdown kənara kliklədikdə bağlama
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.custom-hover-dropdown')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
                menu.parentElement.classList.remove('show');
            });
        }
    });
});
