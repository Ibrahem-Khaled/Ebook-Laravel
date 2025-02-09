<!doctype html>
<html lang="ar">

<head>
    <title>تاريخ قراءة الكتب</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ربط ملف Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body dir="rtl">
    <!-- الهيدر -->
    <header class="bg-dark text-white py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- زر الرجوع -->
            <a href="{{ url()->previous() }}" class="btn btn-light">رجوع</a>
            <!-- الشعار -->
            <img src="{{ asset('img/logo-ct-dark.png') }}" alt="شعار الموقع" class="img-fluid" style="height: 50px;">
        </div>
    </header>

    <div class="container mt-3">
        <h1 class="text-center mb-4">سجل الكتب المقروءة</h1>

        <!-- زر إضافة كتاب جديد -->
        <div class="text-end mb-3">
            <a href="{{ route('book.create') }}" class="btn btn-success">إضافة كتاب جديد</a>
        </div>

        <!-- جدول عرض السجل -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>اسم الكتاب</th>
                        <th>اسم المؤلف</th>
                        <th>عدد الصفحات المقروءة</th>
                        <th>إجمالي صفحات الكتاب</th>
                        <th>نسبة القراءة</th>
                        <th>تاريخ الإضافة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($readingData as $index => $record)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $record->book_title }}</td>
                            <td>{{ $record->author->author_name ?? 'غير متوفر' }}</td>
                            <td>{{ $record->pivot->page }}</td>
                            <td>{{ $record->book_number_pages ?? 'غير متوفر' }}</td>
                            <td>
                                @if(isset($record->book_number_pages) && $record->book_number_pages > 0)
                                    {{ number_format(($record->pivot->page / $record->book_number_pages) * 100, 2) }}%
                                @else
                                    غير متوفر
                                @endif
                            </td>
                            <td>{{ $record?->pivot?->created_at?->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">لا توجد بيانات.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ربط ملف Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
