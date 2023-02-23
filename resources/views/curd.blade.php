<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Curd</title>
    {{-- !bootstrap files --}}
    <link rel="stylesheet" href="{{ asset('Curd/bootstrap.min.css') }}">
    <script src="{{ asset("Curd/bootstrap.bundle.min.js") }}"></script>
    {{-- !datatable files--}}
    <link rel="stylesheet" href="{{ asset("Curd/jquery.dataTables.min.css") }}">
    <script src="{{ asset("Curd/jquery-3.5.1.js") }}"></script>
    <script src="{{ asset("Curd/jquery.dataTables.min.js") }}"></script>
    <script type="module" src="{{ asset("Curd/main.js") }}"></script>
    {{-- !preloader --}}
    <link rel="stylesheet" href="{{ asset("Curd/preloader-style.css") }}">
    {{-- !fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('Curd/all.min.css') }}"> --}}
</head>

<body>
</body>
<div class="preloader js-preloader flex-center">
    <div class="dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>
<div id="head">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-6 h1">Crud Tables</div>
                    <div class="col-6 text-end">
                        <!-- Button trigger modal -->
                        <button type="button" id="add_record_button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#add_record_model">
                            <i class="fa-sharp fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="main table-responsive">
                    <table class="table table-success table-striped" id="table">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- !add record model --}}
<div class="modal fade" id="add_record_model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="add_record_modelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_record1">Add Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/post_add_record" class="text-capitalize" id="post_add_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label">name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add">Add</button>
            </div>
        </div>
    </div>
</div>
{{-- ! end add record model --}}

{{-- !edit record model --}}
<div class="modal fade" id="edit_record_model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="edit_record_modelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_record1">Edit Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/post_edit_record" class="text-capitalize" id="post_edit_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label">name</label>
                        <input type="hidden" class="form-control" id="id_edit" name="id_edit">
                        <input type="text" class="form-control" id="name_edit" name="name_edit">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">email</label>
                        <input type="email" class="form-control" id="email_edit" name="email_edit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit_submit">Edit</button>
            </div>
        </div>
    </div>
</div>
{{-- ! end edit record model --}}
</html>
