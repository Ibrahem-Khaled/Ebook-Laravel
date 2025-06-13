<div class="modal fade" id="editPublisherModal{{ $publisher->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editPublisherModalLabel{{ $publisher->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPublisherModalLabel{{ $publisher->id }}">تعديل الناشر:
                    {{ $publisher->publisher_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('publishers.update', $publisher->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_publisher_name_{{ $publisher->id }}">اسم الناشر <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_publisher_name_{{ $publisher->id }}"
                                    name="publisher_name" value="{{ $publisher->publisher_name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_image_{{ $publisher->id }}">صورة الناشر</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_image_{{ $publisher->id }}"
                                        name="image">
                                    <label class="custom-file-label" for="edit_image_{{ $publisher->id }}">اختر
                                        ملف...</label>
                                </div>
                                @if ($publisher->image)
                                    <small class="form-text text-muted">
                                        الصورة الحالية: <a href="{{ asset('storage/' . $publisher->image) }}"
                                            target="_blank">عرض</a>
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="edit_fb_{{ $publisher->id }}">فيسبوك</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="edit_fb_{{ $publisher->id }}"
                                        name="fb" value="{{ $publisher->fb }}"
                                        placeholder="https://facebook.com/username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_yt_{{ $publisher->id }}">يوتيوب</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-youtube text-danger"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="edit_yt_{{ $publisher->id }}"
                                        name="yt" value="{{ $publisher->yt }}"
                                        placeholder="https://youtube.com/username">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_desc_{{ $publisher->id }}">وصف الناشر</label>
                                <textarea class="form-control" id="edit_desc_{{ $publisher->id }}" name="desc" rows="3">{{ $publisher->desc }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_telegram_{{ $publisher->id }}">تلجرام</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="edit_telegram_{{ $publisher->id }}"
                                        name="telegram" value="{{ $publisher->telegram }}"
                                        placeholder="https://t.me/username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_whatsapp_{{ $publisher->id }}">واتساب</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fab fa-whatsapp text-success"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit_whatsapp_{{ $publisher->id }}"
                                        name="whatsapp" value="{{ $publisher->whatsapp }}"
                                        placeholder="رقم الهاتف مع رمز الدولة">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_instagram_{{ $publisher->id }}">إنستجرام</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fab fa-instagram text-warning"></i></span>
                                    </div>
                                    <input type="url" class="form-control"
                                        id="edit_instagram_{{ $publisher->id }}" name="instagram"
                                        value="{{ $publisher->instagram }}"
                                        placeholder="https://instagram.com/username">
                                </div>
                            </div>
                        </div>
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
