@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">إدارة الكوبونات</h1>

        <!-- عرض رسائل النجاح أو الخطأ -->
        @include('components.alerts')

        <!-- إحصائيات بسيطة -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">عدد الكتب التي تحتوي على كوبونات</h5>
                        <p class="card-text display-4">{{ $booksWithCoupons->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">عدد الاشتراكات التي تحتوي على كوبونات</h5>
                        <p class="card-text display-4">{{ $subscriptionsWithCoupons->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر لتصدير بيانات الكوبونات إلى ملف إكسيل -->
        <button id="exportExcel" class="btn btn-info mb-3">
            <i class="fas fa-file-excel"></i> تصدير الكوبونات إلى إكسيل
        </button>

        <!-- زر لإظهار نافذة إنشاء كوبونات جديدة -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addCouponModal">
            <i class="fas fa-plus"></i> إنشاء كوبونات جديدة
        </button>

        <!-- نموذج حذف الكوبونات المحددة (إن وجد اختيار متعدد) -->
        <form action="{{ route('coupons.deleteCoupons') }}" method="POST" id="deleteCouponsForm" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> حذف الكوبونات المختارة
            </button>
        </form>

        <!-- تبويبات لعرض كوبونات الكتب والاشتراكات -->
        <ul class="nav nav-tabs mb-3" id="couponTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="book-coupons-tab" data-toggle="tab" data-target="#book-coupons"
                    type="button" role="tab" aria-controls="book-coupons" aria-selected="true">كوبونات الكتب</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="subscription-coupons-tab" data-toggle="tab" data-target="#subscription-coupons"
                    type="button" role="tab" aria-controls="subscription-coupons" aria-selected="false">كوبونات
                    الاشتراكات</button>
            </li>
        </ul>
        <div class="tab-content" id="couponTabContent">
            <!-- تبويب كوبونات الكتب -->
            <div class="tab-pane fade show active" id="book-coupons" role="tabpanel" aria-labelledby="book-coupons-tab">
                @if ($booksWithCoupons->count())
                    <table class="table table-bordered table-hover" id="bookCouponsTable">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>عنوان الكتاب</th>
                                <th>عدد الكوبونات</th>
                                <th>عرض التفاصيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booksWithCoupons as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->book_title }}</td>
                                    <td>{{ $book->coupons->count() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm view-coupons" data-type="book"
                                            data-id="{{ $book->id }}" data-title="{{ $book->book_title }}">
                                            عرض التفاصيل
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">لا توجد كوبونات مرتبطة بالكتب.</p>
                @endif
            </div>
            <!-- تبويب كوبونات الاشتراكات -->
            <div class="tab-pane fade" id="subscription-coupons" role="tabpanel" aria-labelledby="subscription-coupons-tab">
                @if ($subscriptionsWithCoupons->count())
                    <table class="table table-bordered table-hover" id="subscriptionCouponsTable">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>اسم الاشتراك</th>
                                <th>عدد الكوبونات</th>
                                <th>عرض التفاصيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscriptionsWithCoupons as $subscription)
                                <tr>
                                    <td>{{ $subscription->id }}</td>
                                    <td>{{ $subscription->title ?? '---' }}</td>
                                    <td>{{ $subscription->coupons->count() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm view-coupons"
                                            data-type="subscription" data-id="{{ $subscription->id }}"
                                            data-title="{{ $subscription->title }}">
                                            عرض التفاصيل
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">لا توجد كوبونات مرتبطة بالاشتراكات.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- نافذة عرض تفاصيل الكوبونات -->
    <div class="modal fade" id="couponsDetailModal" tabindex="-1" aria-labelledby="couponsDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تفاصيل الكوبونات لـ <span id="detailTitle"></span></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body" id="couponsDetailBody">
                    <!-- سيتم تعبئة تفاصيل الكوبونات هنا عبر تحميل صفحة جديدة أو بيانات من الخادم -->
                    <p>تحميل البيانات...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة إنشاء كوبونات جديدة -->
    <div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="addCouponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('coupons.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCouponModalLabel">إنشاء كوبونات جديدة</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <!-- حقل الخصم -->
                        <div class="mb-3">
                            <label for="discount" class="form-label">نسبة الخصم (%)</label>
                            <input type="number" class="form-control" id="discount" name="discount" required
                                min="0" max="100">
                        </div>
                        <!-- عدد الكوبونات المطلوب إنشاؤها -->
                        <div class="mb-3">
                            <label for="count" class="form-label">عدد الكوبونات</label>
                            <input type="number" class="form-control" id="count" name="count" required
                                min="1">
                        </div>
                        <!-- نوع الكوبون -->
                        <div class="mb-3">
                            <label for="type" class="form-label">نوع الكوبون</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="book">كتاب</option>
                                <option value="subscription">اشتراك</option>
                            </select>
                        </div>
                        <!-- قائمة الكتب أو الاشتراكات اعتماداً على النوع -->
                        <div class="mb-3" id="referenceDiv">
                            <label for="reference_id" class="form-label">اختر المرجع</label>
                            <select name="reference_id" id="reference_id" class="form-control" required>
                                <!-- سيتم تعبئتها دون استخدام JS هنا، بل يمكنك تمرير البيانات من الخادم -->
                                @if (old('type', 'book') == 'book')
                                    <option value="">اختر الكتاب</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->book_title }}</option>
                                    @endforeach
                                @else
                                    <option value="">اختر الاشتراك</option>
                                    @foreach ($subscriptions as $subscription)
                                        <option value="{{ $subscription->id }}">{{ $subscription->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">إنشاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- تضمين مكتبة SheetJS من CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        // دالة استخراج بيانات جدول الكوبونات وتحويلها إلى ملف إكسيل
        document.getElementById('exportExcel').addEventListener('click', function() {
            // هنا مثال على استخراج بيانات من جدول الكتب
            var table = document.getElementById('bookCouponsTable');
            var workbook = XLSX.utils.table_to_book(table, {
                sheet: "كوبونات الكتب"
            });
            XLSX.writeFile(workbook, 'coupons_books.xlsx');
        });

        // إضافة حدث لزر "عرض التفاصيل" في كل صف من تبويب الكتب والاشتراكات
        document.querySelectorAll('.view-coupons').forEach(function(button) {
            button.addEventListener('click', function() {
                var type = this.getAttribute('data-type');
                var id = this.getAttribute('data-id');
                var title = this.getAttribute('data-title');
                // تعيين العنوان في Modal التفاصيل
                document.getElementById('detailTitle').innerText = title;
                // إرسال طلب AJAX لتحميل بيانات الكوبونات الخاصة بالمرجع المحدد
                // في هذا المثال سنقوم بتوجيه المستخدم إلى صفحة عرض التفاصيل (يمكنك استخدام AJAX إذا رغبت)
                window.location.href = (type === 'book') ?
                    '/admin/coupons/book/' + id :
                    '/admin/coupons/subscription/' + id;
            });
        });
    </script>
@endsection
