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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <h1 class="card-title mb-0 col-sm-8 col-md-10">قائمة الاقسام الفرعية للاقسام الفرعية الموجودة</h1><br>
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-primary" role="button"  href="{{ route('late_subsubcategories.create') }}"> اضافة قسم فرعي جديد</a>
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


                            <div class="card-body">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%;overflow: scroll">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم القسم  </th>
                                            <th>القسم الفرعي</th>
                                            <th> المدير المسئول</th>
                                            <th> رقم التليفون الداخلي</th>
                                            <th> عدد الموظفين</th>
                                            <th> Email  القسم</th>

                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ( $subsubcatg as $subsub)
                                       <td>{{$loop->iteration }}</td>
                                         <td>{{ $subsub->name }}</td>
                                        <td>{{ $subsub->subcategory->name }}</td>
                                        <td>{{ $subsub->leader }}</td>
                                        <td>{{ $subsub->phone_subsubcatg }}</td>
                                        <td>{{ $subsub->number_employee }}</td>
                                        <td>{{ $subsub->email }}</td>

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
