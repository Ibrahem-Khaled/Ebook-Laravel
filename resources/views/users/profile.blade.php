<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background: #BA68C8;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8;
        }

        .profile-button {
            background: #BA68C8;
            box-shadow: none;
            border: none;
        }

        .profile-button:hover {
            background: #682773;
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none;
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none;
        }

        .back:hover {
            color: #682773;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        src="https://cdn-icons-png.flaticon.com/128/3135/3135715.png" width="90"><span
                        class="font-weight-bold">
                        {{ Auth::user()->name }}</span><span class="text-black-50">
                        {{ Auth::user()->email }}</span><span>{{ Auth::user()->role->role_name }}</span></div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('home') }}" class="d-flex flex-row align-items-center back"><i
                                class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <h6>Back to home</h6>
                        </a>
                        <h6 class="text-right">Profile</h6>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="name"
                                value="{{ Auth::user()->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Email"
                                value="{{ Auth::user()->email }}"></div>
                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-danger profile-button" type="button" data-toggle="modal"
                            data-target="#deleteModal">Delete Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteProfileForm" action="{{ route('profile.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="password">Enter your password to confirm deletion:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" >Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
