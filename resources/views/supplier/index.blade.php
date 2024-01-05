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
                                    <h5 class="card-title mb-0 col-sm-8 col-md-10">قائمة الموردين</h5>



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
                                            <th>اسم المورد</th>
                                            <th>العنوان</th>
                                            <th>رقم التليفون</th>
                                            <th>Email</th>
                                            <th>صورة الشعار</th>
                                            <th>ملف معلومات عن المورد</th>
                                            <th>تعديل</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @foreach ( $suppliers as $supplier)
                                     <td>{{ $loop->iteration }}</td>
                                     <td>{{ $supplier->name}}</td>
                                     <td>
                                        <?php
                                        $location = App\Models\Suppliers_Address_store::where('supplier_id', $supplier->id)->first();

                                        ?>
                                    {{ $location->location }}

                                    </td>


                                     <td>
                                        <?php
                                       $phone=App\Models\Suppliers_Phones_store::where('supplier_id' ,$supplier->id)->first();
                                     ?>
                                     {{ $phone->phone }}
                                    </td>
                                     <td>{{ $supplier->email }}</td>
                                     <td><a class="btn btn-primary" role="button" href="{{ route('admin.companies.suppliers.view.image' ,$supplier->id) }}">عرض الصورة </a></td>
                                     <td><a class="btn btn-primary" role="button" href="{{ route('admin.companies.suppliers.view.file' ,$supplier->id) }}">عرض الملف  </a></td>
                                     <td>
                                    <a class="btn btn-primary" role="button" href="{{ route('admin.companies.suppliers.store.edit' , $supplier->id) }}">تعديل </a>
                                    </td></tr>
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
    @push('js')
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
       <script>
    // داخل نافذة onload أو قبل إغلاق body
$('.open-modal').on('shown.bs.modal', function () {
    var address = $(this).data('address');
    var mapId = 'map-' + $(this).attr('id').replace('modal-', '');

    // جلب العنوان عن طريق جيوكودينج
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var mapOptions = {
                center: results[0].geometry.location,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById(mapId), mapOptions);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert('العنوان غير صالح: ' + status);
        }
    });
});



    </script>
    <!-- تضمين مكتبة Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>

@endpush
