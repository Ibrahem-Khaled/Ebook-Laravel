@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">إدارة slides</h1>

        <!-- عرض رسائل النجاح أو الخطأ -->
        @include('components.alerts')

        <!-- زر إضافة شريحة جديدة -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addSlideModal">
            <i class="fas fa-plus"></i> إضافة slide جديدة
        </button>

        <!-- جدول عرض الشرائح -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>المرجع</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slides as $slide)
                    <tr>
                        <td>{{ $slide->id }}</td>
                        <td>
                            @if ($slide->image)
                                <img src="{{ asset('storage/' . $slide->image) }}" alt="صورة الشريحة" width="100">
                            @else
                                لا توجد صورة
                            @endif
                        </td>
                        <td>
                            {{ $slide->related_id ? $slide->related_id . ' - ' . $slide->type_related : 'غير محدد' }}
                        </td>
                        <td>
                            <!-- زر تعديل الشريحة -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editSlideModal{{ $slide->id }}">
                                تعديل
                            </button>
                            <!-- زر حذف الشريحة -->
                            <form action="{{ route('slides.destroy', $slide->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('هل أنت متأكد من عملية الحذف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>

                    <!-- نافذة تعديل الشريحة -->
                    <div class="modal fade" id="editSlideModal{{ $slide->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editSlideModalLabel{{ $slide->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('slides.update', $slide->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSlideModalLabel{{ $slide->id }}">تعديل الشريحة
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- حقل رفع الصورة -->
                                        <div class="form-group mb-3">
                                            <label for="image{{ $slide->id }}">الصورة</label>
                                            <input type="file" class="form-control" id="image{{ $slide->id }}"
                                                name="image">
                                            @if ($slide->image)
                                                <img src="{{ asset('storage/' . $slide->image) }}" alt="الصورة الحالية"
                                                    width="100" class="mt-2">
                                            @endif
                                        </div>
                                        <!-- حقل رقم المرجع -->
                                        <div class="form-group mb-3">
                                            <label for="related_id{{ $slide->id }}">رقم المرجع</label>
                                            <input type="number" class="form-control" id="related_id{{ $slide->id }}"
                                                name="related_id" value="{{ $slide->related_id }}">
                                        </div>
                                        <!-- حقل نوع المرجع -->
                                        <div class="form-group mb-3">
                                            <label for="type_related{{ $slide->id }}">نوع المرجع</label>
                                            <select name="type_related" id="type_related{{ $slide->id }}"
                                                class="form-control">
                                                <option value=""
                                                    {{ $slide->type_related == null ? 'selected' : '' }}>غير محدد</option>
                                                <option value="book"
                                                    {{ $slide->type_related == 'book' ? 'selected' : '' }}>كتاب</option>
                                                <option value="author"
                                                    {{ $slide->type_related == 'author' ? 'selected' : '' }}>مؤلف</option>
                                                <option value="publisher"
                                                    {{ $slide->type_related == 'publisher' ? 'selected' : '' }}>ناشر
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-primary">تحديث</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- نافذة إضافة شريحة جديدة -->
    <div class="modal fade" id="addSlideModal" tabindex="-1" role="dialog" aria-labelledby="addSlideModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSlideModalLabel">إضافة slide جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- حقل رفع الصورة -->
                        <div class="form-group mb-3">
                            <label for="image">الصورة</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <!-- حقل رقم المرجع -->
                        <div class="form-group mb-3">
                            <label for="related_id">رقم المرجع</label>
                            <input type="number" class="form-control" id="related_id" name="related_id">
                        </div>
                        <!-- حقل نوع المرجع -->
                        <div class="form-group mb-3">
                            <label for="type_related">نوع المرجع</label>
                            <select name="type_related" id="type_related" class="form-control">
                                <option value="" selected>غير محدد</option>
                                <option value="book">كتاب</option>
                                <option value="author">مؤلف</option>
                                <option value="publisher">ناشر</option>
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
