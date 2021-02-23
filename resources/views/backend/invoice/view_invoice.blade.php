@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
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
                                    Invoice List
                                    <a href="{{ route('add-invoice') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-plus-circle"></i> Add Invoice</a>
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
