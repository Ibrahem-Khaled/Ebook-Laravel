<!doctype html>
<html lang="ar">


<head>
    <title>اعدادات التطبيق</title>
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

    @php
        if (isset($appSettings)) {
            $nappSettings = count($appSettings);
        }
    @endphp

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
                        <h2 class="title">بيانات تطبيقك</h2>
                        <!-- Button to trigger modal -->
                        @if ($nappSettings == 0)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addSettingModal">
                                اضافة اعدادات جديدة
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addSettingModal" tabindex="-1" aria-labelledby="addSettingModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSettingModalLabel">إضافة إعدادات جديدة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form to add a new setting -->
                                <form action="{{ route('app-settings.store') }}" enctype="multipart/form-data"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="privacy" class="form-label">الخصوصية (PDF)</label>
                                        <input type="file" class="form-control" id="privacy" name="privacy"
                                            required>
                                    </div>
                                    <div class="container mt-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="can_screen_shot"
                                                id="toggle1" value="1">
                                            <label class="form-check-label" for="toggle1">السماح بعمل لقطة شاشة</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="can_screen_shot"
                                                id="toggle0" value="0">
                                            <label class="form-check-label" for="toggle0">لا يمكن السماح بعمل لقطة
                                                شاشة</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Instructions" class="form-label">التعليمات (PDF)</label>
                                        <input type="file" class="form-control" id="Instructions" name="Instructions"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="about_us" class="form-label">حول</label>
                                        <textarea class="form-control" id="about_us" name="about_us" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="yt" class="form-label">YouTube</label>
                                        <input type="text" class="form-control" id="yt" name="yt">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fb" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="fb" name="fb">
                                    </div>
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram">
                                    </div>
                                    <div class="mb-3">
                                        <label for="twitter" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telegram" class="form-label">Telegram</label>
                                        <input type="text" class="form-control" id="telegram" name="telegram">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">الهاتف</label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="whats_app" class="form-label">واتساب</label>
                                        <input type="text" class="form-control" id="whats_app" name="whats_app">
                                    </div>

                                    <button type="submit" class="btn btn-primary">إضافة</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @if ($nappSettings > 0)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الرقم التعريفي</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الخصوصية</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            التعليمات</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            حول</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            YouTube</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            Facebook</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            Instagram</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            Twitter</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            Telegram</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            البريد الإلكتروني</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الهاتف</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            واتساب</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ الإنشاء</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ التحديث</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تعديل</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($appSettings as $appSetting)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->id }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $appSetting->privacy }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->Instructions }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->about_us }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->yt }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->fb }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->instagram }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->twitter }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->telegram }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->email }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->phone }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->whats_app }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class=" mb-0">{{ $appSetting->updated_at }}</p>
                                            </td>
                                            <td class="align-middle" style="text-align: center;">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editapp{{ $appSetting->id }}">
                                                    تعديل
                                                </button>
                                                <div class="modal fade" id="editapp{{ $appSetting->id }}"
                                                    tabindex="-1" aria-labelledby="addSettingModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addSettingModalLabel">
                                                                    تعديل إعدادات التطبيق</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form to add a new setting -->
                                                                <form
                                                                    action="{{ route('app-settings.update', $appSetting->id) }}"
                                                                    enctype="multipart/form-data" method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="privacy"
                                                                            class="form-label">الخصوصية (PDF)</label>
                                                                        <input type="file"
                                                                            value="{{ $appSetting->privacy }}"
                                                                            class="form-control" id="privacy"
                                                                            name="privacy" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="Instructions"
                                                                            class="form-label">التعليمات (PDF)</label>
                                                                        <input type="file"
                                                                            value="{{ $appSetting->Instructions }}"
                                                                            class="form-control" id="Instructions"
                                                                            name="Instructions" required>
                                                                    </div>
                                                                    <div class="container mt-5">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="can_screen_shot"
                                                                                id="toggle1" value="1">
                                                                            <label class="form-check-label"
                                                                                for="toggle1">السماح بعمل لقطة
                                                                                شاشة</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="can_screen_shot"
                                                                                id="toggle0" value="0">
                                                                            <label class="form-check-label"
                                                                                for="toggle0">لا يمكن السماح بعمل لقطة
                                                                                شاشة</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="about_us"
                                                                            class="form-label">حول</label>
                                                                        <textarea class="form-control" id="about_us" name="about_us" rows="3"></textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="yt"
                                                                            class="form-label">YouTube</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->yt }}"
                                                                            class="form-control" id="yt"
                                                                            name="yt">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="fb"
                                                                            class="form-label">Facebook</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->fb }}"
                                                                            class="form-control" id="fb"
                                                                            name="fb">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="instagram"
                                                                            class="form-label">Instagram</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->instagram }}"
                                                                            class="form-control" id="instagram"
                                                                            name="instagram">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="twitter"
                                                                            class="form-label">Twitter</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->twitter }}"
                                                                            class="form-control" id="twitter"
                                                                            name="twitter">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="telegram"
                                                                            class="form-label">Telegram</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->telegram }}"
                                                                            class="form-control" id="telegram"
                                                                            name="telegram">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email"
                                                                            class="form-label">البريد
                                                                            الإلكتروني</label>
                                                                        <input type="email"
                                                                            value="{{ $appSetting->email }}"
                                                                            class="form-control" id="email"
                                                                            name="email">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="phone"
                                                                            class="form-label">الهاتف</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->phone }}"
                                                                            class="form-control" id="phone"
                                                                            name="phone">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="whats_app"
                                                                            class="form-label">واتساب</label>
                                                                        <input type="text"
                                                                            value="{{ $appSetting->whats_app }}"
                                                                            class="form-control" id="whats_app"
                                                                            name="whats_app">
                                                                    </div>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">إضافة</button>
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
                    <br>
                    <div class="row">
                        <div class="col">
                            {{--                                                    <h3 class="title mt-3">{{$user->category_name}}</h3> --}}
                            <p class="display-4" style="font-size: x-large">لا توجد
                                فئات.</p>
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
