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

        <h1>إدارة المستخدمين للاشتراك: {{ $subscription->title }}</h1>
        
        <!-- قائمة المستخدمين المشتركين -->
        <h2>المستخدمون المشتركين</h2>
        <a href="{{ route('dashboard.books') }}" class="btn btn-secondary mb-3">رجوع</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المستخدم</th>
                    <th>البريد الإلكتروني</th>
                    <th>تاريخ انتهاء الاشتراك</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('history.read.index', $user->id) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->pivot->expiry_date }}</td>
                        <td>
                            <form action="{{ route('subscriptions.users.remove', [$subscription->id, $user->id]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">إزالة</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- إضافة مستخدم جديد -->
        <h2>إضافة مستخدم جديد</h2>
        <form action="{{ route('subscriptions.users.add', $subscription->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id">اختر مستخدم</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">اختر مستخدم</option>
                    @foreach ($allUsers as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إضافة</button>
        </form>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>

</body>

</html>
