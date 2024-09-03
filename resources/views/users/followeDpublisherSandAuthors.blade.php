<!doctype html>
<html lang="ar">

<head>
    <title>إحصائيات المتابعة</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- الخطوط والرموز -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .page-header {
            background-image: url('{{ asset('img/bg-20.jpg') }}');
            height: 250px;
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            position: relative;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
        }

        .page-header h1 {
            color: white;
            text-align: center;
            padding-top: 90px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            position: relative;
            z-index: 2;
        }

        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 3;
            background-color: #ff9800;
            color: #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-back:hover {
            background-color: #e68900;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .author-publisher-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .author-publisher-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex: 1;
            min-width: 300px;
            transition: transform 0.2s ease;
            position: relative;
        }

        .author-publisher-card:hover {
            transform: translateY(-5px);
        }

        .author-publisher-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .author-publisher-card-body {
            padding: 20px;
            text-align: center;
        }

        .author-publisher-card-body h5 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .author-publisher-card-body p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }

        .btn-view-stats {
            margin-top: 10px;
            background-color: #ff9800;
            color: #fff;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-view-stats:hover {
            background-color: #e68900;
        }

        .btn-delete {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }
    </style>
</head>

<body>

    @include('layouts.navigation')

    <div class="page-header">
        <a href="{{ route('dashboard.books') }}" class="btn-back">
            <i class="material-icons">arrow_back</i>
        </a>
        <h1>إحصائيات المتابعة</h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="title mb-4">المؤلفون والناشرون الذين تتابعهم</h2>
            </div>
        </div>

        <div class="author-publisher-list">

            <!-- بطاقة المؤلف -->
            @foreach ($followedAuthors as $author)
                <div class="author-publisher-card" id="author-card-{{ $author->id }}">
                    <img src="{{ asset('public/storage/' . $author->image) }}" alt="{{ $author->author_name }}">

                    <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-id="{{ $author->pivot->id }}">
                        <i class="material-icons">delete</i>
                    </button>

                    <div class="author-publisher-card-body">
                        <h5>{{ $author->author_name }}</h5>
                        <p>{{ $author->desc }}</p>
                    </div>
                </div>
            @endforeach

            <!-- بطاقة الناشر -->
            @foreach ($followedPublishers as $publisher)
                <div class="author-publisher-card" id="publisher-card-{{ $publisher->id }}">
                    <img src="{{ asset('public/storage/' . $publisher->image) }}"
                        alt="{{ $publisher->publisher_name }}">

                    <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-id="{{ $publisher->pivot->id }}">
                        <i class="material-icons">delete</i>
                    </button>

                    <div class="author-publisher-card-body">
                        <h5>{{ $publisher->publisher_name }}</h5>
                        <p>{{ $publisher->desc }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد حذف هذا العنصر من قائمة المتابعة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        // Pass the delete URL to the modal form
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract the data-id attribute
            var formAction = "{{ route('delete.user.followed.AuthorAndPublisher', ':id') }}";
            formAction = formAction.replace(':id', id);
            $('#deleteForm').attr('action', formAction);
        });
    </script>

</body>

</html>
