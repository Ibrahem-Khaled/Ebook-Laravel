<div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deletePostModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalLabel{{ $post->id }}">حذف المنشور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل أنت متأكد من رغبتك في حذف المنشور التالي:</p>
                    <h5 class="text-danger">{{ $post->title }}</h5>
                    <p class="text-muted">سيتم حذف جميع الصور والملفات المرتبطة بهذا المنشور أيضاً.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
