@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة المنشورات</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">المنشورات</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات المنشورات --}}
        <div class="row mb-4">
            {{-- إجمالي المنشورات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-newspaper" title="إجمالي المنشورات" :value="$totalPosts" color="primary" />
            </div>
            {{-- المنشورات المنشورة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-check-circle" title="المنشورات المنشورة" :value="$publishedPosts" color="success" />
            </div>
            {{-- المسودات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-edit" title="المسودات" :value="$draftPosts" color="info" />
            </div>
            {{-- منشوراتي --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-user" title="منشوراتي" :value="$userPosts" color="warning" />
            </div>
        </div>

        {{-- بطاقة قائمة المنشورات --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة المنشورات</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createPostModal">
                    <i class="fas fa-plus"></i> إضافة منشور
                </button>
            </div>
            <div class="card-body">
                {{-- تبويب المنشورات --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedTab === 'all' ? 'active' : '' }}"
                            href="{{ route('posts.index') }}">الكل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedTab === 'published' ? 'active' : '' }}"
                            href="{{ route('posts.index', ['tab' => 'published']) }}">منشورة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedTab === 'draft' ? 'active' : '' }}"
                            href="{{ route('posts.index', ['tab' => 'draft']) }}">مسودات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedTab === 'mine' ? 'active' : '' }}"
                            href="{{ route('posts.index', ['tab' => 'mine']) }}">منشوراتي</a>
                    </li>
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث بالعنوان أو المحتوى..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول المنشورات --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>العنوان</th>
                                <th>المحتوى</th>
                                <th>المستخدم</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ Str::limit($post->title, 30) }}</td>
                                    <td>{{ Str::limit(strip_tags($post->description), 50) }}</td>
                                    <td>{{ $post->user->name ?? 'غير محدد' }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $post->status === 'published' ? 'success' : 'secondary' }}">
                                            {{ $post->status === 'published' ? 'منشور' : 'مسودة' }}
                                        </span>
                                    </td>
                                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showPostModal{{ $post->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editPostModal{{ $post->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deletePostModal{{ $post->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- تضمين المودالات لكل منشور --}}
                                        @include('dashboard.posts.modals.show', ['post' => $post])
                                        @include('dashboard.posts.modals.edit', ['post' => $post])
                                        @include('dashboard.posts.modals.delete', ['post' => $post])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">لا يوجد منشورات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة منشور (ثابت) --}}
    @include('dashboard.posts.modals.create')
@endsection

@push('scripts')
    {{-- عرض اسم الملف المختار في حقول upload --}}
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        {{-- تفعيل التولتيب الافتراضي --}}
        $('[data-toggle="tooltip"]').tooltip();

        {{-- معاينة الصور قبل الرفع --}}

        function previewImages(input, previewId) {
            var preview = document.getElementById(previewId);
            preview.innerHTML = '';

            if (input.files) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail m-1';
                        img.style.maxHeight = '100px';
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
@endpush
