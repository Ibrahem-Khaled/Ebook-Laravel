@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">إدارة الإشعارات</h1>

        <!-- عرض رسائل النجاح أو الخطأ -->
        @include('components.alerts')

        <!-- بطاقات الإحصائيات -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الإشعارات</h5>
                        <p class="card-text display-4">{{ $totalNotifications }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">إشعارات مرتبطة بمستخدمين</h5>
                        <p class="card-text display-4">{{ $notificationsWithUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">إشعارات بدون مستخدمين</h5>
                        <p class="card-text display-4">{{ $notificationsWithoutUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">آخر 5 إشعارات</h5>
                        <p class="card-text display-4">{{ $latestNotifications->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر إضافة إشعار جديد -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addNotifcationModal">
            <i class="fas fa-plus"></i> إضافة إشعار جديد
        </button>

        <!-- عرض آخر 5 إشعارات -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">آخر 5 إشعارات</h5>
            </div>
            <div class="card-body">
                @if ($latestNotifications->isEmpty())
                    <p class="text-muted">لا توجد إشعارات حديثة.</p>
                @else
                    <div class="list-group">
                        @foreach ($latestNotifications as $notification)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">{{ $notification->title }}</h6>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-secondary text-white">{{ $notification->user ? $notification->user->name : 'بدون مستخدم' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- جدول عرض الإشعارات -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">قائمة الإشعارات</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>الصورة</th>
                            <th>الوصف</th>
                            <th>المستخدم</th>
                            <th>تاريخ الإنشاء</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->id }}</td>
                                <td>{{ $notification->title }}</td>
                                <td>
                                    @if ($notification->image)
                                        <img src="{{ asset('storage/' . $notification->image) }}" alt="الصورة"
                                            width="80">
                                    @else
                                        لا توجد صورة
                                    @endif
                                </td>
                                <td>{{ $notification->desc }}</td>
                                <td>
                                    @if ($notification->user)
                                        {{ $notification->user->name }}<br>
                                        {{ $notification->user->email }}
                                    @else
                                        غير محدد
                                    @endif
                                </td>
                                <td>{{ $notification->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <!-- زر تعديل الإشعار -->
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editNotifcationModal{{ $notification->id }}">
                                        تعديل
                                    </button>
                                    <!-- زر حذف الإشعار -->
                                    <form action="{{ route('notifcations.destroy', $notification->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('هل أنت متأكد من عملية الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- نافذة تعديل الإشعار -->
                            <div class="modal fade" id="editNotifcationModal{{ $notification->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="editNotifcationModalLabel{{ $notification->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('notifcations.update', $notification->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="editNotifcationModalLabel{{ $notification->id }}">
                                                    تعديل الإشعار</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="إغلاق">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- حقل العنوان -->
                                                <div class="form-group mb-3">
                                                    <label for="title{{ $notification->id }}">العنوان</label>
                                                    <input type="text" class="form-control"
                                                        id="title{{ $notification->id }}" name="title"
                                                        value="{{ $notification->title }}" required>
                                                </div>
                                                <!-- حقل رفع الصورة -->
                                                <div class="form-group mb-3">
                                                    <label for="image{{ $notification->id }}">الصورة</label>
                                                    <input type="file" class="form-control"
                                                        id="image{{ $notification->id }}" name="image">
                                                    @if ($notification->image)
                                                        <img src="{{ asset('storage/' . $notification->image) }}"
                                                            alt="الصورة الحالية" width="80" class="mt-2">
                                                    @endif
                                                </div>
                                                <!-- حقل الوصف -->
                                                <div class="form-group mb-3">
                                                    <label for="desc{{ $notification->id }}">الوصف</label>
                                                    <textarea class="form-control" id="desc{{ $notification->id }}" name="desc" rows="3">{{ $notification->desc }}</textarea>
                                                </div>
                                                <!-- حقل المستخدم: قائمة منسدلة -->
                                                <div class="form-group mb-3">
                                                    <label for="user_id{{ $notification->id }}">المستخدم</label>
                                                    <select name="user_id" id="user_id{{ $notification->id }}"
                                                        class="form-control">
                                                        <option value="">-- اختر المستخدم --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}"
                                                                {{ $notification->user_id == $user->id ? 'selected' : '' }}>
                                                                {{ $user->name }} ({{ $user->email }})
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- نافذة إضافة إشعار جديد -->
    <div class="modal fade" id="addNotifcationModal" tabindex="-1" role="dialog"
        aria-labelledby="addNotifcationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('notifcations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNotifcationModalLabel">إضافة إشعار جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- حقل العنوان -->
                        <div class="form-group mb-3">
                            <label for="title">العنوان</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <!-- حقل رفع الصورة -->
                        <div class="form-group mb-3">
                            <label for="image">الصورة</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <!-- حقل الوصف -->
                        <div class="form-group mb-3">
                            <label for="desc">الوصف</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                        </div>
                        <!-- حقل المستخدم: قائمة منسدلة -->
                        <div class="form-group mb-3">
                            <label for="user_id">المستخدم</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">-- اختر المستخدم --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
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
