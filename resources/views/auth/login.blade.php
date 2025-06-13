<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.seo')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', 'Tajawal', sans-serif;
            direction: rtl;
            text-align: right;
            overflow-x: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 0;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            max-width: 1000px;
            width: 100%;
            overflow: hidden;
            position: relative;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-form-section {
            padding: 60px 50px;
            position: relative;
        }

        .login-visual-section {
            background: linear-gradient(135deg, #4a2f85 0%, #6b46c1 50%, #8b5cf6 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 600px;
            overflow: hidden;
        }

        .login-visual-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" patternUnits="userSpaceOnUse" width="100" height="100"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .visual-content {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #4a2f85 0%, #8b5cf6 100%);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 15px 35px rgba(74, 47, 133, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo i {
            font-size: 48px;
            color: white;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 700;
            color: #2d1b69;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #4a2f85 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-subtitle {
            color: #64748b;
            font-size: 16px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e5e7eb;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            font-family: 'Cairo', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
            margin-top: 12px;
        }

        .form-input:focus + .input-icon {
            color: #8b5cf6;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4a2f85 0%, #8b5cf6 100%);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-family: 'Cairo', sans-serif;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(74, 47, 133, 0.4);
        }

        .forgot-password {
            text-align: center;
            margin: 20px 0;
        }

        .forgot-password a {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #4a2f85;
        }

        .register-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e5e7eb;
        }

        .register-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 30px;
            border: 2px solid #8b5cf6;
            background: transparent;
            color: #8b5cf6;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
        }

        .register-btn:hover {
            background: #8b5cf6;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            border: none;
            font-weight: 500;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatShapes 8s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes floatShapes {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            33% {
                transform: translateY(-30px) rotate(120deg);
            }
            66% {
                transform: translateY(15px) rotate(240deg);
            }
        }

        .visual-icon {
            font-size: 120px;
            color: rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                margin: 10px;
                border-radius: 20px;
            }

            .login-form-section {
                padding: 40px 30px;
            }

            .login-visual-section {
                min-height: 300px;
                order: -1;
            }

            .brand-title {
                font-size: 24px;
            }

            .logo {
                width: 80px;
                height: 80px;
            }

            .logo i {
                font-size: 32px;
            }
        }

        @media (max-width: 480px) {
            .login-form-section {
                padding: 30px 20px;
            }

            .form-input {
                padding: 14px 16px 14px 45px;
            }

            .login-btn {
                padding: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="row g-0" style="display: flex; min-height: 600px;">
                <!-- Form Section -->
                <div class="col-lg-6" style="flex: 1;">
                    <div class="login-form-section">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="{{ asset('img/logo-ct-dark.png') }}" width="100" alt="الشعار">
                            </div>
                            <h2 class="brand-title">منصة الخزانة</h2>
                            <p class="brand-subtitle">منصتك المتكاملة للإدارة المالية</p>
                        </div>

                        <form action="{{ route('customLogin') }}" method="POST">
                            @csrf

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label" for="email">البريد الإلكتروني</label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-input"
                                       placeholder="أدخل بريدك الإلكتروني"
                                       required />
                                <i class="fas fa-envelope input-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="password">كلمة المرور</label>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-input"
                                       placeholder="أدخل كلمة المرور"
                                       required />
                                <i class="fas fa-lock input-icon"></i>
                            </div>

                            <button type="submit" class="login-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                تسجيل الدخول
                            </button>

                            <div class="forgot-password">
                                <a href="{{ route('forgetPassword') }}">
                                    <i class="fas fa-key me-1"></i>
                                    هل نسيت كلمة المرور؟
                                </a>
                            </div>

                            <div class="register-section">
                                <p style="color: #64748b; margin-bottom: 15px;">ليس لديك حساب؟</p>
                                <a href="{{ route('register') }}" class="register-btn">
                                    <i class="fas fa-user-plus"></i>
                                    إنشاء حساب جديد
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Visual Section -->
                <div class="col-lg-6" style="flex: 1;">
                    <div class="login-visual-section">
                        <div class="floating-shapes">
                            <div class="shape"></div>
                            <div class="shape"></div>
                            <div class="shape"></div>
                        </div>

                        <div class="visual-content">
                            <div class="visual-icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <h3 style="font-size: 32px; margin-bottom: 20px; font-weight: 700;">
                                مرحباً بك في الخزانة
                            </h3>
                            <p style="font-size: 18px; line-height: 1.6; opacity: 0.9; max-width: 300px; margin: 0 auto;">
                                نحن نقدم لك أفضل الحلول المالية المتطورة لإدارة أموالك بذكاء وأمان
                            </p>

                            <div style="margin-top: 40px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-shield-alt" style="font-size: 20px;"></i>
                                    <span>أمان عالي</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-chart-line" style="font-size: 20px;"></i>
                                    <span>تقارير ذكية</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-mobile-alt" style="font-size: 20px;"></i>
                                    <span>واجهة سهلة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // تأثيرات تفاعلية للنموذج
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');

            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // تأثير الضغط على زر تسجيل الدخول
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });
    </script>
</body>

</html>
