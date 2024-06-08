<!doctype html>
<html lang="ar">

<head>
    <title>إدارة الكتب</title>
    <!-- Required meta tags --->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.navigation')
    <!-- End Navbar -->


    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{--        <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>

    <div style="margin-top: -20rem !important;" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="container">
            <div class="section text-left my-4">
                <h2 class="title">إدارة الكتب</h2>
            </div>
            <div class="row my-4">
                <div class="col my-2">
                    <a href="{{ route('users.index') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($users) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">المستخدمين</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="#">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($userBooks) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">الكتب المباعة</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="{{ route('payment.index') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($payment) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">عمليات الدفع الداخلية</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col my-2">
                    <a href="{{ route('index.slide') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($slides) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">السلايد شو</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="{{ route('index.notification') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($notification) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">الاشعارات</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="{{ route('index.contactUs') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($contact) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">الشكاوي و المقترحات</h6>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="row my-4">
                <div class="col my-2">
                    <a href="{{ route('category.index') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($categories) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">الفئات</h6>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col my-2">
                    <a href="{{ route('subcategory.index') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">
                                        {{ count($subcategories) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">الفئات الفرعية</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row my-4">
                <div class="col my-2">
                    <a href="{{ route('author.index') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span
                                        id="status1">{{ count($authors) }}</span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">المؤلفون</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="{{ route('publisher.index') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span
                                        id="status1">{{ count($publishers) }}</span></h1>
                                <h6 class="mb-0 font-weight-bolder">الناشرون</h6>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <div class="row my-4">
                <div class="col my-2">
                    <a href="{{ route('book.index') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span
                                        id="status1">{{ count($books) }}</span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">الكتب</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="{{ route('coupons.index') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span
                                        id="status1">{{ count($coupons) }}</span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">اضافة كود خصم للكتاب</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row my-4">
                <div class="col my-2">
                    <a href="{{ route('index.appSetting') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">اعدادات الموقع</span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">اعدادات التطبيق</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col my-2">
                    <a href="{{ route('instructions.index') }}">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">التعليمات</span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">هنا يتم اضافة تعليمات التطبيق</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row my-4">
                <div class="col my-2">
                    <a href="#">
                        <div class="card move-on-hover">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">.......</span>
                                </h1>
                                <h6 class="mb-0 font-weight-bolder">سجل الاعمال الادارية</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
