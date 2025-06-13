<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الخزانة للكتب الالكترونية</title>

    <!-- Google Fonts: Tajawal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #D1935E;
            --primary-dark: #B87D4D;
            --primary-light: #E5B080;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            overflow-x: hidden;
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .border-primary {
            border-color: var(--primary-color);
        }

        .hover\:bg-primary-dark:hover {
            background-color: var(--primary-dark);
        }

        .hover\:text-primary:hover {
            color: var(--primary-color);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .pulse-border {
            box-shadow: 0 0 0 0 rgba(209, 147, 94, 0.7);
            animation: pulse-border 2s infinite;
        }

        @keyframes pulse-border {
            0% { box-shadow: 0 0 0 0 rgba(209, 147, 94, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(209, 147, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(209, 147, 94, 0); }
        }

        .morphing-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: morphing 15s ease infinite;
        }

        @keyframes morphing {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .book-card {
            transform-style: preserve-3d;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .book-card:hover {
            transform: rotateY(10deg) rotateX(5deg) translateZ(20px);
        }

        .book-3d {
            position: relative;
            transform-style: preserve-3d;
        }

        .book-3d::before {
            content: '';
            position: absolute;
            top: 5px;
            left: -10px;
            width: 10px;
            height: 100%;
            background: linear-gradient(90deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.1) 100%);
            transform: skewY(-5deg);
        }

        .stats-counter {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(209, 147, 94, 0.2);
        }

        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
            transform-origin: left;
            transform: scaleX(0);
            z-index: 9999;
        }

        .particle {
            position: absolute;
            background: var(--primary-color);
            border-radius: 50%;
            opacity: 0.7;
            animation: particles 4s linear infinite;
        }

        @keyframes particles {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.7;
            }
            90% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .category-tab {
            position: relative;
            overflow: hidden;
        }

        .category-tab::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .category-tab:hover::before {
            left: 100%;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>

    <!-- Floating Particles -->
    <div id="particles-container" class="fixed inset-0 pointer-events-none z-0"></div>

    <!-- Navigation -->
    <nav class="nav-glass fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a class="text-xl font-bold text-primary floating-animation" href="#">
                    <div class="relative">
                        <img src="{{ asset('img/logo-ct-dark.png') }}" alt="الشعار" class="w-24 pulse-border rounded-lg">
                        <div class="absolute -top-2 -right-2 w-4 h-4 bg-red-500 rounded-full animate-pulse"></div>
                    </div>
                </a>

                <div class="hidden md:flex items-center space-x-8 space-x-reverse">
                    <a href="#" class="relative text-gray-700 hover:text-primary transition duration-300 group">
                        الرئيسية
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="relative text-gray-700 hover:text-primary transition duration-300 group">
                        الفئات
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="relative text-gray-700 hover:text-primary transition duration-300 group">
                        المؤلفون
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="relative text-gray-700 hover:text-primary transition duration-300 group">
                        الناشرون
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    @if (Auth::check())
                    <a href="{{ route('home.dashboard') }}" class="relative text-gray-700 hover:text-primary transition duration-300 group">
                         لوحة التحكم
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="relative text-gray-700 hover:text-primary transition duration-300 group">
                        تسجيل الدخول
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    @endif
                </div>

                <button class="md:hidden text-gray-700 focus:outline-none" id="mobile-menu-btn">
                    <svg class="h-6 w-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <main class="mt-20">
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <div class="morphing-bg absolute inset-0"></div>
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>

            <!-- 3D Elements -->
            <div class="absolute top-20 left-10 floating-animation opacity-30">
                <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full blur-xl"></div>
            </div>
            <div class="absolute bottom-20 right-10 floating-animation opacity-30" style="animation-delay: -3s;">
                <div class="w-48 h-48 bg-white bg-opacity-10 rounded-full blur-2xl"></div>
            </div>

            <div class="relative z-10 text-center text-white px-6" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    <span class="inline-block transform hover:rotate-3 transition-transform duration-300">اكتشف</span>
                    <span class="inline-block transform hover:-rotate-3 transition-transform duration-300 text-yellow-300">عوالم</span>
                    <span class="inline-block transform hover:rotate-3 transition-transform duration-300">جديدة</span>
                </h1>

                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto opacity-90 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    انطلق في رحلة استكشافية عبر مكتبتنا الرقمية الواسعة واكتشف كنوز المعرفة والإبداع
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="400">
                    <button class="group relative inline-flex items-center px-8 py-4 bg-white text-gray-800 font-bold rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <span class="relative z-10">ابدأ التصفح الآن</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                    </button>

                    <button class="group relative inline-flex items-center px-8 py-4 border-2 border-white text-white font-bold rounded-full transition-all duration-300 hover:bg-white hover:text-gray-800">
                        <svg class="w-5 h-5 ml-2 group-hover:animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12L6 8h8l-4 4z"/>
                        </svg>
                        اعرف المزيد
                    </button>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </section>

        <!-- Enhanced Stats Section -->
        <section class="py-20 bg-white relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-purple-50"></div>
            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 mb-4" data-aos="fade-down">
                        أرقام تتحدث عن نفسها
                    </h2>
                    <div class="w-24 h-1 bg-primary mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="group relative" data-aos="flip-left" data-aos-delay="100">
                        <div class="glass-effect p-8 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105 group-hover:rotate-3">
                            <div class="stats-counter text-6xl md:text-7xl font-black mb-4 counter" data-target="1250">0</div>
                            <div class="text-xl font-semibold text-gray-600">كتاب متاح</div>
                            <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-r from-green-400 to-blue-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>

                    <div class="group relative" data-aos="flip-left" data-aos-delay="200">
                        <div class="glass-effect p-8 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105 group-hover:-rotate-3">
                            <div class="stats-counter text-6xl md:text-7xl font-black mb-4 counter" data-target="300">0</div>
                            <div class="text-xl font-semibold text-gray-600">مؤلف مبدع</div>
                            <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>

                    <div class="group relative" data-aos="flip-left" data-aos-delay="300">
                        <div class="glass-effect p-8 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105 group-hover:rotate-3">
                            <div class="stats-counter text-6xl md:text-7xl font-black mb-4 counter" data-target="50">0</div>
                            <div class="text-xl font-semibold text-gray-600">ناشر معتمد</div>
                            <div class="absolute -top-4 -right-4 w-8 h-8 bg-gradient-to-r from-yellow-400 to-red-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Authors Carousel -->
        <section class="py-20 bg-gradient-to-br from-gray-900 to-gray-800 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-72 h-72 bg-primary rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-600 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-black mb-4">نخبة من المؤلفين</h2>
                    <p class="text-xl opacity-80 max-w-2xl mx-auto">تعرف على كوكبة من أبرز الكتاب والمفكرين الذين يثرون مكتبتنا بإبداعاتهم</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-orange-500 mx-auto mt-6"></div>
                </div>

                <div class="swiper authors-swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">
                        <!-- Simulated Authors Data -->
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden">
                                <div class="glass-effect p-6 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105">
                                    <div class="relative inline-block mb-4">
                                        <div class="w-24 h-24 bg-gradient-to-br from-primary to-yellow-500 rounded-full mx-auto border-4 border-white shadow-xl"></div>
                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                            <span class="text-white text-xs">✓</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-lg mb-1 group-hover:text-yellow-400 transition-colors">اسم المؤلف</h3>
                                    <p class="text-sm opacity-70">15 كتاب</p>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat for more authors -->
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden">
                                <div class="glass-effect p-6 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105">
                                    <div class="relative inline-block mb-4">
                                        <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full mx-auto border-4 border-white shadow-xl"></div>
                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                            <span class="text-white text-xs">✓</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-lg mb-1 group-hover:text-yellow-400 transition-colors">اسم المؤلف</h3>
                                    <p class="text-sm opacity-70">23 كتاب</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden">
                                <div class="glass-effect p-6 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105">
                                    <div class="relative inline-block mb-4">
                                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full mx-auto border-4 border-white shadow-xl"></div>
                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                            <span class="text-white text-xs">✓</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-lg mb-1 group-hover:text-yellow-400 transition-colors">اسم المؤلف</h3>
                                    <p class="text-sm opacity-70">8 كتب</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="group relative overflow-hidden">
                                <div class="glass-effect p-6 rounded-3xl text-center transform transition-all duration-500 group-hover:scale-105">
                                    <div class="relative inline-block mb-4">
                                        <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-teal-500 rounded-full mx-auto border-4 border-white shadow-xl"></div>
                                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                            <span class="text-white text-xs">✓</span>
                                        </div>
                                    </div>
                                    <h3 class="font-bold text-lg mb-1 group-hover:text-yellow-400 transition-colors">اسم المؤلف</h3>
                                    <p class="text-sm opacity-70">31 كتاب</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination mt-8"></div>
                </div>
            </div>
        </section>

        <!-- Publishers Section -->
        <section class="py-20 bg-white relative overflow-hidden">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 mb-4">شركاؤنا في النجاح</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">نتعاون مع أفضل دور النشر لنقدم لك محتوى عالي الجودة</p>
                    <div class="w-24 h-1 bg-primary mx-auto mt-6"></div>
                </div>

                <div class="swiper publishers-swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper items-center">
                        <div class="swiper-slide">
                            <div class="group p-6 text-center transform transition-all duration-300 hover:scale-110">
                                <div class="w-20 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-2xl mx-auto shadow-lg group-hover:shadow-xl transition-shadow"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="group p-6 text-center transform transition-all duration-300 hover:scale-110">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-200 to-blue-300 rounded-2xl mx-auto shadow-lg group-hover:shadow-xl transition-shadow"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="group p-6 text-center transform transition-all duration-300 hover:scale-110">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-200 to-green-300 rounded-2xl mx-auto shadow-lg group-hover:shadow-xl transition-shadow"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="group p-6 text-center transform transition-all duration-300 hover:scale-110">
                                <div class="w-20 h-20 bg-gradient-to-br from-purple-200 to-purple-300 rounded-2xl mx-auto shadow-lg group-hover:shadow-xl transition-shadow"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Books Categories Section -->
        <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 relative overflow-hidden">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-black text-gray-800 mb-4">استكشف مجموعاتنا</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">تصفح كتبنا المنظمة بعناية في فئات متنوعة</p>
                    <div class="w-24 h-1 bg-primary mx-auto mt-6"></div>
                </div>

                <!-- Category: Fiction Example -->
                <div class="mb-20" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-800 relative">
                            <span class="category-tab inline-block px-6 py-2 bg-gradient-to-r from-primary to-yellow-500 text-white rounded-full">
                                الأدب والرواية
                            </span>
                        </h3>
                        <a href="#" class="text-primary hover:text-primary-dark font-semibold flex items-center group">
                            <span class="ml-2">عرض المزيد</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        <!-- Book Card Example -->
                        <div class="book-card group" data-aos="flip-up" data-aos-delay="100">
                            <div class="bg-white rounded-3xl shadow-lg overflow-hidden transform transition-all duration-500 group-hover:shadow-2xl">
                                <div class="relative overflow-hidden">
                                    <div class="book-3d w-full h-64 bg-gradient-to-br from-blue-400 to-purple-600 relative">
                                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                                        <div class="absolute top-4 right-4">
                                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                                خصم 25%
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="font-bold text-lg mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                        عنوان الكتاب هنا
                                    </h4>
                                    <p class="text-gray-600 text-sm mb-3">اسم المؤلف</p>

                                    <div class="flex items-center mb-3">
                                        <div class="flex text-yellow-400">
                                            ★★★★☆
                                        </div>
                                        <span class="text-xs text-gray-500 mr-2">(124)</span>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-primary font-bold text-lg">75.00 د.ج</span>
                                            <span class="text-gray-400 line-through text-sm mr-2">100.00 د.ج</span>
                                        </div>
                                        <button class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 hover:scale-105 focus:ring-4 focus:ring-primary focus:ring-opacity-30">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat book cards for this category -->
                        <div class="book-card group" data-aos="flip-up" data-aos-delay="150">
                            <div class="bg-white rounded-3xl shadow-lg overflow-hidden transform transition-all duration-500 group-hover:shadow-2xl">
                                <div class="relative overflow-hidden">
                                    <div class="book-3d w-full h-64 bg-gradient-to-br from-green-400 to-teal-600 relative">
                                        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="font-bold text-lg mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                                        عنوان كتاب آخر هنا
                                    </h4>
                                    <p class="text-gray-600 text-sm mb-3">مؤلف آخر</p>

                                    <div class="flex items-center mb-3">
                                        <div class="flex text-yellow-400">
                                            ★★★★★
                                        </div>
                                        <span class="text-xs text-gray-500 mr-2">(89)</span>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span class="text-primary font-bold text-lg">120.00 د.ج</span>
                                        <button class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 hover:scale-105 focus:ring-4 focus:ring-primary focus:ring-opacity-30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add 3 more book cards for this category -->
                        <div class="book-card group" data-aos="flip-up" data-aos-delay="200">
                            <!-- Book card content -->
                        </div>
                        <div class="book-card group" data-aos="flip-up" data-aos-delay="250">
                            <!-- Book card content -->
                        </div>
                        <div class="book-card group" data-aos="flip-up" data-aos-delay="300">
                            <!-- Book card content -->
                        </div>
                    </div>
                </div>

                <!-- Category: Science Example -->
                <div class="mb-20" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-800 relative">
                            <span class="category-tab inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-blue-500 text-white rounded-full">
                                العلوم والتكنولوجيا
                            </span>
                        </h3>
                        <a href="#" class="text-primary hover:text-primary-dark font-semibold flex items-center group">
                            <span class="ml-2">عرض المزيد</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        <!-- Science books cards here -->
                        <!-- Repeat similar structure as above -->
                    </div>
                </div>

                <!-- Category: Children Example -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-800 relative">
                            <span class="category-tab inline-block px-6 py-2 bg-gradient-to-r from-pink-500 to-red-500 text-white rounded-full">
                                كتب الأطفال
                            </span>
                        </h3>
                        <a href="#" class="text-primary hover:text-primary-dark font-semibold flex items-center group">
                            <span class="ml-2">عرض المزيد</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        <!-- Children books cards here -->
                        <!-- Repeat similar structure as above -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-gray-900 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-1/3 bg-gradient-to-b from-primary to-transparent"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-purple-600 rounded-full blur-3xl"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-black mb-4">آراء قرائنا</h2>
                    <p class="text-xl opacity-80 max-w-2xl mx-auto">ما يقوله عملاؤنا عن تجربتهم مع منصتنا</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-orange-500 mx-auto mt-6"></div>
                </div>

                <div class="swiper testimonials-swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">
                        <!-- Testimonial 1 -->
                        <div class="swiper-slide">
                            <div class="glass-effect p-8 rounded-3xl h-full">
                                <div class="flex items-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-yellow-500 rounded-full"></div>
                                    <div class="mr-4">
                                        <h4 class="font-bold text-lg">محمد أحمد</h4>
                                        <p class="text-sm opacity-70">قارئ منذ 2018</p>
                                    </div>
                                </div>
                                <p class="text-lg leading-relaxed mb-6">
                                    "منصة رائعة توفر مجموعة واسعة من الكتب بجودة عالية وسهولة في التصفح والشراء. أوصي بها لكل محبي القراءة."
                                </p>
                                <div class="flex text-yellow-400">
                                    ★★★★★
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="swiper-slide">
                            <div class="glass-effect p-8 rounded-3xl h-full">
                                <div class="flex items-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full"></div>
                                    <div class="mr-4">
                                        <h4 class="font-bold text-lg">سارة خالد</h4>
                                        <p class="text-sm opacity-70">قارئة منذ 2020</p>
                                    </div>
                                </div>
                                <p class="text-lg leading-relaxed mb-6">
                                    "أحب التنوع الكبير في الكتب المتاحة وسهولة الوصول إليها من أي جهاز. خدمة العملاء ممتازة أيضًا."
                                </p>
                                <div class="flex text-yellow-400">
                                    ★★★★☆
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="swiper-slide">
                            <div class="glass-effect p-8 rounded-3xl h-full">
                                <div class="flex items-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full"></div>
                                    <div class="mr-4">
                                        <h4 class="font-bold text-lg">علي حسن</h4>
                                        <p class="text-sm opacity-70">قارئ منذ 2019</p>
                                    </div>
                                </div>
                                <p class="text-lg leading-relaxed mb-6">
                                    "التطبيق سهل الاستخدام ويوفر توصيات كتب ممتازة بناءً على قراءاتي السابقة. شكرًا لكم على هذه الخدمة المميزة."
                                </p>
                                <div class="flex text-yellow-400">
                                    ★★★★★
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination mt-8"></div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-primary to-primary-dark relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-white to-transparent opacity-5"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl opacity-20"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10 text-center" data-aos="zoom-in">
                <h2 class="text-4xl md:text-5xl font-black mb-6">انضم إلى مجتمع القراء اليوم</h2>
                <p class="text-xl opacity-90 max-w-2xl mx-auto mb-8 leading-relaxed">
                    سجل الآن واحصل على خصم 20% على أول عملية شراء، بالإضافة إلى توصيات كتب مخصصة لك
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button class="group relative inline-flex items-center px-8 py-4 bg-white text-gray-800 font-bold rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                        <span class="relative z-10">سجل مجانًا</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                    </button>

                    <button class="group relative inline-flex items-center px-8 py-4 border-2 border-dark font-bold rounded-full transition-all duration-300 hover:bg-white hover:text-gray-800">
                        <svg class="w-5 h-5 ml-2 group-hover:animate-bounce" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12L6 8h8l-4 4z"/>
                        </svg>
                        اكتشف المميزات
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-20 pb-10 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-1/3 bg-gradient-to-b from-primary to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-16">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('img/logo-ct-dark.png') }}" alt="الشعار" class="w-16 mr-3">
                        <span class="text-2xl font-bold text-primary">الخزانة</span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        منصة رائدة في مجال الكتب الإلكترونية العربية، نقدم محتوى مميزًا لعشاق القراءة في العالم العربي.
                    </p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold mb-6 relative inline-block">
                        <span class="relative z-10">روابط سريعة</span>
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary z-0 opacity-30"></span>
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">الصفحة الرئيسية</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">تصفح الكتب</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">المؤلفون</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">الناشرون</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">عروض خاصة</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">الفئات</a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold mb-6 relative inline-block">
                        <span class="relative z-10">خدمة العملاء</span>
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary z-0 opacity-30"></span>
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">مركز المساعدة</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">أسئلة شائعة</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">سياسة الإرجاع</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">طرق الدفع</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition-colors">اتصل بنا</a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-bold mb-6 relative inline-block">
                        <span class="relative z-10">النشرة البريدية</span>
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary z-0 opacity-30"></span>
                    </h3>
                    <p class="text-gray-400 mb-4">
                        اشترك في نشرتنا البريدية لتصلك آخر الإصدارات والعروض الخاصة
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="بريدك الإلكتروني" class="px-4 py-3 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-primary text-gray-800 w-full">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-3 rounded-l-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-10 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    © 2023 الخزانة للكتب الإلكترونية. جميع الحقوق محفوظة.
                </p>
                <div class="flex space-x-6 space-x-reverse">
                    <a href="#" class="text-gray-400 hover:text-primary text-sm transition-colors">شروط الخدمة</a>
                    <a href="#" class="text-gray-400 hover:text-primary text-sm transition-colors">سياسة الخصوصية</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg flex items-center justify-center transition-all duration-300 opacity-0 invisible hover:bg-primary-dark">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Scripts -->
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Initialize Swiper
        const authorsSwiper = new Swiper('.authors-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.authors-swiper .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            }
        });

        const publishersSwiper = new Swiper('.publishers-swiper', {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
            }
        });

        const testimonialsSwiper = new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.testimonials-swiper .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            }
        });

        // Scroll Indicator
        window.addEventListener('scroll', function() {
            const scrollIndicator = document.getElementById('scrollIndicator');
            const scrollTop = document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollProgress = (scrollTop / scrollHeight) * 100;
            scrollIndicator.style.transform = `scaleX(${scrollProgress / 100})`;
        });

        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        mobileMenuBtn.addEventListener('click', function() {
            this.querySelector('svg').classList.toggle('rotate-90');
            // Add mobile menu functionality here
        });

        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        function animateCounters() {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(animateCounters, 1);
                } else {
                    counter.innerText = target;
                }
            });
        }

        // Start counter animation when scrolled to stats section
        const statsSection = document.querySelector('.stats-counter').parentElement.parentElement;
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                animateCounters();
                observer.unobserve(statsSection);
            }
        });

        observer.observe(statsSection);

        // Create floating particles
        function createParticles() {
            const container = document.getElementById('particles-container');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random properties
                const size = Math.random() * 10 + 5;
                const posX = Math.random() * window.innerWidth;
                const delay = Math.random() * 5;
                const duration = Math.random() * 10 + 5;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}px`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;

                container.appendChild(particle);
            }
        }

        createParticles();

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
                navbar.classList.add('bg-white');
                navbar.classList.remove('bg-opacity-95');
            } else {
                navbar.classList.remove('shadow-lg');
                navbar.classList.add('bg-opacity-95');
            }
        });
    </script>
</body>
</html>
