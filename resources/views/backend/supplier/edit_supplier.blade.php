@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Supplier</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Supplier</li>
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
                                    Edit Supplier
                                    <a href="{{ route('view-supplier') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-user"></i>Back</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update-supplier',$editData->id) }}" method="post" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$editData->name}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" class="form-control" value="{{$editData->mobile}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control" value="{{$editData->email}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" value="{{$editData->address}}">
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
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy'
    });
</script>

@endsection
