@extends('layouts.web')
@push('css')
<script src="script.js"></script>
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
                            <h4 class="card-title mb-0">اضافة كمية للمنتج:{{ $data->name }}  </h4>
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




                                    <form action="{{ route('store_quantity' ,$data->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstNameinput" class="form-label">كمية</label>
                                                            <input type="number" class="form-control" name="كمية"
                                                                placeholder="أدخل مخزون المنتج" min="1"  value="{{ old('كمية') }}"
                                                                required id="firstNameinput">
                                                        </div>
                                                    </div><br><!--end col-->



                                                    <div class="col-lg-6 col-md-6 my-2">
                                                        <div class="mt-3">
                                                            <label class="form-label mb-0">تاريخ الإنتاج</label>
                                                            <input type="date" required name="تاريخ_الإنتاج"
                                                                class="form-control" data-provider="flatpickr"
                                                                data-date-format="d M, Y"
                                                                value="{{ old('تاريخ_الإنتاج') }}"
                                                                data-deafult-date="25 12,2021">
                                                        </div>


                                                    </div><br>

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

                                                    {{-- <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <h6 class="fw-semibold">الموردين</h6>
                                                            <select class="js-example-basic-multiple" required name="الموردين">

                                                                <option selected>اختر المورد</option>
                                                                @foreach ($suppliers as $supplier )
                                                                <option value="{{$supplier->id}}">{{ $supplier->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div><!--end col--> --}}


                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">اضافة</button>
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
    function handleRadioChange() {
      var radios = document.getElementsByName("status");
      var selectedValue = "";

       for (var i = 0; i < radios.length; i++) {
         if (radios[i].checked) {
          selectedValue = radios[i].value;
           break;
         }
      }

       if (selectedValue === "1") {
         window.location.href =;
       } else if (selectedValue === "0") {
         window.location.href = "";
       }
    }
  </script>
    @endpush
