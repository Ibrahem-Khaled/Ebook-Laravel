<!doctype html>
<html lang="es">


<head>
    <title>التجارة الإلكترونية</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>
    <!-- Navbar Transparent -->
    @include('layouts.navigation')
    <!-- End Navbar -->

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


    <div style="" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}"
                    class="btn bg-gradient-faded-secondary" style="max-width: 233px; width: -webkit-fill-available;">
                    <svg style="margin-right: 1rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                    رجوع
                </a>
            </div>
        </div>
        <div class="container">
            <div class="section text-left my-4">
                <div class="row">

                    <div class="col">

                        <h2 class="title">الناشرين</h2>
                    </div>
                    <div class="col" style="text-align: end"><a href="{{ route('publisher.create') }}"
                            class="btn btn-sm btn-warning">إنشاء الناشر</a></div>
                </div>
                @php if (isset($publishers)) {
                        $npublishers = count($publishers);
                } @endphp
                @if ($npublishers > 0)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            الرمز
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            الاسم
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            تم الإنشاء
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            تم التحديث
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($publishers as $publisher)
                                        <tr>
                                            <td class="align-middle text-center ">
                                                <p class=" mb-0">{{ $publisher->id }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $publisher->publisher_name }}</p>
                                            </td>
                                            <td class="align-middle text-center  ">
                                                <p class=" mb-0">{{ $publisher->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <p class=" mb-0">{{ $publisher->updated_at }}</p>
                                            </td>
                                            <td class="align-middle" style="text-align: center;">


                                                <a href="{{ route('publisher.show', $publisher->id) }}"
                                                    class="text-secondary  mx-3 font-weight-normal "
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    عرض
                                                </a>

                                                <a href="{{ route('publisher.edit', $publisher->id) }}"
                                                    class="text-secondary  mx-3 font-weight-normal "
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    تعديل
                                                </a>


                                                <a href="" class="text-secondary font-weight-normal "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteConfirm{{ $publisher->id }}"
                                                    data-toggle="tooltip" data-original-title="Delete user">
                                                    حذف
                                                </a>

                                            </td>
                                            <div class="modal fade" id="deleteConfirm{{ $publisher->id }}"
                                                tabindex="-1" aria-labelledby="deleteConfirm{{ $publisher->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" style="margin-top: 10rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تأكيد
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل أنت متأكد من رغبتك في حذف الناشر
                                                            '{{ $publisher->publisher_name }}'؟
                                                            <br><br>
                                                            هذا الإجراء لا يمكن التراجع عنه وقد يؤثر على جميع الكتب
                                                            التابعة لهذا الناشر.
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn bg-gradient-dark mb-0"
                                                                data-bs-dismiss="modal">إلغاء
                                                            </button>
                                                            <form method="POST"
                                                                action="{{ route('publisher.delete', $publisher->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn bg-gradient-danger mb-0">
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                            {{--                                                    <h3 class="title mt-3">{{$publisher->publisher_name}}</h3> --}}
                            <p class="display-4" style="font-size: x-large"> لا توجد
                                الناشرين.</p>
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

    </div>
    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
