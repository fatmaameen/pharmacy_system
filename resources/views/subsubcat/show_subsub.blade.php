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
                                    <h1 class="card-title mb-0 col-sm-8 col-md-10">قائمة الاقسام الفرعية للقسم الفرعي  {{ $subcatg->name }} </h1><br>

                            <div class="card-body">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%;overflow: scroll">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم القسم </th>
                                            <th>اسم القسم الفرعي </th>
                                            <th> المدير المسئول</th>
                                            <th> رقم التليفون الداخلي</th>
                                            <th> عدد الموظفين</th>
                                            <th> Email  القسم</th>

                                            <th> العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ( $subsubcatg as $subsub)
                                       <td>{{$loop->iteration }}</td>
                                         <td>{{ $subsub->name }}</td>
                                       <td>
                                      {{$subcatg->name }}
                                       </td>
                                       <td>{{ $subsub->leader }}</td>
                                       <td>{{ $subsub->phone_subsubcatg }}</td>
                                       <td>{{ $subsub->number_employee }}</td>
                                       <td>{{ $subsub->email }}</td>
                                       <td>
                                        <a class="btn btn-primary" role="button" href="{{ route('subsubcatg.edit' , $subsub->id ) }}">تعديل بيانات القسم</a>
                                       </td>

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
