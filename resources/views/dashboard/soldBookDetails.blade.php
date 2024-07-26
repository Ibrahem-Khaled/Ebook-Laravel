<!doctype html>
<html lang="ar">

<head>
    <title>التجارة الإلكترونية</title>
    <!-- العلامات الواجبة -->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- الخطوط والرموز -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- الرموز المادية -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>
    <!-- شريط التنقل الشفاف -->
    @include('layouts.navigation')
    <!-- نهاية شريط التنقل -->

    @include('layouts.alerts')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{-- <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}"
                    class="btn bg-gradient-faded-secondary"
                    style="max-width: 233px; width: -webkit-fill-available;"><svg style="margin-right: 1rem"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>العودة
                </a>
            </div>
        </div>
        <div class="container">
            <div class="section text-left my-4">
                <h2 class="title">{{ $book->book_title }}</h2>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">{{ $book->book_title }}</h4>
                        <p class="card-category">{{ $book->category->category_name }}</p>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">عدد اكواد الخصم للكتاب التي بيع بها الكتاب:
                            {{ $book->coupons->where('is_used', 1)->count() }}</p>
                        <p class="mb-2">عدد مرات بيع هذا الكتاب إجمالي بالاكواد:
                            {{ $book->userBooks->count() }}</p>
                    </div>
                    <div class="card-footer">
                        <h5>المستخدمين الذين قاموا بشراء هذا الكتاب:</h5>
                        <ul class="list-group">
                            @foreach ($book->userBooks as $userBook)
                                <li class="list-group-item">{{ $userBook->name }} - {{ $userBook->email }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- مركز التحكم لواجهة المستخدم المادية: تأثيرات التدرج، النصوص لصفحات المثال وما إلى ذلك -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
