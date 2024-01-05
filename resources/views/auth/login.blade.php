@extends('layouts.web')
@section('content')
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-12 " >
                                    <div class="col-xl-12 mx-auto">
                                        <div class="card">

                                            <div class="card-body">

                                                <div class="live-preview">
                                                    <div id="carouselExampleInterval" class="carousel slide"
                                                        data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active" data-bs-interval="10000">
                                                                <a href="https://www.facebook.com/MsarWeb" target="_black">
                                                                    <img src="{{asset('web/assets/images/0111.png')}}" class="d-block w-100" height="auto"
                                                                    alt="First slide" />
                                                                </a>

                                                            </div>
                                                            <div class="carousel-item" data-bs-interval="2000">
                                                                <img src="{{asset('web/assets/images/Untitl--ed-1 (1).jpg')}}" style="max-height: 500px" class="d-block w-100"
                                                                    alt="two slide" />
                                                            </div>
                                                            <div class="carousel-item">
                                                                <img src="{{asset('web/assets/images/010.jpg')}}" class="d-block w-100"
                                                                    alt="There slide" />
                                                            </div>
                                                        </div>
                                                        <button class="carousel-control-prev" type="button"
                                                            data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button"
                                                            data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="d-none code-view">
                                                    <pre class="language-markup" style="height: 375px;">
            <code>&lt;!-- Individual Slide --&gt;
            &lt;div id=&quot;carouselExampleInterval&quot; class=&quot;carousel slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
                &lt;div class=&quot;carousel-inner&quot;&gt;
                  &lt;div class=&quot;carousel-item active&quot; data-bs-interval=&quot;10000&quot;&gt;
                    &lt;img src=&quot;...&quot; class=&quot;d-block w-100&quot; alt=&quot;...&quot;&gt;
                  &lt;/div&gt;
                  &lt;div class=&quot;carousel-item&quot; data-bs-interval=&quot;2000&quot;&gt;
                    &lt;img src=&quot;...&quot; class=&quot;d-block w-100&quot; alt=&quot;...&quot;&gt;
                  &lt;/div&gt;
                  &lt;div class=&quot;carousel-item&quot;&gt;
                    &lt;img src=&quot;...&quot; class=&quot;d-block w-100&quot; alt=&quot;...&quot;&gt;
                  &lt;/div&gt;
                &lt;/div&gt;
                &lt;button class=&quot;carousel-control-prev&quot; type=&quot;button&quot; data-bs-target=&quot;#carouselExampleInterval&quot; data-bs-slide=&quot;prev&quot;&gt;
                  &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
                  &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
                &lt;/button&gt;
                &lt;button class=&quot;carousel-control-next&quot; type=&quot;button&quot; data-bs-target=&quot;#carouselExampleInterval&quot; data-bs-slide=&quot;next&quot;&gt;
                  &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
                  &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
                &lt;/button&gt;
            &lt;/div&gt;</code></pre>
                                                </div>
                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div>

                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100"
                                        style="background-image: url({{ URL::asset('web/assets/images/Logo-2.png') }}); opacity:0.8">

                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">مرحبًا بعودتك !</h5>
                                            <p class="text-muted">تسجيل دخول.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">بريد إلكتروني</label>
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder="أدخل البريد الإلكتروني" name="email" required>
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">

                                                    </div>
                                                    <label class="form-label" for="password-input">كلمة المرور</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                            name="password" placeholder="أدخل كلمة المرور"
                                                            id="password-input">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                        @error('password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">تذكرنى</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">تسجيل الدخول</button>
                                                </div>



                                            </form>
                                        </div>


                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i>
                                MSAR WEB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
@endsection

@push('js')
    <script src="{{ asset('web/assets/js/pages/passowrd-create.init.js') }}"></script>
    <script src="{{asset('web/assets/libs/prismjs/prism.js')}}"></script>
@endpush
