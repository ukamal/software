@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Password </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Password</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Add User
                                    <a href="{{ route('view-user') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-list"></i>User List</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('password-update') }}" method="post" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="current_password">Current Password</label>
                                            <input type="password" name="current_password" id="current_password" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="new_password">New Password</label>
                                            <input type="password" name="new_password" id="new_password" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="con_password">Confirm New Password</label>
                                            <input type="password" name="con_password" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="submit" class="btn btn-primary" value="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>  <script>
                            $(function () {
                                $('#myForm').validate({
                                    rules: {
                                        current_password: {
                                            required: true,
                                            minlength: 8
                                        },
                                        new_password: {
                                            required: true,
                                            minlength: 8
                                        },
                                        con_password: {
                                            required: true,
                                            equalTo: '#new_password'
                                        },
                                    },
                                    messages: {
                                        current_password: {
                                            required: "Please provide a current password",
                                            minlength: "Your password must be at least 8 characters long"
                                        },
                                        new_password: {
                                            required: "Please provide a new password",
                                        },
                                        con_password: {
                                            required: "Please provide a again new password",
                                        },
                                        terms: "Please accept our terms"
                                    },
                                    errorElement: 'span',
                                    errorPlacement: function (error, element) {
                                        error.addClass('invalid-feedback');
                                        element.closest('.form-group').append(error);
                                    },
                                    highlight: function (element, errorClass, validClass) {
                                        $(element).addClass('is-invalid');
                                    },
                                    unhighlight: function (element, errorClass, validClass) {
                                        $(element).removeClass('is-invalid');
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
