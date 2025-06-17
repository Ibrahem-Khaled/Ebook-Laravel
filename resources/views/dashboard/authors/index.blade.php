@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">إدارة المؤلفين</h1>

        <!-- عرض رسالة النجاح إن وجدت -->
        @include('components.alerts')

        <!-- بطاقات الإحصائيات -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">عدد المؤلفين</h5>
                        <p class="card-text display-4">{{ $authors->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الكتب</h5>
                        <p class="card-text display-4">{{ $authors->sum('books_count') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">متوسط الكتب لكل مؤلف</h5>
                        <p class="card-text display-4">{{ round($authors->avg('books_count'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر لإظهار نافذة إضافة مؤلف جديد -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addAuthorModal">
            <i class="fas fa-plus"></i> إضافة مؤلف جديد
        </button>

        <!-- شريط البحث -->
        <form action="{{ route('author.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="ابحث عن اسم أو وصف المؤلف" name="query"
                    value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>
        </form>

        <!-- جدول عرض المؤلفين -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم المؤلف</th>
                    <th>الصورة</th>
                    <th>الوصف</th>
                    <th>عدد الكتب</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->author_name }}</td>
                        <td>
                            @if ($author->image)
                                <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->author_name }}"
                                    width="50" class="img-thumbnail">
                            @else
                                <span class="text-muted">لا يوجد صورة</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($author->desc, 50) }}</td>
                        <td>{{ $author->books_count }}</td>
                        <td>
                            <a href="{{ route('publishers.analysis', $author->id) }}"
                                class="btn btn-sm btn-circle btn-secondary" title="الاحصاءيات">
                                <i class="fas fa-chart-bar"></i>
                            </a>
                            <!-- زر تعديل يفتح نافذة تعديل خاصة بهذا المؤلف -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editAuthorModal{{ $author->id }}">
                                <i class="fas fa-edit"></i> تعديل
                            </button>
                            <!-- زر حذف يفتح نافذة تأكيد حذف -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deleteAuthorModal{{ $author->id }}">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </td>
                    </tr>

                    <!-- نافذة تعديل المؤلف -->
                    <div class="modal fade" id="editAuthorModal{{ $author->id }}" tabindex="-1"
                        aria-labelledby="editAuthorModalLabel{{ $author->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAuthorModalLabel{{ $author->id }}">تعديل المؤلف</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>
                                <form action="{{ route('author.update', $author->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="author_name{{ $author->id }}" class="form-label">اسم
                                                المؤلف</label>
                                            <input type="text" class="form-control" id="author_name{{ $author->id }}"
                                                name="author_name" value="{{ old('author_name', $author->author_name) }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc{{ $author->id }}" class="form-label">الوصف</label>
                                            <textarea class="form-control" id="desc{{ $author->id }}" name="desc">{{ old('desc', $author->desc) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image{{ $author->id }}" class="form-label">الصورة</label>
                                            @if ($author->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $author->image) }}"
                                                        alt="{{ $author->author_name }}" width="100">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="image{{ $author->id }}"
                                                name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fb{{ $author->id }}" class="form-label">فيسبوك</label>
                                            <input type="text" class="form-control" id="fb{{ $author->id }}"
                                                name="fb" value="{{ old('fb', $author->fb) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="yt{{ $author->id }}" class="form-label">يوتيوب</label>
                                            <input type="text" class="form-control" id="yt{{ $author->id }}"
                                                name="yt" value="{{ old('yt', $author->yt) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telegram{{ $author->id }}" class="form-label">تليجرام</label>
                                            <input type="text" class="form-control" id="telegram{{ $author->id }}"
                                                name="telegram" value="{{ old('telegram', $author->telegram) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="whatsapp{{ $author->id }}" class="form-label">واتساب</label>
                                            <input type="text" class="form-control" id="whatsapp{{ $author->id }}"
                                                name="whatsapp" value="{{ old('whatsapp', $author->whatsapp) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="instagram{{ $author->id }}" class="form-label">إنستجرام</label>
                                            <input type="text" class="form-control" id="instagram{{ $author->id }}"
                                                name="instagram" value="{{ old('instagram', $author->instagram) }}">
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

                    <!-- نافذة تأكيد حذف المؤلف -->
                    <div class="modal fade" id="deleteAuthorModal{{ $author->id }}" tabindex="-1"
                        aria-labelledby="deleteAuthorModalLabel{{ $author->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAuthorModalLabel{{ $author->id }}">حذف المؤلف
                                    </h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>
                                <div class="modal-body">
                                    هل أنت متأكد من حذف المؤلف <strong>{{ $author->author_name }}</strong>؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <form action="{{ route('author.destroy', $author->id) }}" method="POST"
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

    <!-- نافذة إضافة مؤلف جديد -->
    <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-labelledby="addAuthorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAuthorModalLabel">إضافة مؤلف جديد</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="author_name" class="form-label">اسم المؤلف</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">الوصف</label>
                            <textarea class="form-control" id="desc" name="desc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">الصورة</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="fb" class="form-label">فيسبوك</label>
                            <input type="text" class="form-control" id="fb" name="fb">
                        </div>
                        <div class="mb-3">
                            <label for="yt" class="form-label">يوتيوب</label>
                            <input type="text" class="form-control" id="yt" name="yt">
                        </div>
                        <div class="mb-3">
                            <label for="telegram" class="form-label">تليجرام</label>
                            <input type="text" class="form-control" id="telegram" name="telegram">
                        </div>
                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">واتساب</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">إنستجرام</label>
                            <input type="text" class="form-control" id="instagram" name="instagram">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // إعادة تعيين حقول الفورم عند فتح Modal الإضافة
        $('#addAuthorModal').on('show.modal', function() {
            $('#addAuthorForm')[0].reset();
        });
    </script>
@endsection
