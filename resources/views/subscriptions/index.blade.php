<!doctype html>
<html lang="ar">

<head>
    <title>التجارة الإلكترونية</title>
    <!-- الوسوم الضرورية -->
    <meta charset="UTF-8">

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     الخطوط والرموز     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href={{ asset('icons/icons.css') }}>
    <!-- الرموز المادية -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- نمط Material Kit -->
    <link href={{ asset('css/material-kit.css') }} rel="stylesheet" />
</head>

<body>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>إدارة الاشتراكات</h1>

        <a href="{{ route('dashboard.books') }}" class="btn btn-secondary mb-3">رجوع</a>

        <!-- زر لإضافة اشتراك جديد -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubscriptionModal">إضافة اشتراك
            جديد</button>

        <!-- قائمة الاشتراكات -->
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>السعر</th>
                    <th>المدة</th>
                    <th>الحالة</th>
                    <th>عدد المشتركين</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>
                            <a href="{{ route('subscriptions.users', $subscription->id) }}">
                                {{ $subscription->title }}
                            </a>
                        </td>
                        <td>{{ $subscription->description }}</td>
                        <td>{{ $subscription->price }}</td>
                        <td>{{ $subscription->duration }}</td>
                        <td>{{ $subscription->is_active ? 'نشط' : 'غير نشط' }}</td>
                        <td>{{ $subscription->users_count }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editSubscriptionModal{{ $subscription->id }}">تعديل</button>
                            <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>

                    <!-- مودال تعديل -->
                    <div class="modal fade" id="editSubscriptionModal{{ $subscription->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">تعديل الاشتراك</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="title">العنوان</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $subscription->title }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description">الوصف</label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $subscription->description }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="price">السعر</label>
                                            <input type="number" name="price" class="form-control"
                                                value="{{ $subscription->price }}" step="0.01" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="duration">المدة</label>
                                            <input type="number" name="duration" class="form-control"
                                                value="{{ $subscription->duration }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="is_active">حالة الاشتراك</label>
                                            <select name="is_active" id="is_active" class="form-control" required>
                                                <option value="1"
                                                    {{ $subscription->is_active ? 'selected' : '' }}>نشط
                                                </option>
                                                <option value="0"
                                                    {{ !$subscription->is_active ? 'selected' : '' }}>غير
                                                    نشط</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- مودال إضافة -->
    <div class="modal fade" id="addSubscriptionModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('subscriptions.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة اشتراك جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- العنوان -->
                        <div class="mb-3">
                            <label for="title">العنوان</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <!-- الوصف -->
                        <div class="mb-3">
                            <label for="description">الوصف</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- أيقونة -->
                        <div class="mb-3">
                            <label for="icon">الأيقونة</label>
                            <input type="image" name="icon" id="icon" class="form-control">
                        </div>

                        <!-- السعر -->
                        <div class="mb-3">
                            <label for="price">السعر</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>

                        <!-- المدة -->
                        <div class="mb-3">
                            <label for="duration">المدة</label>
                            <input type="number" name="duration" id="duration" class="form-control" required>
                        </div>

                        <!-- حالة الاشتراك -->
                        <div class="mb-3">
                            <label for="is_active">حالة الاشتراك</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1">نشط</option>
                                <option value="0">غير نشط</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>

</body>

</html>
