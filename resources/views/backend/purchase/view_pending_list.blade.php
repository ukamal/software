@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Purchase</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Purchase</li>
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
                                    Pending Purchase List
                                    <!-- <a href="" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add Purchase</a> -->
                                </h3>
                            </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Purchase No</th>
                                            <th>Date</th>
                                            <th>Supplier Name</th>
                                            <th>Category</th>
                                            <th>product Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Pprice</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th width="8%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchases as $key => $purchase)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$purchase->purchase_no}}</td>
                                                <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                                                <td>{{$purchase['supplier']['name']}}</td>
                                                <td>{{$purchase['category']['name']}}</td>
                                                <td>{{$purchase['product']['name']}}</td>
                                                <td>{{$purchase->description}}</td>
                                                <td>
                                                    {{$purchase->buying_qty}}
                                                    {{$purchase['product']['unit']['name']}}
                                                </td>
                                                <td>{{$purchase->unit_price}}</td>
                                                <td>{{$purchase->buying_price}}</td>
                                                <td>
                                                    @if($purchase->status=='0')
                                                    <span style="background: red;padding: 5px">Pending</span>
                                                    @elseif($purchase->status=='1')
                                                    <span style="background: green">Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($purchase->status=='0')
                                                    <a title="Approved" id="approveBtn" href="{{ route('purchase-approve',$purchase->id)}}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-check-circle"></i>
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
