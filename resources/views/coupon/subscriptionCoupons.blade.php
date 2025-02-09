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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
</head>

<body>
    <!-- شريط التنقل الشفاف -->
    @include('layouts.navigation')
    <!-- نهاية شريط التنقل -->

    @include('layouts.alerts')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px"></div>

    <div style="" class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <form action="{{ route('subscription.coupons', Route::current()->parameter('id')) }}" method="GET"
                class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="query" placeholder="ابحث عن code">
                    <button class="btn btn-primary" type="submit">بحث</button>
                </div>
            </form>

            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}"
                    class="btn bg-gradient-faded-secondary" style="max-width: 233px; width: -webkit-fill-available;">
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
                <button class="btn btn-sm btn-warning" onclick="exportToExcel()">استخراج الاكواد في ملف اكسيل</button>
                <form action="{{ route('coupons.delete') }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    @if (Auth::user()->role->role_name == 'admin')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('هل أنت متأكد من حذف الأكواد المحددة؟')">حذف الأكواد
                            المحددة</button>
                    @endif
                    @php
                        $ncoupons = count($coupons);
                    @endphp
                    @if ($ncoupons > 0)
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll()">
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                code
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                نسبة الخصم
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                اسم الاشتراك
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                من الذي استخدم الكود
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                بريد الذي استخدم الكود
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                تم الإنشاء
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                                هل هو مستخدم
                                            </th>
                                            {{-- <th class="text-secondary opacity-7"></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="coupons[]" value="{{ $coupon->id }}">
                                                </td>
                                                <td class="align-middle text-center ">
                                                    <p class="mb-0">{{ $coupon->code }}</p>
                                                </td>
                                                <td class="align-middle text-center ">
                                                    <p class="mb-0">{{ $coupon->discount }} %</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0">{{ $coupon->subscription->title }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0">{{ $coupon->user?->name }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0">{{ $coupon->user?->email }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <p class="mb-0">{{ $coupon->created_at }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($coupon->updated_at == $coupon->created_at)
                                                        <p class="mb-0">غير مستخدم</p>
                                                    @else
                                                        <p class="mb-0">مستخدم</p>
                                                        <p class="mb-0">{{ $coupon->updated_at }}</p>
                                                    @endif
                                                </td>
                                                {{-- <td class="align-middle" style="text-align: center;">
                                                    <a href="{{ route('subscription.coupon.details', $coupon->id) }}"
                                                        class="text-secondary mx-3 font-weight-normal "
                                                        data-toggle="tooltip" data-original-title="عرض">
                                                        عرض
                                                    </a>
                                                </td> --}}
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
                                <p class="display-4" style="font-size: x-large">لا توجد اكواد خصم.</p>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

        </div>
    </div>
    <script>
        function exportToExcel() {
            var wb = XLSX.utils.table_to_book(document.getElementById('dataTable'), {
                sheet: "Sheet 1"
            });
            var wbout = XLSX.write(wb, {
                bookType: 'xlsx',
                type: 'binary'
            });

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
                return buf;
            }

            var fileName = "subscription_coupons.xlsx";
            saveAs(new Blob([s2ab(wbout)], {
                type: "application/octet-stream"
            }), fileName);
        }

        function toggleSelectAll() {
            var selectAllCheckbox = document.getElementById('selectAll');
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="coupons[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
