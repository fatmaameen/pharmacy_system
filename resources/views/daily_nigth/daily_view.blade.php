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
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">عرض المنتجات التي تم سحبها اليوم</h5>


                                    {{-- <div class="hstack flex-wrap gap-2   mb-lg-0 mb-0 col-sm-2 col-md-1">
                                        <a href="{{ route('expenses.categories') }}"
                                            class="btn btn-outline-secondary btn-load">
                                            <span class="d-flex align-items-center">
                                                <span class="spinner-grow flex-shrink-0" role="status">
                                                    <span class="visually-hidden">+</span>
                                                </span>
                                                <span class="flex-grow-1 ms-2">
                                                    <i class='bx bx-arrow-back'></i>
                                                </span>
                                            </span>
                                        </a>
                                    </div> --}}

                                </div>
                                @if (session('message'))
                                    <div class="alert alert-secondary alert-border-left alert-dismissible fade show my-2"
                                        role="alert">
                                        <i class="ri-check-double-line me-3 align-middle"></i>
                                        <strong>{{ session('message') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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



                            </div>
                        </div>

                        <div class="card-body">
                            <table id="alternative-pagination"
                                class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                style="width:100%;overflow: scroll">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المنتج</th>
                                        <th> اسم المستخدم</th>
                                        <th>الكميه الكلية</th>

                                        <th>الكميه المسحوبة</th>
                                        <th>الكميه المتبقية </th>
                                        <th>حذف</th>
                                        <th>تعديل الكميه</th>


                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->user->name }}</td>

                                        <td>{{ $item->limit }}</td>
                                          <td>{{ $item->total_used}} </td>
                                         <td>{{ $item->limit - $item->total_used }}</td>

                                            <td><a href="{{ route('daily_used_delete', $item->id) }}"><i
                                                        class='bx bxs-message-square-x'></i></a></td>            
                                            <td><button type="button" class="btn btn-primary btn-sm"
                                                    data-id="{{ $item->id }}"  data-value="{{ $item->total_used}}"data-bs-toggle="modal"
                                                    data-bs-target="#varyingcontentModal{{ $item->id }}"
                                                    data-bs-whatever="@getbootstrap">
                                                    <i class='bx bx-edit-alt'></i>
                                                </button></td>
                                        </tr>

                                        <div class="modal fade" id="varyingcontentModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="varyingcontentModalLabel"  aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="varyingcontentModalLabel">تعديل كميه سحب
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>


                                                  <form action="{{ route('daily_used_edit', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">كميه</label>
                                                                <input type="number" class="form-control" required
                                                                    name="كميه" value=""
                                                                    id="recipient-name" value="{{ $item->total_used}}">
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">يغلق</button>
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
