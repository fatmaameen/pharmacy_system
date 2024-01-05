@section('content')
    <div id="layout-wrapper">
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="row">
                    <div class="col-20">
                        <div class="btn-group mt-3">
                            <button class="btn btn-primary">
                                <a href="{{ route('nigth_categories.index') }}"
                                    style="color: inherit; text-decoration: none; display: block;"> قائمة الاقسام
                                    الرئيسية</a>
                            </button>
                            <button class="btn btn-primary">
                                <a href="{{ route('nigth_subcategories.index') }}"
                                    style="color: inherit; text-decoration: none; display: block;">قائمة الاقسام الفرعية</a>
                            </button>
                            <button class="btn btn-primary">
                                <a href="{{ route('late_subsubcategories.index') }}"
                                    style="color: inherit; text-decoration: none; display: block;"> الاقسام الفرعية لقائمة
                                    الاقسام الفرعية </a>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        @endsection
