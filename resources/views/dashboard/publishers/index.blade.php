@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">إدارة الناشرين</h1>

        <!-- عرض رسالة النجاح إن وجدت -->
        @include('components.alerts')

        <!-- بطاقات الإحصائيات -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">عدد الناشرين</h5>
                        <p class="card-text display-4">{{ $publishers->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الكتب</h5>
                        <p class="card-text display-4">{{ $publishers->sum('books_count') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">متوسط الكتب لكل ناشر</h5>
                        <p class="card-text display-4">{{ round($publishers->avg('books_count'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر لإظهار نافذة إضافة ناشر جديد -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addPublisherModal">
            <i class="fas fa-plus"></i> إضافة ناشر جديد
        </button>

        <!-- شريط البحث -->
        <form action="{{ route('publisher.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="ابحث عن اسم أو وصف الناشر" name="query"
                    value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i> بحث
                </button>
            </div>
        </form>

        <!-- جدول عرض الناشرين -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم الناشر</th>
                    <th>الصورة</th>
                    <th>الوصف</th>
                    <th>عدد الكتب</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publishers as $publisher)
                    <tr>
                        <td>{{ $publisher->id }}</td>
                        <td>{{ $publisher->publisher_name }}</td>
                        <td>
                            @if ($publisher->image)
                                <img src="{{ asset('storage/' . $publisher->image) }}"
                                    alt="{{ $publisher->publisher_name }}" width="50" class="img-thumbnail">
                            @else
                                <span class="text-muted">لا يوجد صورة</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($publisher->desc, 50) }}</td>
                        <td>{{ $publisher->books_count }}</td>
                        <td>
                            <!-- زر تعديل يفتح نافذة تعديل خاصة بهذا الناشر -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editPublisherModal{{ $publisher->id }}">
                                <i class="fas fa-edit"></i> تعديل
                            </button>
                            <!-- زر حذف يفتح نافذة تأكيد حذف -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#deletePublisherModal{{ $publisher->id }}">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </td>
                    </tr>

                    <!-- نافذة تعديل الناشر -->
                    <div class="modal fade" id="editPublisherModal{{ $publisher->id }}" tabindex="-1"
                        aria-labelledby="editPublisherModalLabel{{ $publisher->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPublisherModalLabel{{ $publisher->id }}">تعديل الناشر
                                    </h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>
                                <form action="{{ route('publisher.update', $publisher->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="publisher_name{{ $publisher->id }}" class="form-label">اسم
                                                الناشر</label>
                                            <input type="text" class="form-control"
                                                id="publisher_name{{ $publisher->id }}" name="publisher_name"
                                                value="{{ old('publisher_name', $publisher->publisher_name) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc{{ $publisher->id }}" class="form-label">الوصف</label>
                                            <textarea class="form-control" id="desc{{ $publisher->id }}" name="desc">{{ old('desc', $publisher->desc) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image{{ $publisher->id }}" class="form-label">الصورة</label>
                                            @if ($publisher->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $publisher->image) }}"
                                                        alt="{{ $publisher->publisher_name }}" width="100">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="image{{ $publisher->id }}"
                                                name="image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="fb{{ $publisher->id }}" class="form-label">فيسبوك</label>
                                            <input type="text" class="form-control" id="fb{{ $publisher->id }}"
                                                name="fb" value="{{ old('fb', $publisher->fb) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="yt{{ $publisher->id }}" class="form-label">يوتيوب</label>
                                            <input type="text" class="form-control" id="yt{{ $publisher->id }}"
                                                name="yt" value="{{ old('yt', $publisher->yt) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telegram{{ $publisher->id }}" class="form-label">تليجرام</label>
                                            <input type="text" class="form-control" id="telegram{{ $publisher->id }}"
                                                name="telegram" value="{{ old('telegram', $publisher->telegram) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="whatsapp{{ $publisher->id }}" class="form-label">واتساب</label>
                                            <input type="text" class="form-control" id="whatsapp{{ $publisher->id }}"
                                                name="whatsapp" value="{{ old('whatsapp', $publisher->whatsapp) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="instagram{{ $publisher->id }}"
                                                class="form-label">إنستجرام</label>
                                            <input type="text" class="form-control"
                                                id="instagram{{ $publisher->id }}" name="instagram"
                                                value="{{ old('instagram', $publisher->instagram) }}">
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

                    <!-- نافذة تأكيد حذف الناشر -->
                    <div class="modal fade" id="deletePublisherModal{{ $publisher->id }}" tabindex="-1"
                        aria-labelledby="deletePublisherModalLabel{{ $publisher->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePublisherModalLabel{{ $publisher->id }}">حذف الناشر
                                    </h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>
                                <div class="modal-body">
                                    هل أنت متأكد من حذف الناشر <strong>{{ $publisher->publisher_name }}</strong>؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                    <form action="{{ route('publisher.destroy', $publisher->id) }}" method="POST"
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

    <!-- نافذة إضافة ناشر جديد -->
    <div class="modal fade" id="addPublisherModal" tabindex="-1" aria-labelledby="addPublisherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('publisher.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPublisherModalLabel">إضافة ناشر جديد</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="publisher_name" class="form-label">اسم الناشر</label>
                            <input type="text" class="form-control" id="publisher_name" name="publisher_name"
                                required>
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
        // يمكنك إضافة سكربتات إضافية هنا عند الحاجة
    </script>
@endsection
