<!doctype html>
<html lang="es">

<head>
    <title>انشاء كتاب</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
</head>

<body>
    @include('layouts.navigation')
    @include('book.styles.create')
    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
    </div>
    <div style="" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="container">
            <div class="section text-left my-4">
                <a href="{{ route('book.index') }}" class="text-warning text-sm icon-move-left">
                    < الرجوع </a>
                        <h2 class="title">إنشاء كتاب</h2>
                        <div class="card">
                            <div class="card d-flex justify-content-center p-4 shadow-lg">
                                <form role="form" id="contact-form" method="POST" autocomplete="off"
                                    action="{{ route('book.save') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body pb-2">
                                        <div class="row">
                                            <!-- ISBN code -->
                                            <div class="input-group input-group-static mb-4 mt-4">
                                                <label>رمز العالمي</label>
                                                <input name="book_isbn" id="book_isbn" class="form-control"
                                                    type="text" placeholder="قم بمسح أو إدخال رمز ISN" autofocus
                                                    value="{{ app('request')->old('book_isbn', null) }}"
                                                    style="{{ $errors->has('book_isbn') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                                <span class="input-group-text" style="right: 18px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                        height="25" fill="currentColor" class="bi bi-upc-scan"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_isbn')"></x-input-error>

                                            <!-- Category select -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>الفئة</label>
                                                <select name="category_id" id="category_id" class="form-control"
                                                    style="{{ $errors->has('category_id') ? 'box-shadow: 0 0 8px 2px #ff000061;' : '' }}">
                                                    <option selected disabled hidden value=""></option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('category_id')"></x-input-error>

                                            <!-- Subcategory select -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>الفئة الفرعية</label>
                                                <select name="subcategory_id" id="subcategory_id" class="form-control"
                                                    style="{{ $errors->has('subcategory_id') ? 'box-shadow: 0 0 8px 2px #ff000061;' : '' }}">
                                                </select>
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('subcategory_id')"></x-input-error>

                                            <!-- Title -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>العنوان</label>
                                                <input name="book_title" id="book_title" class="form-control"
                                                    type="text" placeholder="اسم الكتاب"
                                                    value="{{ app('request')->old('book_title', null) }}"
                                                    style="{{ $errors->has('book_title') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_title')"></x-input-error>

                                            <!-- Author -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>الناشر</label>
                                                <input readonly="readonly" name="author_name" id="author_name"
                                                    class="form-control" placeholder="اختر الناشر"
                                                    style="{{ $errors->has('author_id') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                                <input name="author_id" id="author_id" hidden>
                                                <ul name="selectAuthor" id="selectAuthor"
                                                    class="mt-6 card selectSearch dropdown-menu"
                                                    style="width:-webkit-fill-available; position: absolute"
                                                    aria-labelledby="navbarDropdownMenuLink2">
                                                    <div class="container mr-1 mt-1 ml-1 mb-1">
                                                        <div class="input-group input-group-dynamic">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-search" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                </svg>
                                                            </span>
                                                            <input id="searchAuthor" name="searchAuthor" type="text"
                                                                class="form-control" placeholder="Buscar autor"
                                                                aria-label="Username" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div id="authorOptions" name="authorOptions"></div>
                                                </ul>
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('author_id')"></x-input-error>

                                            <!-- Publisher -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>ناشر للكتاب</label>
                                                <input readonly="readonly" name="publisher_name" id="publisher_name"
                                                    class="form-control" placeholder="اختر ناشرًا"
                                                    style="{{ $errors->has('publisher_id') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                                <input name="publisher_id" id="publisher_id" hidden>
                                                <ul name="selectPublisher" id="selectPublisher"
                                                    class="mt-6 card selectSearch dropdown-menu"
                                                    style="width:-webkit-fill-available; position: absolute"
                                                    aria-labelledby="navbarDropdownMenuLink2">
                                                    <div class="container mr-1 mt-1 ml-1 mb-1">
                                                        <div class="input-group input-group-dynamic">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-search" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                </svg>
                                                            </span>
                                                            <input id="searchPublisher" name="searchPublisher"
                                                                type="text" class="form-control"
                                                                placeholder="Buscar editorial" aria-label="Username"
                                                                aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                    <div id="publisherOptions" name="publisherOptions"></div>
                                                </ul>
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('publisher_id')"></x-input-error>

                                            <!-- Number Of Pages -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>عدد الصفحات</label>
                                                <input name="book_number_pages" id="book_number_pages"
                                                    class="form-control" type="number"
                                                    placeholder="عدد صفحات الكتاب"
                                                    value="{{ app('request')->old('book_number_pages', null) }}"
                                                    style="{{ $errors->has('book_number_pages') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_number_pages')"></x-input-error>

                                            <!-- Publication Date -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>تاريخ النشر</label>
                                                <input name="book_publication_date" id="book_publication_date"
                                                    class="form-control" type="date"
                                                    value="{{ app('request')->old('book_publication_date', null) }}"
                                                    style="{{ $errors->has('book_publication_date') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_publication_date')"></x-input-error>

                                            <!-- Free Sample -->
                                            <div class="container mt-5">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="free_sample"
                                                        id="toggle1" value="1">
                                                    <label class="form-check-label" for="toggle1">معاينة
                                                        مجانية</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="free_sample"
                                                        id="toggle0" value="0">
                                                    <label class="form-check-label" for="toggle0">لا يوجد معاينة
                                                        مجانية</label>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="input-group input-group-static mb-4 mt-md-0 mt-4">
                                                <label>ملخص</label>
                                                <textarea name="book_description" class="form-control" id="book_description" rows="6"
                                                    placeholder="ملخص أو وصف الكتاب"
                                                    style="{{ $errors->has('book_description') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">{{ app('request')->old('book_description', null) }}</textarea>
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_description')"></x-input-error>

                                            <!-- Price (optional) -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>سعر (اختياري)</label>
                                                <input name="book_price" id="book_price" class="form-control"
                                                    type="number" placeholder="سعر الكتاب بدون ضريبة القيمة المضافة"
                                                    value="{{ app('request')->old('book_price', null) }}">
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_price')"></x-input-error>

                                            <!-- Discount -->
                                            <div class="input-group input-group-static mb-4">
                                                <label>تخفيض</label>
                                                <input name="book_discount" id="book_discount" class="form-control"
                                                    type="number" placeholder="أدخل الخصم كنسبة مئوية (0 - 100)%"
                                                    value="{{ app('request')->old('book_discount', null) }}"
                                                    style="{{ $errors->has('book_discount') ? 'box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;' : '' }}">
                                            </div>
                                            <x-input-error class="text-danger" :messages="$errors->get('book_discount')"></x-input-error>

                                            <!-- Image Upload -->
                                            <div class="row">
                                                <div class="card mt-5"
                                                    style="{{ $errors->has('book_image') ? 'box-shadow: 0 0 8px 2px #ff000061;' : 'box-shadow: 0 5px 15px -3px rgb(0 0 0 / 26%), 0 -4px 6px -2px rgb(0 0 0 / 5%) !important;' }}">
                                                    <div class="row">
                                                        <div class="col" style="min-width: 250px">
                                                            <div class="card-body">
                                                                <h4 class="font-weight-normal mt-3">صورة</h4>
                                                                <p class="card-text mb-4">
                                                                    تحميل الصورة بتنسيق .jpg، تأكد من
                                                                    أن الصورة تجتمع أ
                                                                    نسبة العرض إلى الارتفاع 5:7 لضمان ذلك
                                                                    المشاهدة الأمثل.
                                                                </p>
                                                                <x-input-error class="text-danger"
                                                                    :messages="$errors->get('book_image')"></x-input-error>
                                                                <div class="row mt-5">
                                                                    <div class="col-md-4">
                                                                        <a id="falseinput"
                                                                            class="btn btn-outline-warning">تحميل
                                                                            الصور</a>
                                                                    </div>
                                                                    <div class="col" style="align-self: center;">
                                                                        <p id="selected_filename">لم يتم اختيار اي ملف
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mb-4 text-center" style="min-width: 50%">
                                                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                                                                style="background: none;">
                                                                <img id="book_img" class="border-radius-lg w-50"
                                                                    src="" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-static mb-4 mt-4">
                                                <input id="fileinput" name="book_image" type="file"
                                                    accept=".jpg,.jpeg,.png" style="display:none;">
                                            </div>

                                            <!-- PDF Upload (optional) -->
                                            <div class="row">
                                                <div class="card mt-5"
                                                    style="{{ $errors->has('book_pdf') ? 'box-shadow: 0 0 8px 2px #ff000061;' : 'box-shadow: 0 5px 15px -3px rgb(0 0 0 / 26%), 0 -4px 6px -2px rgb(0 0 0 / 5%) !important;' }}">
                                                    <div class="row">
                                                        <div class="col" style="min-width: 250px">
                                                            <div class="card-body">
                                                                <h4 class="font-weight-normal mt-3">ebup</h4>
                                                                <p class="card-text mb-4">تحميل ebup بتنسيق</p>
                                                                <x-input-error class="text-danger"
                                                                    :messages="$errors->get('book_pdf')"></x-input-error>
                                                                <div class="row mt-5">
                                                                    <div class="col-md-4">
                                                                        <a onclick="document.getElementById('pdfinput').click()"
                                                                            class="btn btn-outline-warning">تحميل
                                                                            ebup</a>
                                                                        <p id="pdf_selected">لم يتم اختيار أي ملف</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mb-4 text-center" style="min-width: 50%">
                                                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                                                                style="background: none;">
                                                                <img id="book_pdf" class="border-radius-lg w-50"
                                                                    src="" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-static mb-4 mt-4">
                                                <input id="pdfinput" name="book_pdf" type="file"
                                                    style="display:none;">
                                            </div>
                                            <script>
                                                document.getElementById('pdfinput').addEventListener('change', function() {
                                                    var selectedFile = this.files[0];
                                                    var selectedFilename = selectedFile ? selectedFile.name : 'لم يتم اختيار أي ملف';
                                                    document.getElementById('pdf_selected').innerText = selectedFilename;
                                                });
                                            </script>

                                            <!-- Buttons -->
                                            <div class="row">
                                                <div class="col-sm-6 text-start">
                                                    <a href="{{ route('book.index') }}"
                                                        class="btn bg-gradient-danger mt-3 mb-0"
                                                        style="max-width: 233px; width: -webkit-fill-available;">يلغي</a>
                                                </div>
                                                <div class="col-sm-6 text-end">
                                                    <button type="submit" class="btn bg-gradient-warning mt-3 mb-0"
                                                        style="max-width: 233px;width: -webkit-fill-available;">انشاء</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    </div>
    @include('book.scripts.create')
    <script src="{{ asset('js/plugins/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
