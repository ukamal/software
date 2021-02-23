@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Paid Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
                                    Paid Customer List
                                    
                                    <a target="_blank" href="{{ route('paid-customer-pdf') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-download"></i> Download PDF</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($allData as $key => $payment)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                            {{$payment['customer']['name']}},
                                            {{$payment['customer']['mobile']}},
                                            {{$payment['customer']['address']}}
                                            </td>
                                            <td>Invoice No # {{$payment['invoice']['invoice_no']}}</td>
                                            <td>
                                                {{date('d-m-Y',strtotime($payment['invoice']['date']))}}
                                            </td>
                                            <td>{{$payment->paid_amount}} Tk</td>
                                            <td>
                                                <a title="Details" id="details" href="{{route('customer-details-invoice-pdf',$payment->invoice_id)}}" class="btn btn-sm btn-success" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                              <table id="example1" class="table table-bordered table-hover">
                                <tbody>
                                    @php
                                        $total_paid = '0';
                                    @endphp
                                    @foreach($allData as $key => $payment)
                                        <tr>
                                            
                                            @php
                                                $total_paid += $payment->paid_amount;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Grand Total :</strong> </td>
                                        <td><strong>{{$total_paid}} Tk</strong></td>
                                    </tr>
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
