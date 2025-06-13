<!doctype html>
<html lang="ar" id="html" class="loading">

<head>
    <title>الصفحة الشخصية للمؤلف - alkazana</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        :root {
            --main-color: #D1935E;
            --secondary-color: #333;
            --background-color: #f5f5f5;
        }

        body {
            font-family: "Cairo", sans-serif;
            background-color: var(--background-color);
        }

        .main-color {
            color: var(--main-color);
        }

        .secondary-color {
            color: var(--secondary-color);
        }

        .profile-header {
            background: var(--main-color);
            color: white;
            padding: 60px 0;
            text-align: center;
            position: relative;
        }

        .profile-header::after {
            content: "";
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 30px;
            background: white;
            border-radius: 0 0 50% 50%;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            margin-bottom: 20px;
        }

        .profile-info {
            margin-top: -75px;
            text-align: center;
        }

        .profile-info h2 {
            margin: 15px 0;
            font-size: 32px;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .profile-info p {
            color: #666;
        }

        .books-section {
            padding: 60px 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        .books-section h3 {
            font-size: 28px;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .book-item {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .book-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .profile-header::after {
                width: 80%;
            }

            .book-item {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="profile-header">
        <img src="{{ asset('public/storage/' . $author->image) }}" alt="{{ $author->author_name }}" class="profile-img">
    </div>
    <div class="profile-info">
        <h2>{{ $author->author_name }}</h2>
    </div>

    <div class="books-section">
        <div class="container">
            <h3 class="main-color mb-4">أعمال المؤلف</h3>
            <div class="row">
                @foreach ($author->books as $book)
                    <div class="col-md-3">
                        <div class="book-item card shadow-sm mb-4">
                            <img src="{{ asset($book->book_image_url) }}" alt="{{ $book->book_title }}" height="200"
                                style="object-fit: cover" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title secondary-color">{{ $book->book_title }}</h5>
                                <h6 class="card-text" style="color: var(--main-color)">
                                    {{ $book->book_price === null ? 'مجانا' : $book->book_price . ' د.ج' }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap and necessary plugins -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
