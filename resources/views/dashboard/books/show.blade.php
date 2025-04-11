@extends('layouts.app')

@section('styles')
    <!-- تحميل CSS الخاص بـ SortableJS ليس ضرورياً، لكن يمكنك إضافة تنسيقات إضافية -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <style>
        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
        }

        /* تنسيق الصفوف لتسهيل السحب */
        #sortable tr {
            cursor: move;
        }

        /* تنسيق العنصر placeholder أثناء السحب */
        .ui-sortable-placeholder {
            height: 50px;
            background: #f0f0f0;
            border: 1px dashed #ccc;
            visibility: visible !important;
        }

        /* تنسيق رسالة عدم وجود كتب */
        .no-books {
            text-align: center;
            padding: 30px;
            background: #e9f5ff;
            border: 2px dashed #b3d7ff;
            border-radius: 10px;
            color: #007bff;
            margin: 20px 0;
        }

        .no-books i {
            font-size: 3rem;
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center my-4">كتب الفئة: {{ $category->category_name }}</h1>

        @include('components.alerts')

        <!-- جدول عرض الكتب -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان الكتاب</th>
                    <th>الوصف</th>
                    <th>المؤلف</th>
                    <th>الناشر</th>
                    <th>الترتيب</th>
                    <th>الصورة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @forelse ($books as $book)
                    <tr data-id="{{ $book->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $book->book_title }}</td>
                        <td>{{ $book->book_description }}</td>
                        <td>{{ $book->author->author_name ?? 'غير محدد' }}</td>
                        <td>{{ $book->publisher->publisher_name ?? 'غير محدد' }}</td>
                        <td>{{ $book->sort_order }}</td>
                        <td>
                            <img src="{{ asset($book->book_image_url) }}" alt="{{ $book->book_title }}" class="img-fluid"
                                style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>
                            <!-- هنا يمكن إضافة أزرار للتعديل والحذف إن وُجدت -->
                            {{-- مثال:
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')">حذف</button>
                            </form>
                            --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="no-books">
                                <i class="fas fa-book-open"></i>
                                <h3>لا توجد كتب مضافة حتى الآن</h3>
                                <p>عفواً، لم يتم إضافة كتب لهذه الفئة بعد. قم بإضافة الكتب لتظهر هنا وتستمتع بترتيبها!</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <!-- تحميل jQuery (إذا لم يكن محملاً مسبقًا) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- تحميل مكتبة SortableJS من CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // تهيئة SortableJS على العنصر tbody#sortable
            var el = document.getElementById('sortable');
            var sortable = Sortable.create(el, {
                animation: 150,
                onEnd: function(evt) {
                    // عند انتهاء السحب، اجمع الترتيب الجديد
                    var order = [];
                    $('#sortable tr').each(function() {
                        order.push($(this).data('id'));
                    });
                    // إرسال الترتيب الجديد عبر Ajax إلى السيرفر
                    $.ajax({
                        url: "{{ route('categories.books.updateOrder', $category->id) }}",
                        method: "POST",
                        data: {
                            order: order,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                location
                            .reload(); // إعادة تحميل الصفحة لتحديث الترتيب المعروض
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
