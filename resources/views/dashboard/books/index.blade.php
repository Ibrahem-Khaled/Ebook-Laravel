@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">لوحة تحكم الكتب</h1>

        <!-- عرض رسالة النجاح إن وجدت -->
        @include('components.alerts')

        <!-- إحصائيات الكتب -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الكتب</h5>
                        <p class="card-text display-4">{{ $totalBooks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">الكتب المفعلّة</h5>
                        <p class="card-text display-4">{{ $activeBooks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">الكتب غير المفعلّة</h5>
                        <p class="card-text display-4">{{ $inactiveBooks }}</p>
                    </div>
                </div>
            </div>
            <!-- يمكن إضافة إحصائيات إضافية هنا مثل مجموع الأسعار أو غيرها -->
        </div>

        <!-- زر لإظهار نافذة إضافة كتاب جديد -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addBookModal">
            <i class="fas fa-plus"></i> إضافة كتاب جديد
        </button>

        <!-- شريط البحث -->
        <form action="{{ route('books.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="ابحث عن عنوان أو وصف الكتاب"
                    value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>
        </form>

        <!-- جدول عرض الكتب -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>عنوان الكتاب</th>
                    <th>الصورة</th>
                    <th>الوصف</th>
                    <th>عدد الصفحات</th>
                    <th>السعر</th>
                    <th>المؤلف</th>
                    <th>الناشر</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->book_title }}</td>
                        <td>
                            @if ($book->book_image_url)
                                <img src="{{ asset($book->book_image_url) }}" alt="{{ $book->book_title }}" width="50"
                                    class="img-thumbnail">
                            @else
                                <span class="text-muted">لا يوجد صورة</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($book->book_description, 50) }}</td>
                        <td>{{ $book->book_number_pages }}</td>
                        <td>{{ $book->book_price }}</td>
                        <td>{{ $book->author->author_name }}</td>
                        <td>{{ $book->publisher->publisher_name }}</td>
                        <td class="text-white">
                            @if ($book->is_active)
                                <span class="badge bg-success">مفعل</span>
                            @else
                                <span class="badge bg-secondary">غير مفعل</span>
                            @endif
                        </td>
                        <td>
                            <!-- زر التفعيل/إلغاء التفعيل -->
                            <form action="{{ route('books.toggleActivation', $book->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm">
                                    @if ($book->is_active)
                                        إلغاء التفعيل
                                    @else
                                        تفعيل
                                    @endif
                                </button>
                            </form>

                            <!-- زر تعديل يفتح نافذة تعديل الكتاب -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editBookModal{{ $book->id }}">
                                <i class="fas fa-edit"></i> تعديل
                            </button>

                            <!-- زر حذف يفتح نافذة تأكيد الحذف -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteBookModal{{ $book->id }}">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </td>
                    </tr>

                    <!-- نافذة تعديل الكتاب -->
                    <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1"
                        aria-labelledby="editBookModalLabel{{ $book->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBookModalLabel{{ $book->id }}">تعديل الكتاب</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>
                                <form action="{{ route('books.update', $book->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <!-- مثال على بعض الحقول، يمكنك تكرارها لبقية الحقول -->
                                        <div class="mb-3">
                                            <label for="book_title{{ $book->id }}" class="form-label">عنوان
                                                الكتاب</label>
                                            <input type="text" class="form-control" id="book_title{{ $book->id }}"
                                                name="book_title" value="{{ old('book_title', $book->book_title) }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="book_description{{ $book->id }}"
                                                class="form-label">الوصف</label>
                                            <textarea class="form-control" id="book_description{{ $book->id }}" name="book_description">{{ old('book_description', $book->book_description) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="book_image{{ $book->id }}" class="form-label">الصورة</label>
                                            @if ($book->book_image_url)
                                                <div class="mb-2">
                                                    <img src="{{ asset($book->book_image_url) }}"
                                                        alt="{{ $book->book_title }}" width="100">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="book_image{{ $book->id }}"
                                                name="book_image">
                                        </div>
                                        <!-- يمكنك إضافة باقي الحقول مثل رقم الصفحات، السعر، ISBN، وتواريخ النشر -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="book_number_pages{{ $book->id }}" class="form-label">عدد
                                                    الصفحات</label>
                                                <input type="number" class="form-control"
                                                    id="book_number_pages{{ $book->id }}" name="book_number_pages"
                                                    value="{{ old('book_number_pages', $book->book_number_pages) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="book_price{{ $book->id }}"
                                                    class="form-label">السعر</label>
                                                <input type="number" step="0.01" class="form-control"
                                                    id="book_price{{ $book->id }}" name="book_price"
                                                    value="{{ old('book_price', $book->book_price) }}">
                                            </div>
                                        </div>
                                        <!-- تحديد العلاقات مثل المؤلف، الناشر، الفئة والفئة الفرعية -->
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="author_id{{ $book->id }}"
                                                    class="form-label">المؤلف</label>
                                                <select name="author_id" id="author_id{{ $book->id }}"
                                                    class="form-control">
                                                    <option value="">اختر المؤلف</option>
                                                    @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}"
                                                            {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                                            {{ $author->author_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="publisher_id{{ $book->id }}"
                                                    class="form-label">الناشر</label>
                                                <select name="publisher_id" id="publisher_id{{ $book->id }}"
                                                    class="form-control">
                                                    <option value="">اختر الناشر</option>
                                                    @foreach ($publishers as $publisher)
                                                        <option value="{{ $publisher->id }}"
                                                            {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>
                                                            {{ $publisher->publisher_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="category_id{{ $book->id }}"
                                                    class="form-label">الفئة</label>
                                                <select name="category_id" id="category_id{{ $book->id }}"
                                                    class="form-control">
                                                    <option value="">اختر الفئة</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="subcategory_id{{ $book->id }}" class="form-label">الفئة
                                                    الفرعية</label>
                                                <select name="subcategory_id" id="subcategory_id{{ $book->id }}"
                                                    class="form-control">
                                                    <option value="">اختر الفئة الفرعية</option>
                                                    @foreach ($subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}"
                                                            {{ $book->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                                            {{ $subcategory->subcategory_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-primary">تحديث</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- نافذة تأكيد حذف الكتاب -->
                    <div class="modal fade" id="deleteBookModal{{ $book->id }}" tabindex="-1"
                        aria-labelledby="deleteBookModalLabel{{ $book->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteBookModalLabel{{ $book->id }}">حذف الكتاب</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>
                                <div class="modal-body">
                                    هل أنت متأكد من حذف الكتاب <strong>{{ $book->book_title }}</strong>؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        // يمكن إضافة سكربتات JavaScript لتحسين التفاعل مثل إعادة ترتيب الكتب أو غيرها
    </script>
@endsection
