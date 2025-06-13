<div class="modal fade" id="deleteBookModal{{ $book->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteBookModalLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBookModalLabel{{ $book->id }}">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من رغبتك في حذف الكتاب "<strong>{{ $book->book_title }}</strong>"؟</p>
                <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه!</p>

                @if ($book->book_pdf || $book->book_image_url)
                    <div class="alert alert-warning">
                        <p>سيتم أيضاً حذف الملفات التالية:</p>
                        <ul>
                            @if ($book->book_pdf)
                                <li>ملف PDF: {{ basename($book->book_pdf) }}</li>
                            @endif
                            @if ($book->book_image_url)
                                <li>صورة الغلاف: {{ basename($book->book_image_url) }}</li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
