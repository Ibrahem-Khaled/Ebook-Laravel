@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- العمود الجانبي (الصورة والمعلومات الأساسية) -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <!-- صورة المستخدم -->
                        <div class="avatar-profile mb-3">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle img-thumbnail"
                                    width="150" alt="صورة المستخدم">
                            @else
                                <img src="https://via.placeholder.com/150" class="rounded-circle img-thumbnail"
                                    width="150" alt="صورة افتراضية">
                            @endif
                        </div>
                        <!-- الاسم -->
                        <h3 class="mb-2">{{ $user->name }}</h3>
                        <!-- الدور -->
                        <p class="text-muted mb-1">
                            <i class="fas fa-user-tag"></i> {{ $user->role == 'admin' ? 'مدير' : 'مستخدم' }}
                        </p>
                        <!-- الحالة -->
                        <p class="mb-3">
                            <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $user->status ? 'نشط' : 'غير نشط' }}
                            </span>
                        </p>
                        <!-- زر التعديل -->
                        {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit"></i> تعديل البروفايل
                        </a> --}}
                    </div>
                </div>
            </div>

            <!-- العمود الرئيسي (تفاصيل البروفايل) -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="card-title mb-4">معلومات البروفايل</h4>

                        <!-- البريد الإلكتروني -->
                        <div class="info-item mb-3">
                            <h6><i class="fas fa-envelope me-2"></i> البريد الإلكتروني</h6>
                            <p class="text-muted">{{ $user->email ?? 'غير متوفر' }}</p>
                        </div>

                        <!-- الهاتف -->
                        <div class="info-item mb-3">
                            <h6><i class="fas fa-phone me-2"></i> الهاتف</h6>
                            <p class="text-muted">{{ $user->phone ?? 'غير متوفر' }}</p>
                        </div>

                        <!-- العنوان -->
                        <div class="info-item mb-3">
                            <h6><i class="fas fa-map-marker-alt me-2"></i> العنوان</h6>
                            <p class="text-muted">{{ $user->address ?? 'غير متوفر' }}</p>
                        </div>

                        <!-- تاريخ الإنشاء -->
                        <div class="info-item mb-3">
                            <h6><i class="fas fa-calendar-alt me-2"></i> تاريخ الإنشاء</h6>
                            <p class="text-muted">{{ $user?->created_at?->format('Y/m/d') ?? 'غير متوفر' }}</p>
                        </div>

                        <!-- معلومات إضافية -->
                        <div class="info-item mb-3">
                            <h6><i class="fas fa-info-circle me-2"></i> معلومات إضافية</h6>
                            <p class="text-muted">
                                هذا المستخدم لديه دور <strong>{{ $user->role == 'admin' ? 'مدير' : 'مستخدم' }}</strong> وهو
                                <strong>{{ $user->status ? 'نشط' : 'غير نشط' }}</strong> في النظام.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* تخصيصات إضافية */
        .avatar-profile {
            border: 3px solid #e9ecef;
            padding: 5px;
            display: inline-block;
            border-radius: 50%;
        }

        .info-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .card {
            border-radius: 10px;
        }

        .shadow-sm {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary {
            border-radius: 20px;
        }
    </style>
@endsection
