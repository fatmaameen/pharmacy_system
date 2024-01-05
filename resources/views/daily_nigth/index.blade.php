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
                                   <h1> عرض المنتج</h1>
                                    <!-- Load More Buttons -->


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
                                            <th>اسم المنتج</th>
                                            <th>وصف</th>
                                            <th>سحب</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $data as $dataa )
                                        <td>{{$loop->iteration }}</td>
                                          <td>{{ $dataa->name }}</td>
                                          <td>{{ $dataa->description }}</td>
                                         <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-id="{{ $dataa->id }}" data_name={{ $dataa->name }}  data-bs-toggle="modal" data-bs-target="#add{{$dataa->id}}">
                                                <i class="bx bx-cart-add"></i>
                                        </button>
                                        <div class="modal fade" id="add{{$dataa->id}}"  tabindex="-1" aria-labelledby="varyingcontentModalLabel{{$dataa->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="varyingcontentModalLabel">ضيف كميه سحب للمنتج :{{ $dataa->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>


                                                    <form action="{{route('add_daily_used' , $dataa->id) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                    <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">كميه</label>
                                                                <input type="number" class="form-control" required name="كميه" id="recipient-name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <h6 class="fw-semibold">المستخدمين</h6>
                                                                    <select class="js-example-basic-multiple" required name="user_name">

                                                                        <option selected>اختر اسم المستخدم:</option>
                                                                        @foreach ($suppliers as $supplier )
                                                                        <option value="{{$supplier->id}}">{{ $supplier->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div><!--end col-->

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">اغلاق</button>
                                                        <button type="submit" class="btn btn-primary">سحب</button>
                                                    </div>
                                                </form>
                                                </div>

                                            </div>
                                        </div>
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
