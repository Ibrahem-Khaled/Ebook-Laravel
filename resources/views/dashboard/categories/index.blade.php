@extends('layouts.app')

@section('styles')
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
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center my-4">إدارة الفئات</h1>

        @include('components.alerts')

        <!-- زر إضافة فئة جديدة -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCategoryModal">
            إضافة فئة جديدة
        </button>

        <!-- جدول عرض الفئات -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الفئة</th>
                    <th>الوصف</th>
                    <th>الترتيب</th>
                    <th>الصورة</th>
                    <th>عدد الكتب</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @foreach ($categories as $category)
                    <tr data-id="{{ $category->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_description }}</td>
                        <td>{{ $category->order }}</td>
                        <td>
                            <img src="{{ asset($category->category_image_url) }}" alt="{{ $category->category_name }}"
                                class="img-fluid" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>
                            {{ $category->books_count ?? $category->books()->count() }}
                        </td>
                        <td>
                            <a class="btn btn-sm" href="{{ route('categories.books', $category->id) }}">عرض الكتب</a>
                            <!-- زر تعديل الفئة -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editCategoryModal{{ $category->id }}">
                                تعديل
                            </button>
                            <!-- زر حذف الفئة -->
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل أنت متأكد من حذف هذه الفئة؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- مودال تعديل الفئة -->
                    <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                        aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">تعديل الفئة</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="category_name_{{ $category->id }}" class="form-label">اسم
                                                الفئة</label>
                                            <input type="text" name="category_name"
                                                id="category_name_{{ $category->id }}" class="form-control"
                                                value="{{ $category->category_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_description_{{ $category->id }}"
                                                class="form-label">الوصف</label>
                                            <textarea name="category_description" id="category_description_{{ $category->id }}" class="form-control">{{ $category->category_description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="order_{{ $category->id }}" class="form-label">الترتيب</label>
                                            <input type="number" name="order" id="order_{{ $category->id }}"
                                                class="form-control" value="{{ $category->order }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">تحديث</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- مودال إضافة فئة جديدة -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">إضافة فئة جديدة</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">اسم الفئة</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_description" class="form-label">الوصف</label>
                                <textarea name="category_description" id="category_description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">الترتيب</label>
                                <input type="number" name="order" id="order" class="form-control"
                                    value="0">
                            </div>
                            <div class="mb-3">
                                <label for="category_image" class="form-label">رفع صورة الفئة</label>
                                <input type="file" name="category_image" id="category_image" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
                        url: "{{ route('categories.updateOrder') }}",
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
