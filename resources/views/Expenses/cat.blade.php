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
                                           <th>  المنتجات</th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($data as $items)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$items->name}}</td>

                                            <td>
                                                <a href="{{route('expenses.subcategories',$items->id)}}" class="btn btn-primary"><i class='bx bxs-category'></i></a>
                                            </td>

                                            <td>
                                                <a href="{{route('expenses.show_product', $items->id)}}" class="btn btn-primary">عرض</i></a>
                                            </td>

                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="modal fade" id="add"  tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="varyingcontentModalLabel">ضيف كميه سحب للمنتج :{{ $items->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>


                            <form action="{{ route('expenses.catgpull' , $items->id) }}" method="POST">
                                @csrf
                                @method('put')
                            <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">كميه</label>
                                        <input type="number" class="form-control" required name="كميه" id="recipient-name">
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">سحب</button>
                            </div>
                        </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        @include('layouts.web_ex.preloader')
        @include('layouts.web_ex.customizer')
        @include('layouts.web_ex.thems')
    @endsection

