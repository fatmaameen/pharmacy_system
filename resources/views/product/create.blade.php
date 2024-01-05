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
                            <h4 class="card-title mb-0">إنشاء نوع جديد في المستلزمات الخاصة بالشيفت الصباحي
                            </h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">

                                    </div>
                                    @if (session('message'))

                                        <div class="alert alert-secondary alert-border-left alert-dismissible fade show" role="alert">
                                            <i class="ri-check-double-line me-3 align-middle"></i> <strong>{{ session('message') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('error'))

                                    <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="ri-check-double-line me-3 align-middle"></i> <strong>{{ session('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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




                                    <form action="{{ route('raw.matiries.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">اسم</label>
                                                    <input type="text" class="form-control" name="اسم"
                                                        placeholder="أدخل اسم المنتج" value="{{ old('اسم') }}"
                                                        required id="firstNameinput">
                                                </div>
                                            </div><!--end col-->





                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">وصف</label>
                                                    <input type="text" class="form-control" name="وصف"
                                                        placeholder="أدخل وصف المنتج" value="{{ old('وصف') }}"
                                                         id="description">
                                                </div>
                                            </div><!--end col-->



                                          <div class="col-lg-6 col-md-6 my-2">
                                                <div class="mt-3">
                                                    <label class="form-label mb-0">تاريخ الإنتاج</label>
                                                    <input type="date" required name="تاريخ_الإنتاج"
                                                        class="form-control" data-provider="flatpickr"
                                                        data-date-format="d M, Y"
                                                        value="{{ old('تاريخ_الإنتاج') }}"
                                                        data-deafult-date="25 12,2021">
                                                </div>


                                            </div>

                                            <div class="col-lg-6 col-md-6 my-2">
                                                <div class="mt-3">
                                                    <label class="form-label mb-0">تاريخ الانتهاء</label>
                                                    <input type="date" required name="تاريخ_الانتهاء"
                                                        class="form-control" data-provider="flatpickr"
                                                        data-date-format="d M, Y"
                                                        value="{{ old('تاريخ_الانتهاء') }}"
                                                        data-deafult-date="25 12,2021">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الاقسام </h6>
                                                    <select class="js-example-basic-multiple" id="الفئات" name="الفئات"  onclick="console.log($(this).val())"
                                                    onchange="console.log('change is firing')">
                                                        <option selected value="">اختر القسم</option>
                                                        @foreach ($categories as $category )
                                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الاقسام الفرعية</h6>
                                                    <select id="subcatgSelect" class="js-example-basic-multiple"  name="subcatg"  onclick="console.log($(this).val())"
                                                    onchange="console.log('change is firing')">
                                                        <option selected value="">اختر القسم الفرعي </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الاقسام الفرعية للاقسام الفرعية </h6>
                                                    <select id="subsubcatg" name="subsubcatg" class="js-example-basic-multiple">
                                                        <option selected value="">اختر القسم الفرعي للاقسام الفرعية</option>
                                                    </select>
                                                </div>
                                            </div><!--end col-->



                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">الموردين</h6>
                                                    <select class="js-example-basic-multiple" required name="الموردين">

                                                        <option selected>اختر المورد</option>
                                                        @foreach ($suppliers as $supplier )
                                                        <option value="{{$supplier->id}}">{{ $supplier->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div><!--end col-->





                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">كمية</label>
                                                    <input type="number" class="form-control" name="كمية"
                                                        placeholder="أدخل مخزون المنتج" min="1"  value="{{ old('كمية') }}"
                                                        required id="firstNameinput">
                                                </div>
                                            </div><!--end col-->
{{--
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">تنبيه </label>
                                                    <input type="number" class="form-control" name="تنبيه"
                                                        placeholder="أدخل مخزون المنتج" min="1"  value="{{ old('تنبيه') }}"
                                                        required id="firstNameinput">
                                                </div>
                                            </div><!--end col--> --}}



                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">صورة الفاتوره</label>
                                                    <input type="file" class="form-control" name="bill_image"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">pdf الفاتوره</label>
                                                    <input type="file" class="form-control" name="bill_file"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div><!--end col-->






                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" id="submit" class="btn btn-primary">انشاء</button>
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
    <script>
             $(document).on('click', '#submit', function() {
            if (confirm('هل أنت متأكد؟')) {
                $('#submit').submit(function(e) {
                    e.preventDefault();

                });

            }

        })

    </script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="{{ asset('web/assets/js/pages/select2.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('select[name="الفئات"]').on('change', function() {
                var subcatgId = $(this).val();
                if (subcatgId) {
                    $.ajax({
                        url: "{{ URL::to('subcategories') }}/" + subcatgId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcatg"]').empty();
                            $('select[name="subcatg"]').append('<option value="">اختر القيمة</option>');
                            $.each(data, function(key, value) {
                                $('select[name="subcatg"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>

    <script>
        $(document).ready(function() {
            $('select[name="subcatg"]').on('change', function() {
                var subsubcatgId = $(this).val();
                if (subsubcatgId) {
                    $.ajax({
                        url: "{{ URL::to('subsubcategories') }}/" + subsubcatgId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcatg"]').empty();
                            $('select[name="subsubcatg"]').append('<option value="">اختر القيمة</option>');
                            $.each(data, function(key, value) {
                                $('select[name="subsubcatg"]').append('<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>
    @endpush
