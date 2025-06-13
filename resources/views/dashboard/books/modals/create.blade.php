<div class="modal fade" id="createBookModal" tabindex="-1" role="dialog" aria-labelledby="createBookModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBookModalLabel">إضافة كتاب جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="book_title">عنوان الكتاب <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="book_title" name="book_title" required>
                            </div>

                            <div class="form-group">
                                <label for="book_isbn">رقم ISBN</label>
                                <input type="text" class="form-control" id="book_isbn" name="book_isbn">
                            </div>

                            <div class="form-group">
                                <label for="author_id">المؤلف</label>
                                <select class="form-control select2" id="author_id" name="author_id">
                                    <option value="">اختر المؤلف...</option>
                                    @foreach (App\Models\Author::all() as $author)
                                        <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="publisher_id">الناشر</label>
                                <select class="form-control select2" id="publisher_id" name="publisher_id">
                                    <option value="">اختر الناشر...</option>
                                    @foreach (App\Models\Publisher::all() as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $author->publisher_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category_id">القسم الرئيسي</label>
                                <select class="form-control select2" id="category_id" name="category_id">
                                    <option value="">اختر القسم الرئيسي...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subcategory_id">القسم الفرعي</label>
                                <select class="form-control select2" id="subcategory_id" name="subcategory_id">
                                    <option value="">اختر القسم الفرعي...</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="book_price">السعر (ر.س)</label>
                                <input type="number" step="0.01" class="form-control" id="book_price"
                                    name="book_price">
                            </div>

                            <div class="form-group">
                                <label for="book_discount">الخصم (%)</label>
                                <input type="number" min="0" max="100" class="form-control"
                                    id="book_discount" name="book_discount" value="0">
                            </div>

                            <div class="form-group">
                                <label for="book_publication_date">تاريخ النشر</label>
                                <input type="date" class="form-control" id="book_publication_date"
                                    name="book_publication_date">
                            </div>

                            <div class="form-group">
                                <label for="book_number_pages">عدد الصفحات</label>
                                <input type="number" class="form-control" id="book_number_pages"
                                    name="book_number_pages">
                            </div>

                            <div class="form-group">
                                <label for="book_image_url">صورة الغلاف</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="book_image_url"
                                        name="book_image_url">
                                    <label class="custom-file-label" for="book_image_url">اختر ملف...</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="book_pdf">ملف PDF</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="book_pdf" name="book_pdf">
                                    <label class="custom-file-label" for="book_pdf">اختر ملف...</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="book_description">وصف الكتاب</label>
                                <textarea class="form-control" id="book_description" name="book_description" rows="3"></textarea>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="is_active">نشط</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="free_sample" name="free_sample"
                                    value="1">
                                <label class="form-check-label" for="free_sample">عينة مجانية</label>
                            </div>

                            <div class="form-group mt-3">
                                <label for="sort_order">ترتيب العرض</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order">
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
