@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header Section with Glassmorphism Effect -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="position-relative overflow-hidden">
                    <div class="header-gradient rounded-4 p-4 shadow-lg border border-light">
                        <div class="backdrop-blur-card p-3 rounded-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div>
                                    <h2 class="text-gradient-primary fw-bold mb-2">لوحة التحكم الإحصائية</h2>
                                    <p class="text-muted mb-0">إدارة شاملة لمبيعاتك وإيراداتك</p>
                                </div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <button class="btn btn-outline-primary btn-modern">
                                        <i class="fas fa-download me-2"></i>تصدير تقرير
                                    </button>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-modern dropdown-toggle" type="button"
                                            id="filterDropdown" data-bs-toggle="dropdown">
                                            <i class="fas fa-filter me-2"></i>فلترة حسب الفترة
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-modern">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-calendar-day me-2"></i>اليوم</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-calendar-week me-2"></i>الأسبوع</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-calendar-alt me-2"></i>الشهر</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-calendar me-2"></i>السنة</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards with Modern Design -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card stats-card stats-card-sales h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-icon-wrapper mb-3">
                                    <div class="stats-icon stats-icon-primary">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                </div>
                                <h6 class="text-muted text-sm mb-2">إجمالي المبيعات</h6>
                                <h3 class="font-weight-bold mb-0 counter" data-target="24530">0</h3>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-light-success text-success">
                                    <i class="fas fa-arrow-up me-1"></i>+12.5%
                                </span>
                            </div>
                        </div>
                        <div class="progress progress-modern mt-3">
                            <div class="progress-bar bg-gradient-primary" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card stats-card stats-card-revenue h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-icon-wrapper mb-3">
                                    <div class="stats-icon stats-icon-success">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <h6 class="text-muted text-sm mb-2">إجمالي الإيرادات</h6>
                                <h3 class="font-weight-bold mb-0 counter" data-target="143890">0</h3>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-light-success text-success">
                                    <i class="fas fa-arrow-up me-1"></i>+8.3%
                                </span>
                            </div>
                        </div>
                        <div class="progress progress-modern mt-3">
                            <div class="progress-bar bg-gradient-success" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card stats-card stats-card-subscriptions h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-icon-wrapper mb-3">
                                    <div class="stats-icon stats-icon-info">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <h6 class="text-muted text-sm mb-2">إيرادات الاشتراكات</h6>
                                <h3 class="font-weight-bold mb-0 counter" data-target="86450">0</h3>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-light-info text-info">
                                    <i class="fas fa-arrow-up me-1"></i>+15.2%
                                </span>
                            </div>
                        </div>
                        <div class="progress progress-modern mt-3">
                            <div class="progress-bar bg-gradient-info" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card stats-card stats-card-withdrawals h-100 border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="stats-icon-wrapper mb-3">
                                    <div class="stats-icon stats-icon-warning">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                                <h6 class="text-muted text-sm mb-2">عمليات السحب</h6>
                                <h3 class="font-weight-bold mb-0 counter" data-target="32500">0</h3>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-light-warning text-warning">
                                    <i class="fas fa-arrow-down me-1"></i>-3.1%
                                </span>
                            </div>
                        </div>
                        <div class="progress progress-modern mt-3">
                            <div class="progress-bar bg-gradient-warning" style="width: 40%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mb-5">
            <!-- Sales Trend Chart -->
            <div class="col-lg-8">
                <div class="card chart-card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">اتجاه المبيعات</h5>
                                <p class="text-muted mb-0">تحليل شامل لأداء المبيعات الشهرية</p>
                            </div>
                            <div class="d-flex gap-2">
                                <select class="form-select form-select-modern">
                                    <option>2023</option>
                                    <option selected>2024</option>
                                    <option>2025</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="sales-chart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Distribution -->
            <div class="col-lg-4">
                <div class="card chart-card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h5 class="mb-1">توزيع الإيرادات</h5>
                        <p class="text-muted mb-0">نسب توزيع مصادر الدخل</p>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <div class="chart-container w-100">
                            <canvas id="revenue-distribution" height="300"></canvas>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center p-3 bg-light-primary rounded-3">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="dot-indicator bg-primary me-2"></div>
                                        <span class="text-primary fw-bold">كتب</span>
                                    </div>
                                    <h4 class="mb-0 text-primary">57%</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 bg-light-info rounded-3">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="dot-indicator bg-info me-2"></div>
                                        <span class="text-info fw-bold">اشتراكات</span>
                                    </div>
                                    <h4 class="mb-0 text-info">43%</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Tables Section -->
        <div class="row g-4">
            <!-- Recent Withdrawals -->
            <div class="col-lg-6">
                <div class="card modern-table-card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">آخر عمليات السحب</h5>
                                <p class="text-muted mb-0">تتبع أحدث المعاملات المالية</p>
                            </div>
                            <a href="#" class="btn btn-outline-primary btn-sm btn-modern">
                                <i class="fas fa-external-link-alt me-1"></i>عرض الكل
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-modern align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase text-secondary text-xs font-weight-bolder">
                                            المستخدم</th>
                                        <th class="border-0 text-uppercase text-secondary text-xs font-weight-bolder">
                                            المبلغ</th>
                                        <th
                                            class="border-0 text-uppercase text-secondary text-xs font-weight-bolder text-center">
                                            الحالة</th>
                                        <th
                                            class="border-0 text-uppercase text-secondary text-xs font-weight-bolder text-center">
                                            التاريخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="d-flex align-items-center px-3 py-2">
                                                <div class="avatar-modern bg-gradient-primary me-3">
                                                    <span class="text-white fw-bold">أ</span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">أحمد محمد</h6>
                                                    <p class="text-xs text-muted mb-0">مؤلف</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="text-success fw-bold">$1,200</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="badge bg-light-success text-success rounded-pill">
                                                <i class="fas fa-check me-1"></i>مكتمل
                                            </span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="text-muted text-sm">15 يونيو 2024</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="d-flex align-items-center px-3 py-2">
                                                <div class="avatar-modern bg-gradient-info me-3">
                                                    <span class="text-white fw-bold">س</span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">سارة علي</h6>
                                                    <p class="text-xs text-muted mb-0">كاتبة</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="text-warning fw-bold">$850</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="badge bg-light-warning text-warning rounded-pill">
                                                <i class="fas fa-clock me-1"></i>قيد المراجعة
                                            </span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="text-muted text-sm">12 يونيو 2024</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="d-flex align-items-center px-3 py-2">
                                                <div class="avatar-modern bg-gradient-secondary me-3">
                                                    <span class="text-white fw-bold">خ</span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">خالد عبدالله</h6>
                                                    <p class="text-xs text-muted mb-0">مترجم</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="text-success fw-bold">$2,300</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="badge bg-light-success text-success rounded-pill">
                                                <i class="fas fa-check me-1"></i>مكتمل
                                            </span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="text-muted text-sm">8 يونيو 2024</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Selling Books -->
            <div class="col-lg-6">
                <div class="card modern-table-card border-0 shadow-lg h-100">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">الكتب الأكثر مبيعاً</h5>
                                <p class="text-muted mb-0">أفضل الكتب أداءً هذا الشهر</p>
                            </div>
                            <a href="#" class="btn btn-outline-primary btn-sm btn-modern">
                                <i class="fas fa-external-link-alt me-1"></i>عرض الكل
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-modern align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase text-secondary text-xs font-weight-bolder">
                                            الكتاب</th>
                                        <th class="border-0 text-uppercase text-secondary text-xs font-weight-bolder">
                                            المؤلف</th>
                                        <th
                                            class="border-0 text-uppercase text-secondary text-xs font-weight-bolder text-center">
                                            المبيعات</th>
                                        <th
                                            class="border-0 text-uppercase text-secondary text-xs font-weight-bolder text-center">
                                            الإيرادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="d-flex align-items-center px-3 py-2">
                                                <div class="book-cover-modern bg-gradient-primary me-3">
                                                    <i class="fas fa-book text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">فن اللامبالاة</h6>
                                                    <div class="rating-stars">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="text-dark fw-bold">مارك مانسون</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="badge bg-light-primary text-primary rounded-pill">1,432</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="text-success fw-bold">$14,320</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="d-flex align-items-center px-3 py-2">
                                                <div class="book-cover-modern bg-gradient-info me-3">
                                                    <i class="fas fa-book text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">العادات الذرية</h6>
                                                    <div class="rating-stars">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="text-dark fw-bold">جيمس كلير</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="badge bg-light-info text-info rounded-pill">1,210</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="text-success fw-bold">$12,100</span>
                                        </td>
                                    </tr>
                                    <tr class="table-row-hover">
                                        <td class="border-0">
                                            <div class="d-flex align-items-center px-3 py-2">
                                                <div class="book-cover-modern bg-gradient-success me-3">
                                                    <i class="fas fa-book text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-sm">قوة الآن</h6>
                                                    <div class="rating-stars">
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-warning"></i>
                                                        <i class="fas fa-star text-muted"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <span class="text-dark fw-bold">إيكهارت تول</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="badge bg-light-success text-success rounded-pill">987</span>
                                        </td>
                                        <td class="border-0 text-center">
                                            <span class="text-success fw-bold">$9,870</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Design Styles */
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --info-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --card-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header Gradient */
        .header-gradient {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            position: relative;
            overflow: hidden;
        }

        .header-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
            opacity: 0.5;
        }

        .backdrop-blur-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .text-gradient-primary {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Modern Buttons */
        .btn-modern {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .btn-modern:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover:before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        /* Modern Dropdown */
        .dropdown-menu-modern {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 10px;
            margin-top: 10px;
        }

        .dropdown-menu-modern .dropdown-item {
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
            margin-bottom: 2px;
        }

        .dropdown-menu-modern .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateX(5px);
        }

        /* Stats Cards */
        .stats-card {
            border-radius: 20px;
            transition: all 0.3s ease;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stats-card:hover::before {
            opacity: 1;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .stats-icon-wrapper {
            position: relative;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stats-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .stats-icon-primary {
            background: var(--primary-gradient);
        }

        .stats-icon-success {
            background: var(--success-gradient);
        }

        .stats-icon-info {
            background: var(--info-gradient);
        }

        .stats-icon-warning {
            background: var(--warning-gradient);
        }

        /* Progress Bars */
        .progress-modern {
            height: 6px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .progress-modern .progress-bar {
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .progress-modern .progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: progress-shine 2s infinite;
        }

        @keyframes progress-shine {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* Counter Animation */
        .counter {
            font-family: 'Courier New', monospace;
        }

        /* Light Backgrounds */
        .bg-light-primary {
            background-color: rgba(102, 126, 234, 0.1);
        }

        .bg-light-success {
            background-color: rgba(17, 153, 142, 0.1);
        }

        .bg-light-info {
            background-color: rgba(102, 126, 234, 0.1);
        }

        .bg-light-warning {
            background-color: rgba(240, 147, 251, 0.1);
        }

        /* Chart Cards */
        .chart-card {
            border-radius: 20px;
            transition: all 0.3s ease;
            background: white;
        }

        .chart-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        .chart-container {
            position: relative;
        }

        .form-select-modern {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            background-color: white;
        }

        .form-select-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* Dot Indicators */
        .dot-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Modern Tables */
        .modern-table-card {
            border-radius: 20px;
            background: white;
            transition: all 0.3s ease;
        }

        .modern-table-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }

        .table-modern {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table-modern thead th {
            background: #f8f9fa;
            border: none;
            padding: 15px 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 11px;
        }

        .table-modern tbody tr {
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .table-row-hover:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table-modern tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            border: none;
        }

        .table-modern tbody tr:first-child td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table-modern tbody tr:first-child td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* Avatar Modern */
        .avatar-modern {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }

        .avatar-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: avatar-glow 4s infinite;
        }

        @keyframes avatar-glow {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }
        }

        /* Book Cover Modern */
        .book-cover-modern {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            position: relative;
            overflow: hidden;
        }

        .book-cover-modern::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .table-row-hover:hover .book-cover-modern::after {
            left: 100%;
        }

        /* Rating Stars */
        .rating-stars {
            font-size: 12px;
            margin-top: 2px;
        }

        /* Badge Improvements */
        .badge {
            font-weight: 600;
            padding: 6px 12px;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        /* Gradient Backgrounds */
        .bg-gradient-primary {
            background: var(--primary-gradient) !important;
        }

        .bg-gradient-success {
            background: var(--success-gradient) !important;
        }

        .bg-gradient-info {
            background: var(--info-gradient) !important;
        }

        .bg-gradient-warning {
            background: var(--warning-gradient) !important;
        }

        .bg-gradient-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-card {
                margin-bottom: 20px;
            }

            .chart-card {
                margin-bottom: 20px;
            }

            .btn-modern {
                width: 100%;
                margin-bottom: 10px;
            }

            .d-flex.gap-2 {
                flex-direction: column;
            }

            .table-responsive {
                border-radius: 12px;
            }
        }

        /* Smooth Animations */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Loading Animation for Counter */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .counter {
            animation: countUp 0.8s ease-out;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Counter Animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    element.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target.toLocaleString();
                }
            };

            updateCounter();
        }

        // Initialize counters when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');

            // Intersection Observer for counter animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });

        // Sales Trend Chart with Modern Styling
        var salesChart = document.getElementById('sales-chart').getContext('2d');
        new Chart(salesChart, {
            type: 'line',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر',
                    'نوفمبر', 'ديسمبر'
                ],
                datasets: [{
                    label: "مبيعات الكتب",
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    borderColor: "#667eea",
                    backgroundColor: "rgba(102, 126, 234, 0.1)",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500, 350, 400, 450],
                    pointBackgroundColor: "#667eea",
                    pointBorderColor: "#ffffff",
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: "#667eea",
                    pointHoverBorderColor: "#ffffff",
                    pointHoverBorderWidth: 3
                }, {
                    label: "إيرادات الاشتراكات",
                    tension: 0.4,
                    borderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    borderColor: "#11998e",
                    backgroundColor: "rgba(17, 153, 142, 0.1)",
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400, 300, 350, 400],
                    pointBackgroundColor: "#11998e",
                    pointBorderColor: "#ffffff",
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: "#11998e",
                    pointHoverBorderColor: "#ffffff",
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: true,
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7',
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    }
                },
                elements: {
                    line: {
                        borderJoinStyle: 'round'
                    },
                    point: {
                        hoverBorderWidth: 3
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Revenue Distribution Chart with Modern Styling
        var revenueChart = document.getElementById('revenue-distribution').getContext('2d');
        new Chart(revenueChart, {
            type: 'doughnut',
            data: {
                labels: ['مبيعات الكتب', 'إيرادات الاشتراكات'],
                datasets: [{
                    data: [57, 43],
                    backgroundColor: ['#667eea', '#11998e'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 4,
                    hoverOffset: 8,
                    hoverBorderWidth: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                },
                cutout: '65%',
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 2000,
                    easing: 'easeInOutQuart'
                },
                elements: {
                    arc: {
                        borderJoinStyle: 'round'
                    }
                }
            }
        });

        // Add smooth hover effects to cards
        document.querySelectorAll('.stats-card, .chart-card, .modern-table-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add click animations to buttons
        document.querySelectorAll('.btn-modern').forEach(button => {
            button.addEventListener('click', function(e) {
                let ripple = document.createElement('span');
                let rect = this.getBoundingClientRect();
                let size = Math.max(rect.width, rect.height);
                let x = e.clientX - rect.left - size / 2;
                let y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple effect styles
        const style = document.createElement('style');
        style.textContent = `
    .btn-modern {
        position: relative;
        overflow: hidden;
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
        document.head.appendChild(style);
    </script>
@endsection
