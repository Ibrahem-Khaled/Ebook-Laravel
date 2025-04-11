@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">كوبونات الكتاب</h1>

        @include('components.alerts')

        <!-- إحصائيات الكوبونات -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الكوبونات</h5>
                        <p class="card-text display-4">{{ $coupons->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">الكوبونات المستخدمة</h5>
                        <p class="card-text display-4">{{ $coupons->where('is_used', true)->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title">الكوبونات غير المستخدمة</h5>
                        <p class="card-text display-4">{{ $coupons->where('is_used', false)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول عرض تفاصيل الكوبونات -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>الكوبون</th>
                    <th>الخصم (%)</th>
                    <th>الحالة وتفاصيل المستخدم</th>
                    <th>تاريخ الإنشاء</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->discount }}</td>
                        <td>
                            @if ($coupon->is_used && $coupon->user)
                                <span class="badge bg-success">مستخدم</span>
                                <br>
                                <small>{{ $coupon->user->name }}</small>
                                <br>
                                <small>{{ $coupon->user->email }}</small>
                            @else
                                <span class="badge bg-warning">غير مستخدم</span>
                            @endif
                        </td>
                        <td>{{ $coupon?->created_at?->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">لا توجد كوبونات مرتبطة بهذا الكتاب.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
