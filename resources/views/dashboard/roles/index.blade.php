@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">إدارة الأدوار</h1>

        @include('components.alerts')

        <!-- زر إضافة دور -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addRoleModal">
            إضافة دور
        </button>

        <!-- جدول عرض الأدوار -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الدور</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->role_name }}</td>
                        <td>
                            <!-- زر تعديل الدور -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editRoleModal{{ $role->id }}">
                                تعديل
                            </button>
                            <!-- زر حذف الدور -->
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا الدور؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- مودال تعديل الدور -->
                    <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1"
                        aria-labelledby="editRoleModalLabel{{ $role->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRoleModalLabel{{ $role->id }}">تعديل الدور</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="role_name_{{ $role->id }}" class="form-label">اسم الدور</label>
                                            <input type="text" name="role_name" id="role_name_{{ $role->id }}"
                                                class="form-control" value="{{ $role->role_name }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">تحديث</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- مودال إضافة دور -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoleModalLabel">إضافة دور جديد</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="role_name" class="form-label">اسم الدور</label>
                                <input type="text" name="role_name" id="role_name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
        }
    </style>
@endsection
