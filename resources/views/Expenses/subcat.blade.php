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
                            <h4 class="mb-sm-0"> {{$catg->name}}


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">الفئات الفرعية</li>

                                    {{-- <li class="breadcrumb-item"><a
                                            href="{{route('expenses.categories')}}">فئات</a>
                                    </li> --}}
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
                                        {{$catg->name}}

                                    </h5>


                                    <button type="submit"
                                        class="btn btn-outline-primary mb-0 col-sm-2 col-md-1 btn-icon waves-effect waves-light"
                                        id="refresh"><i class="ri-24-hours-fill"></i></button>


                                    <div class="alert alert-secondary col-md-7 mx-auto alert-border-left alert-dismissible fade show"
                                        role="alert" id="alert" style="display: none">
                                        <i class="ri-check-double-line me-3 align-middle"></i> <strong
                                            id="strong"></strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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
                                            <th>الفئات الفرعية</th>
                                            <td> المنتجات</td>

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($subcatg as $sub)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$sub->name}}</td>
                                            <td>
                                                <a href="{{ route('expenses.subsub' , $sub->id) }}" class="btn btn-primary"><i class='bx bxs-category'></i></a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" role="button" href="{{ route('expenses.show_subproduct' ,$sub->id) }}">  عرض   </a>
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
