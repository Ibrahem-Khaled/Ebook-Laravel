<!doctype html>
<!--suppress ALL -->
<html lang="es" id="html" class="loading">


<head>
    <title>Home Ecommerce Example</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons   -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Material Kit CSS -->
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
</head>

<body class="loading">

    <div class="container flex justify-content-center position-relative overflow-hidden w-10">

        <div id="spin" class='spinner'></div>
    </div>
    <div id='load' class="loading">
        @include('layouts.navigation_txt_dark')
        <!-- Main Body -->

        <div class="card card-body shadow-xl mx-3 mx-md-4" style="margin-top: 2rem">
            <section class="py-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="mb-2 text-center">Our Products</h1>
                        <p class="mb-0 text-center" style="font-size: 20px">Latest arrivals</p>
                    </div>
                </div>
                <div id="latestProducts" class="product-horizontal-slider">
                    <div class="row flex-nowrap rowProducts" style="max-width: 210px; position: relative;">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="card mb-5 mt-2 mx-3 shadow-lg">
                                <div class="card-header p-0 position-relative mx-3 mt-3 z-index-2 shadow-xl">
                                    <a class="d-block blur-shadow-image" href="#">
                                        <img loading='eager' src="https://picsum.photos/id/{{ $i }}/200/300"
                                            alt="img-blur-shadow" class="img-fluid border-radius-lg">
                                    </a>
                                    <div class="colored-shadow"
                                        style="background-image: url('https://picsum.photos/id/{{ $i }}/200/300');">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0 text-warning text-uppercase font-weight-normal text-sm">category
                                        {{ $i }}</p>
                                    <h5 class="font-weight-bold mt-3">
                                        <a class="link-dark" href="#">Product {{ $i }}</a>
                                    </h5>
                                    <p class="mb-0 text-left">
                                        Author {{ $i }}
                                    </p>
                                </div>
                                <div class="card-footer d-flex pt-0" style="padding-right: 0">
                                    <div class="row w-100">
                                        <div class="col">
                                            <p class="font-weight-normal my-auto">
                                                $ {{ rand(10, 100) }}.00</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endfor

                    </div>
                </div>

                <div class="row">
                    <div class="row mt-4"
                        style="width: 100%;  padding-right: 0;  margin-left: -1%;  margin-right: 0px; justify-content: center">


                    </div>

                </div>
            </section>
        </div>
    </div>

    {{-- WARNING: //////////////////////////////////////////////// Be careful when changing the order of the following scripts //////////////////////////////////////////////// --}}

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script> {{-- Important --}}
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>

</body>

</html>
