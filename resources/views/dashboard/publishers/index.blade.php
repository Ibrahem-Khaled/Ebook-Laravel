@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة الناشرين</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">الناشرين</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات الناشرين --}}
        <div class="row mb-4">
            {{-- إجمالي الناشرين --}}
            <div class="col-xl-4 col-md-6 mb-4">
                <x-stats-card icon="fas fa-building" title="إجمالي الناشرين" :value="$totalPublishers" color="primary" />
            </div>
            {{-- الناشرون بروابط اجتماعية --}}
            <div class="col-xl-4 col-md-6 mb-4">
                <x-stats-card icon="fas fa-share-alt" title="الناشرون بروابط اجتماعية" :value="$publishersWithSocial" color="success" />
            </div>
            {{-- أحدث الناشرين --}}
            <div class="col-xl-4 col-md-6 mb-4">
                <x-stats-card icon="fas fa-star" title="أحدث ناشر" :value="optional($publishers->first())->publisher_name ?? 'لا يوجد'" color="info" />
            </div>
        </div>

        {{-- بطاقة قائمة الناشرين --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة الناشرين</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createPublisherModal">
                    <i class="fas fa-plus"></i> إضافة ناشر
                </button>
            </div>
            <div class="card-body">
                {{-- نموذج البحث --}}
                <form action="{{ route('publishers.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث باسم الناشر أو الوصف..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول الناشرين --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>الصورة</th>
                                <th>اسم الناشر</th>
                                <th>الوصف</th>
                                <th>وسائل التواصل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($publishers as $publisher)
                                <tr>
                                    <td>
                                        @if ($publisher->image)
                                            <img src="{{ asset('storage/' . $publisher->image) }}"
                                                alt="{{ $publisher->publisher_name }}" width="60" class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('img/default-publisher.png') }}" alt="صورة افتراضية"
                                                width="60" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td>{{ $publisher->publisher_name }}</td>
                                    <td>
                                        @if ($publisher->desc)
                                            {{ Str::limit($publisher->desc, 50) }}
                                        @else
                                            لا يوجد وصف
                                        @endif
                                    </td>
                                    <td>
                                        <div class="social-icons">
                                            @if ($publisher->fb)
                                                <a href="{{ $publisher->fb }}" target="_blank" class="text-primary"
                                                    title="فيسبوك">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            @endif
                                            @if ($publisher->yt)
                                                <a href="{{ $publisher->yt }}" target="_blank" class="text-danger"
                                                    title="يوتيوب">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            @endif
                                            @if ($publisher->telegram)
                                                <a href="{{ $publisher->telegram }}" target="_blank" class="text-info"
                                                    title="تلجرام">
                                                    <i class="fab fa-telegram"></i>
                                                </a>
                                            @endif
                                            @if ($publisher->whatsapp)
                                                <a href="https://wa.me/{{ $publisher->whatsapp }}" target="_blank"
                                                    class="text-success" title="واتساب">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @endif
                                            @if ($publisher->instagram)
                                                <a href="{{ $publisher->instagram }}" target="_blank" class="text-warning"
                                                    title="إنستجرام">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            @endif
                                            @if (!$publisher->fb && !$publisher->yt && !$publisher->telegram && !$publisher->whatsapp && !$publisher->instagram)
                                                <span class="text-muted">لا يوجد</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showPublisherModal{{ $publisher->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editPublisherModal{{ $publisher->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deletePublisherModal{{ $publisher->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- تضمين المودالات لكل ناشر --}}
                                        @include('dashboard.publishers.modals.show', [
                                            'publisher' => $publisher,
                                        ])
                                        @include('dashboard.publishers.modals.edit', [
                                            'publisher' => $publisher,
                                        ])
                                        @include('dashboard.publishers.modals.delete', [
                                            'publisher' => $publisher,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا يوجد ناشرون</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $publishers->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة ناشر (ثابت) --}}
    @include('dashboard.publishers.modals.create')
@endsection

@push('styles')
    <style>
        .social-icons a {
            display: inline-block;
            margin: 0 3px;
            font-size: 1.2rem;
        }
    </style>
@endpush

@push('scripts')
    {{-- عرض اسم الملف المختار في حقول upload --}}
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        // تفعيل التولتيب الافتراضي
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush
