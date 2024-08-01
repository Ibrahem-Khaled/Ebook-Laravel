<!doctype html>
<html lang="ar">

<head>
    <title>إدارة الكتب</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- الخطوط والرموز -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    <style>
        body {
            font-family: "Roboto", sans-serif;
            background-color: #f8f9fa;
        }

        .page-header {
            background-image: url({{ asset('img/bg-20.jpg') }});
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .page-header .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .page-header h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2.5rem;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .table-responsive {
            margin-top: 1rem;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .form-control,
        .form-select {
            margin-bottom: 1rem;
        }

        .modal-header,
        .modal-footer {
            border: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navigation')
    <!-- End Navbar -->

    <div class="page-header">
        <div class="overlay"></div>
        <h1>إدارة الكتب</h1>
    </div>

    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-0">كتب المؤلفين والناشرين الخاصة بك</h2>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#filterModal">
                            فلترة البيانات
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">اسم الكتاب</th>
                                <th class="text-center">المؤلف</th>
                                <th class="text-center">الناشر</th>
                                <th class="text-center">تاريخ الإصدار</th>
                                <th class="text-center">عدد مرات البيع</th>
                                <th class="text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td class="text-center">{{ $book->book_title }}</td>
                                    <td class="text-center">{{ $book->author->author_name }}</td>
                                    <td class="text-center">{{ $book->publisher->publisher_name }}</td>
                                    <td class="text-center">{{ $book->book_publication_date }}</td>
                                    <td class="text-center">{{ $book->userBooks->count() }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#viewBookModal{{ $book->id }}">
                                            عرض التفاصيل
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal لعرض التفاصيل -->
                                <div class="modal fade" id="viewBookModal{{ $book->id }}" tabindex="-1"
                                    aria-labelledby="viewBookModalLabel{{ $book->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewBookModalLabel{{ $book->id }}">
                                                    تفاصيل الكتاب</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>اسم الكتاب:</strong> {{ $book->book_title }}</p>
                                                <p><strong>المؤلف:</strong> {{ $book->author->author_name }}</p>
                                                <p><strong>الناشر:</strong> {{ $book->publisher->publisher_name }}</p>
                                                <p><strong>تاريخ الإصدار:</strong> {{ $book->book_publication_date }}
                                                </p>
                                                <p><strong>عدد مرات البيع:</strong> {{ $book->userBooks->count() }}</p>
                                                <p><strong>وصف:</strong> {{ $book->book_description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal الفلترة -->

        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">فلترة الكتب</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.AuthorAndPublisher', Auth::user()->id) }}" method="GET">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">من تاريخ</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">إلى تاريخ</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <button type="submit" class="btn btn-primary">بحث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
