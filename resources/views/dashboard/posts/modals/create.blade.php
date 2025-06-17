<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">إضافة منشور جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">العنوان</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">المحتوى</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user_id">المستخدم</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">اختر مستخدم...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">الحالة</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="published">منشور</option>
                                <option value="draft">مسودة</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="images">الصور</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="images" name="images[]" multiple
                                onchange="previewImages(this, 'imagesPreview')">
                            <label class="custom-file-label" for="images">اختر الصور...</label>
                        </div>
                        <small class="form-text text-muted">يمكنك اختيار أكثر من صورة</small>
                        <div id="imagesPreview" class="mt-2"></div>
                    </div>

                    <div class="form-group">
                        <label for="files">الملفات</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="files" name="files[]" multiple>
                            <label class="custom-file-label" for="files">اختر الملفات...</label>
                        </div>
                        <small class="form-text text-muted">يمكنك اختيار أكثر من ملف (PDF, Word, Excel)</small>
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
