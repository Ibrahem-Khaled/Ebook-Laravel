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
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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

        .carousel-item {
            height: 500px;
        }

        .carousel-item img.background-blur {
            filter: blur(8px);
            -webkit-filter: blur(8px);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-caption {
            bottom: 20%;
        }

        .carousel-caption img.book-cover {
            height: 300px;
            width: 150px;
            object-fit: cover;
            margin: 20px;
        }

        .carousel-caption h5,
        .carousel-caption p {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
        }

        .authors-section .swiper-slide {
            opacity: 0.5;
            transition: transform 0.3s, opacity 0.3s;
        }

        .authors-section .swiper-slide-active {
            transform: scale(1.2);
            opacity: 1;
        }

        .authors-section .author-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .swiper-container {
            padding: 20px 0;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--main-color);
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
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="7000">
            <ol class="carousel-indicators">
                @foreach ($books as $index => $book)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                        class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach ($books as $index => $book)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img class="d-block w-100 background-blur" src="{{ asset($book->book_image_url) }}"
                            alt="الشريحة {{ $index + 1 }}">
                        <div class="carousel-caption d-flex flex-column align-items-center text-center">
                            <img class="book-cover" src="{{ asset($book->book_image_url) }}"
                                alt="{{ $book->book_title }}">
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

        <!-- Authors Section -->
        <section class="authors-section py-5">
            <div class="container">
                <h2 class="text-center mb-4">المؤلفون</h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($authors as $author)
                            <a href="{{ route('author', $author->id) }}" class="swiper-slide text-center">
                                <h5>{{ $author->author_name }}</h5>
                            </a>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <section class="authors-section py-5">
            <div class="container">
                <h2 class="text-center mb-4">دار النشر</h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($publishers as $publisher)
                            <div class="swiper-slide text-center">
                                <h5>{{ $publisher->publisher_name }}</h5>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <!-- Book with Category Name Section -->

        <section class="pt-3 pt-md-5 pb-md-5 pt-lg-8">
            <div class="container">
                @foreach ($categories as $category)
                    <div class="category-section">
                        <div class="category-header"
                            style="color: var(--main-color); margin: 20px; font-size: 20px;font-weight: bold">
                            {{ $category->category_name }}
                        </div>
                        <div class="category-body">
                            <div class="row">
                                @foreach ($category->books as $book)
                                    <div class="col-md-3">
                                        <div class="book-item card shadow-sm mb-4">
                                            <img src="{{ asset($book->book_image_url) }}" alt="book image"
                                                height="200" style="object-fit: cover" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $book->book_title }}</h5>
                                                <h6 class="card-text font-black" style="color: var(--main-color)">
                                                    {{ $book->book_price === null ? 'مجانا' : $book->book_price . '  د.ج' }}
                                                </h6>
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
       @include('layouts.footer')
    </div>

    <!-- Bootstrap and necessary plugins -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });
    </script>
</body>

</html>
