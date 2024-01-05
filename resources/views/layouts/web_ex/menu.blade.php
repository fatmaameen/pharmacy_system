<div class="app-menu navbar-menu">


    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('web/assets/images/Logo-1.png') }}" alt="" height="170px" width="225px">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('web/assets/images/Logo-1.png') }}" alt=""  height="170px" width="225px">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('web/assets/images/Logo-1.png') }}" alt=""height="170px" width="225px">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('web/assets/images/Logo-1.png') }}" alt=""height="170px" width="225px">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">القائمة</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link"
                         href="{{route('dashboard')}}" >
                       <span data-key="t-dashboards"> الصفحة الرئيسية</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLanding">
                        <i class='bx bx-category-alt'></i> <span data-key="t-landing">
                            الاقسام</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('shifts') }}" class="nav-link"
                                        data-key="t-one-page">قائمة الاقسام </a>
                                </li>
                            </ul>
                        </div>
                    {{-- <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}" class="nav-link"
                                        data-key="t-one-page">قائمة الاقسام الرئيسية</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('subcategories.index') }}" class="nav-link"
                                        data-key="t-one-page">قائمة الاقسام الفرعية</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('subsubcategories.index') }}" class="nav-link"
                                        data-key="t-one-page"> الاقسام الفرعية لقائمة الاقسام الفرعية</a>
                                </li>


                        </ul>
                    </div> --}}
                </li>
                @endif

                @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#product" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="product">
                        <i class='bx bx-category-alt'></i> <span data-key="t-landing">
                            المستلزمات</span>
                    </a>
                    <div class="collapse menu-dropdown" id="product">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('products.shifts') }}" class="nav-link"
                                        data-key="t-one-page">قائمة المستلزمات</a>
                                </li>



                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="#shift" data-bs-toggle="collapse" role="button"
                                        aria-expanded="false" aria-controls="shift">

                                        ادخال نوع جديد</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="shift">
                                        <ul class="nav nav-sm flex-column">

                                                <li class="nav-item">
                                                    <a href="{{ route('raw.matiries.create') }}" class="nav-link"
                                                        data-key="t-one-page">شيفت صباحي </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{ route('products.shifts') }}" class="nav-link"
                                                        data-key="t-one-page"> شيفت مسائي</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('raw.matiries.create') }}" class="nav-link"
                                                        data-key="t-nft-landing">
                                                          شيفت ليلي </a>
                                                </li>

                                        </ul>
                                    </div>
                                </li>
                        </ul>
                    </div>
                </li>
                @endif





                @if(auth()->user()->role_id==1)

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarForms">
                        <i class='bx bxs-group'></i> <span data-key="t-pages">الموردين</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarForms">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ route('admin.companies.suppliers.store.index') }}" class="nav-link"
                                    data-key="t-team"> قائمة الموردين</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.companies.suppliers.create') }}" class="nav-link"
                                    data-key="t-starter"> ادخال مورد جديد </a>
                            </li>







                        </ul>
                    </div>
                </li>
                @endif



                @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class='bx bx-user'></i><span data-key="t-apps">طاقم العمل</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{route('super.admin.create.admin.company.create')}}" class="nav-link" data-key="t-calendar">  ادخال  موظف جديد

                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('super.admin.create.admin.company.index')}}" class="nav-link" data-key="t-chat">قائمة العاملين بالمستشفي</a>
                                </li>



                        </ul>
                    </div>
                </li>
                    @endif
                    @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">مسمى وظيفي</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{route('companies.type.of.job.create')}}" class="nav-link" data-key="t-calendar">
                                        القائمة
                                    </a>
                                </li>

                        </ul>
                    </div>
                </li>
                @endif





                @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#used" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="used">
                        <i class='bx bx-category-alt'></i> <span data-key="t-landing">
                            الاستهلاك اليومي</span>
                    </a>
                    <div class="collapse menu-dropdown" id="used">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('daily_shifts') }}" class="nav-link"
                                        data-key="t-one-page">قائمة</a>
                                </li>


                        </ul>
                    </div>
                </li>
                @endif

                @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Expenses" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="Expenses">
                        <i class='bx bx-category-alt'></i> <span data-key="t-landing">
                            المصروفات</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Expenses">
                        <ul class="nav nav-sm flex-column">




                                <li class="nav-item">
                                    <a href="{{ route('expenses.create_invoce') }}" class="nav-link"
                                        data-key="t-nft-landing">
                                        اذن صرف جديد  </a>
                                </li>

                        </ul>
                    </div>
                </li>
                @endif


                @if(auth()->user()->role_id==1)
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#history" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="history">
                        <i class='bx bx-category-alt'></i> <span data-key="t-landing">
                            سجل المصروفات</span>
                    </a>
                    <div class="collapse menu-dropdown" id="history">
                        <ul class="nav nav-sm flex-column">

                                <li class="nav-item">
                                    <a href="{{ route('expenses.histore.list') }}" class="nav-link"
                                        data-key="t-one-page">قائمة المصروفات</a>
                                </li>




                                        </ul>
                                    </div>
                                </li>

                        </ul>
                    </div>
                </li>
                @endif

            </ul>




            </div>





        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
