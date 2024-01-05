@extends('layouts.web')
@push('css')
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
                            <h4 class="card-title mb-0">ادخال بيانات مورد جديد
                            </h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            {{-- <div>


                                                <a class="btn btn-success add-btn" id="create-btn"
                                                    href="{{route('admin.companies.suppliers.store.index')}}">خلف</a>


                                            </div> --}}
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




                                    <form action="{{ route('admin.companies.suppliers.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">اسم الشركة</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="أدخل اسم الشركة الموردة" value="{{ old('name') }}"
                                                        required id="firstNameinput">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">عنوان الشركة</label>
                                                    <input type="text" class="form-control" name="location"
                                                        placeholder="أدخل موقع الشركة الموردة " value="{{ old('location') }}"
                                                         id="firstNameinput">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">رقم التليفون</label>
                                                    <input type="tel" required class="form-control" name="phone" placeholder="+(20) 10346632" id="phonenumberInput">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label"> Email </label>
                                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"  placeholder=".....@gmail.com">
                                                </div>
                                                  </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">صورة الشعار</label>
                                                    <input type="file" class="form-control" name="logo"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div><!--end col-->


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label"> ورق الشركة (السجل التجاري او بطاقة ضريبية او ترخيص) </label>
                                                    <input type="file" class="form-control" name="company_file"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">ادخال</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->

                                    </form>


                                </div></div>
                            </div><!-- end card -->
                        </div></div>
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
    @endpush
