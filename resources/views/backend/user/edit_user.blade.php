@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                Edit User
                <a href="{{ route('view-user') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-list"></i>User List</a>
              </h3>
              </div>
              <div class="card-body">
                <form action="{{ route('update-user',$editData->id) }}" method="post" id="myForm">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="usertype">User Role</label>
                      <select name="usertype" id="usertype" class="form-control">
                        <option value="">Select Role</option>
                        <option value="Admin" {{($editData->usertype=="Admin")?"selected":""}}>Admin</option>
                        <option value="User" {{($editData->usertype=="User")?"selected":""}}>User</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="name">Name</label>
                      <input type="text" name="name" value="{{$editData->name}}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" name="email" value="{{$editData->email}}" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                      <input type="submit" class="btn btn-primary btn-lg btn-block" value="Update">
                    </div>
                  </div>
                </form>
              </div>
          </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
$(function () {
  $('#myForm').validate({
    rules: {
      usertype: {
        required: true,
        usertype: true,
      },
      name: {
        required: true,
        name: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 8
      },
      password2: {
        required: true,
        equalTo: '#password'
      },
    },
    messages: {
      usertype: {
        required: "Please enter a roles",
      },
      name: {
        required: "Please enter a valid name",
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
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
 
 @endsection