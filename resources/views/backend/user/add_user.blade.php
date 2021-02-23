@extends('backend.layouts.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add User</h1>
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
                Add User
                <a href="{{ route('view-user') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-list"></i>User List</a>
              </h3>
              </div>
              <div class="card-body">
                <form action="{{ route('store-user') }}" method="post" id="myForm">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="usertype">User Role</label>
                      <select name="usertype" id="usertype" class="form-control">
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="password">Confirm Password</label>
                      <input type="password" name="password2" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="submit" class="btn btn-primary" value="submit">
                    </div>
                  </div>
                </form>
              </div>
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

              
          </div>
        </div>
      </div>
    </section>
  </div>



 @endsection
