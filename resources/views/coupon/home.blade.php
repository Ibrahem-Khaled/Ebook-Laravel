<!doctype html>
<html lang="ar">


<head>
    <title>اكواد الخصم</title>
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
                    <div class="col" style="text-align: end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#createCouponModal">
                            إنشاء كود خصم
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="createCouponModal" tabindex="-1"
                        aria-labelledby="createCouponModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createCouponModalLabel">إنشاء كود خصم</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <!-- Add your form or content for creating coupon here -->
                                    <!-- Example form: -->
                                    <form action="{{ route('coupon.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="count">عدد الاكواد</label>
                                            <input type="number" class="form-control" id="count" name="count"
                                                required min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label for="book_id">اختر الكتاب:</label>
                                            <select class="form-select" id="book_id" name="book_id" required>
                                                <option value="" selected disabled>اختر الكتاب</option>
                                                @foreach ($books as $book)
                                                    <option value="{{ $book->id }}">{{ $book->book_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="discount">الخصم:</label>
                                            <input type="number" class="form-control" id="discount" name="discount"
                                                required min="0">
                                        </div>
                                        <button type="submit" class="btn btn-primary">إنشاء</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    if (isset($coupons)) {
                        $ncoupons = count($coupons);
                } @endphp
                @if ($ncoupons > 0)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            id
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            الكود
                                        </th>
                                        <th
                                            class="text-center  text-uppercase text-secondary  font-weight-bolder opacity-7">
                                            اسم الكتاب التابع له
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
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td class="align-middle text-center ">
                                                <p class=" mb-0">{{ $coupon->id }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $coupon->code }}</p>
                                            </td>
                                            <td>
                                                <p class=" mb-0">{{ $coupon->book->book_title }}</p>
                                            </td>
                                            <td class="align-middle text-center  ">
                                                <p class=" mb-0">{{ $coupon->created_at }}</p>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <p class=" mb-0">{{ $coupon->updated_at }}</p>
                                            </td>
                                            <td class="align-middle" style="text-align: center;">


                                                <a href="{{ route('category.show', $coupon->id) }}"
                                                    class="text-secondary  mx-3 font-weight-normal "
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    عرض
                                                </a>

                                                <a href="{{ route('category.edit', $coupon->id) }}"
                                                    class="text-secondary  mx-3 font-weight-normal "
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    تحرير
                                                </a>


                                                <a href="" class="text-secondary font-weight-normal "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteConfirm{{ $coupon->id }}"
                                                    data-toggle="tooltip" data-original-title="Delete user">
                                                    حذف
                                                </a>

                                            </td>
                                            <div class="modal fade" id="deleteConfirm{{ $coupon->id }}"
                                                tabindex="-1" aria-labelledby="deleteConfirm{{ $coupon->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" style="margin-top: 10rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل أنت متأكد أنك تريد حذف الفئة
                                                            '{{ $coupon->category_name }}' ؟
                                                            <br><br>
                                                            هذا الإجراء لا يمكن التراجع عنه وقد يؤثر على جميع الكتب
                                                            المرتبطة بهذه الفئة.
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn bg-gradient-dark mb-0"
                                                                data-bs-dismiss="modal">إلغاء
                                                            </button>
                                                            <form method="POST"
                                                                action="{{ route('category.delete', $coupon->id) }}">
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
                            <p class="display-4" style="font-size: x-large">لا توجد
                                اكواد خصم.</p>
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
