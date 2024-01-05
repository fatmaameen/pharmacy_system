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
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">فئات المنتجات</h5>


                                    <!-- Load More Buttons -->
                                    <div class="hstack flex-wrap gap-2   mb-lg-0 mb-0 col-sm-2 col-md-1">

                                    </div>
                                    @if (session('error'))
                                    <div class="alert alert-warning alert-border-left col-md-7 mx-auto alert-dismissible fade show"
                                        role="alert">
                                        <i class="ri-check-double-line me-3 align-middle"></i>
                                        <strong>{{ session('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif



                                </div>
                            </div>

                            <div class="card-body">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%;overflow: scroll">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم</th>
                                            <th>الفئات الفرعية</th>
                                            <th> المنتجات</th>
                                            <th>انشئت في</th>


                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($category as $catg)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$catg->name}}</td>
                                            <td>
                                                <a href="{{ route('daily.subcategories.material.index' ,$catg->id) }}" class="btn btn-primary"><i class='bx bxs-category'></i></a>

                                            </td>
                                            <td>
                                                <a href="{{ route('daily_show_product', $catg->id) }}" class="btn btn-primary">عرض</a>
                                            </td>
                                            <td>{{ $catg->created_at }}</td>
                                        </tr>
                                        @endforeach


                                    </tbody>
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

