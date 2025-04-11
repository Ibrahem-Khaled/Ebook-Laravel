@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center my-4">لوحة التحكم</h1>

        <!-- إحصائيات سريعة -->
        <div class="row">
            <!-- إحصائيات المستخدمين -->
            <div class="col-md-3">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">المستخدمين</h5>
                                <p class="card-text">{{ $users->count() }}</p>
                            </div>
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- إحصائيات الكتب -->
            <div class="col-md-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">الكتب</h5>
                                <p class="card-text">{{ $books->count() }}</p>
                            </div>
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- إحصائيات المشتركين -->
            <div class="col-md-3">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">المشتركين</h5>
                                <p class="card-text">{{ $subscribersCount }}</p>
                            </div>
                            <i class="fas fa-user-check fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- إحصائيات الكوبونات -->
            <div class="col-md-3">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">الكوبونات</h5>
                                <p class="card-text">{{ $coupons->count() }}</p>
                            </div>
                            <i class="fas fa-tags fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- رسوم بيانية -->
        <div class="row my-4">
            <!-- توزيع الكتب حسب الفئات -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">توزيع الكتب حسب الفئات</div>
                    <div class="card-body">
                        <canvas id="booksByCategoryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- توزيع المستخدمين حسب الاشتراكات -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">توزيع المستخدمين حسب الاشتراكات</div>
                    <div class="card-body">
                        <canvas id="usersBySubscriptionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول آخر الكتب المضافة -->
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">آخر الكتب المضافة</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الكتاب</th>
                                    <th>المؤلف</th>
                                    <th>الناشر</th>
                                    <th>تاريخ الإضافة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books->take(5) as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author->name }}</td>
                                        <td>{{ $book->publisher->name }}</td>
                                        <td>{{ $book->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- إحصائيات أخرى -->
        <div class="row my-4">
            <!-- إحصائيات المؤلفين -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">المؤلفين</div>
                    <div class="card-body">
                        <canvas id="authorsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- إحصائيات الناشرين -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">الناشرين</div>
                    <div class="card-body">
                        <canvas id="publishersChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- إحصائيات الفئات -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">الفئات</div>
                    <div class="card-body">
                        <canvas id="categoriesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول آخر المستخدمين المسجلين -->
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">آخر المستخدمين المسجلين</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المستخدم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>تاريخ التسجيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users->take(5) as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user?->created_at?->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // رسم بياني لتوزيع الكتب حسب الفئات
        const booksByCategoryCtx = document.getElementById('booksByCategoryChart').getContext('2d');
        const booksByCategoryChart = new Chart(booksByCategoryCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categories->pluck('name')) !!},
                datasets: [{
                    label: 'عدد الكتب',
                    data: {!! json_encode(
                        $categories->map(function ($category) {
                            return $category->books->count();
                        }),
                    ) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // رسم بياني لتوزيع المستخدمين حسب الاشتراكات
        const usersBySubscriptionCtx = document.getElementById('usersBySubscriptionChart').getContext('2d');
        const usersBySubscriptionChart = new Chart(usersBySubscriptionCtx, {
            type: 'pie',
            data: {
                labels: ['مشتركين', 'غير مشتركين'],
                datasets: [{
                    label: 'عدد المستخدمين',
                    data: [{{ $subscribersCount }}, {{ $users->count() - $subscribersCount }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'توزيع المستخدمين حسب الاشتراكات'
                    }
                }
            }
        });

        // رسم بياني للمؤلفين
        const authorsCtx = document.getElementById('authorsChart').getContext('2d');
        const authorsChart = new Chart(authorsCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($authors->pluck('name')) !!},
                datasets: [{
                    label: 'عدد الكتب',
                    data: {!! json_encode(
                        $authors->map(function ($author) {
                            return $author->books->count();
                        }),
                    ) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'توزيع الكتب حسب المؤلفين'
                    }
                }
            }
        });
    </script>
@endsection
