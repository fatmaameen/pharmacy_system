@extends('layouts.web')
@section('content')

    <div id="layout-wrapper">
        @include('layouts.web_ex.header')
        @include('layouts.web_ex.notavcation')
        @include('layouts.web_ex.menu')
        <div class="vertical-overlay"></div>


        <div class="main-content">

            <div class="page-content">

                    <div class="row my-3">
                        <div class="col-xxl-4 col-md-6 ">
                            <div class="card info-card revenue-card bg-danger" style="box-shadow: 10px 10px 10px rgb(184, 82, 82)">


                                <div class="card-body">
                                    <h5 class="card-title">عدد<span>|المنتجات</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ps-3">
                                                   {{$product}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->
                        <div class="col-xxl-4 col-md-6 ">
                            <div class="card info-card revenue-card bg-danger" style="box-shadow: 10px 10px 10px rgb(184, 82, 82)">


                                <div class="card-body">
                                    <h5 class="card-title">عدد<span>|المستخدمين نشطين</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ps-3">
                                            {{$active}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card bg-danger" style="box-shadow: 10px 10px 10px rgb(184, 82, 82)">


                                <div class="card-body">
                                    <h5 class="card-title">عدد <span>|المستخدمين غير نشطين</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ps-3">
                                            {{$not}}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>




        </div>



         </div>
    @include('layouts.web_ex.preloader')
    @include('layouts.web_ex.customizer')
    @include('layouts.web_ex.thems')
@endsection
