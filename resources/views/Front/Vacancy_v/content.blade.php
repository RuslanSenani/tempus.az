<!-- Page Banner -->
<div class="page-banner contact-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$siteContent['home_contact']->value??''}}</h3>

        <ol class="breadcrumb">
            <li><a href="{{route('home')}}">{{$siteContent['home_home']->value??''}}</a></li>
            <li class="active">{{$siteContent['home_contact']->value??''}}</li>
        </ol>
    </div><!-- Container /- -->
    <!-- Shape -->
    <div class="banner-shape container-fluid no-padding">
        <div class="col-md-6 col-sm-6 col-xs-6 shape-left no-padding">
            <div class="left-shape-blue">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon2" clipPathUnits="objectBoundingBox">
                        <polygon points="0 0, 0 100, 120 100, 0 0"></polygon>
                    </clipPath>
                </svg>
            </div>
            <div class="left-shape">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon1" clipPathUnits="objectBoundingBox">
                        <polygon points="0 0, 0 100, 100 100, 0 0"></polygon>
                    </clipPath>
                </svg>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 shape-right no-padding">
            <div class="right-shape-blue">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon3" clipPathUnits="objectBoundingBox">
                        <polygon points="1 0.2, 0 1, 0 0.835, 1 0"></polygon>
                    </clipPath>
                </svg>
            </div>
            <div class="right-shape">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon4" clipPathUnits="objectBoundingBox">
                        <polygon points="1 0, 0 1, 100 100, 100 0"></polygon>
                    </clipPath>
                </svg>
            </div>
        </div>
    </div><!-- Shape -->
</div><!-- Page Banner /- -->


<div class="container my-5">
    <div class="row">
        <article class="col-lg-6 ">
            <div class="entry-content">
                <h3 class="entry-title"><a href="#">Latest Blog new Slider Image Post</a></h3>
                <div class="post-meta">
                    <a href="#" title="25th sep 2015" class="post-date">25th sep 2015</a> by
                    <a href="#" title="Mathov" class="post-admin">Mathov</a> in Hospital
                </div>
                <p>

                </p>
            </div>
        </article>

        <div class="col-lg-6">
            <div class="card border-0 shadow-lg sticky-top" style="top: 20px;">
                <div class="card-header text-white p-4" style="background-color: #045184;">
                    <h4 class="mb-0 fw-bold">Müraciət Formu</h4>
                    <small>Sizinlə əlaqə saxlamağımız üçün doldurun</small>
                </div>
                <div class="card-body p-4">
                    <form action="#" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Adınız</label>
                                <input type="text" name="adınız" class="form-control bg-light" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Soyadınız</label>
                                <input type="text" name="soyadınız" class="form-control bg-light" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">E-mail</label>
                            <input type="email" name="email" class="form-control bg-light" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Əlaqə nömrəsi</label>
                            <input type="tel" name="phone" class="form-control bg-light" placeholder="+994" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Müraciət etdiyiniz vəzifə</label>
                            <input type="text" name="position" class="form-control bg-light" value="Tibbi Nümayəndə"
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Həftənin hansı günü yaxınlaşa bilərsiniz?</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(['B.E', 'Ç.A', 'Ç', 'C.A', 'C'] as $day)
                                    <input type="checkbox" class="btn-check" name="days[]" id="day_{{$day}}"
                                           value="{{$day}}">
                                    <label class="btn btn-outline-primary btn-sm" for="day_{{$day}}">{{$day}}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">Özünüz haqda qısa məlumat</label>
                            <textarea name="message" class="form-control bg-light" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold text-uppercase shadow">
                            GÖNDƏR <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
