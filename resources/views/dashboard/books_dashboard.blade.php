<!doctype html>
<html lang="ar">

<head>
    <title>إدارة الكتب</title>
    <!-- Required meta tags --->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />

    <style>
        body {
            font-family: "Cairo", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "slnt" 0;
        }
    </style>
</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.navigation')
    <!-- End Navbar -->


    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
    </div>

    <div style="margin-top: -20rem !important;" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="container">
            <div class="section text-left my-4">
                <h2 class="title">إدارة الكتب</h2>
            </div>
            @if (auth()->user()->role->role_name !== 'supervisor')
                <div class="row my-4">
                    <div class="col my-2">
                        <a href="{{ route('users.index') }}">
                            <div class="card move-on-hover" style="height: 100%">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span id="status1">{{ count($users) }}
                                        </span>
                                    </h1>
                                    <h6 class="mb-0">المستخدمين</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col my-2">
                        <a href="{{ route('book.sold') }}">
                            <div class="card move-on-hover" style="height: 100%">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span id="status1">{{ count($userBooks) }}
                                        </span>
                                    </h1>
                                    <h6 class="mb-0">الكتب المباعة</h6>
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
                                    <h6 class="mb-0">عمليات الدفع الداخلية</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col my-2">
                        <a href="{{ route('chats.users') }}">
                            <div class="card move-on-hover" style="height: 100%">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span id="status1">0
                                        </span>
                                    </h1>
                                    <h6 class="mb-0">المحادثات</h6>
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
                                    <h6 class="mb-0">السلايد شو</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col my-2">
                        <a href="{{ route('index.notification') }}">
                            <div class="card move-on-hover" style="height: 100%">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span
                                            id="status1">{{ count($notification) }}
                                        </span>
                                    </h1>
                                    <h6 class="mb-0">الاشعارات</h6>
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
                                    <h6 class="mb-0">الشكاوي و المقترحات</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            @endif
            <div class="row my-4">
                <div class="col my-2">
                    <a href="{{ route('category.index') }}">
                        <div class="card move-on-hover" style="height: 100%">
                            <div class="card-body text-center">
                                <h1 class="text-gradient text-warning"><span id="status1">{{ count($categories) }}
                                    </span>
                                </h1>
                                <h6 class="mb-0">الفئات</h6>
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
                                <h6 class="mb-0">الفئات الفرعية</h6>
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
                                <h6 class="mb-0">المؤلفون</h6>
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
                                <h6 class="mb-0">الناشرون</h6>
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
                                <h6 class="mb-0">الكتب</h6>
                            </div>
                        </div>
                    </a>
                </div>

                @if (Auth::user()->role->role_name !== 'supervisor')
                    <div class="col my-2">
                        <a href="{{ route('coupons.index') }}">
                            <div class="card move-on-hover">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span
                                            id="status1">{{ count($coupons) }}</span>
                                    </h1>
                                    <h6 class="mb-0">اضافة كود خصم للكتاب</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col my-2">
                <a href="{{ route('subscriptions.index') }}">
                    <div class="card move-on-hover">
                        <div class="card-body text-center">
                            <h1 class="text-gradient text-info">
                                <span id="subscriptions_count">{{ count($subscriptions) }}</span>
                            </h1>
                            <h6 class="mb-0">عدد الاشتراكات</h6>
                        </div>
                        <div class="card-body text-center">
                            <h1 class="text-gradient text-info">
                                <span id="subscriptions_count">{{ $subscribersCount }}</span>
                            </h1>
                            <h6 class="mb-0">عدد المشتركين</h6>
                        </div>
                    </div>
                </a>
            </div>
            @if (Auth::user()->role->role_name !== 'supervisor')
                <div class="row my-4">
                    <div class="col my-2">
                        <a href="{{ route('index.appSetting') }}">
                            <div class="card move-on-hover">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span id="status1">اعدادات الموقع</span>
                                    </h1>
                                    <h6 class="mb-0">اعدادات التطبيق</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col my-2">
                        <a href="{{ route('suggest.book.index') }}">
                            <div class="card move-on-hover">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning"><span id="status1">الكتب المقترحة</span>
                                    </h1>
                                    <h6 class="mb-0">الكتب المقترحة من العملاء</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col my-2">
                        <a href="{{ route('rating.book.index') }}">
                            <div class="card move-on-hover">
                                <div class="card-body text-center">
                                    <h1 class="text-gradient text-warning">تقييمات الكتاب
                                    </h1>
                                    <h6 class="mb-0">تقييمات الكتاب من العملاء</h6>
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
                                    <h6 class="mb-0">هنا يتم اضافة تعليمات التطبيق</h6>
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
                                    <h6 class="mb-0">سجل الاعمال الادارية</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
