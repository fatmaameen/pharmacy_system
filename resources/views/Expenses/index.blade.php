@extends('layouts.web')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')
    <div id="layout-wrapper">
        @include('layouts.web_ex.header')
        @include('layouts.web_ex.notavcation')
        @include('layouts.web_ex.menu')
        <div class="vertical-overlay"></div>



        <div class="main-content">

            <div class="page-content">
                <div class="col-md-9 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title mb-0">إنشاء اذن صرف جديد
                            </h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>


                                                <a class="btn btn-success add-btn" id="create-btn"
                                                    href="{{route('raw.matiries.categories.material.index')}}">خلف</a>


                                            </div>
                                        </div>

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




                                    <form action="{{ route('expenses.store_invoce') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">










                                            <div class="col-md-6 my-2">
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold">طالب الصرف</h6>
                                                    <select class="js-example-basic-multiple" required name="طالب_الصرف"
                                                    >
                                                        <optgroup label="اختيار الموظف">

                                                            @foreach($uniqueCategories as $item)
                                                            <option value="" disabled>
                                                                {{ $item->job_title_name }}
                                                            </option>
                                                            @foreach($data as $subitem)
                                                                @if($subitem->job_title_id === $item->job_title_id)
                                                                    <option value="{{ $subitem->users_id }}" {{$subitem->users_id==old('طالب_الصرف') ? 'selected':''}}>
                                                                        &nbsp;&nbsp;&nbsp;{{ $subitem->users_name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach




                                                        </optgroup>


                                                    </select>
                                                </div>
                                            </div><!--end col-->











                                            <div class="col-md-6 ">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">صورة الصرف</label>
                                                    <input type="file" class="form-control" name="صورة_الصرف"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="address1ControlTextarea" class="form-label">pdf الصرف</label>
                                                    <input type="file" class="form-control" name="pdf_الصرف"
                                                        id="address1ControlTextarea">
                                                </div>
                                            </div><!--end col-->






                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" id="submit" class="btn btn-primary">انشاء</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </form>


                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>


                </div>
            </div>

        </div>
        @include('layouts.web_ex.preloader')
        @include('layouts.web_ex.customizer')
        @include('layouts.web_ex.thems')
    @endsection
    @push('js')
    <script>
             $(document).on('click', '#submit', function() {
            if (confirm('هل أنت متأكد؟')) {
                $('#submit').submit(function(e) {
                    e.preventDefault();

                });

            }

        })

    </script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="{{ asset('web/assets/js/pages/select2.init.js') }}"></script>
    @endpush
