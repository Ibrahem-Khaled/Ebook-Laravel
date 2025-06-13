<div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editBookModalLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookModalLabel{{ $book->id }}">تعديل الكتاب: {{ $book->book_title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_book_title_{{ $book->id }}">عنوان الكتاب <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_book_title_{{ $book->id }}"
                                    name="book_title" value="{{ $book->book_title }}" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_book_isbn_{{ $book->id }}">رقم ISBN</label>
                                <input type="text" class="form-control" id="edit_book_isbn_{{ $book->id }}"
                                    name="book_isbn" value="{{ $book->book_isbn }}">
                            </div>

                            <div class="form-group">
                                <label for="edit_author_id_{{ $book->id }}">المؤلف</label>
                                <select class="form-control select2" id="edit_author_id_{{ $book->id }}"
                                    name="author_id">
                                    <option value="">اختر المؤلف...</option>
                                    @foreach (App\Models\Author::all() as $author)
                                        <option value="{{ $author->id }}"
                                            {{ $book->author_id == $author->id ? 'selected' : '' }}>
                                            {{ $author->author_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_publisher_id_{{ $book->id }}">الناشر</label>
                                <select class="form-control select2" id="edit_publisher_id_{{ $book->id }}"
                                    name="publisher_id">
                                    <option value="">اختر الناشر...</option>
                                    @foreach (App\Models\Publisher::all() as $publisher)
                                        <option value="{{ $publisher->id }}"
                                            {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>
                                            {{ $author->publisher_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_category_id_{{ $book->id }}">القسم الرئيسي</label>
                                <select class="form-control select2" id="edit_category_id_{{ $book->id }}"
                                    name="category_id">
                                    <option value="">اختر القسم الرئيسي...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_subcategory_id_{{ $book->id }}">القسم الفرعي</label>
                                <select class="form-control select2" id="edit_subcategory_id_{{ $book->id }}"
                                    name="subcategory_id">
                                    <option value="">اختر القسم الفرعي...</option>
                                    @if ($book->category)
                                        @foreach ($book->category->subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ $book->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_book_price_{{ $book->id }}">السعر (ر.س)</label>
                                <input type="number" step="0.01" class="form-control"
                                    id="edit_book_price_{{ $book->id }}" name="book_price"
                                    value="{{ $book->book_price }}">
                            </div>

                            <div class="form-group">
                                <label for="edit_book_discount_{{ $book->id }}">الخصم (%)</label>
                                <input type="number" min="0" max="100" class="form-control"
                                    id="edit_book_discount_{{ $book->id }}" name="book_discount"
                                    value="{{ $book->book_discount }}">
                            </div>

                            <div class="form-group">
                                <label for="edit_book_publication_date_{{ $book->id }}">تاريخ النشر</label>
                                <input type="date" class="form-control"
                                    id="edit_book_publication_date_{{ $book->id }}" name="book_publication_date"
                                    value="{{ $book->book_publication_date ? $book->book_publication_date->format('Y-m-d') : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="edit_book_number_pages_{{ $book->id }}">عدد الصفحات</label>
                                <input type="number" class="form-control"
                                    id="edit_book_number_pages_{{ $book->id }}" name="book_number_pages"
                                    value="{{ $book->book_number_pages }}">
                            </div>

                            <div class="form-group">
                                <label for="edit_book_image_url_{{ $book->id }}">صورة الغلاف</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="edit_book_image_url_{{ $book->id }}" name="book_image_url">
                                    <label class="custom-file-label"
                                        for="edit_book_image_url_{{ $book->id }}">اختر ملف...</label>
                                </div>
                                @if ($book->book_image_url)
                                    <small class="form-text text-muted">
                                        الصورة الحالية: <a href="{{ asset('storage/' . $book->book_image_url) }}"
                                            target="_blank">عرض</a>
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="edit_book_pdf_{{ $book->id }}">ملف PDF</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="edit_book_pdf_{{ $book->id }}" name="book_pdf">
                                    <label class="custom-file-label" for="edit_book_pdf_{{ $book->id }}">اختر
                                        ملف...</label>
                                </div>
                                @if ($book->book_pdf)
                                    <small class="form-text text-muted">
                                        الملف الحالي: <a href="{{ asset('storage/' . $book->book_pdf) }}"
                                            target="_blank">عرض</a>
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_book_description_{{ $book->id }}">وصف الكتاب</label>
                                <textarea class="form-control" id="edit_book_description_{{ $book->id }}" name="book_description"
                                    rows="3">{{ $book->book_description }}</textarea>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                    id="edit_is_active_{{ $book->id }}" name="is_active" value="1"
                                    {{ $book->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="edit_is_active_{{ $book->id }}">نشط</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                    id="edit_free_sample_{{ $book->id }}" name="free_sample" value="1"
                                    {{ $book->free_sample ? 'checked' : '' }}>
                                <label class="form-check-label" for="edit_free_sample_{{ $book->id }}">عينة
                                    مجانية</label>
                            </div>

                            <div class="form-group mt-3">
                                <label for="edit_sort_order_{{ $book->id }}">ترتيب العرض</label>
                                <input type="number" class="form-control" id="edit_sort_order_{{ $book->id }}"
                                    name="sort_order" value="{{ $book->sort_order }}">
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
