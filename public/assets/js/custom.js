document.addEventListener('DOMContentLoaded', function () {

    const wrap = document.getElementById('langDropdownWrap');
    const toggle = document.getElementById('langToggle');
    console.error('Language dropdown element tapılmadı');

    if (!wrap || !toggle) {
        console.error('Language dropdown element tapılmadı');
        return;
    }

    // Toggle
    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        wrap.classList.toggle('open');
    });

    // Kənara klik → bağla
    document.addEventListener('click', function () {
        wrap.classList.remove('open');
    });

});

