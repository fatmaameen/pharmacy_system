@extends('layouts.web')
@push('css')
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Bootstrap Css -->
@endpush
@section('content')
    <div id="layout-wrapper">
        @include('layouts.web_ex.header')
        @include('layouts.web_ex.notavcation')
        @include('layouts.web_ex.menu')
        <div class="vertical-overlay"></div>


        <div class="main-content">

            <div class="page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex mx-1 align-items-center justify-content-between">




                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">

                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                   <h1> عرض المنتجات</h1>
                                    <!-- Load More Buttons -->

                                    <form action="{{ route('product.search') }}" method="GET">
                                        <input type="text" name="term" placeholder="Search...">
                                        <button type="submit">Search</button>
                                    </form>

                                    @if (session('error'))
                                        <div class="alert alert-warning alert-border-left col-md-7 mx-auto alert-dismissible fade show"
                                            role="alert">
                                            <i class="ri-check-double-line me-3 align-middle"></i>
                                            <strong>{{ session('error') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('message'))
                                        <div class="alert alert-secondary alert-border-left col-md-7 mx-auto alert-dismissible fade show"
                                            role="alert">
                                            <i class="ri-check-double-line me-3 align-middle"></i>
                                            <strong>{{ session('message') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body" style="overflow:auto">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%;overflow: scroll">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>وصف</th>
                                            <th>كمية</th>

                                            <th>الكميات المضافة</th>
                                            <th> العمليات</th>
                                           <th> تم اضافته في</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach ( $data as $dataa )

                                        <td>{{$loop->iteration }}</td>
                                          <td>{{ $dataa->name }}</td>
                                          <td>{{ $dataa->description }}</td>
                                          <td>{{ $dataa->total_stock }}</td>
                                          <td>
                                            <a class="btn btn-secondary" role="button" href="{{ route('show_addquantity' , $dataa->id) }}">الكميات المضافة</a>
                                           </td>

                                          <td>
                                            <a class="btn btn-primary" role="button" href="{{ route('raw.matiries.edit' ,$dataa->id) }}">تعديل</a>

                                            <a class="btn btn-danger" role="button" href="{{ route('product.addQuantity' , $dataa->id) }}">اضافة كمية</a>
                                         </td>
                                       <td>{{ $dataa->created_at }}</td>
                                      </tbody>

                                      @endforeach

                                </table>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->


            </div>

        </div>
        @include('layouts.web_ex.preloader')
        @include('layouts.web_ex.customizer')
        @include('layouts.web_ex.thems')
    @endsection
    @push('js')


    @endpush
