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
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">عرض المنتجات المضافة من المنتج:{{ $product->name }}</h5>

                                    <!-- Load More Buttons -->

                                    <!-- Load More Buttons -->


                                </div>
                                @if (session('message'))

                                <div class="alert alert-secondary alert-border-left alert-dismissible fade show my-2" role="alert">
                                    <i class="ri-check-double-line me-3 align-middle"></i> <strong>{{ session('message') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                                @if (session('error'))
                                    <div class="alert alert-warning alert-border-left col-md-7 mx-auto alert-dismissible fade show  my-2"
                                        role="alert">
                                        <i class="ri-check-double-line me-3 align-middle"></i>
                                        <strong>{{ session('error') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            <br>
                                <a class="btn btn-primary" role="button" href="{{ route('product.addQuantity' , $product->id) }}"> اضافة كمية</a>

                            </div>
                            <h3>الكمية الكلية:{{ $product->total_stock }}</h3>
                        </div>

                        <div class="card-body">
                            <table id="alternative-pagination"
                                class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                style="width:100%;overflow: scroll">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الكميه</th>
                                        <th>تاريخ الانتاج</th>
                                        <th>تاريخ الانتهاء</th>
                                        <th>حذف</th>
                                        <th>تعديل الكميه</th>



                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($stock as $items)
                                        <tr>
                                            <td>{{ $loop->iteration  }}</td>
                                            <td>{{ $items->stock }}</td>
                                            <td>{{ $items->production_date }}</td>
                                            <td>{{ $items->expired_date }}</td>
                                            <td>
                                                <a href="{{ route('nigth_quantity_delete', $items->id) }}"><i
                                                        class='bx bxs-message-square-x'></i></a>
                                                    </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-id="{{ $items->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#varyingcontentModal{{ $items->id }}"
                                                    data-bs-whatever="@getbootstrap">
                                                    <i class='bx bx-edit-alt' ></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="varyingcontentModal{{ $items->id }}" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="varyingcontentModalLabel">تعديل الكمية المضافة </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>


                                                    <form action="{{route('nigth_quantity_edit',$items->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                    <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label for="recipient-name" class="col-form-label">كميه</label>
                                                                <input type="number" class="form-control" required name="كميه" value="{{$items->stock}}" id="recipient-name">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 my-2">
                                                                <div class="mt-3">
                                                                    <label class="form-label mb-0">تاريخ الإنتاج</label>
                                                                    <input type="date" required name="تاريخ_الإنتاج"
                                                                        class="form-control" data-provider="flatpickr"
                                                                        data-date-format="d M, Y"
                                                                        value="{{ $items->production_date}}"
                                                                        data-deafult-date="25 12,2021">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 my-2">
                                                                <div class="mt-3">
                                                                    <label class="form-label mb-0">تاريخ الانتهاء</label>
                                                                    <input type="date" required name="تاريخ_الانتهاء"
                                                                        class="form-control" data-provider="flatpickr"
                                                                        data-date-format="d M, Y"
                                                                        value="{{$items->expired_date}}"
                                                                        data-deafult-date="25 12,2021">
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">يغلق</button>
                                                        <button type="submit" class="btn btn-primary">تعديل</button>
                                                    </div>
                                                </form>
                                                </div>

                                            </div>

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
