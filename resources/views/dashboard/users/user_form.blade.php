<!-- ملف: resources/views/components/user_form.blade.php -->

@csrf
@if (isset($user))
    @method('PUT')
@endif

<div class="mb-3">
    <label for="name" class="form-label">الاسم</label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ isset($user) ? $user->name : old('name') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">البريد الإلكتروني</label>
    <input type="email" class="form-control" id="email" name="email"
        value="{{ isset($user) ? $user->email : old('email') }}" required>
</div>

<div class="mb-3">
    <label for="password" class="form-label">كلمة المرور</label>
    <input type="password" class="form-control" id="password" name="password" {{ !isset($user) ? 'required' : '' }}>
    @if (isset($user))
        <small class="text-muted">اتركها فارغة إذا لم ترغب في تغيير كلمة المرور.</small>
    @endif
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">الحالة</label>
    <select class="form-control" id="is_active" name="is_active" required>
        <option value="1" {{ isset($user) && $user->is_active ? 'selected' : '' }}>نشط</option>
        <option value="0" {{ isset($user) && !$user->is_active ? 'selected' : '' }}>غير نشط</option>        
    </select>
</div>
<div class="mb-3">
    <label for="role_id" class="form-label">الدور</label>
    <select class="form-control" id="role_id" name="role_id" required>
        <option value="">اختر الدور</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ isset($user) && $user->role_id == $role->id ? 'selected' : '' }}>
                {{ $role->role_name }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">
    {{ isset($user) ? 'تحديث' : 'حفظ' }}
</button>
