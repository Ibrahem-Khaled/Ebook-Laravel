@extends('layouts.app')

@section('title', 'نظام إدارة الاشتراكات')

@section('styles')
    <style>
        /* تخصيص البطاقات */
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        /* تخصيص الجداول */
        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table thead th {
            border-bottom-width: 1px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        /* تأثيرات عند التحويم */
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
            transform: translateX(3px);
        }

        /* تخصيص الأزرار */
        .btn-outline-primary {
            border-width: 2px;
        }

        /* تخصيص النماذج */
        .form-control,
        .form-select {
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        /* تخصيص البادجات */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .badge.bg-primary {
            background-color: #4e73df !important;
        }
    </style>

@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center bg-gradient-primary">
                        <h5 class="mb-0 text-white">
                            <i class="fas fa-crown me-2"></i> نظام إدارة الاشتراكات
                        </h5>
                        <button class="btn btn-light mb-0" data-toggle="modal" data-target="#createSubscriptionModal">
                            <i class="fas fa-plus me-1"></i> إضافة اشتراك جديد
                        </button>
                    </div>
                    @include('components.alerts')
                    <!-- إحصائيات الاشتراكات -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-success shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">إجمالي الاشتراكات</div>
                                                <div class="h4">{{ $subscriptions->count() }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-crown fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-info shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-info mb-1">الاشتراكات النشطة</div>
                                                <div class="h4">{{ $subscriptions->where('is_active', true)->count() }}
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-check-circle fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-warning shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-warning mb-1">إجمالي المشتركين</div>
                                                <div class="h4">{{ $subscriptions->sum('users_count') }}</div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-users fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-4">
                                <div class="card border-start-lg border-start-danger shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-danger mb-1">متوسط السعر</div>
                                                <div class="h4">{{ number_format($subscriptions->avg('price'), 2) }} ر.س
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <i class="fas fa-money-bill-wave fa-2x text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- جدول الاشتراكات -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الاشتراك</th>
                                        <th>السعر</th>
                                        <th>المدة</th>
                                        <th>المشتركين</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($subscription->icon)
                                                        <i class="{{ $subscription->icon }} fa-lg me-3 text-primary"></i>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $subscription->title }}</h6>
                                                        <small
                                                            class="text-muted">{{ Str::limit($subscription->description, 30) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($subscription->price, 2) }} ر.س</td>
                                            <td>
                                                @if ($subscription->duration == 1)
                                                    شهر واحد
                                                @elseif($subscription->duration == 12)
                                                    سنة كاملة
                                                @else
                                                    {{ $subscription->duration }} أشهر
                                                @endif
                                            </td>
                                            <td class="text-white">
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ $subscription->users->count() }}</span>
                                            </td>
                                            <td>
                                                @if ($subscription->is_active)
                                                    <span class="badge bg-success">نشط</span>
                                                @else
                                                    <span class="badge bg-secondary">غير نشط</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('subscriptions.users', $subscription->id) }}"
                                                        class="btn btn-sm btn-outline-primary me-1" title="إدارة المشتركين">
                                                        <i class="fas fa-users"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-info me-1" data-toggle="modal"
                                                        data-target="#editSubscriptionModal{{ $subscription->id }}"
                                                        title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form
                                                        action="{{ route('subscriptions.destroy', $subscription->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('هل أنت متأكد من حذف هذا الاشتراك؟')"
                                                            title="حذف">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.subscriptions.create')
    @foreach ($subscriptions as $subscription)
        @include('dashboard.subscriptions.edit', ['subscription' => $subscription])
    @endforeach
@endsection
