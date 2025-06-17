<div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">تعديل المنشور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">العنوان</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $post->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">المحتوى</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required>{{ $post->description }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="user_id">المستخدم</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">اختر مستخدم...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $post->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">الحالة</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>منشور
                                </option>
                                <option value="draft" {{ $post->status === 'draft' ? 'selected' : '' }}>مسودة</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>الصور الحالية</label>
                        @if ($post->images && count(json_decode($post->images)))
                            <div class="row">
                                @foreach (json_decode($post->images) as $index => $image)
                                    <div class="col-md-3 mb-2">
                                        <div class="thumbnail-container">
                                            <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail"
                                                style="max-height: 100px;">
                                            <a href="{{ route('posts.deleteImage', ['post' => $post->id, 'imageIndex' => $index]) }}"
                                                class="btn btn-sm btn-danger thumbnail-remove"
                                                onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">لا توجد صور مرفقة</p>
                        @endif

                        <label for="edit_images">إضافة صور جديدة</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit_images" name="images[]" multiple
                                onchange="previewImages(this, 'editImagesPreview')">
                            <label class="custom-file-label" for="edit_images">اختر الصور...</label>
                        </div>
                        <small class="form-text text-muted">يمكنك اختيار أكثر من صورة</small>
                        <div id="editImagesPreview" class="mt-2"></div>
                    </div>

                    <div class="form-group">
                        <label>الملفات الحالية</label>
                        @if ($post->files && count(json_decode($post->files)))
                            <ul class="list-group">
                                @foreach (json_decode($post->files) as $index => $file)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-primary">
                                            <i class="fas fa-file-download mr-2"></i> {{ basename($file) }}
                                        </a>
                                        <a href="{{ route('posts.deleteFile', ['post' => $post->id, 'fileIndex' => $index]) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا الملف؟')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">لا توجد ملفات مرفقة</p>
                        @endif

                        <label for="edit_files">إضافة ملفات جديدة</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit_files" name="files[]" multiple>
                            <label class="custom-file-label" for="edit_files">اختر الملفات...</label>
                        </div>
                        <small class="form-text text-muted">يمكنك اختيار أكثر من ملف (PDF, Word, Excel)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
