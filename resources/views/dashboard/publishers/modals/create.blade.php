<div class="modal fade" id="createPublisherModal" tabindex="-1" role="dialog" aria-labelledby="createPublisherModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPublisherModalLabel">إضافة ناشر جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('publishers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="publisher_name">اسم الناشر <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="publisher_name" name="publisher_name"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="image">صورة الناشر</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">اختر ملف...</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fb">فيسبوك</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="fb" name="fb"
                                        placeholder="https://facebook.com/username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="yt">يوتيوب</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-youtube text-danger"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="yt" name="yt"
                                        placeholder="https://youtube.com/username">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc">وصف الناشر</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="telegram">تلجرام</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-telegram"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="telegram" name="telegram"
                                        placeholder="https://t.me/username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="whatsapp">واتساب</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fab fa-whatsapp text-success"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                        placeholder="رقم الهاتف مع رمز الدولة">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="instagram">إنستجرام</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fab fa-instagram text-warning"></i></span>
                                    </div>
                                    <input type="url" class="form-control" id="instagram" name="instagram"
                                        placeholder="https://instagram.com/username">
                                </div>
                            </div>
                        </div>
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
