@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                                    Edit Product
                                    <a href="{{ route('view-product') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-user"></i>Back</a>
                                </h3>
                            </div>
                              <div class="card-body">
                                  <form action="{{ route('store-product') }}" method="post" id="myForm">
                                      @csrf
                                      <div class="form-row">
                                          <div class="form-group col-md-6">
                                              <label for="supplier_id">Supplier Name</label>
                                              <select name="supplier_id" id="supplier_id" class="form-control">
                                                <option value="">Selecte Supplier</option>
                                                 @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="unit_id">Units</label>
                                              <select name="unit_id" id="unit_id" class="form-control">
                                                <option value="">Select Units Name</option>
                                                @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="category_id">Category</label>
                                              <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="name">Product Name</label>
                                              <input type="text" name="name" id="name" class="form-control">
                                          </div>
                                          <div class="form-group col-md-12">
                                              <input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit">
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
                  supplier_id: {
                      required: true,
                  },
                  unit_id: {
                      required: true,
                  },
                  category_id: {
                      required: true,
                  },
                  name: {
                      required: true,
                  },
              },
              messages: {
                  supplier_id: {
                      required: "Please select supplier name",
                  },
                  unit_id: {
                      required: "Please select units",
                  },
                  category_id: {
                      required: "Please provide a Category Name",
                  },
                  name: {
                      required: "Please provide a Product Name",
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
