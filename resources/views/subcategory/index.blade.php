<!doctype html>
<html lang="ar">

<head>
    <title>التجارة الإلكترونية</title>
    <!-- الوسوم الضرورية -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     الخطوط والرموز     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- الرموز المادية -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- نمط Material Kit -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.navigation')
    <!-- End Navbar -->

    @foreach ($categories as $category)
        @foreach ($category->subcategories as $subcategory)
            <div class="modal fade" id="deleteConfirm{{ $subcategory->id }}" tabindex="-1"
                aria-labelledby="deleteConfirm{{ $subcategory->id }}" aria-hidden="true">
                <div class="modal-dialog" style="margin-top: 10rem;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                تأكيد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            هل أنت متأكد أنك تريد حذف الفئة الفرعية
                            '{{ $subcategory->subcategory_name }}
                            ' المرتبطة بالفئة {{ $category->category_name }}
                            ؟
                            <br><br>
                            هذا الإجراء لا يمكن التراجع عنه وقد يؤثر على جميع
                            الكتب المرتبطة بهذه الفئة الفرعية.
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">
                                إلغاء
                            </button>
                            <form method="POST" action="{{ route('subcategory.delete', $subcategory->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-gradient-danger mb-0">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

    <!-- Estilos para mostrar las alertas con un toque mas suave -->
    <style>
        .mostrar {
            display: block;
            opacity: 1;
        }

        .ocultar {
            opacity: 0;
            pointer-events: none;
        }

        .row-hover:hover {
            background-color: #f8f9fa;
        }
    </style>

    @if ($message = Session::get('success'))
        <script>
            // Función para mostrar la alerta y ocultarla después de cierto tiempo
            function mostrarAlerta() {
                var alerta = document.getElementById('alert');
                alerta.style.display = 'block';

                // Ocultar la alerta después de 5 segundos (5000 milisegundos)
                setTimeout(function() {
                    alerta.style.display = 'none';
                }, 3000);
            }

            // Llama a la función para mostrar la alerta
            mostrarAlerta();
        </script>
        <div class="container"
            style="max-width: initial;
    padding: unset;
    position: fixed;
    margin-top: 8rem;
    z-index: 1;
}">
            <div id="alert" class="alert blur alert-success text-white font-weight-bold" role="alert"
                style="transition: opacity 0.5s ease-in-out;;box-shadow: none;background-image: initial;margin: 0px 10% 10% 10%; position: absolute;
             backdrop-filter: saturate(0%) blur(4px) !important; background-color: rgb(7 255 0 / 15%) !important;   width: -webkit-fill-available;
             z-index: 1;">
                {{ $message }}
            </div>
        </div>
        <script>
            function mostrarAlerta() {
                var alerta = document.getElementById('alert');


                setTimeout(function() {
                    alerta.classList.add('ocultar');
                }, 3000);


            }

            mostrarAlerta();
        </script>
    @endif

    @if ($message = Session::get('danger'))
        <div class="container"
            style="max-width: initial;
    padding: unset;
    position: fixed;
    margin-top: 8rem;
    z-index: 1;
}">
            <div id="alert" class="alert blur alert-danger text-white font-weight-bold" role="alert"
                style="transition: opacity 0.5s ease-in-out;box-shadow: none;background-image: initial;margin: 0px 10% 10% 10%; position: absolute;    width: -webkit-fill-available;backdrop-filter: saturate(0%) blur(4px) !important;
    background-color: rgb(7 255 0 / 15%) !important;    z-index: 1;">
                {{ $message }}
            </div>
        </div>
        <script>
            function mostrarAlerta() {
                var alerta = document.getElementById('alert');

                setTimeout(function() {
                    alerta.classList.add('ocultar');
                }, 3000);

            }

            mostrarAlerta();
        </script>
    @endif

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px">
        {{--        <span class="mask bg-gradient-dark opacity-6"></span> --}}
    </div>

    <style>
        .btn-secondary :hover {
            box-shadow: 0 14px 26px -12px rgba(0, 0, 0, 0.4), 0 4px 23px 0 rgba(0, 0, 0, 0.15), 0 8px 10px -5px rgba(0, 0, 0, 0.2) !important;
        }
    </style>

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
                    </svg>Volver
                </a>
            </div>
        </div>
        <div class="container">
            <div class="section text-left my-4">
                <div class="row">

                    <div class="col">

                        <h2 class="title">الفئات الفرعية</h2>
                    </div>
                    <div class="col" style="text-align: end; max-width: fit-content;">
                        @if (count($categories) > 0)
                            <a href="{{ route('subcategory.create') }}" class="btn btn-sm btn-warning">إنشاء
                                فئة فرعية</a>
                        @else
                            <a type="button" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="من الضروري أولاً إنشاء فئة واحدة على الأقل"
                                data-container="body" data-animation="true"
                                style="box-shadow: 0 3px 3px 0 rgb(0 0 0 / 15%), 0 3px 1px -2px rgb(146 146 146 / 20%), 0 1px 5px 0 rgb(0 0 0 / 15%); cursor: not-allowed !important;">إنشاء
                                فئة فرعية</a>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col mx-3">
                        <div class="accordion" id="accordionRental">

                            @forelse($categories as $category)

                                <div class="accordion-item mb-3">
                                    <h5 class="accordion-header" id="heading{{ $category->id }}">
                                        <button class="accordion-button border-bottom font-weight-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $category->id }}">
                                            <div class="row" style="display: contents">
                                                <div class="col-6">
                                                    {{ $category->category_name }}
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="هذه الفئة الفرعية تحتوي على {{ count($category->subcategories) }} فئات فرعية مرتبطة"
                                                        class="badge bg-gradient-warning">{{ count($category->subcategories) }}</span>
                                                </div>
                                            </div>

                                            <i class="collapse-close expand_more text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>


                                            <i class="collapse-open text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                        </button>
                                    </h5>
                                    <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $category->id }}"
                                        data-bs-parent="#accordionRental" style="">
                                        <div class="accordion-body text-sm opacity-8">
                                            @if (count($category->subcategories) > 0)
                                                <hr class="horizontal dark my-auto">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card">
                                                            <div class="table-responsive">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th
                                                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                                                الرمز
                                                                            </th>
                                                                            <th
                                                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                                                الاسم
                                                                            </th>
                                                                            <th
                                                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                                                تم الإنشاء
                                                                            </th>
                                                                            <th
                                                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                                                تم التحديث
                                                                            </th>
                                                                            <th class="text-secondary opacity-7"></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($category->subcategories as $subcategory)
                                                                            <tr>
                                                                                <td class="align-middle text-center">
                                                                                    <p class="mb-0">
                                                                                        {{ $subcategory->id }}</p>
                                                                                </td>
                                                                                <td>
                                                                                    <p class="mb-0">
                                                                                        {{ $subcategory->subcategory_name }}
                                                                                    </p>
                                                                                </td>
                                                                                <td
                                                                                    class="align-middle text-center text-sm">
                                                                                    <p class="mb-0">
                                                                                        {{ $subcategory->created_at }}
                                                                                    </p>
                                                                                </td>
                                                                                <td
                                                                                    class="align-middle text-center text-sm">
                                                                                    <p class="mb-0">
                                                                                        {{ $subcategory->updated_at }}
                                                                                    </p>
                                                                                </td>
                                                                                <td class="align-middle"
                                                                                    style="text-align: center;">


                                                                                    <a href="{{ route('subcategory.show', $subcategory->id) }}"
                                                                                        class="text-secondary mx-3 font-weight-normal"
                                                                                        data-original-title="Edit user">
                                                                                        عرض
                                                                                    </a>

                                                                                    <a href="{{ route('subcategory.edit', $subcategory->id) }}"
                                                                                        class="text-secondary mx-3 font-weight-normal"
                                                                                        data-original-title="Edit user">
                                                                                        تحرير
                                                                                    </a>


                                                                                    <a href=""
                                                                                        class="text-secondary font-weight-normal"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#deleteConfirm{{ $subcategory->id }}"
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="Delete user">
                                                                                        حذف
                                                                                    </a>

                                                                                </td>

                                                                            </tr>
                                                                        @endforeach


                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col">
                                                        {{--                                                    <h3 class="title mt-3">{{$category->category_name}}</h3> --}}
                                                        <p class="display-4" style="font-size: x-large"> لا توجد
                                                            فئات فرعية لهذه الفئة.</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col">
                                        {{--                                                    <h3 class="title mt-3">{{$category->category_name}}</h3> --}}
                                        <p class="display-4" style="font-size: x-large"> لا توجد
                                            فئات.</p>
                                    </div>
                                </div>
                            @endforelse


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </footer>
    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
    {{--    <script> --}}
    {{--        $('.modal-dialog').parent().on('show.bs.modal', function(e){        $(e.relatedTarget.attributes['data-target'].value).appendTo('body'); }) --}}
    {{--    </script> --}}
</body>

</html>
