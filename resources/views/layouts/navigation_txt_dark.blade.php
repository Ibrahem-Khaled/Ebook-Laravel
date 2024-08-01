<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('img/logos/Home_Logo.png') }}" alt="Logo" style="max-width: 150px" class="navbar-brand-img">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('home') }}">الصفحة الرئيسية</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    الكتب
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @forelse($categories as $category)
                        <li>
                            <h6 class="dropdown-header">{{ $category->category_name }}</h6>
                        </li>
                        @forelse($category->subcategories as $subcategory)
                            <li><a class="dropdown-item" href="#">{{ $subcategory->subcategory_name }}</a>
                            </li>
                        @empty
                            <li class="dropdown-item">لا توجد فئات فرعية لـ {{ $category->category_name }}</li>
                        @endforelse
                    @empty
                        <li class="dropdown-item">لا توجد فئات</li>
                    @endforelse
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">المنتجات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">من نحن</a>
            </li>
            @if (Auth::user()->role->role_name == 'admin' ||
                    Auth::user()->role->role_name == 'superAdmin' ||
                    Auth::user()->role->role_name == 'supervisor')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.books') }}">لوحة التحكم</a>
                </li>
            @endif
            @if (Auth::user()->author()->exists() || Auth::user()->publisher()->exists())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.AuthorAndPublisher', Auth::user()->id) }}">متابعة الاحصائيات</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            @if (Auth::user() !== null)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">الحساب</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">تعديل الملف الشخصي</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">التسجيل</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm me-1" style="background-color: #D1935E; color: white;"
                        href="{{ route('login') }}">تسجيل الدخول</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
