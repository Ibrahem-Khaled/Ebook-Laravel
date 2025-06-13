@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة الكتب</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">الكتب</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات الكتب --}}
        <div class="row mb-4">
            {{-- إجمالي الكتب --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-book" title="إجمالي الكتب" :value="$totalBooks" color="primary" />
            </div>
            {{-- الكتب النشطة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-book-open" title="الكتب النشطة" :value="$activeBooks" color="success" />
            </div>
            {{-- العينات المجانية --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-book-reader" title="العينات المجانية" :value="$freeBooks" color="info" />
            </div>
            {{-- الكتب المخفضة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-tag" title="الكتب المخفضة" :value="$discountedBooks" color="warning" />
            </div>
        </div>

        {{-- بطاقة قائمة الكتب --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة الكتب</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createBookModal">
                    <i class="fas fa-plus"></i> إضافة كتاب
                </button>
            </div>
            <div class="card-body">
                {{-- تبويب الفئات --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedCategory === 'all' ? 'active' : '' }}"
                            href="{{ route('books.index') }}">الكل</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $selectedCategory == $category->id ? 'active' : '' }}"
                                href="{{ route('books.index', ['category' => $category->id]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('books.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="ابحث بالعنوان أو ISBN أو الوصف..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول الكتب --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>الصورة</th>
                                <th>العنوان</th>
                                <th>المؤلف</th>
                                <th>الناشر</th>
                                <th>السعر</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td>
                                        @if ($book->book_image_url)
                                            <img src="{{ asset('storage/' . $book->book_image_url) }}"
                                                alt="{{ $book->book_title }}" width="60" class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('img/default-book.png') }}" alt="صورة افتراضية"
                                                width="60" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td>{{ $book->book_title }}</td>
                                    <td>{{ $book->author->author_name ?? 'غير محدد' }}</td>
                                    <td>{{ $book->publisher->publisher_name ?? 'غير محدد' }}</td>
                                    <td>
                                        @if ($book->book_discount > 0)
                                            <span class="text-danger"><del>{{ $book->book_price }} ر.س</del></span>
                                            <br>
                                            {{ $book->book_price - ($book->book_price * $book->book_discount) / 100 }} ر.س
                                            <span class="badge badge-success">{{ $book->book_discount }}%</span>
                                        @else
                                            {{ $book->book_price ?? '0' }} ر.س
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $book->is_active ? 'success' : 'danger' }}">
                                            {{ $book->is_active ? 'نشط' : 'غير نشط' }}
                                        </span>
                                        @if ($book->free_sample)
                                            <span class="badge badge-info mt-1">عينة مجانية</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showBookModal{{ $book->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editBookModal{{ $book->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deleteBookModal{{ $book->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- تضمين المودالات لكل كتاب --}}
                                        @include('dashboard.books.modals.show', ['book' => $book])
                                        @include('dashboard.books.modals.edit', ['book' => $book])
                                        @include('dashboard.books.modals.delete', ['book' => $book])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا يوجد كتب</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة كتاب (ثابت) --}}
    @include('dashboard.books.modals.create')
@endsection

@push('scripts')
    {{-- عرض اسم الملف المختار في حقول upload --}}
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        // تفعيل التولتيب الافتراضي
        $('[data-toggle="tooltip"]').tooltip();

        // تحديث الأقسام الفرعية عند تغيير القسم الرئيسي
        $('#category_id').on('change', function() {
            var category_id = $(this).val();
            var $subcategorySelect = $('#subcategory_id');

            $subcategorySelect.empty();
            $subcategorySelect.append('<option value="">اختر قسم فرعي...</option>');

            if (category_id) {
                $.get('/api/subcategories/' + category_id, function(data) {
                    $.each(data, function(key, value) {
                        $subcategorySelect.append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                });
            }
        });
    </script>
@endpush
