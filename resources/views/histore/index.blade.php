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
                            <h4 class="mb-sm-0">




                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">
                                        سجل المصروفات
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
                                            <th>رقم الطلبيه</th>
                                            <th> أمين المخازن</th>


                                            <th>اسم المستلم</th>


                                            <th>صوره الاذن</th>
                                            <th>عرض التفاصيل</th>
                                            <th> تاريخ السحب</th>


                                        </tr>
                                    </thead>
                                    <tbody class="text-center">



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
        <script>
            var locale = '{{ App::getLocale() }}';

            var table = $('#alternative-pagination').DataTable({
                ajax: '{{ route("expenses.histore.datatable") }}',
                columns: [{
                        'data': 'id'
                    },


                    {
                        'data': 'cache_name'

                    },

                    {
                        'data': 'employee_name'

                    },

                    {
                        'data': null,
                        render: function(data, row) {
                            return `
                    <img src="{{ asset('web/expenses/bill/image/') }}/${data.image}"
                     class="small-image" style="height: 50px; width: 50px" onclick="openFullScreen(this)">
                  `;
                        }
                    },



                    {
                            'data': null,
                            render: function(data) {
                                var id = data.id;
                                console.log(id);
                                var url = '{{ route("expenses.histore_one.list", ":id") }}';
                                url = url.replace(':id', data.id);
                                return '<a href="' + url + '"> <i class="bx bx-show btn btn-info"></i></a>';


                            }
                        },


                    {
                        'data': 'created_at',
                        render: function(data, type, row) {
                            // Parse the date string
                            var date = new Date(data);

                            // Check if the date is valid
                            if (!isNaN(date.getTime())) {
                                // Format the date as 'YYYY-MM-DD'
                                var year = date.getFullYear();
                                var month = (date.getMonth() + 1).toString().padStart(2,
                                    '0'); // Months are zero-based
                                var day = date.getDate().toString().padStart(2, '0');

                                return year + '-' + month + '-' + day;
                            } else {
                                return 'Invalid Date'; // Handle invalid date strings
                            }
                        }


                    },





                ]
            });
        </script>
        <script>

            $('#refresh').on('click', function() {
                $('#alert').css('display', 'none');
                table.ajax.reload();

            });





        </script>
        <script>
            function openFullScreen(image) {
                var fullScreenContainer = document.createElement('div');
                fullScreenContainer.className = 'fullscreen-image';

                var fullScreenImage = document.createElement('img');
                fullScreenImage.src = image.src;

                fullScreenContainer.appendChild(fullScreenImage);
                document.body.appendChild(fullScreenContainer);

                fullScreenContainer.addEventListener('click', function() {
                    document.body.removeChild(fullScreenContainer);
                });
            }
        </script>
    @endpush
