<!doctype html>
<html lang="ar">


<head>
    <title>التجارة الإلكترونية</title>
    <!-- الوسوم الضرورية -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- رموز المواد -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS مجموعة مواد -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.navigation')
    <!-- End Navbar -->


    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{--        <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>
    <div style="" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('author.index') }}"
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

                <h2 class="title">إنشاء مؤلف</h2>

                <div class="card">

                    <div class="card d-flex justify-content-center p-4 shadow-lg">
                        <form role="form" id="contact-form" method="POST" action="{{ route('author.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body pb-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>الاسم</label>
                                            @if (count($errors->get('author_name')) >= 1)
                                                <input name="author_name" id="author_name" class="form-control"
                                                    placeholder="اسم المؤلف" aria-label="Full Name" type="text"
                                                    style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                    value="{{ app('request')->old('author_name', null) }}">
                                            @else
                                                <input name="author_name" id="author_name" class="form-control"
                                                    placeholder="اسم المؤلف" aria-label="Full Name" type="text"
                                                    value="{{ app('request')->old('author_name', null) }}">
                                            @endif
                                        </div>
                                        <x-input-error class="text-danger" :messages="$errors->get('author_name')"></x-input-error>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>الصورة</label>
                                            <input name="image" id="image" class="form-control" type="file"
                                                value="{{ app('request')->old('image', null) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>الوصف</label>
                                            <textarea name="desc" id="desc" 
                                            class="form-control" placeholder="وصف المؤلف" 
                                            aria-label="Author Description">{{ app('request')->old('desc', null) }}</textarea>
                                        </div>
                                        <!-- Add any necessary validation error display here -->
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Facebook -->
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Facebook</label>
                                            <input name="fb" id="fb" class="form-control"
                                                placeholder="Facebook Profile URL" aria-label="Facebook Profile URL"
                                                type="text" value="{{ app('request')->old('fb', null) }}">
                                        </div>
                                        <!-- Add any necessary validation error display here -->
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- YouTube -->
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>YouTube</label>
                                            <input name="yt" id="yt" class="form-control"
                                                placeholder="YouTube Channel URL" aria-label="YouTube Channel URL"
                                                type="text" value="{{ app('request')->old('yt', null) }}">
                                        </div>
                                        <!-- Add any necessary validation error display here -->
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Telegram -->
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Telegram</label>
                                            <input name="telegram" id="telegram" class="form-control"
                                                placeholder="Telegram Profile URL" aria-label="Telegram Profile URL"
                                                type="text" value="{{ app('request')->old('telegram', null) }}">
                                        </div>
                                        <!-- Add any necessary validation error display here -->
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- WhatsApp -->
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>WhatsApp</label>
                                            <input name="whatsapp" id="whatsapp" class="form-control"
                                                placeholder="WhatsApp Profile URL" aria-label="WhatsApp Profile URL"
                                                type="text" value="{{ app('request')->old('whatsapp', null) }}">
                                        </div>
                                        <!-- Add any necessary validation error display here -->
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Instagram -->
                                    <div class="col-md-12">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Instagram</label>
                                            <input name="instagram" id="instagram" class="form-control"
                                                placeholder="Instagram Profile URL" aria-label="Instagram Profile URL"
                                                type="text" value="{{ app('request')->old('instagram', null) }}">
                                        </div>
                                        <!-- Add any necessary validation error display here -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 text-start">
                                        <a href="{{ route('author.index') }}"
                                            class="btn bg-gradient-danger mt-3 mb-0"
                                            style="max-width: 233px; width: -webkit-fill-available;">إلغاء
                                        </a>
                                    </div>

                                    <div class="col-sm-6 text-end">
                                        <button type="submit" class="btn bg-gradient-warning mt-3 mb-0"
                                            style="max-width: 233px;width: -webkit-fill-available;">إنشاء
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
