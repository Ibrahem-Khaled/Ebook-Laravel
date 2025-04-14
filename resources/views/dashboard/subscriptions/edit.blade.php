<div class="modal fade" id="editSubscriptionModal{{ $subscription->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i> تعديل الاشتراك
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">عنوان الاشتراك</label>
                        <input type="text" name="title" class="form-control" value="{{ $subscription->title }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control" rows="3">{{ $subscription->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الأيقونة (اختياري)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-icons"></i></span>
                            <input type="text" name="icon" class="form-control" value="{{ $subscription->icon }}"
                                placeholder="مثال: fas fa-crown">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">السعر (ر.س)</label>
                                <input type="number" name="price" class="form-control"
                                    value="{{ $subscription->price }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">المدة</label>
                                <select name="duration" class="form-select" required>
                                    <option value="1" {{ $subscription->duration == 1 ? 'selected' : '' }}>شهر واحد
                                    </option>
                                    <option value="2" {{ $subscription->duration == 2 ? 'selected' : '' }}>شهرين
                                    </option>
                                    <option value="3" {{ $subscription->duration == 3 ? 'selected' : '' }}>3 أشهر
                                    </option>
                                    <option value="6" {{ $subscription->duration == 6 ? 'selected' : '' }}>6 أشهر
                                    </option>
                                    <option value="12" {{ $subscription->duration == 12 ? 'selected' : '' }}>سنة
                                        كاملة</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active"
                                id="isActive{{ $subscription->id }}" {{ $subscription->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive{{ $subscription->id }}">اشتراك نشط</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
