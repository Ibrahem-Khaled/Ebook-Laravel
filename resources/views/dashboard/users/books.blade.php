@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">كتب المستخدم: {{ $user->name }}</h1>

        <!-- زر العودة -->
        <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> العودة إلى قائمة المستخدمين
        </a>

        <!-- عرض الكتب -->
        <div class="row">
            @forelse ($userBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top"
                            alt="{{ $book->book_title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->book_title }}</h5>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            <p class="card-text"><strong>المؤلف:</strong> {{ $book->author->author_name }}</p>
                            <p class="card-text"><strong>الناشر:</strong> {{ $book->publisher->publisher_name }}</p>
                            <p class="card-text"><strong>تاريخ النشر:</strong> {{ $book->book_publication_date }}</p>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                            <!-- زر عرض التفاصيل إن وجد -->
                            {{-- <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> عرض التفاصيل
                            </a> --}}
                            <!-- زر الحذف -->
                            <form action="{{ route('user.book.destroy', ['userId' => $user->id, 'bookId' => $book->id]) }}"
                                method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fas fa-trash-alt"></i> حذف الكتاب
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5" role="alert" style="border-radius: 10px;">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <h4 class="alert-heading">لا توجد كتب مضافة!</h4>
                        <p class="mb-0">عفواً، لم يتم إضافة أي كتب لهذا المستخدم بعد. قم بإضافة الكتب الآن لتظهر هنا.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $userBooks->links() }}
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-footer {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
@endsection
