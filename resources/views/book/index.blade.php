<!doctype html>
<html lang="ar">

<head>
    <title>الكتب</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

    <style>
        .page-header {
            background-image: url('{{ asset('img/bg-20.jpg') }}');
            height: 500px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .card {
            border-radius: 15px;
        }

        .btn-warning {
            background-color: #ff9800;
            color: #fff;
            border-radius: 30px;
        }

        .btn-warning:hover {
            background-color: #e68900;
            color: #fff;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 700;
        }

        .table td {
            vertical-align: middle;
        }

        .truncated-text-large {
            max-width: 400px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .truncated-text-short {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .loading-animation {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .modal-header {
            background-color: #ff9800;
            color: #fff;
        }

        .modal-footer .btn {
            border-radius: 20px;
        }

        .input-group-text {
            background-color: #ff9800;
            color: #fff;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .input-group-dynamic input {
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: none;
            border: 1px solid #ff9800;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    @include('book.styles.index')

    <div class="page-header">
        <div class="mask bg-gradient-dark opacity-6"></div>
    </div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn btn-warning mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}">
                    <svg style="margin-right: 1rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg> العودة
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
                            class="btn btn-warning btn-sm">إنشاء كتاب</a></div>
                </div>

                <div class="row">
                    <div class="container w-60 my-5 shadow-lg p-2" style="border-radius: 10px">
                        <div class="input-group input-group-dynamic">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                            <input id="searchBook" name="searchBook" type="text" class="form-control"
                                placeholder="ابحث عن الكتب">
                        </div>
                    </div>
                </div>

                @php
                    $nbooks = isset($books) ? count($books) : 0;
                @endphp
                @if ($nbooks > 0)
                    <div class="card">
                        <div id="loader" style="align-self: center"></div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="table">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الرقم التسلسلي الدولي (ISBN)
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            العنوان
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الناشر
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            المترجمون
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
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $isbn }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 truncated-text-large" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="{{ $book->book_title }}">
                                                    {{ $book->book_title }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="mb-0 truncated-text-short" data-bs-toggle='tooltip'
                                                    data-bs-placement='top'
                                                    title='{{ $book->publisher->publisher_name }}'>
                                                    {{ $book->publisher->publisher_name }}</p>
                                            </td>

                                            <td class="align-middle">
                                                <ul class="mb-0 list-unstyled">
                                                    @foreach ($book->bookInfo as $author)
                                                        @php
                                                            $authorId = $author?->author_id;
                                                            $authorData = $authorId
                                                                ? \App\Models\Author::find($authorId)
                                                                : null;
                                                        @endphp

                                                        @if ($authorData)
                                                            <li data-bs-toggle='tooltip'
                                                                title='{{ $authorData->author_name }}'>
                                                                {{ $authorData->author_name }}
                                                                <form
                                                                    action="{{ route('book.translator.delete', $author->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="text-primary btn btn-danger btn-sm">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16" fill="#fff"
                                                                            class="bi bi-x" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td class="align-middle">
                                                <p class="mb-0">$ {{ number_format($book->book_price) }}</p>
                                            </td>

                                            <td class="align-middle text-center">
                                                <a href="{{ route('book.show', $book->id) }}"
                                                    class="text-secondary mx-3 font-weight-normal" data-toggle="tooltip"
                                                    data-original-title="Show book">عرض
                                                </a>

                                                <a href="{{ route('book.edit', $book->id) }}"
                                                    class="text-secondary mx-3 font-weight-normal"
                                                    data-toggle="tooltip" data-original-title="Edit book">تحرير
                                                </a>

                                                @if (Auth::user()->role->role_name == 'admin')
                                                    <a href="" class="text-secondary font-weight-normal"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteConfirm{{ $book->id }}"
                                                        data-toggle="tooltip" data-original-title="Delete book">حذف
                                                    </a>
                                                @endif
                                            </td>
                                            <div class="modal fade" id="deleteConfirm{{ $book->id }}"
                                                tabindex="-1" aria-labelledby="deleteConfirm{{ $book->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" style="margin-top: 10rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تأكيد</h5>
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
                                                                    class="btn bg-gradient-danger mb-0">حذف
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
                                <p class="display-4" style="font-size: x-large">لم يتم العثور على الكتاب</p>
                            </div>
                        </div>
                    @else
                        <br>
                        <div class="row">
                            <div class="col">
                                <p class="display-4" style="font-size: x-large">لا توجد كتب.</p>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>

    @include('book.scripts.index')

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
