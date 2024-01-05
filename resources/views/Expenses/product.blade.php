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
                            <h4 class="mb-sm-0"> قائمة المنتجات ل

                                    {{ $data->name }}

                            </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item active">المنتجات</li>

                                    <li class="breadcrumb-item"><a
                                            href="{{ route('expenses.subcategories', $data->category_id) }}">الفئات الفرعية</a>
                                    </li>
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
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">قائمة المنتجات

                                    </h5>

                                    <!-- Load More Buttons -->
                                    <div class="hstack flex-wrap gap-2   mb-lg-0 mb-0 col-sm-2 col-md-1">
                                        <a href="{{ route('raw.matiries.create') }}"
                                            class="btn btn-outline-secondary btn-load">
                                            <span class="d-flex align-items-center">
                                                <span class="spinner-grow flex-shrink-0" role="status">
                                                    <span class="visually-hidden">+</span>
                                                </span>
                                                <span class="flex-grow-1 ms-2">
                                                    +
                                                </span>
                                            </span>
                                        </a>
                                    </div>
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

                            <div class="card-body" style="overflow:auto">
                                <table id="alternative-pagination"
                                    class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                    style="width:100%;overflow: scroll">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>وصف</th>
                                            <th>كمية</th>
                                            <th>تنبيه</th>
                                            <th>تاريخ الإنتاج</th>
                                            <th>تاريخ الانتهاء</th>


                                            <th>سحب</th>

                                            <th>أنشئت في</th>


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


            var table = $('#alternative-pagination').DataTable({
                ajax: '{{ route('raw.matiries.datatable', $data->id) }}',
                columns: [{
                        'data': 'id'


                    },


                    {
                        'data': 'name'

                    },

                    {
                        'data': 'description'

                    },
                    {
                        'data': 'stock'

                    },
                    {
                        'data': 'alart'

                    },
                    {
                        'data': 'production_date',
                        'searchable': false

                    },
                    {
                        'data': 'expired_date',
                        'searchable': false,

                    },











                    {
                                'data': null,
                                render: function(data, row) {
                                    var id = data.id;
                                var url = '{{ route('expenses.add.to.card', ":id") }}';
                                url = url.replace(':id', data.id);
                                    return `
                                    <button type="button" class="btn btn-primary btn-sm" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#add${data.id}" data-bs-whatever="@getbootstrap">
                                          <i class="bx bx-cart-add"></i>
                                  </button>
                                    <div class="modal fade" id="add${data.id}" tabindex="-1" aria-labelledby="varyingcontentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="varyingcontentModalLabel">ضيف كميه سحب</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>


                                                <form action="${url}" method="POST">
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
                                                    <button type="submit" class="btn btn-primary">ضيف</button>
                                                </div>
                                            </form>
                                            </div>

                                        </div>
                                    </div>
                            `;
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
                        },
                        'searchable': false,


                    },





                ]
            });
        </script>
        <script>



            $(document).on('click', '#status', function() {

                $.ajax({
                    type: "put",
                    url: "{{ route('raw.matiries.status') }}",

                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': $(this).data('id')
                    },


                    success: function(response) {
                        $('#alert').css('display', 'block');
                        $('#strong').text(response.message);

                        table.ajax.reload();

                    },
                    errors: function(response) {
                        $('#alert').css('display', 'block');
                        $('#strong').text(response.message);

                        table.ajax.reload();

                    }
                });

            })
            $('#refresh').on('click', function() {
                $('#alert').css('display', 'none');
                table.ajax.reload();

            });

            // ...

        </script>

    @endpush
