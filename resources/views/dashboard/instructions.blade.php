<!doctype html>
<html lang="ar">

<head>
    <title>إدارة التعليمات</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('icons/icons.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
</head>

<body>
    @include('layouts.navigation')
    @include('layouts.alerts')

    <div class="page-header" style="background-image: url({{ asset('img/bg-20.jpg') }}); height: 500px"></div>

    <div class="card card-body shadow-xl mt-n12 mx-3 mx-md-4">
        <div class="row mt-4">
            <div class="col-md-3">
                <a class="btn bg-white mb-0 mt-lg-auto w-100" href="{{ route('dashboard.books') }}"
                    style="max-width: 233px; width: -webkit-fill-available;">
                    <svg style="margin-right: 1rem" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>العودة
                </a>
            </div>
        </div>
        <div class="container">
            <div class="section text-left my-4">
                <div class="row">
                    <div class="col">
                        <h2 class="title">إدارة التعليمات</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addInstructionModal">إضافة تعليمات جديدة</button>
                    </div>
                </div>

                <!-- Add Instruction Modal -->
                <div class="modal fade" id="addInstructionModal" tabindex="-1"
                    aria-labelledby="addInstructionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addInstructionModalLabel">إضافة تعليمات جديدة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('instructions.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="title" class="form-label">العنوان</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">الوصف</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="link" class="form-label">الرابط</label>
                                        <textarea class="form-control" id="link" name="link" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">إضافة</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($instructions->count() > 0)
                    <div class="card mt-4">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الرقم التعريفي</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            العنوان</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الوصف</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الرابط</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ الإنشاء</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تاريخ التحديث</th>
                                        <th
                                            class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تعديل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructions as $instruction)
                                        <tr>
                                            <td class="align-middle text-center">{{ $instruction->id }}</td>
                                            <td class="align-middle text-center">{{ $instruction->title }}</td>
                                            <td class="align-middle text-center">{{ $instruction->description }}</td>
                                            <td class="align-middle text-center">{{ $instruction->link }}</td>
                                            <td class="align-middle text-center">{{ $instruction->created_at }}</td>
                                            <td class="align-middle text-center">{{ $instruction->updated_at }}</td>
                                            <td class="align-middle text-center">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editInstructionModal{{ $instruction->id }}">تعديل</button>
                                                <!-- Edit Instruction Modal -->
                                                <div class="modal fade"
                                                    id="editInstructionModal{{ $instruction->id }}" tabindex="-1"
                                                    aria-labelledby="editInstructionModalLabel{{ $instruction->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editInstructionModalLabel{{ $instruction->id }}">
                                                                    تعديل التعليمات</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('instructions.update', $instruction->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <label for="title"
                                                                            class="form-label">العنوان</label>
                                                                        <input type="text" class="form-control"
                                                                            id="title" name="title"
                                                                            value="{{ $instruction->title }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="description"
                                                                            class="form-label">الوصف</label>
                                                                        <textarea class="form-control" id="description" name="description" rows="3">{{ $instruction->description }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="link"
                                                                            class="form-label">الرابط</label>
                                                                        <textarea class="form-control" id="link" name="link" rows="3">{{ $instruction->link }}</textarea>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">تحديث</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('instructions.destroy', $instruction->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col">
                            <p class="display-4" style="font-size: x-large">لا توجد تعليمات.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/material-kit.min.js') }}" type="text/javascript"></script>
</body>

</html>
