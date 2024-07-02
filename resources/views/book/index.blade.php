<!doctype html>
<html lang="es">

<head>
    <title>الكتب</title>
    <!-- الوسوم الضرورية -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     الخطوط والأيقونات     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- أيقونات المواد -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS لمجموعة المواد -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />

    {{-- جيكويري --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

</head>

<body>
    <!-- شريط التنقل شفاف -->
    @include('layouts.navigation')
    <!-- End Navbar -->

    {{-- أنماط إضافية --}}
    @include('book.styles.index')


    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{--        <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>


    <div style="" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
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
                <div class="row">

                    <div class="col">

                        <h2 class="title">الكتب</h2>
                    </div>
                    <div class="col" style="text-align: end"><a href="{{ route('book.create') }}"
                            class="btn btn-sm btn-warning">إنشاء كتاب</a></div>
                </div>

                {{-- شريط البحث --}}
                <div class="row">
                    <div class="container w-60 my-5 shadow-lg p-2" style="border-radius: 10px">
                        <div class="input-group input-group-dynamic">

                            <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-search"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></span>


                            <input id="searchBook" name="searchBook" type="text" class="form-control"
                                placeholder="ابحث عن الكتب">

                        </div>
                    </div>
                </div>
                @php
                    if (isset($books)) {
                        $nbooks = count($books);
                } @endphp
                @if ($nbooks > 0)
                    <div class="card">
                        <div id="loader" style="align-self: center"></div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="table">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            الرقم التسلسلي الدولي (ISBN)
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            العنوان
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            الناشر
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            السعر
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody id="bookDisplay">
                                    @php
                                        function convertToISBN($number): string
                                        {
                                            return 'ISBN ' .
                                                substr($number, 0, 3) .
                                                '-' .
                                                substr($number, 3, 1) .
                                                '-' .
                                                substr($number, 4, 4) .
                                                '-' .
                                                substr($number, 8, 4) .
                                                '-' .
                                                substr($number, 12, 1);
                                        }
                                    @endphp
                                    @foreach ($books as $book)
                                        @php
                                            $number = $book->book_isbn;
                                            $isbn = convertToISBN($number);
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-center  ">
                                                <p class="mb-0">{{ $isbn }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 truncated-text-large" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="{{ $book->book_title }}">
                                                    {{ $book->book_title }}</p>
                                            </td>
                                            <td class="align-middle ">
                                                <p class="mb-0 truncated-text-short" data-bs-toggle='tooltip'
                                                    data-bs-placement='top'
                                                    title='{{ $book->publisher->publisher_name }}'>
                                                    {{ $book->publisher->publisher_name }}</p>
                                            </td>
                                            <td class="align-middle ">
                                                <p class="mb-0">$ {{ number_format($book->book_price) }}</p>
                                            </td>

                                            <td class="align-middle" style="text-align: center;">


                                                <a href="{{ route('book.show', $book->id) }}"
                                                    class="text-secondary  mx-3 font-weight-normal "
                                                    data-toggle="tooltip" data-original-title="Show user">
                                                    عرض
                                                </a>

                                                <a href="{{ route('book.edit', $book->id) }}"
                                                    class="text-secondary  mx-3 font-weight-normal "
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    تحرير
                                                </a>


                                                <a href="" class="text-secondary font-weight-normal "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteConfirm{{ $book->id }}"
                                                    data-toggle="tooltip" data-original-title="Delete user">
                                                    حذف
                                                </a>

                                            </td>
                                            <div class="modal fade" id="deleteConfirm{{ $book->id }}"
                                                tabindex="-1" aria-labelledby="deleteConfirm{{ $book->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" style="margin-top: 10rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                تأكيد</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل أنت متأكد أنك تريد حذف الكتاب '{{ $book->book_title }}'؟
                                                            <br><br>
                                                            هذا الإجراء لا يمكن التراجع عنه.
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn bg-gradient-dark mb-0"
                                                                data-bs-dismiss="modal">إلغاء
                                                            </button>
                                                            <form method="POST"
                                                                action="{{ route('book.delete', $book->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn bg-gradient-danger mb-0">
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="loading" class="loading-animation"></div>
                        </div>
                        <br>
                        <div class="row" id="noExistsDisplay" style="display: none">
                            <div class="col text-center">
                                <p class="display-4" style="font-size: x-large"> لم يتم العثور على الكتاب</p>
                            </div>
                        </div>
                    @else
                        <br>
                        <div class="row">
                            <div class="col">
                                {{--                                                    <h3 class="title mt-3">{{$category->category_name}}</h3> --}}
                                <p class="display-4" style="font-size: x-large"> لا توجد كتب.</p>
                            </div>
                        </div>
                @endif
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">

        </div>
    </div>

    </div>

    <br><br><br><br>

    @include('book.scripts.index')

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
