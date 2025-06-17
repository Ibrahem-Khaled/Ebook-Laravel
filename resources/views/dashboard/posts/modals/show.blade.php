<div class="modal fade" id="showPostModal{{ $post->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showPostModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showPostModalLabel{{ $post->id }}">عرض المنشور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>{{ $post->title }}</h4>
                <p class="text-muted">
                    بواسطة: {{ $post->user->name ?? 'غير محدد' }} |
                    الحالة: <span class="badge badge-{{ $post->status === 'published' ? 'success' : 'secondary' }}">
                        {{ $post->status === 'published' ? 'منشور' : 'مسودة' }}
                    </span> |
                    تاريخ الإنشاء: {{ $post->created_at->format('Y-m-d') }}
                </p>

                <hr>

                <div class="mb-4">
                    {!! $post->description !!}
                </div>

                @if ($post->images && count(json_decode($post->images)))
                    <h5>الصور المرفقة:</h5>
                    <div class="row">
                        @foreach (json_decode($post->images) as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail"
                                    style="max-height: 200px;">
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($post->files && count(json_decode($post->files)))
                    <h5>الملفات المرفقة:</h5>
                    <ul class="list-group">
                        @foreach (json_decode($post->files) as $file)
                            <li class="list-group-item">
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-primary">
                                    <i class="fas fa-file-download mr-2"></i> {{ basename($file) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
