<!doctype html>
<html lang="ar">

<head>
    <title>المستخدمين</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- الخطوط والرموز -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- شريط التنقل -->
    @include('layouts.navigation')
    <!-- نهاية شريط التنقل -->

    @include('layouts.alerts')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
    </div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}"
                    class="btn bg-gradient-faded-secondary">
                    <svg style="margin-right: 1rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                    العودة
                </a>
            </div>
        </div>

        <div class="container">
            <div class="section text-left my-4">
                @if (isset($users) && count($users) > 0)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الاسم</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الايميل</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ الانضمام</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ اخر تحديث</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            عدد الرسائل
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <a href="{{ route('chats.index', $user->id) }}"
                                                    class="text-white btn btn-success">{{ $user->name }}</a>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $user->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $user->updated_at }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <p class="mb-0">{{ $user->chats->count() }}</p> --}}
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
                            <p class="display-4" style="font-size: x-large">لا توجد بيانات للمستخدمين.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
