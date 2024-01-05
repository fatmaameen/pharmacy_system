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
                            <h4 class="card-title mb-0">تعديل منتج {{$data->name}}
                            </h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                            </div>
                                        </div>

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




                                    <form action="{{ route('raw.nigth.update', $data->id) }}" method="POST">

                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">اسم</label>
                                                    <input type="text" class="form-control" name="اسم"
                                                        placeholder="أدخل اسم المنتج" value="{{ $data->name}}"
                                                        required id="firstNameinput">
                                                </div>
                                            </div><!--end col-->





                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">وصف</label>
                                                    <input type="text" class="form-control" name="وصف"
                                                        placeholder="أدخل وصف المنتج" value="{{ $data->description }}"
                                                         id="description">
                                                </div>
                                            </div><!--end col-->



                                            <div class="col-lg-6 col-md-6 my-2">
                                                <div class="mt-3">
                                                    <label class="form-label mb-0">تاريخ الإنتاج</label>
                                                    <input type="date" required name="تاريخ_الإنتاج"
                                                        class="form-control" data-provider="flatpickr"
                                                        data-date-format="d M, Y"
                                                        value="{{ $data->production_date}}"
                                                        data-deafult-date="25 12,2021">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 my-2">
                                                <div class="mt-3">
                                                    <label class="form-label mb-0">تاريخ الانتهاء</label>
                                                    <input type="date" required name="تاريخ_الانتهاء"
                                                        class="form-control" data-provider="flatpickr"
                                                        data-date-format="d M, Y"
                                                        value="{{$data->expired_date}}"
                                                        data-deafult-date="25 12,2021">
                                                </div>
                                            </div>




                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">كمية</label>
                                                    <input type="text" class="form-control" name="كمية"
                                                        value="{{ $data->stock }}"
                                                         id="description">
                                                </div>
                                            </div><!--end col-->









                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
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
    @endpush
