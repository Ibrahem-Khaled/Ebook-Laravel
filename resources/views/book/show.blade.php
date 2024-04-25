<!doctype html>
<html lang="ar">


<head>
    <title>{{ $book->book_name }}</title>
    <!-- العلامات الواجبة -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     الخطوط والأيقونات     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- أيقونات المواد -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- النمط المادي كيت CSS -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>
    <!-- الشريط الجانبي شفاف -->
    @include('layouts.navigation')
    <!-- انتهى الشريط الجانبي -->

    @php
        function convertToISBN($number): string
        {
            return substr($number, 0, 3) .
                '-' .
                substr($number, 3, 1) .
                '-' .
                substr($number, 4, 4) .
                '-' .
                substr($number, 8, 4) .
                '-' .
                substr($number, 12, 1);
        }

        $number = $book->book_isbn;
        $isbn = convertToISBN($number);

    @endphp


    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{--        <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>

    <div class="card card-body shadow-2xl shadow-dark mx-4 mx-md-5 mx-lg-10 mt-n12">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('book.index') }}"
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
        {{--    <button class="btn btn-white ms-auto mt-n6 me-n3" type="button" name="button"><i class="material-icons me-2">shopping_cart</i>0 items</button> --}}
        <div class="section my-4 my-lg-5">
            <div class="container">
                <div class="row flex-row">
                    <div class="col-lg-5">
                        <img class="w-80 shadow-lg border-radius-lg img-fluid ms-2"
                            src="{{ asset($book->book_image_url) }}" alt="ladydady" loading="lazy">
                    </div>
                    <div class="col-lg-7">
                        <div>
                            <h3 class="mt-lg-0 mt-4">{{ $book->book_title }}</h3>
                            <p class="text-xs text-uppercase font-weight-bold text-gradient text-warning mb-4">
                                {{ $book->subcategory->subcategory_name }}</p>
                            <h6 class="mb-0 mt-2 text-lg">السعر</h6>
                            <p class="text-lg">$ {{ number_format($book->book_price) }}</p>

                            <h6 class="mb-0 mt-2">الخصم</h6>
                            <p class="text-lg">{{ $book->book_discount }} %</p>

                            <h6 class="mb-0 mt-2">السعر العام</h6>
                            <p class="text-lg">$
                                {{ number_format($book->book_price - $book->book_price * ($book->book_discount / 100)) }}
                            </p>

                            <h6 class="mb-0 mt-2">الفئة</h6>
                            <p class="text-lg">{{ $book->category->category_name }}</p>

                            <h6 class="mb-0 mt-2">الفئة الفرعية</h6>
                            <p class="text-lg">{{ $book->subcategory->subcategory_name }}</p>

                            <h6 class="mb-0 mt-2">المؤلف</h6>
                            <p class="text-lg">{{ $book->author->author_name }}</p>

                            <h6 class="mb-0 mt-2">الناشر</h6>
                            <p class="text-lg">{{ $book->publisher->publisher_name }}</p>

                            <h6 class="mb-0 mt-2">عدد الصفحات</h6>
                            <p class="text-lg">{{ $book->book_number_pages }}</p>

                            <h6 class="mb-0 mt-2">تاريخ النشر</h6>
                            <p class="text-lg">{{ $book->book_publication_date }}</p>



                            <div class="row mt-4">
                                <div class="accordion" id="accordionRental">
                                    <div class="accordion-item mb-3">
                                        <h5 class="accordion-header" id="headingOne">
                                            <button class="accordion-button border-bottom font-weight-bold collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                ملخص
                                                <svg style="margin-left: 1rem" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </button>
                                        </h5>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionRental"
                                            style="">
                                            <div class="accordion-body text-md opacity-8">
                                                {{ $book->book_description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- وحدة التحكم لمجموعة مواد UI: تأثيرات بارالاكس، نصوص لصفحات المثال الخ -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
