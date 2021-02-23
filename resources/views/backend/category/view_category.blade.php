@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
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
                                    Category List
                                    
                                    <a href="{{ route('add-category') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add Category</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
@foreach($categories as $key => $category)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$category->name}}</td>
        @php
        $count_category = App\Model\Product::where('category_id',$category->id)->count();
        @endphp
        <td>
            <a title="Edit" href="{{ route('edit-category',$category->id) }}" class="btn btn-sm btn-primary">
                <i class="fa fa-edit"></i>
            </a>
            @if($count_category <1)
            <a title="Delete" id="delete" href="{{ route('delete-category',$category->id)}}" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </a>
            @endif
        </td>
    </tr>
@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
