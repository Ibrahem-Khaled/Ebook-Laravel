<div class="modal fade" id="deletePublisherModal{{ $publisher->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deletePublisherModalLabel{{ $publisher->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePublisherModalLabel{{ $publisher->id }}">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من رغبتك في حذف الناشر "<strong>{{ $publisher->publisher_name }}</strong>"؟</p>
                <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه!</p>

                @if ($publisher->image)
                    <div class="alert alert-warning">
                        <p>سيتم أيضاً حذف الصورة التالية:</p>
                        <ul>
                            <li>{{ basename($publisher->image) }}</li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
