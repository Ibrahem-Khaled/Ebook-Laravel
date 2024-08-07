<!doctype html>
<html lang="es">

<head>
    <title>تعديل الكتاب</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />


    {{--    Jquery --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>


</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.navigation')
    <!-- End Navbar -->

    {{-- TODO: Organize this styles later --}}
    <style>
        .listbox {
            margin-top: 10px !important;
        }


        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }


        input[type=date]::-webkit-inner-spin-button,
        input[type=date]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=date] {
            -moz-appearance: textfield;
        }

        .selectSearch {
            display: none;
        }

        .show {
            display: block;
        }

        input::file-selector-button {
            padding: 7px 7px 7px 7px !important;
            background-color: lightgray !important;
            border-radius: 10px;
            !important
        }
    </style>

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{--        <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>

    <div style="" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('book.index') }}"
                    class="btn bg-gradient-faded-secondary"
                    style="max-width: 233px; width: -webkit-fill-available;"><svg style="margin-right: 1rem"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>يعود
                </a>
            </div>
        </div>
        <div class="container">
            <div class="section text-left my-4">

                <h2 class="title">تحرير الكتاب</h2>

                <div class="card">

                    <div class="card d-flex justify-content-center p-4 shadow-lg">
                        <form role="form" id="contact-form" method="POST" autocomplete="off"
                            action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body pb-2">
                                <div class="row">

                                    {{-- ISBN code --}}
                                    <div class="input-group input-group-static mb-4 mt-4">
                                        <label>شفرة ISBN</label>
                                        @if (count($errors->get('book_isbn')) >= 1)
                                            <input name="book_isbn" id="book_isbn" class="form-control" type="text"
                                                placeholder="Escanear o digitar el codigo ISN"
                                                style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                autofocus value="{{ $book->book_isbn }}">
                                        @else
                                            <input name="book_isbn" id="book_isbn" class="form-control" type="text"
                                                placeholder="escanear o digitar el codigo ISBN" autofocus
                                                value="{{ $book->book_isbn }}">
                                        @endif

                                        <span class="input-group-text" style="right: 18px"> <svg
                                                xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                            </svg></span>
                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('book_isbn')"></x-input-error>

                                    {{-- Category select --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>فئة</label>
                                        @if (count($errors->get('category_id')) >= 1)
                                            <select name="category_id" id="category_id" class="form-control"
                                                style="box-shadow: 0 0 8px 2px #ff000061;">
                                                <option selected value="{{ $category->id }}">
                                                    {{ $category->category_name }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option selected value="{{ $category->id }}">
                                                    {{ $category->category_name }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('category_id')"></x-input-error>

                                    {{-- Subcategory select --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>تصنيف فرعي</label>
                                        @if (count($errors->get('subcategory_id')) >= 1)
                                            <select name="subcategory_id" id="subcategory_id" class="form-control"
                                                style="box-shadow: 0 0 8px 2px #ff000061;">
                                                <option selected value="{{ $subcategory->id }}">
                                                    {{ $subcategory->subcategory_name }}</option>
                                            </select>
                                        @else
                                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                                <option selected value="{{ $subcategory->id }}">
                                                    {{ $subcategory->subcategory_name }}</option>
                                            </select>
                                        @endif

                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('subcategory_id')"></x-input-error>

                                    {{-- Title --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>عنوان</label>
                                        @if (count($errors->get('book_title')) >= 1)
                                            <input name="book_title" id="book_title" class="form-control"
                                                style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                type="text" placeholder="Nombre del libro"
                                                value="{{ $book->book_title }}">
                                        @else
                                            <input name="book_title" id="book_title" class="form-control"
                                                type="text" placeholder="Nombre del libro"
                                                value="{{ $book->book_title }}">
                                        @endif
                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('book_title')"></x-input-error>

                                    {{-- Author --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>مؤلف</label>
                                        @if (count($errors->get('author_id')) >= 1)
                                            <input readonly="readonly" name="author_name" id="author_name"
                                                style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                placeholder="حدد مؤلفًا" class="form-control"
                                                value="{{ $author->author_name }}" />
                                        @else
                                            <input readonly="readonly" name="author_name" id="author_name"
                                                placeholder="حدد مؤلفًا" class="form-control"
                                                value="{{ $author->author_name }}" />
                                        @endif
                                        <input name="author_id" id="author_id" value="{{ $author->id }}" hidden>

                                        <ul name="selectAuthor" id="selectAuthor"
                                            style="width:-webkit-fill-available; position: absolute"
                                            class="mt-6 card selectSearch dropdown-menu"
                                            aria-labelledby="navbarDropdownMenuLink2">

                                            <div class="container mr-1 mt-1 ml-1 mb-1">
                                                <div class="input-group input-group-dynamic">
                                                    <span class="input-group-text" id="basic-addon1"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-search"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                        </svg></span>
                                                    <input id="searchAuthor" name="searchAuthor" type="text"
                                                        class="form-control" placeholder="Buscar autor"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div id="authorOptions" name="authorOptions">

                                            </div>
                                        </ul>

                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('author_id')"></x-input-error>

                                    {{-- Publisher --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>افتتاحية</label>
                                        @if (count($errors->get('publisher_id')) >= 1)
                                            <input value="{{ $publisher->publisher_name }}" readonly="readonly"
                                                name="publisher_name" id="publisher_name"
                                                style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                placeholder="Seleccione una editorial" class="form-control" />
                                        @else
                                            <input value="{{ $publisher->publisher_name }}" readonly="readonly"
                                                name="publisher_name" id="publisher_name"
                                                placeholder="Seleccione una editorial" class="form-control" />
                                        @endif
                                        <input name="publisher_id" id="publisher_id" value="{{ $publisher->id }}"
                                            hidden>

                                        <ul name="selectPublisher" id="selectPublisher"
                                            style="width:-webkit-fill-available; position: absolute"
                                            class="mt-6 card selectSearch dropdown-menu"
                                            aria-labelledby="navbarDropdownMenuLink2">

                                            <div class="container mr-1 mt-1 ml-1 mb-1">
                                                <div class="input-group input-group-dynamic">
                                                    <span class="input-group-text" id="basic-addon1"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-search"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                        </svg></span>
                                                    <input id="searchPublisher" name="searchPublisher" type="text"
                                                        class="form-control" placeholder="Buscar editorial"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div id="publisherOptions" name="publisherOptions">

                                            </div>
                                        </ul>

                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('publisher_id')"></x-input-error>


                                    <div class="container mt-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="free_sample"
                                                id="toggle1" value="1">
                                            <label class="form-check-label" for="toggle1">معاينة مجانية</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="free_sample"
                                                id="toggle0" value="0">
                                            <label class="form-check-label" for="toggle0">لا يوجد معاينة
                                                مجانية</label>
                                        </div>
                                    </div>


                                    {{-- Number Of Pages --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>عدد الصفحات</label>
                                        @if (count($errors->get('book_number_pages')) >= 1)
                                            <input name="book_number_pages" id="book_number_pages"
                                                class="form-control"
                                                style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                type="number" placeholder="Numero de paginas del libro"
                                                value="{{ $book->book_number_pages }}">
                                        @else
                                            <input name="book_number_pages" id="book_number_pages"
                                                class="form-control" type="number"
                                                placeholder="Numero de paginas del libro"
                                                value="{{ $book->book_number_pages }}">
                                        @endif

                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('book_number_pages')"></x-input-error>

                                    {{-- Publication Date --}}
                                    <div class="input-group input-group-static mb-4">
                                        <label>تاريخ النشر</label>
                                        @if (count($errors->get('book_publication_date')) >= 1)
                                            <input name="book_publication_date" id="book_publication_date"
                                                class="form-control" type="date"
                                                style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                                value="{{ $book->book_publication_date }}">
                                        @else
                                            <input name="book_publication_date" id="book_publication_date"
                                                class="form-control" type="date"
                                                value="{{ $book->book_publication_date }}">
                                        @endif
                                    </div>
                                    <x-input-error class="text-danger" :messages="$errors->get('book_publication_date')"></x-input-error>
                                </div>

                                {{-- Description --}}
                                <div class="input-group input-group-static mb-4 mt-md-0 mt-4">
                                    <label>ملخص</label>
                                    @if (count($errors->get('book_description')) >= 1)
                                        <textarea name="book_description" class="form-control" id="book_description" rows="6"
                                            placeholder="Resumen o descripcion del libro"
                                            style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;">{{ $book->book_description }}</textarea>
                                    @else
                                        <textarea name="book_description" class="form-control" id="book_description" rows="6"
                                            placeholder="Resumen o descripcion del libro">{{ $book->book_description }}</textarea>
                                    @endif
                                </div>
                                <x-input-error class="text-danger" :messages="$errors->get('book_description')"></x-input-error>

                                {{-- Price --}}
                                <div class="input-group input-group-static mb-4">
                                    <label>سعر</label>
                                    @if (count($errors->get('book_price')) >= 1)
                                        <input name="book_price" id="book_price" class="form-control"
                                            style="box-shadow: 0 0 8px 2px #ff000061; border-radius: 10px !important;"
                                            type="number" placeholder="Precio del libro sin iva"
                                            value="{{ $book->book_price }}">
                                    @else
                                        <input name="book_price" id="book_price" class="form-control" type="number"
                                            placeholder="Precio del libro sin iva" value="{{ $book->book_price }}">
                                    @endif
                                </div>
                                <x-input-error class="text-danger" :messages="$errors->get('book_price')"></x-input-error>

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

                                {{-- image display --}}
                                <div class="row">
                                    <div class="card mt-5" <?php if (count($errors->get('book_image')) >= 1) {
                                        echo "style='box-shadow: 0 0 8px 2px #ff000061;'";
                                    } else {
                                        echo "style='box-shadow: 0 5px 15px -3px rgb(0 0 0 / 26%), 0 -4px 6px -2px rgb(0 0 0 / 5%) !important;'";
                                    } ?>>
                                        <div class="row">
                                            <!-- Card body -->
                                            <div class="col" style="min-width: 250px">
                                                <div class="card-body">
                                                    <h4 class="font-weight-normal mt-3">صورة</h4>
                                                    <p class="card-text mb-4">
                                                        قم بإرسال الصورة بصيغة .jpg، تأكد
                                                        من الصورة الكاملة مع واحدة
                                                        نسبة العرض إلى الارتفاع 5:7 لضمان الرؤية
                                                        أوبتيما.
                                                    </p>
                                                    <x-input-error class="text-danger"
                                                        :messages="$errors->get('book_image')"></x-input-error>
                                                    <div class="row mt-5">
                                                        <div class="col-md-4">

                                                            <a id="falseinput" class="btn btn-outline-warning">اختار
                                                                صورة</a>
                                                        </div>
                                                        <div class="col" style="align-self: center;">

                                                            <p id="selected_filename">لم يتم اختيار اي ملف</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Card image -->
                                            <div class="col mb-4 text-center" style="min-width: 50%">
                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                                                    style="background: none;">
                                                    <img id="book_img" class="border-radius-lg w-50"
                                                        src="{{ asset($book->book_image_url) }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- image input --}}
                                <div class="input-group input-group-static mb-4 mt-4">
                                    <input id="fileinput" name="book_image" type="file" accept=".jpg,.jpeg,.png"
                                        style="display:none;">
                                </div>

                                <div class="row">
                                    <div class="card mt-5"
                                        @if (count($errors->get('book_pdf')) >= 1) style='box-shadow: 0 0 8px 2px #ff000061;'
                                    @else
                                        style='box-shadow: 0 5px 15px -3px rgb(0 0 0 / 26%), 0 -4px 6px -2px rgb(0 0 0 / 5%) !important;' @endif>
                                        <div class="row">
                                            <!-- Card body -->
                                            <div class="col" style="min-width: 250px">
                                                <div class="card-body">
                                                    <h4 class="font-weight-normal mt-3">ebup</h4>
                                                    <p class="card-text mb-4">
                                                        تحميل ebup بتنسيق
                                                    </p>
                                                    <x-input-error class="text-danger"
                                                        :messages="$errors->get('book_pdf')"></x-input-error>
                                                    <div class="row mt-5">
                                                        <div class="col-md-4">
                                                            <!-- Trigger file input -->
                                                            <a onclick="document.getElementById('pdfinput').click()"
                                                                class="btn btn-outline-warning">تحميل ebup</a>
                                                            <!-- Display selected filename -->
                                                            <p id="pdf_selected">لم يتم اختيار أي ملف</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Card image -->
                                            <div class="col mb-4 text-center" style="min-width: 50%">
                                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                                                    style="background: none;">
                                                    <!-- Display uploaded PDF image -->
                                                    <img id="book_pdf" class="border-radius-lg w-50" src=""
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PDF file input -->
                                <div class="input-group input-group-static mb-4 mt-4">
                                    <input id="pdfinput" name="book_pdf" type="file" style="display:none;">
                                </div>

                                <script>
                                    // Update selected filename when a file is selected
                                    document.getElementById('pdfinput').addEventListener('change', function() {
                                        var selectedFile = this.files[0];
                                        var selectedFilename = selectedFile ? selectedFile.name : 'لم يتم اختيار أي ملف';
                                        document.getElementById('pdf_selected').innerText = selectedFilename;
                                    });
                                </script>

                                {{-- Buttons --}}
                                <div class="row">
                                    <div class="col-sm-6 text-start">
                                        <a href="{{ route('book.index') }}" class="btn bg-gradient-danger mt-3 mb-0"
                                            style="max-width: 233px; width: -webkit-fill-available;">Cancelar
                                        </a>
                                    </div>

                                    <div class="col-sm-6 text-end">
                                        <button type="submit" class="btn bg-gradient-warning mt-3 mb-0"
                                            style="max-width: 233px;width: -webkit-fill-available;">Guardar
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


    @include('book.scripts.edit')

    <script src="{{ asset('js/plugins/flatpickr.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
