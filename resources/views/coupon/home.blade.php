<!doctype html>
<html lang="ar">

<head>
    <title>إدارة أكواد الخصم</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- شريط التنقل -->
    @include('layouts.navigation')

    @include('layouts.alerts')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px"></div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}">
                    <svg style="margin-right: 1rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                    العودة
                </a>
            </div>
        </div>

        <div class="container">
            <div class="section text-left my-4">
                <!-- زر إضافة كوبونات -->
                <div class="row mb-4">
                    <div class="col text-end">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#createCouponModal">
                            إنشاء كود خصم
                        </button>
                    </div>
                </div>

                <!-- نموذج إضافة الكوبونات -->
                <div class="modal fade" id="createCouponModal" tabindex="-1" aria-labelledby="createCouponModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createCouponModalLabel">إنشاء كود خصم</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('coupon.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="count">عدد الأكواد</label>
                                        <input type="number" class="form-control" id="count" name="count"
                                            required min="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="type">نوع الكوبون:</label>
                                        <select class="form-select" id="type" name="type" required
                                            onchange="updateReferenceOptions()">
                                            <option value="" disabled selected>اختر النوع</option>
                                            <option value="book">كتاب</option>
                                            <option value="subscription">اشتراك</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reference_id">اختر الكتاب/الاشتراك:</label>
                                        <select class="form-select" id="reference_id" name="reference_id" required>
                                            <option value="" disabled selected>اختر</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="discount">الخصم (%):</label>
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            required min="0" max="100" oninput="validateDiscount(this)">
                                    </div>
                                    <button type="submit" class="btn btn-primary">إنشاء</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- عرض الكوبونات -->
                <ul class="nav nav-tabs" id="couponTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="book-tab" data-bs-toggle="tab"
                            data-bs-target="#book-coupons" type="button" role="tab" aria-controls="book-coupons"
                            aria-selected="true">الكتب التي تحتوي على كوبونات</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="subscription-tab" data-bs-toggle="tab"
                            data-bs-target="#subscription-coupons" type="button" role="tab"
                            aria-controls="subscription-coupons" aria-selected="false">الاشتراكات التي تحتوي على
                            كوبونات</button>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="couponTabsContent">
                    <!-- الكتب التي تحتوي على كوبونات -->
                    <div class="tab-pane fade show active" id="book-coupons" role="tabpanel"
                        aria-labelledby="book-tab">
                        @if ($booksWithCoupons->count() > 0)
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>اسم الكتاب</th>
                                            <th>عدد الكوبونات</th>
                                            <th>الإجراء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booksWithCoupons as $book)
                                            <tr>
                                                <td>{{ $book->id }}</td>
                                                <td>{{ $book->book_title }}</td>
                                                <td>{{ $book->coupons->count() }}</td>
                                                <td>
                                                    <a href="{{ route('book.coupons', $book->id) }}"
                                                        class="btn btn-sm btn-primary">عرض الكوبونات</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center">لا توجد كتب تحتوي على كوبونات.</p>
                        @endif
                    </div>

                    <!-- الاشتراكات التي تحتوي على كوبونات -->
                    <div class="tab-pane fade" id="subscription-coupons" role="tabpanel"
                        aria-labelledby="subscription-tab">
                        @if ($subscriptionsWithCoupons->count() > 0)
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>اسم الاشتراك</th>
                                            <th>عدد الكوبونات</th>
                                            <th>الإجراء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscriptionsWithCoupons as $subscription)
                                            <tr>
                                                <td>{{ $subscription->id }}</td>
                                                <td>{{ $subscription->title }}</td>
                                                <td>{{ $subscription->coupons->count() }}</td>
                                                <td>
                                                    <a href="{{ route('subscription.coupons', $subscription->id) }}"
                                                        class="btn btn-sm btn-primary">عرض الكوبونات</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center">لا توجد اشتراكات تحتوي على كوبونات.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const books = @json($books); // تحويل بيانات الكتب إلى JSON
        const subscriptions = @json($subscriptions); // تحويل بيانات الاشتراكات إلى JSON

        function updateReferenceOptions() {
            const type = document.getElementById('type').value;
            const referenceSelect = document.getElementById('reference_id');

            // تفريغ الخيارات الحالية
            referenceSelect.innerHTML = '<option value="" disabled selected>اختر</option>';

            // إضافة الخيارات بناءً على النوع
            if (type === 'book') {
                books.forEach(book => {
                    const option = document.createElement('option');
                    option.value = book.id;
                    option.textContent = `كتاب: ${book.book_title}`;
                    referenceSelect.appendChild(option);
                });
            } else if (type === 'subscription') {
                subscriptions.forEach(subscription => {
                    const option = document.createElement('option');
                    option.value = subscription.id;
                    option.textContent = `اشتراك: ${subscription.title}`;
                    referenceSelect.appendChild(option);
                });
            }
        }

        function validateDiscount(input) {
            if (input.value > 100) {
                input.value = 100;
                alert("الخصم لا يمكن أن يتجاوز 100%");
            }
        }
    </script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}"></script>
</body>

</html>
