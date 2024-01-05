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
                            <h4 class="card-title mb-0"> تعديل بيانات هذا القسم</h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                   
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




                                    <form action="{{ route('late_categories.update',$id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">الاسم</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="أدخل اسم القسم " value="{{$data->name}}"
                                                        required id="firstNameinput">
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">المدير المسئول عن هذا القسم</label>
                                                    <input type="text" class="form-control" name="leader"
                                                        placeholder="أدخل اسم المدير السئول " value="{{$data->leader}}"
                                                        required id="firstNameinput"><br>


                                                </div>
                                            </div><!--end col-->

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="phoneinput" class="form-label">رقم التليفون</label>
                                                    <input type="text" class="form-control" name="phone_catg"
                                                        placeholder="أدخل رقم التليفون الداخلي الخاص بالقسم"
                                                        value="{{$data->phone_catg}}" required><br>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">عدد الموظفين</label>
                                                    <input type="number" class="form-control" name="number_employee"
                                                        placeholder="أدخل  عدد الموظفين العاملين  بالقسم " value="{{ $data->number_employee }}"
                                                        required id="firstNameinput"><br>


                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstNameinput" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="  القسم Email  " value="{{$data->email }}"
                                                        required id="firstNameinput"><br>


                                                </div>
                                            </div><!--end col-->




                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">تعديل</button>
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
    @endpush
