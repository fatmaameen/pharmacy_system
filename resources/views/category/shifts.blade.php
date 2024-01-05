@extends('layouts.web')
@include('layouts.web_ex.header')
@include('layouts.web_ex.notavcation')
@include('layouts.web_ex.menu')
@push('css')
    <link rel="stylesheet" href="{{ asset('web/mycss/mycss.css') }}">
    <style>
        .btn-group .btn {
            font-size: 24px;
            /* حجم النص */
            padding: 15px 60px;
            /* الهامش داخلي للزر */
            border-top-left-radius: 30px;
            /* شكل الحافة العلوية اليسرى */
            border-bottom-left-radius: 30px;
            /* شكل الحافة السفلية اليسرى */
            border-top-right-radius: 0;
            /* يجعل الحافة العلوية اليمنى مستقيمة */
            border-bottom-right-radius: 0;
            /* يجعل الحافة السفلية اليمنى مستقيمة */
            width: 300px;
            /* عرض الزر */
            height: 100px;
            /* ارتفاع الزر */
            margin: 20px;
            position: relative;

            text-align: center;
        }
    </style>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Bootstrap Css -->
@endpush
@section('content')
    <div id="layout-wrapper">

        <div class="vertical-overlay"></div>


        <div class="main-content">

            <div class="page-content">
                <div class="row">
                    <div class="col-20">
                     

                        <div class="btn-group mt-3">
                            <button class="btn btn-primary">
                                <a href="{{ route('pages') }}"
                                    style="color: inherit; text-decoration: none; display: block;">شيفت صباحي <br>9 صباحًا - 5 مساءً</a>
                            </button>
                            <button class="btn btn-primary">
                                <a href="{{ route('nigth') }}"
                                    style="color: inherit; text-decoration: none; display: block;">شيفت مسائي <br>5 مساءً - 1 صباحًا</a>
                            </button>
                            <button class="btn btn-primary">
                                <a href="{{ route('late') }}"
                                    style="color: inherit; text-decoration: none; display: block;">شيفت ليلي<br>1 صباحًا - 9 صباحًا</a>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
