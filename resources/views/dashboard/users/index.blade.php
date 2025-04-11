@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">إدارة المستخدمين</h1>

        @include('components.alerts')

        <!-- شريط البحث -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="ابحث عن اسم أو بريد إلكتروني" name="query"
                    value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">بحث</button>
            </div>
        </form>

        <!-- زر إضافة مستخدم -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">
            إضافة مستخدم
        </button>

        <!-- جدول عرض المستخدمين -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الدور</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ optional($user->role)->role_name ?? 'غير محدد' }}</td>
                        <td class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}" >{{ $user->is_active ? 'نشط' : 'غير نشط' }}</td>
                        <td>
                            <!-- زر التعديل -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editUserModal{{ $user->id }}">
                                تعديل
                            </button>

                            <!-- زر الحذف -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                            </form>

                            <!-- زر إضافة كتب -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="#addBooksModal{{ $user->id }}">
                                إضافة كتب
                            </button>

                            <!-- زر عرض كتب المستخدم -->
                            <a href="{{ route('users.books', $user->id) }}" class="btn btn-primary btn-sm">
                                عرض كتب المستخدم
                            </a>

                            <!-- زر إضافة مؤلف وناشر -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#addAuthorPublisherModal{{ $user->id }}">
                                إضافة مؤلف وناشر
                            </button>
                        </td>
                    </tr>

                    <!-- Modal للتعديل -->
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">تعديل مستخدم</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @include('dashboard.users.user_form', ['user' => $user])
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal لإضافة كتب -->
                    <div class="modal fade" id="addBooksModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="addBooksModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addBooksModalLabel{{ $user->id }}">إضافة كتب للمستخدم
                                    </h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.addBooks', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="books" class="form-label">اختر الكتب</label>
                                            <select class="form-control" id="books" name="book_ids[]" multiple required>
                                                @foreach ($books as $book)
                                                    <option value="{{ $book->id }}">{{ $book->book_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">إضافة</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal لإضافة مؤلف وناشر -->
                    <div class="modal fade" id="addAuthorPublisherModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="addAuthorPublisherModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addAuthorPublisherModalLabel{{ $user->id }}">
                                        إضافة مؤلف وناشر للمستخدم</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.addAuthorAndPublisher', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="author_id_{{ $user->id }}" class="form-label">اختر
                                                المؤلف</label>
                                            <select class="form-control" id="author_id_{{ $user->id }}"
                                                name="author_id" required>
                                                <option value="">اختر المؤلف</option>
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author->id }}">{{ $author->author_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="publisher_id_{{ $user->id }}" class="form-label">اختر
                                                الناشر</label>
                                            <select class="form-control" id="publisher_id_{{ $user->id }}"
                                                name="publisher_id" required>
                                                <option value="">اختر الناشر</option>
                                                @foreach ($publishers as $publisher)
                                                    <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">إضافة</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Modal لإضافة مستخدم -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @include('dashboard.users.user_form', ['user' => null])
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
@endsection
