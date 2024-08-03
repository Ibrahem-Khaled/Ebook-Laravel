<!doctype html>
<html lang="ar">

<head>
    <title>إنشاء كتاب</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
</head>

<body>
    @include('layouts.navigation')
    @include('book.styles.create')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px"></div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="container">
            <div class="section text-left my-4">
                <a href="{{ route('book.index') }}" class="text-warning text-sm icon-move-left">الرجوع</a>
                <h2 class="title">إنشاء كتاب</h2>
                <div class="card">
                    <div class="card-body p-4 shadow-lg">

                        <form method="POST" action="{{ route('book.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- ISBN -->
                                <div class="input-group input-group-static mb-4">
                                    <label>رمز العالمي</label>
                                    <input name="book_isbn" id="book_isbn" class="form-control" type="text"
                                        placeholder="قم بمسح أو إدخال رمز ISN" value="{{ old('book_isbn') }}">
                                    <span class="input-group-text"><i class="material-icons">barcode</i></span>
                                    <x-input-error class="text-danger" :messages="$errors->get('book_isbn')"></x-input-error>
                                </div>

                                <!-- Category -->
                                <div class="input-group input-group-static mb-4">
                                    <label>الفئة</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option selected disabled hidden value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="text-danger" :messages="$errors->get('category_id')"></x-input-error>
                                </div>

                                <!-- Subcategory -->
                                <div class="input-group input-group-static mb-4">
                                    <label>الفئة الفرعية</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control"></select>
                                    <x-input-error class="text-danger" :messages="$errors->get('subcategory_id')"></x-input-error>
                                </div>

                                <!-- Title -->
                                <div class="input-group input-group-static mb-4">
                                    <label>العنوان</label>
                                    <input name="book_title" id="book_title" class="form-control" type="text"
                                        placeholder="اسم الكتاب" value="{{ old('book_title') }}">
                                    <x-input-error class="text-danger" :messages="$errors->get('book_title')"></x-input-error>
                                </div>

                                <!-- Author -->
                                <div class="input-group input-group-static mb-4">
                                    <label>الناشر</label>
                                    <input readonly="readonly" name="author_name" id="author_name" class="form-control"
                                        placeholder="اختر الناشر">
                                    <input name="author_id" id="author_id" hidden>
                                    <ul id="selectAuthor" class="dropdown-menu mt-6 card selectSearch">
                                        <div class="container">
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="material-icons">search</i></span>
                                                <input id="searchAuthor" name="searchAuthor" type="text"
                                                    class="form-control" placeholder="Buscar autor">
                                            </div>
                                            <div id="authorOptions"></div>
                                        </div>
                                    </ul>
                                    <x-input-error class="text-danger" :messages="$errors->get('author_id')"></x-input-error>
                                </div>

                                <!-- Publisher -->
                                <div class="input-group input-group-static mb-4">
                                    <label>ناشر للكتاب</label>
                                    <input readonly="readonly" name="publisher_name" id="publisher_name"
                                        class="form-control" placeholder="اختر ناشرًا">
                                    <input name="publisher_id" id="publisher_id" hidden>
                                    <ul id="selectPublisher" class="dropdown-menu mt-6 card selectSearch">
                                        <div class="container">
                                            <div class="input-group">
                                                <span class="input-group-text"><i
                                                        class="material-icons">search</i></span>
                                                <input id="searchPublisher" name="searchPublisher" type="text"
                                                    class="form-control" placeholder="Buscar editorial">
                                            </div>
                                            <div id="publisherOptions"></div>
                                        </div>
                                    </ul>
                                    <x-input-error class="text-danger" :messages="$errors->get('publisher_id')"></x-input-error>
                                </div>

                                <!-- Number Of Pages -->
                                <div class="input-group input-group-static mb-4">
                                    <label>عدد الصفحات</label>
                                    <input name="book_number_pages" id="book_number_pages" class="form-control"
                                        type="number" placeholder="عدد صفحات الكتاب"
                                        value="{{ old('book_number_pages') }}">
                                    <x-input-error class="text-danger" :messages="$errors->get('book_number_pages')"></x-input-error>
                                </div>

                                <!-- Publication Date -->
                                <div class="input-group input-group-static mb-4">
                                    <label>تاريخ النشر</label>
                                    <input name="book_publication_date" id="book_publication_date"
                                        class="form-control" type="date"
                                        value="{{ old('book_publication_date') }}">
                                    <x-input-error class="text-danger" :messages="$errors->get('book_publication_date')"></x-input-error>
                                </div>

                                <!-- Free Sample -->
                                <div class="container mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="free_sample"
                                            id="toggle1" value="1">
                                        <label class="form-check-label" for="toggle1">معاينة مجانية</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="free_sample"
                                            id="toggle0" value="0">
                                        <label class="form-check-label" for="toggle0">لا يوجد معاينة مجانية</label>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="input-group input-group-static mb-4 mt-4">
                                    <label>ملخص</label>
                                    <textarea name="book_description" class="form-control" id="book_description" rows="6"
                                        placeholder="ملخص أو وصف الكتاب">{{ old('book_description') }}</textarea>
                                    <x-input-error class="text-danger" :messages="$errors->get('book_description')"></x-input-error>
                                </div>

                                <!-- Price -->
                                <div class="input-group input-group-static mb-4">
                                    <label>سعر (اختياري)</label>
                                    <input name="book_price" id="book_price" class="form-control" type="number"
                                        placeholder="سعر الكتاب بدون ضريبة القيمة المضافة"
                                        value="{{ old('book_price') }}">
                                    <x-input-error class="text-danger" :messages="$errors->get('book_price')"></x-input-error>
                                </div>

                                <!-- Discount -->
                                <div class="input-group input-group-static mb-4">
                                    <label>تخفيض</label>
                                    <input name="book_discount" id="book_discount" class="form-control"
                                        type="number" placeholder="أدخل الخصم كنسبة مئوية (0 - 100)%"
                                        value="{{ old('book_discount') }}">
                                    <x-input-error class="text-danger" :messages="$errors->get('book_discount')"></x-input-error>
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label>اضافة مترجم </label>
                                    <select name="author_id_2" id="author_id_2" class="form-control"
                                        value="{{ old('author_id_2') }}">
                                        <option selected disabled>اختر مترجم</option>
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->author_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group input-group-static mb-4">
                                    <label>اضافة رابط نسخة ورقية</label>
                                    <input name="paper_url" id="paper_url" class="form-control" type="url"
                                        placeholder="رابط نسخة ورقية الكتاب" value="{{ old('paper_url') }}">
                                </div>

                                <!-- Image Upload -->
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <div class="card shadow-lg">
                                            <div class="card-body">
                                                <h4 class="font-weight-normal mt-3">صورة</h4>
                                                <p class="card-text">تحميل الصورة بتنسيق .jpg</p>
                                                <x-input-error class="text-danger" :messages="$errors->get('book_image')"></x-input-error>
                                                <input name="book_image" type="file" accept=".jpg,.jpeg,.png">
                                            </div>

                                            <!-- PDF Upload (optional) -->
                                            <div class="col-md-6">
                                                <div class="card shadow-lg">
                                                    <div class="card-body">
                                                        <h4 class="font-weight-normal mt-3">ebup</h4>
                                                        <p class="card-text">تحميل ebup بتنسيق</p>
                                                        <x-input-error class="text-danger"
                                                            :messages="$errors->get('book_pdf')"></x-input-error>
                                                        <input id="pdfinput" name="book_pdf" type="file">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="row mt-5">
                                            <div class="col-sm-6">
                                                <a href="{{ route('book.index') }}"
                                                    class="btn bg-gradient-danger w-100">إلغاء</a>
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <button type="submit"
                                                    class="btn bg-gradient-warning w-100">إنشاء</button>
                                            </div>
                                        </div>
                                    </div>
                        </form>
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
