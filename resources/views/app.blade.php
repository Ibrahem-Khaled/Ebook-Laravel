<!DOCTYPE html>
<html lang="ar" dir="rtl"> {{-- اللغة العربية والاتجاه من اليمين لليسار --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>متجر الكتب الفاخر</title>

    {{-- Google Fonts: Tajawal --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via CDN (for demonstration) --}}
    {{-- في مشروع Laravel حقيقي، ستستخدم Vite أو Mix لتضمين Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ستايلات مخصصة إضافية --}}
    <style>
        /* تطبيق الخط الافتراضي */
        body {
            font-family: 'Tajawal', sans-serif;
        }

        /* تعريف ألوان مخصصة لتجاوز أو تكملة Tailwind */
        .text-primary {
            color: #D1935E;
        }

        .bg-primary {
            background-color: #D1935E;
        }

        .border-primary {
            border-color: #D1935E;
        }

        .hover\:bg-primary-dark:hover {
            background-color: #B87D4D;
        }

        /* درجة أغمق للـ hover */
        .hover\:text-primary:hover {
            color: #D1935E;
        }

        .hover\:border-primary:hover {
            border-color: #D1935E;
        }

        /* يمكنك إضافة المزيد من الستايلات المخصصة هنا إذا لزم الأمر */
    </style>

</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white shadow-md border-b-2 border-primary">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            {{-- الشعار --}}
            <a class="text-xl font-bold text-primary" href="#">
                <img src="{{ asset('img/logo-ct-dark.png') }}" alt="الشعار" style="width: 105px;">
            </a>
            {{-- الروابط --}}
            <div class="hidden md:flex items-center space-x-5 space-x-reverse">
                <a href="#" class="text-gray-700 hover:text-primary transition duration-300">الرئيسية</a>
                <a href="#" class="text-gray-700 hover:text-primary transition duration-300">الفئات</a>
                <a href="#" class="text-gray-700 hover:text-primary transition duration-300">المؤلفون</a>
                <a href="#" class="text-gray-700 hover:text-primary transition duration-300">الناشرون</a>
                {{-- أضف روابط أخرى هنا (سلة، تسجيل دخول) --}}
            </div>
            {{-- زر القائمة للموبايل --}}
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <main>

        <section id="slideshow"
            class="mb-12 bg-gradient-to-r from-gray-100 to-gray-200 h-72 md:h-96 flex items-center justify-center text-gray-800 relative overflow-hidden">
            {{-- يمكنك إضافة صورة خلفية للسلايد هنا --}}
            <img src="{{ asset('img/logo-ct-dark.png') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-20" alt="">
            <div class="text-center z-10 p-6">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">اكتشف عوالم جديدة</h2>
                <p class="mb-6 max-w-xl mx-auto">تصفح مجموعتنا الواسعة من الكتب الإلكترونية في مختلف المجالات.</p>
                <a href="#"
                    class="inline-block bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-md font-semibold transition duration-300 shadow-lg">
                    ابدأ التصفح
                </a>
            </div>
        </section>

        <section id="stats" class="py-12 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-6 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-5xl font-bold text-primary">1250+</div> {{-- مثال: عدد الكتب --}}
                        <div class="mt-3 text-lg text-gray-600">كتاب متاح</div>
                    </div>
                    <div class="p-6 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-5xl font-bold text-primary">300+</div> {{-- مثال: عدد المؤلفين --}}
                        <div class="mt-3 text-lg text-gray-600">مؤلف مبدع</div>
                    </div>
                    <div class="p-6 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="text-5xl font-bold text-primary">50+</div> {{-- مثال: عدد الناشرين --}}
                        <div class="mt-3 text-lg text-gray-600">ناشر معتمد</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="authors" class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-2 text-gray-800">تعرف على مؤلفينا</h2>
                <div class="w-24 h-1 bg-primary mx-auto mb-10"></div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    {{-- مثال لمؤلف 1 --}}
                    @foreach ($authors as $item)
                        <a href="#"
                            class="block text-center p-4 bg-white rounded-lg shadow-sm border border-transparent hover:border-primary hover:shadow-lg transition duration-300 group">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->author_name }}"
                                class="w-24 h-24 rounded-full mx-auto mb-3 object-cover border-2 border-gray-200 group-hover:border-primary transition duration-300">
                            <h3 class="font-semibold text-gray-800 group-hover:text-primary transition duration-300">اسم
                                {{ $item->author_name }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->books()->count() }} كتاب</p>
                        </a>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <a href="#" class="text-primary hover:underline font-medium">عرض كل المؤلفين &rarr;</a>
                </div>
            </div>
        </section>

        <section id="publishers" class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-2 text-gray-800">شركاؤنا من الناشرين</h2>
                <div class="w-24 h-1 bg-primary mx-auto mb-10"></div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
                    @foreach ($publishers as $item)
                        <a href="#" class="block text-center p-4 group">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->publisher_name }}"
                                class="h-16 mx-auto mb-2 object-contain transition duration-300 ease-in-out transform group-hover:scale-110">
                        </a>
                    @endforeach
                </div>
                <div class="text-center mt-10">
                    <a href="#" class="text-primary hover:underline font-medium">عرض كل الناشرين &rarr;</a>
                </div>
            </div>
        </section>

        <section id="categories-books" class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                @foreach ($categories as $category)
                    <div class="mb-16">
                        <div class="flex justify-between items-baseline mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 relative inline-block">
                                {{ $category->name }}
                                <span class="absolute -bottom-2 left-0 w-1/2 h-0.5 bg-primary"></span>
                            </h2>
                            <a href="{{ route('categories.show', $category->id) }}"
                                class="text-primary hover:underline font-medium">
                                عرض المزيد في {{ $category->name }} &rarr;
                            </a>
                        </div>

                        @if ($category->books->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                                @foreach ($category->books->take(5) as $book)
                                    <div
                                        class="bg-white rounded-lg shadow-md overflow-hidden group transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl border border-transparent hover:border-gray-200">
                                        <a href="{{ route('books.show', $book->id) }}" class="block overflow-hidden">
                                            <img src="{{ asset('storage/' . $book->cover_image) }}"
                                                alt="{{ $book->title }}"
                                                class="w-full h-64 object-cover transition duration-500 ease-in-out group-hover:scale-105">
                                            @if ($book->discount > 0)
                                                <span
                                                    class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                    خصص {{ $book->discount }}%
                                                </span>
                                            @endif
                                        </a>
                                        <div class="p-4">
                                            <h3 class="font-semibold text-md mb-1 truncate"
                                                title="{{ $book->title }}">
                                                <a href="{{ route('books.show', $book->id) }}"
                                                    class="text-gray-800 hover:text-primary transition">
                                                    {{ $book->title }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-500 mb-2 truncate">
                                                <a href="{{ route('authors.show', $book->author->id) }}"
                                                    class="hover:text-primary hover:underline">
                                                    {{ $book->author->name }}
                                                </a>
                                            </p>

                                            <div class="flex items-center mb-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $book->rating)
                                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-300" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                                <span
                                                    class="text-xs text-gray-500 mr-1">({{ $book->reviews_count }})</span>
                                            </div>

                                            <div
                                                class="flex justify-between items-center pt-2 border-t border-gray-100">
                                                <div class="flex items-center">
                                                    @if ($book->discount > 0)
                                                        <span
                                                            class="text-primary font-bold text-lg">{{ number_format($book->price_after_discount, 2) }}
                                                            د.ج</span>
                                                        <span
                                                            class="text-xs text-gray-500 line-through mr-2">{{ number_format($book->price, 2) }}
                                                            د.ج</span>
                                                    @else
                                                        <span
                                                            class="text-primary font-bold text-lg">{{ number_format($book->price, 2) }}
                                                            د.ج</span>
                                                    @endif
                                                </div>
                                                <button
                                                    class="text-xs bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md font-semibold transition duration-300 shadow"
                                                    onclick="addToCart({{ $book->id }})">
                                                    أضف للسلة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <h4 class="mt-4 text-lg font-medium text-gray-700">لا توجد كتب متاحة في هذه الفئة</h4>
                                <p class="mt-1 text-gray-500">سنقوم بإضافة كتب جديدة قريباً</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    @include('components.web.footer')

    {{-- يمكنك إضافة أي سكربتات JavaScript هنا في الأسفل إذا لزم الأمر --}}
    {{-- <script src="/path/to/your/script.js"></script> --}}

</body>

</html>
