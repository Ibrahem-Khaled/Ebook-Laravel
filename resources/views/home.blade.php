<!doctype html>
<html lang="ar" id="html" class="loading">

<head>
    <title>الخزانة - alkazana</title>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">

    <style>
        :root {
            --main-color: #D1935E;
        }

        body {
            font-family: "Cairo", sans-serif;
        }

        .main-color {
            color: var(--main-color);
        }

        .main-bg-color {
            background-color: var(--main-color);
        }

        .footer {
            background-color: #f8f9fa;
            padding: 40px 0;
            border-top: 1px solid #e7e7e7;
        }

        .footer h5 {
            color: var(--main-color);
            font-weight: bold;
        }

        .footer .social-icons a {
            color: #333;
            margin-right: 15px;
            font-size: 18px;
        }

        .footer .newsletter input {
            width: 70%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 5px;
        }

        .footer .newsletter button {
            padding: 10px 20px;
            border: none;
            background-color: var(--main-color);
            color: white;
            border-radius: 5px;
        }
    </style>
</head>

<body class="loading">
    <div class="container flex justify-content-center position-relative overflow-hidden w-10">
        <div id="spin" class='spinner'></div>
    </div>
    <div id='load' class="loading">
        @include('layouts.navigation_txt_dark')

        <!-- Slider Section -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
            <ol class="carousel-indicators">
                @foreach ($books as $index => $book)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                        class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($books as $index => $book)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img class="d-block w-100" style="height: 500px; object-fit: cover"
                            src="{{ asset($book->book_image_url) }}" alt="الشريحة {{ $index + 1 }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="main-color">{{ $book->book_title }}</h5>
                            <p>{{ $book->book_description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">السابق</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">التالي</span>
            </a>
        </div>

        <!-- Book with Category Name Section -->

        <section class="pt-3 pt-md-5 pb-md-5 pt-lg-8">
            <div class="container">
                @foreach ($categories as $category)
                    <div class="category-section">
                        <div class="category-header">
                            {{ $category->category_name }}
                        </div>
                        <div class="category-body">
                            <p>{{ $category->category_description }}</p>
                            <div class="row">
                                @foreach ($category->books as $book)
                                    <div class="col-md-4">
                                        <div class="book-item card shadow-sm mb-4">
                                            <img src="{{ asset($book->book_image_url) }}" alt="book image" height="200" style="object-fit: cover"
                                                class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $book->book_title }}</h5>
                                                <h6 class="card-text font-black" style="color: var(--main-color)">{{ $book->book_price === null ? 'مجانا' : $book->book_price . '  د.ج' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5>عن الخزانة</h5>
                        <p>نحن مكتبة تقدم أفضل الكتب من جميع أنحاء العالم.</p>
                    </div>
                    <div class="col-md-3">
                        <h5>روابط مفيدة</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">الرئيسية</a></li>
                            <li><a href="#">من نحن</a></li>
                            <li><a href="#">خدماتنا</a></li>
                            <li><a href="#">اتصل بنا</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>تابعنا</h5>
                        <div class="social-icons">
                            <a href="#"><i class="material-icons">facebook</i></a>
                            <a href="#"><i class="material-icons">twitter</i></a>
                            <a href="#"><i class="material-icons">instagram</i></a>
                            <a href="#"><i class="material-icons">youtube</i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>النشرة الإخبارية</h5>
                        <div class="newsletter">
                            <input type="email" placeholder="ادخل بريدك الإلكتروني">
                            <button>اشترك</button>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p>&copy; {{ date('Y') }} الخزانة. جميع الحقوق محفوظة.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
</body>

</html>
