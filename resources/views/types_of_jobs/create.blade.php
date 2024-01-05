@extends('layouts.web')
@push('css')
<link href="{{asset("web/assets/libs/sweetalert2/sweetalert2.min.css")}}" rel="stylesheet" type="text/css" />
<style>
.icon-container {
    position: relative;
    display: inline-block;
}

.icon {
    font-size: 24px;
    cursor: pointer;
}

.message {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    width: 200px;
    background-color: #333;
    color: #fff;
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}

.icon-container:hover .message {
    opacity: 1;
    visibility: visible;
}

</style>
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
                <div class="col-md-5">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title mb-0">ادخال أنواع جديدة من الوظائف</h4>
                            <div class="card-body ">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">

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




                                    <form action="{{ route('companies.type.of.job.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="job_title" class="form-label">مسمى وظيفي</label>
                                                    <input type="text" class="form-control" name="job_title"
                                                        placeholder="أدخل المسمى الوظيفي" value="{{ old('job_title') }}"
                                                        required id="job_title">
                                                </div>
                                            </div><!--end col-->










                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">انشاء</button>
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
                <div class="col-md-7">
                    <table id="alternative-pagination"
                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                    style="width:100%;overflow: scroll">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>مسمى وظيفي</th>
                            <th>تعديل</th>




                        </tr>
                    </thead>
                    <tbody class="text-center">



                    </tbody>
                </table>


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


            var table = $('#alternative-pagination').DataTable({
                ajax: '{{route('companies.type.of.job.datatable')}}',
                columns: [

                    {
                        'data': 'id'
                    },
                    {
                        'data': 'title'
                    },

                    {
                                'data': null,
                                render: function(data, row) {
                                    var id = data.id;


                                    var url = '{{ route("companies.type.of.job.update",":id") }}';
                                    url = url.replace(':id', id);
                                    return `
                                        <button type="button" class="btn btn-primary btn-sm" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#varyingcontentModal${data.id}" data-bs-whatever="@getbootstrap"><i class='bx bx-edit-alt'></i></button>

                                    <div class="modal fade" id="varyingcontentModal${data.id}" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="varyingcontentModalLabel">Update Job Title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>


                                                <form action="${url}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                <div class="modal-body">

                                                        <div class="mb-3">

                                                            <label for="job_title" class="form-label">Job Title</label>
                                                    <input type="text" class="form-control" name="job_title"
                                                        placeholder="Enter job title " value="${data.title}"
                                                        required id="job_title">
                                                            </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                            </div>

                                        </div>
                                    </div>
                            `;
                        }
                    },



                ]
            });
        </script>


       <script src="{{asset('web/assets/js/pages/sweetalerts.init.js')}}"></script>


    @endpush
