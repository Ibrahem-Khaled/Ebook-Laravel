<style>
    .footer {
        background-color: #f8f9fa;
        padding: 40px 0;
        border-top: 1px solid #e7e7e7;
    }

    .footer h5 {
        color: var(--main-color);
        margin-bottom: 20px;
    }

    .footer p {
        color: #555;
    }

    .footer .list-unstyled a {
        color: #555;
        text-decoration: none;
    }

    .footer .list-unstyled a:hover {
        color: var(--main-color);
    }

    .footer .social-icons a {
        margin-right: 15px;
        font-size: 24px;
        color: #555;
        text-decoration: none;
    }

    .footer .social-icons a:hover {
        color: var(--main-color);
    }

    .footer .newsletter input[type="email"] {
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 10px;
        width: calc(100% - 110px);
        display: inline-block;
        margin-right: 10px;
    }

    .footer .newsletter button {
        background-color: var(--main-color);
        color: white;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .footer .newsletter button:hover {
        background-color: darken(var(--main-color), 10%);
    }

    .footer .social-icons i {
        font-size: 24px;
    }
</style>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>عن الخزانة</h5>
                <p>نحن مكتبة تقدم أفضل الكتب من جميع أنحاء العالم.</p>
            </div>
            <div class="col-md-3">
                <h5>روابط مفيدة</h5>
                <ul class="list-unstyled">
                    <li><a href="#">الرئيسية</a></li>
                    <li><a href="#">من نحن</a></li>
                    <li><a href="#">خدماتنا</a></li>
                    <li><a href="#">اتصل بنا</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>تابعنا</h5>
                <div class="social-icons">
                    <a href="https://www.tiktok.com/@alkhizana"><i class="material-icons">tiktok</i></a>
                    <a href="https://www.facebook.com/alkhizana1"><i class="material-icons">facebook</i></a>
                    <a href="https://www.instagram.com/alkhizana1"><i class="material-icons">instagram</i></a>
                    <a href="wa.me/+213542712600"><i class="material-icons">whatsapp</i></a>
                </div>
            </div>
            <div class="col-md-3">
                <h5>النشرة الإخبارية</h5>
                <div class="newsletter">
                    <input type="email" placeholder="ادخل بريدك الإلكتروني">
                    <button>اشترك</button>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>&copy; {{ date('Y') }} الخزانة. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>
