@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Invoice List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice Pending List</li>
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
                                    Invoice Pending List
                                </h3>
                            </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Customer Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th width="12%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $key => $invoice)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    Name:{{$invoice['payment']['customer']['name']}},
                                                    Mobile:{{$invoice['payment']['customer']['mobile']}},
                                                    Address:{{$invoice['payment']['customer']['address']}}
                                                </td>
                                                <td>Invoice No: #{{$invoice->invoice_no}}</td>
                                                <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                                                <td>{{$invoice->description}}</td>
                                                <td>{{$invoice['payment']['total_amount']}}</td>
                                                <td>
                                                    @if($invoice->status=='0')
                                                    <span style="background: red;padding: 5px">Pending</span>
                                                    @elseif($invoice->status=='1')
                                                    <span style="background: green">Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($invoice->status=='0')
                                                    <a title="Approved" id="approveBtn" href="{{ route('invoice-approve',$invoice->id)}}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-check-circle"></i>
                                                    </a>
                                                     <a title="Delete" id="delete" href="{{ route('delete-invoice',$invoice->id)}}" class="btn btn-sm btn-danger">
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
