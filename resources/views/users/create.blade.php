@extends('layouts.web')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')
    <div id="layout-wrapper">
        @include('layouts.web_ex.header')
        @include('layouts.web_ex.notavcation')
        @include('layouts.web_ex.menu')
        <div class="vertical-overlay"></div>



        <div class="main-content">

            <div class="page-content">
                <div class="col-md-9 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title mb-0">إنشاء طاقم عمل جديد</h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>

                                                <a class="btn btn-success add-btn" id="create-btn"
                                                    href="{{ route('super.admin.create.admin.company.index') }}">خلف</a>



                                            </div>
                                        </div>

                                    </div>
                                    @if (session('message'))
                                        <div class="alert alert-secondary alert-border-left alert-dismissible fade show"
                                            role="alert">
                                            <i class="ri-check-double-line me-3 align-middle"></i>
                                            <strong>{{ session('message') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-warning alert-border-left alert-dismissible fade show"
                                            role="alert">
                                            <i class="ri-check-double-line me-3 align-middle"></i>
                                            <strong>{{ session('error') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>عفوًا!</strong> كانت هناك بعض المشاكل مع المدخلات الخاصة بك.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif




                                    <form action="{{ route('super.admin.create.admin.company.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">الاسم</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="أدخل الاسم" value="{{ old('name') }}" required
                                                        id="firstNameinput">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">بريد إلكتروني</label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="أدخل البريد الإلكتروني" value="{{ old('email') }}" required
                                                        id="firstNameinput">
                                                </div>
                                            </div><!--end col-->



                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="password-input">كلمة المرور</label>
                                                    <div class="position-relative auth-pass-inputgroup">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                         placeholder="أدخل كلمة المرور"  name="password">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                    <div id="passwordInput" class="form-text">يجب أن يكون على الأقل 8 أحرف.
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="form-label" for="confirm-password-input">تأكيد كلمة المرور</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                           placeholder="تأكيد كلمة المرور"
                                                           name="password_confirmation"

                                                           required>
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="confirm-password-input"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>
                                            </div>










                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">مسمى وظيفي</h6>
                                                    <select class="js-example-basic-multiple" required name="job_type"
                                                    >
                                                        <optgroup label="اختيار المسمى الوظيفي">

                                                            @foreach($job_title as $item)
                                                            <option value="{{ $item->id }}" {{$item->id==old('job_type') ? 'selected':''}}>
                                                              {{ $item->title }}
                                                            </option>
                                                            @endforeach




                                                        </optgroup>


                                                    </select>
                                                </div>
                                            </div><!--end col-->


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الأدوار</h6>
                                                    <select class="js-example-basic-multiple" required name="role_id"
                                                    >
                                                        <optgroup label="تحديد الدور">

                                                            @foreach($roles as $item)
                                                            <option value="{{ $item->id }}" {{$item->id==old('role_id')? 'selected':''}}>
                                                              {{ $item->name }}
                                                            </option>
                                                            @endforeach




                                                        </optgroup>


                                                    </select>
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">الصورة الرمزية</label>
                                                    <input type="file" class="form-control" name="avatar"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div><!--end col-->


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="form-check-input">
                                                        حالة

                                                    </label>
                                                    <!-- Base Radios -->
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" value="1" type="radio"
                                                            name="status" id="yes1" checked>
                                                        <label class="form-check-label" for="yes1">
                                                            نشيط
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" value="0" type="radio"
                                                            name="status" id="no">
                                                        <label class="form-check-label" for="no">
                                                            إلغاء التنشيط
                                                          </label>
                                                    </div>



                                                </div>
                                            </div><!--end col-->














                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">انشاء</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </form>


                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>


                </div>
            </div>

        </div>
        @include('layouts.web_ex.preloader')
        @include('layouts.web_ex.customizer')
        @include('layouts.web_ex.thems')
    @endsection
    @push('js')
    <script src="{{asset("web/assets/libs/particles.js/particles.js")}}"></script>

    <!-- particles app js -->
    <script src="{{asset("web/assets/js/pages/particles.app.js")}}"></script>
        <script src="{{ asset('web/assets/js/pages/passowrd-create.init.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('web/assets/js/pages/select2.init.js') }}"></script>
    @endpush
