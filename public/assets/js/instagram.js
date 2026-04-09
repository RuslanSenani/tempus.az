document.addEventListener("DOMContentLoaded", function () {
    const config = window.instaConfig;
    if (!config) return;

    const translations = config.translations;
    let nextCursor = config.nextCursor;
    let isLoading = false;

    // --- BU HİSSƏNİ ƏLAVƏ ET ---
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            loadMoreInstagram();
        });
    }

    function loadMoreInstagram() {
        if (isLoading || !nextCursor) return;

        isLoading = true;
        $('#load-more-btn').hide();
        $('#loading-spinner').fadeIn();

        $.ajax({
            url: config.ajaxUrl, // Blade route-u əvəzinə
            type: "GET",
            data: {after: nextCursor},
            success: function (response) {
                if (response.posts && response.posts.length > 0) {
                    let newItems = '';

                    response.posts.forEach(function (post) {
                        let caption = post.caption ? post.caption : translations.default_caption;

                        if (caption.length > 80) {
                            caption = caption.substring(0, 80) + '...';
                        }

                        newItems += `
                        <div class="col-6 col-md-4 col-lg-3 mb-4 insta-col">
                            <div class="card border-0 shadow-sm overflow-hidden h-100">
                                <a href="${post.permalink}" target="_blank" class="d-block">
                                    <div class="insta-card-container">
                                        <img src="${post.imageSrc}" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover;">
                                        ${post.media_type === 'VIDEO' ? `
                                            <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.5); color: white; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                                                <i class="fa fa-play"></i> ${translations.video}
                                            </div>
                                        ` : ''}
                                    </div>
                                </a>
                                <div class="card-body p-2 d-none d-md-block d-flex flex-column">
                                    <p class="insta-caption text-muted mb-0">${caption}</p>
                                    <a href="${post.permalink}" target="_blank" class="btn btn-sm btn-outline-primary mt-auto">
                                        ${translations.more_details}
                                    </a>
                                </div>
                            </div>
                        </div>`;
                    });

                    $('#instagram-wrapper').append(newItems);
                    nextCursor = response.next_cursor;
                }

                isLoading = false;
                $('#loading-spinner').hide();

                if (nextCursor) {
                    $('#load-more-btn').fadeIn();
                } else {
                    $('#load-more-btn').remove();
                    $('#loading-spinner').html('<p class="text-muted mt-3">Bütün paylaşımlar yükləndi</p>').show();
                }
            },
            error: function () {
                isLoading = false;
                $('#loading-spinner').hide();
                $('#load-more-btn').show();
                alert("Məlumat yüklənərkən xəta baş verdi.");
            }
        });
    }
});
