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
                            <h4 class="mb-sm-0"> {{$subcatg->name}}


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">الفئات الفرعية</li>


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
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">قائمة الفئات الفرعية ل
                                        {{$subcatg->name}}

                                    </h5>

                                    <!-- Load More Buttons -->
                                    {{-- <div class="hstack flex-wrap gap-2   mb-lg-0 mb-0 col-sm-2 col-md-1">
                                            <a href="{{ route('admin.companies.subcategories.store.create',$data->id) }}"
                                                class="btn btn-outline-secondary btn-load">
                                                <span class="d-flex align-items-center">
                                                    <span class="spinner-grow flex-shrink-0" role="status">
                                                        <span class="visually-hidden">+</span>
                                                    </span>
                                                    <span class="flex-grow-1 ms-2">
                                                        +
                                                    </span>
                                                </span>
                                            </a>
                                    </div> --}}

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

                            <div class="card-body">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%;overflow: scroll">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم</th>
                                            <th> المنتجات</th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($sudsubcatg as $subsub)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$subsub->name}}</td>
                                            <td>
                                                <a href="{{ route('expenses.subsubproducts', $subsub->id) }}" class="btn btn-primary">عرض المنتج</i></a>
                                            </td>

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
    @push('js')

    @endpush
