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


<!-- Page Content -->
<div class="container-fluid no-padding page-content">
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Blog Area -->


            <div class="col-md-6 mb-4">
                <div class="card custom-job-card">
                    <div class="custom-header text-start">
                        <h2 class="text-uppercase mb-4">{{$vacancy->title ?? $siteContent['home_vacancy_form_medical_represtative']->value??''}}</h2>
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-salary">{{$vacancy->salary ?? $siteContent['home_vacancy_salary']->value ??''}}</span>
                            <span class="fw-bold fs-5">{{$vacancy->company ?? $siteContent['home_company']->value??''}} </span>
                        </div>
                    </div>

                    <div class="info-table-section">
                        <div class="info-row">
                            <div class="info-label">{{$siteContent['home_vacancy_city']->value??'Şəhər'}}</div>
                            <div class="info-text">{{$vacancy->city ??$siteContent['home_vacancy_city']->value??''}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{$siteContent['home_vacancy_age']->value??'Yaş'}}</div>
                            <div class="info-text">{{$vacancy->age ?? $siteContent['home_vacancy_age']->value ?? ''}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{$siteContent['home_vacancy_edu']->value??'Təhsil'}}</div>
                            <div
                                    class="info-text">{{$vacancy->education ?? $siteContent['home_vacancy_edu']->value ??''}}</div>
                        </div>
                        <div class="info-row">
                            <div
                                    class="info-label">{{$siteContent['home_vacancy_work_experience']->value??'İş təcrübəsi'}}</div>
                            <div
                                    class="info-text">{{$vacancy->experience ?? $siteContent['home_vacancy_work_experience']->value ??''}}</div>
                        </div>

                        <div class="info-row">
                            <div
                                    class="info-label">{{$siteContent['home_vacancy_phone']->value ?? 'Telefon nömrəsi'}}</div>
                            <div class="info-text text-primary text-decoration-underline">{{$vacancy->phone?? $siteContent['home_vacancy_phone']->value ?? ''}}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">{{$siteContent['home_vacancy_email']->value ?? 'E-mail'}}</div>
                            <div class="info-text text-primary text-decoration-underline">{{$vacancy->email ?? $siteContent['home_vacancy_email']->value ?? ''}}</div>
                        </div>
                    </div>

                    <div class="description-section">
                        <div
                                class="section-blue-mark">{{$siteContent['home_vacancy_work_info']->value??'İş barədə məlumat'}}</div>
                        <div class="vacancy-details">
                            {!! $vacancy->description ?? $siteContent['home_vacancy_work_info']->value??'' !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6  blog-area">
                <div class="col-md-12">
                    <div class="leave-comment">
                        <h3 class="section-heading">{{$siteContent['home_vacancy_form']->value??''}}</h3>
                        <form class="comment-form" method="POST" action="{{route('vacancy.store')}}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" name="name" id="name" value="{{old('name')}}"
                                           placeholder="{{$siteContent['home_vacancy_form_name']->value??''}}"
                                           class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" name="surname" id="surname" value="{{old('surname')}}"
                                           placeholder="{{$siteContent['home_vacancy_form_surname']->value??''}}"
                                           class="form-control @error('surname') is-invalid @enderror">
                                    @error('surname')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="email" name="email" value="{{old('email')}}"
                                           placeholder="{{$siteContent['home_vacancy_form_email']->value??''}}"
                                           class="form-control @error('email') is-invalid @enderror"
                                    >
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" name="phone" value="{{old('phone')}}"
                                           placeholder="{{$siteContent['home_vacancy_form_phone']->value??''}}"
                                           class="form-control  @error('phone') is-invalid @enderror">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" name="vacancy_name" value="{{old('vacancy_name')}}"
                                           placeholder="{{$siteContent['home_vacancy_form_medical_represtative']->value??''}}"
                                           class="form-control  @error('vacancy_name') is-invalid @enderror">
                                    @error('vacancy_name')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" name="work_experience" value="{{old('work_experience')}}"
                                           placeholder="{{$siteContent['home_vacancy_form_work_experience']->value??''}}"
                                           class="form-control @error('work_experience') is-invalid @enderror">
                                    @error('work_experience')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror

                                </div>


                                <div class="col-md-12 my-1">
                                    <label
                                            class="fw-bold mb-3 d-block text-primary @error('available_day') text-danger @enderror">
                                        {{ $siteContent['home_vacancy_interview']->value ?? 'Müsahibə üçün uyğun günlər' }}
                                    </label>

                                    <div class="d-flex flex-row align-items-center gap-3">
                                        @php
                                            $days = [
                                                'B.E' => $siteContent['home_mon']->value,
                                                'Ç.A' => $siteContent['home_tue']->value,
                                                'Ç' => $siteContent['home_wed']->value,
                                                'C.A' => $siteContent['home_thu']->value,
                                                'C' => $siteContent['home_fri']->value
                                            ];
                                        @endphp

                                        @foreach($days as $key => $label)
                                            <div class="custom-radio-group">
                                                <input type="radio" name="available_day"
                                                       id="day_{{ $loop->index }}"
                                                       value="{{ $key }}"
                                                       class="d-none custom-radio-input" {{ $loop->first ? 'checked' : '' }}
                                                        {{ old('available_day') == $key ? 'checked' : '' }}>

                                                <label for="day_{{ $loop->index }}" class="custom-radio-label">
                                                    <span class="day-text">{{ $label }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('available_day') <small
                                            class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <textarea rows="5" name="message" id="message"
                                              placeholder="{{$siteContent['home_vacancy_message']->value}}"
                                              class="form-control @error('message') is-invalid @enderror"></textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                @if(session('success'))
                                    <div class="col-md-12">
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    </div>
                                @endif

                                <div class="col-md-12 form-group mt-3">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                        {{$siteContent['home_vacancy_send']->value ??''}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- Leave Comment /- -->
                </div>
            </div>

            <!-- Blog Area /- -->

        </div><!-- Row /- -->
    </div><!-- Container /- -->
</div><!-- Page Content /- -->






