<!doctype html>
<html lang="ar">

<head>
    <title>المستخدمين</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- الخطوط والرموز -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />

    <!-- إضافة مكتبة Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <!-- CSS مخصص -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .page-header {
            background-image: url('{{ asset('img/bg-20.jpg') }}');
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .page-header h1 {
            color: white;
            text-align: center;
            padding-top: 150px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .btn-primary,
        .btn-danger,
        .btn-warn {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .btn-warn {
            background-color: #ff9800;
            color: #fff;
        }

        .btn-warn:hover {
            background-color: #e68900;
        }

        .btn-outline-primary {
            border-color: #ff9800;
            color: #ff9800;
        }

        .btn-outline-primary:hover {
            background-color: #ff9800;
            color: #fff;
        }

        .table th {
            font-weight: 700;
            background-color: #f8f9fa;
        }

        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }

        .modal-header {
            background-color: #ff9800;
            color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .modal-footer {
            border-top: none;
        }

        .select2-container--default .select2-selection--multiple {
            border-radius: 15px;
        }

        .form-control,
        .select2-selection {
            border-radius: 15px;
            box-shadow: none;
            border-color: #ddd;
        }

        .form-control:focus {
            border-color: #ff9800;
            box-shadow: 0 0 8px rgba(255, 152, 0, 0.4);
        }

        .input-group-text {
            background-color: #ff9800;
            color: #fff;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }
    </style>
</head>

<body>
    <!-- شريط التنقل -->
    @include('layouts.navigation')
    <!-- نهاية شريط التنقل -->

    @include('layouts.alerts')

    <div class="page-header">
        <h1>إدارة المستخدمين</h1>
    </div>

    <div class="card card-body shadow-xl mt-n5 mx-3 mx-md-4 p-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn btn-outline-primary mb-0 w-100" href="{{ route('dashboard.books') }}">
                    <svg style="margin-right: 0.5rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                    العودة
                </a>
            </div>
        </div>

        <div class="container">
            <div class="section text-left my-4">
                <form action="{{ route('users.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="ابحث عن مستخدم">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </form>

                <div class="row">
                    <div class="col">
                        <h2 class="title">المستخدمين</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            اضافة مستخدم جديد
                        </button>
                    </div>
                </div>

                <!-- Modal لإضافة مستخدم جديد -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">اضافة مستخدم جديد</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add.newUser') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">الاسم</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">الايميل</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">كلمة المرور</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">الصلاحية</label>
                                        <select class="form-control select2" id="role" name="role">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">اضافة</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (isset($users) && count($users) > 0)
                    <div class="card mt-4">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الدور</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الاسم</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الايميل</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ الانضمام</th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ اخر تحديث</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                @if (Auth::user()->role->role_name == 'admin')
                                                    <button type="button"
                                                        class="btn btn-outline-primary font-weight-normal"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateUserRoleModal{{ $user->id }}">
                                                        {{ $user->role->role_name }}
                                                    </button>

                                                    <div class="modal fade"
                                                        id="updateUserRoleModal{{ $user->id }}" tabindex="-1"
                                                        aria-labelledby="updateUserRoleModal{{ $user->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="updateUserRoleModal{{ $user->id }}Label">
                                                                        تحديث الصلاحية</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('update.user.role', $user->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="role"
                                                                                class="form-label">الصلاحية
                                                                                الجديدة</label>
                                                                            <select class="form-control select2"
                                                                                id="role" name="role">
                                                                                @foreach ($roles as $role)
                                                                                    <option
                                                                                        value="{{ $role->id }}"
                                                                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                                        {{ $role->role_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">تحديث</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{ Auth::user()->role->role_name }}
                                                @endif
                                            </td>

                                            <td>
                                                <p class="mb-0">{{ $user->name }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $user->email }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $user->created_at->format('Y-m-d') }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $user->updated_at->format('Y-m-d') }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.show.books', $user->id) }}"
                                                    class="btn btn-outline-primary mx-2 font-weight-normal"
                                                    data-toggle="tooltip" data-original-title="عرض المستخدم">عرض</a>

                                                @if ($user?->author()->exists() || $user?->publisher()->exists())
                                                    <a href="{{ route('user.followed.AuthorAndPublisher', $user->id) }}"
                                                        class="btn btn-outline-primary mx-2 font-weight-normal"
                                                        data-toggle="tooltip" data-original-title=" عرض من يتابع المستخدم">
                                                        عرض من يتابع المستخدم
                                                    </a>
                                                @endif

                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#addBookFromUser{{ $user->id }}"
                                                    class="btn btn-warn">اضافة كتب</button>

                                                <div class="modal fade" id="addBookFromUser{{ $user->id }}"
                                                    tabindex="-1" aria-labelledby="createCouponModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="createCouponModalLabel">
                                                                    اضافة كتب للمستخدم</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('user.addBooks') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <input type="hidden"
                                                                            value="{{ $user->id }}"
                                                                            class="form-control" id="user_id"
                                                                            name="user_id">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="book_ids">اختر الكتب:</label>
                                                                        <select class="form-select select2"
                                                                            id="book_ids" name="book_ids[]"
                                                                            multiple="multiple" required>
                                                                            @foreach ($books as $book)
                                                                                <option value="{{ $book->id }}">
                                                                                    {{ $book->book_title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">اضافة</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if (Auth::user()->role->role_name == 'admin')
                                                    <a href="#" class="btn btn-danger mx-2 font-weight-normal"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteConfirm{{ $user->id }}"
                                                        data-toggle="tooltip"
                                                        data-original-title="حذف المستخدم">حذف</a>
                                                @endif

                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal{{ $user->id }}"
                                                    class="btn btn-warn">تعديل</button>
                                                <div class="modal fade" id="editUserModal{{ $user->id }}"
                                                    tabindex="-1" aria-labelledby="editUserModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editUserModalLabel">تعديل
                                                                    بيانات المستخدم</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('user.update', $user->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="name">الاسم</label>
                                                                        <input type="text"
                                                                            value="{{ $user->name }}"
                                                                            class="form-control" id="name"
                                                                            name="name" required>

                                                                        <label for="email">الايميل</label>
                                                                        <input type="email"
                                                                            value="{{ $user->email }}"
                                                                            class="form-control" id="email"
                                                                            name="email">

                                                                        <label for="password">كلمة المرور</label>
                                                                        <input type="password" class="form-control"
                                                                            id="password" name="password">
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">تحديث</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#addAuthorAndPublisherFromUser{{ $user->id }}"
                                                    class="btn btn-danger">اضافة مؤلف وناشر</button>

                                                <div class="modal fade"
                                                    id="addAuthorAndPublisherFromUser{{ $user->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="addAuthorAndPublisherFromUserLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="addAuthorAndPublisherFromUserLabel">اضافة مؤلف
                                                                    وناشر</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('user.addAuthorAndPublisher', $user->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="user_id">المؤلفون</label>
                                                                        <select class="form-select" id="author_id"
                                                                            name="author_id">
                                                                            <option value="" selected disabled>
                                                                                اختر المؤلف</option>
                                                                            @foreach ($authors as $author)
                                                                                <option value="{{ $author->id }}">
                                                                                    {{ $author->author_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="publisher_id">الناشرون</label>
                                                                        <select class="form-select" id="publisher_id"
                                                                            name="publisher_id">
                                                                            <option value="" selected disabled>
                                                                                اختر الناشر</option>
                                                                            @foreach ($publishers as $publisher)
                                                                                <option value="{{ $publisher->id }}">
                                                                                    {{ $publisher->publisher_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <button type="submit"
                                                                        class="btn btn-primary">إنشاء</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <div class="modal fade" id="deleteConfirm{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="deleteConfirmLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" style="margin-top: 10rem;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteConfirmLabel">تأكيد
                                                                الحذف</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل أنت متأكد أنك تريد حذف '{{ $user->name }}' ؟<br><br>
                                                            هذا الإجراء لا يمكن التراجع عنه وقد يؤثر على جميع البيانات
                                                            المرتبطة بهذا المستخدم.
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn bg-gradient-dark mb-0"
                                                                data-bs-dismiss="modal">إلغاء</button>
                                                            <form method="POST"
                                                                action="{{ route('user.delete', $user->id) }}">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn bg-gradient-danger mb-0">حذف</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $users->links() }}
                @else
                    <br>
                    <div class="row">
                        <div class="col">
                            <p class="display-4" style="font-size: x-large">لا توجد بيانات للمستخدمين.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "اختر الكتب",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
