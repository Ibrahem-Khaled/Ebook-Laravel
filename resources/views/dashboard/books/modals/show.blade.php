<div class="modal fade" id="showBookModal{{ $book->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showBookModalLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showBookModalLabel{{ $book->id }}">تفاصيل الكتاب:
                    {{ $book->book_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($book->book_image_url)
                            <img src="{{ asset('storage/' . $book->book_image_url) }}" alt="{{ $book->book_title }}"
                                class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @else
                            <img src="{{ asset('img/default-book.png') }}" alt="صورة افتراضية"
                                class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @endif

                        <div class="d-flex justify-content-center mb-3">
                            <span class="badge badge-{{ $book->is_active ? 'success' : 'danger' }} p-2 mr-2">
                                {{ $book->is_active ? 'نشط' : 'غير نشط' }}
                            </span>

                            @if ($book->free_sample)
                                <span class="badge badge-info p-2">عينة مجانية</span>
                            @endif
                        </div>

                        @if ($book->book_pdf)
                            <a href="{{ asset('storage/' . $book->book_pdf) }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-download"></i> تحميل الكتاب
                            </a>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <h4>{{ $book->book_title }}</h4>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>رقم ISBN:</strong> {{ $book->book_isbn ?? 'غير محدد' }}</p>
                                <p><strong>المؤلف:</strong> {{ $book->author->name ?? 'غير محدد' }}</p>
                                <p><strong>الناشر:</strong> {{ $book->publisher->name ?? 'غير محدد' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>القسم الرئيسي:</strong> {{ $book->category->name ?? 'غير محدد' }}</p>
                                <p><strong>القسم الفرعي:</strong> {{ $book->subcategory->name ?? 'غير محدد' }}</p>
                                <p><strong>تاريخ النشر:</strong>
                                    {{ $book?->book_publication_date ? $book?->book_publication_date->format('Y-m-d') : 'غير محدد' }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>عدد الصفحات:</strong> {{ $book->book_number_pages ?? 'غير محدد' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>ترتيب العرض:</strong> {{ $book->sort_order ?? 'غير محدد' }}</p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <strong>السعر</strong>
                            </div>
                            <div class="card-body">
                                @if ($book->book_discount > 0)
                                    <h5 class="text-danger"><del>{{ $book->book_price }} ر.س</del></h5>
                                    <h4 class="text-success">
                                        {{ $book->book_price - ($book->book_price * $book->book_discount) / 100 }} ر.س
                                    </h4>
                                    <span class="badge badge-success">خصم {{ $book->book_discount }}%</span>
                                @else
                                    <h4>{{ $book->book_price ?? '0' }} ر.س</h4>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-light">
                                <strong>وصف الكتاب</strong>
                            </div>
                            <div class="card-body">
                                {!! nl2br(e($book->book_description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
