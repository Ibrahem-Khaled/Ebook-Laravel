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
                @php
                    if (isset($books)) {
                        $nbooks = count($books);
                } @endphp
                @if ($nbooks > 0)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            id
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            اسم الكتاب
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            المؤلفون
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            الوصف
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            نوع الكتاب
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            تم الإنشاء
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            تم التحديث
                                        </th>
                                        <th class="text-secondary opacity-7">
                                            action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td class="align-middle text-center ">
                                                <p class=" mb-0">{{ $book->id }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $book->title }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $book->author }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $book->description }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $book->book_type }}</p>
                                            </td>
                                            <td class="align-middle text-center  ">
                                                <p class=" mb-0">{{ $book->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <p class=" mb-0">{{ $book->updated_at }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <form action="{{ route('suggest.book.destroy', $book->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <br>
                    <div class="row">
                        <div class="col">
                            <p class="display-4" style="font-size: x-large">لا توجد مدفوعات.</p>
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

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- مركز التحكم لواجهة المستخدم المادية: تأثيرات التدرج، النصوص لصفحات المثال وما إلى ذلك -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
