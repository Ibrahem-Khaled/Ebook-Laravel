<!doctype html>
<html lang="ar">

<head>
    <title>الاشعارات</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    <style>
        .content {
            overflow: hidden;
            height: 3.6em;
            line-height: 1.2em;
            max-width: 200px;
            transition: height 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- شريط التنقل الشفاف -->
    @include('layouts.navigation')
    <!-- نهاية شريط التنقل -->

    @include('layouts.alerts')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px"></div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}"
                    style="max-width: 233px; width: -webkit-fill-available;">
                    <svg style="margin-right: 1rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
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
                        <h2 class="title">الشكاوي والمقترحات</h2>
                    </div>
                </div>
                @php
                    $ncontact = isset($contact) ? count($contact) : 0;
                @endphp
                @if ($ncontact > 0)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            المستخدم</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            وصف الرسالة</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ الارسال</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ اخر تحديث له</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contact as $item)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $item->user?->name }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="content" id="content{{ $item->id }}">
                                                    {{ \Illuminate\Support\Str::limit($item->desc, 100) }}
                                                </div>
                                                @if (strlen($item->desc) > 100)
                                                    <button class="btn btn-link p-0"
                                                        onclick="toggleContent({{ $item->id }}, '{{ $item->desc }}')">قراءة
                                                        المزيد</button>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $item->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="mb-0">{{ $item->updated_at }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#deleteConfirm{{ $item->id }}">
                                                    حذف
                                                </button>


                                                <div class="modal fade" id="deleteConfirm{{ $item->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteConfirmLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" style="margin-top: 10rem;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteConfirmLabel{{ $item->id }}">تأكيد
                                                                    الحذف</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                هل أنت متأكد أنك تريد حذف؟
                                                                <br><br>
                                                                هذا الإجراء لا يمكن التراجع عنه وقد يؤثر على جميع
                                                                المرتبطة بهذه.
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn bg-gradient-dark mb-0"
                                                                    data-dismiss="modal">إلغاء</button>
                                                                <form method="POST"
                                                                    action="{{ route('destroy.contact', $item->id) }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn bg-gradient-danger mb-0">حذف</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="row mt-4">
                        <div class="col">
                            <p class="display-4" style="font-size: x-large">لا توجد فئات.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        function toggleContent(id, fullText) {
            var contentDiv = document.getElementById('content' + id);
            var button = contentDiv.nextElementSibling;
            if (contentDiv.style.height === 'auto') {
                contentDiv.style.height = '3.6em';
                contentDiv.innerHTML = fullText.substring(0, 100) + '...';
                button.innerHTML = 'قراءة المزيد';
            } else {
                contentDiv.style.height = 'auto';
                contentDiv.innerHTML = fullText;
                button.innerHTML = 'إخفاء';
            }
        }
    </script>
</body>

</html>
