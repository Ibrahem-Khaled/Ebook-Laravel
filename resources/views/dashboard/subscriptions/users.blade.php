@extends('layouts.app')
@push('styles')
    <style>
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        .table-hover tbody tr {
            transition: all 0.2s ease;
        }

        .table-hover tbody tr:hover {
            transform: translateX(5px);
        }

        .badge {
            font-weight: 500;
            padding: 0.5em 0.8em;
        }

        .select2-container--default .select2-selection--single {
            height: 45px;
            border-radius: 0.5rem;
            border: 1px solid #d1d3e2;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-lg">
                    <!-- Header with Gradient Background -->
                    <div class="card-header bg-gradient-primary d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if ($subscription->icon)
                                <i class="{{ $subscription->icon }} fa-2x text-white me-3"></i>
                            @endif
                            <div>
                                <h4 class="mb-0 text-white">{{ $subscription->title }}</h4>
                                <p class="text-white-50 mb-0">
                                    @if ($subscription->duration == 1)
                                        اشتراك شهري
                                    @elseif($subscription->duration == 12)
                                        اشتراك سنوي
                                    @else
                                        اشتراك {{ $subscription->duration }} أشهر
                                    @endif
                                    - {{ number_format($subscription->price, 2) }} ر.س
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('subscriptions.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> رجوع
                        </a>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-success h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">إجمالي المشتركين</div>
                                                <div class="h4">{{ $users->count() }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-users fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-info h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-info mb-1">اشتراكات نشطة</div>
                                                <div class="h4">
                                                    {{ $users->filter(fn($u) => \Carbon\Carbon::parse($u?->pivot?->expiry_date) > now())->count() }}
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-check-circle fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-warning h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-warning mb-1">اشتراكات منتهية</div>
                                                <div class="h4">
                                                    {{ $users->filter(fn($u) => \Carbon\Carbon::parse($u?->pivot?->expiry_date) <= now())->count() }}
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-clock fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-danger h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-danger mb-1">اشتراكات قاربت على الانتهاء
                                                </div>
                                                <div class="h4">
                                                    {{ $users->filter(fn($u) => \Carbon\Carbon::parse($u?->pivot?->expiry_date) > now() && \Carbon\Carbon::parse($u?->pivot?->expiry_date)->diffInDays(now()) <= 7)->count() }}
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add User Form -->
                        <div class="card shadow mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-user-plus me-2"></i> إضافة مشترك جديد
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('subscriptions.addUser', $subscription->id) }}" method="POST"
                                    class="row g-3">
                                    @csrf
                                    <div class="col-md-8">
                                        <select name="user_id" class="form-select select2" required>
                                            <option value="">-- اختر مستخدم --</option>
                                            @foreach ($allUsers->diff($users) as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                    ({{ $user->email }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100 h-100">
                                            <i class="fas fa-plus me-1"></i> إضافة مشترك
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Users Table -->
                        <div class="card shadow">
                            <div class="card-header bg-white py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-users me-2"></i> قائمة المشتركين
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>المستخدم</th>
                                                <th>تاريخ الاشتراك</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                                <tr
                                                    class="@if (\Carbon\Carbon::parse($user->pivot->expiry_date) <= now()) table-danger @elseif(\Carbon\Carbon::parse($user->pivot->expiry_date)->diffInDays(now()) <= 7) table-warning @endif">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}"
                                                                class="rounded-circle me-2" width="40" height="40"
                                                                alt="صورة المستخدم">
                                                            <div>
                                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                                                <small class="text-muted">{{ $user->email }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user?->pivot?->created_at?->format('Y/m/d') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($user->pivot->expiry_date)->format('Y/m/d') }}
                                                    </td>
                                                    <td>
                                                        @if (\Carbon\Carbon::parse($user->pivot->expiry_date) <= now())
                                                            <span class="badge bg-danger">
                                                                <i class="fas fa-times-circle me-1"></i> منتهي
                                                            </span>
                                                        @elseif(\Carbon\Carbon::parse($user->pivot->expiry_date)->diffInDays(now()) <= 7)
                                                            <span class="badge bg-warning text-dark">
                                                                <i class="fas fa-clock me-1"></i> ينتهي خلال
                                                                {{ \Carbon\Carbon::parse($user->pivot->expiry_date)->diffInDays(now()) }}
                                                                أيام
                                                            </span>
                                                        @else
                                                            <span class="badge bg-success">
                                                                <i class="fas fa-check-circle me-1"></i> نشط
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <button class="btn btn-sm btn-outline-secondary me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#renewModal{{ $user->id }}"
                                                                title="تجديد الاشتراك">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                            <form
                                                                action="{{ route('subscriptions.removeUser', [$subscription->id, $user->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('هل أنت متأكد من إزالة هذا المشترك؟')"
                                                                    title="إزالة">
                                                                    <i class="fas fa-user-minus"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Renew Modal -->
                                                <div class="modal fade" id="renewModal{{ $user->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title">تجديد اشتراك {{ $user->name }}
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('subscriptions.renewUser', [$subscription->id, $user->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">تاريخ الانتهاء
                                                                            الحالي</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ \Carbon\Carbon::parse($user->pivot->expiry_date)->format('Y/m/d') }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">تاريخ الانتهاء
                                                                            الجديد</label>
                                                                        <input type="date" name="expiry_date"
                                                                            class="form-control"
                                                                            value="{{ now()->addMonths($subscription->duration)->format('Y-m-d') }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">إلغاء</button>
                                                                    <button type="submit" class="btn btn-primary">حفظ
                                                                        التغييرات</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">
                                                        <img src="{{ asset('images/no-users.svg') }}"
                                                            alt="لا يوجد مشتركون" width="150" class="mb-3">
                                                        <h5 class="text-muted">لا يوجد مشتركون في هذا الاشتراك</h5>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'اختر مستخدم',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
