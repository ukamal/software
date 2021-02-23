@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Pending Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pending Invoice</li>
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
                                    Invoice No:#{{$invoices->invoice_no}},Date:{{date('D-M-Y',strtotime($invoices->date))}}
                                    <a href="{{ route('invoice-pending-list') }}" class="btn btn-primary float-sm-right"> <i class="fa fa-list"></i> Pending Invoice List </a>
                                </h3>
                            </div>
                            <div class="card-body">
                            @php
                            $payment = App\Model\Payment::where('invoice_id',$invoices->id)->first();
                            @endphp
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="20%"><strong>Custome Info:</strong></td>
                                            <td width="25%"><strong>Name: </strong>{{$payment['customer']['name']}}</td>
                                            <td width="25%"><strong>Mobile No: </strong>{{$payment['customer']['mobile']}}</td>
                                            <td width="30%"><strong>Address: </strong>{{$payment['customer']['address']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%"></td>
                                            <td width="15%" colspan="3"><strong>Description :</strong>{{$invoices->description}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <form action="{{route('approval.store',$invoices->id)}}" method="post">
                                    @csrf
                                    <table width="100%" border="1">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Category Name:</th>
                                                <th>Product Name:</th>
                                                <th style="text-align: center;background: #ddd;padding: 1px">Current Stock:</th>
                                                <th>Quantity:</th>
                                                <th>Unit Price:</th>
                                                <th>Total Price:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sum = '0';
                                            @endphp
                                            @foreach($invoices['invoice_details'] as $key => $details)
                                            <tr>
                                                <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                                                <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                                                <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                                                <td>{{$key+1}}</td>
                                                <td>{{$details['category']['name']}}</td>
                                                <td>{{$details['product']['name']}}</td>
                                                <td style="text-align: center;background: #ddd;padding: 1px">{{$details['product']['quantity']}}</td>
                                                <td>{{$details->selling_qty}}</td>
                                                <td>{{$details->unit_price}}</td>
                                                <td>{{$details->selling_price}}</td>
                                            </tr>
                                            @php
                                                $total_sum += $details->selling_price;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="5"></td>
                                                <td><strong>Sub Total:</strong></td>
                                                <td><strong>{{$total_sum}}/=</strong></td>
                                            </tr>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td><strong>Discount:</strong></td>
                                                <td><strong>{{$payment->discount_amount}}</strong></td>
                                            </tr>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td><strong>Paid Amount:</strong></td>
                                                <td><strong>{{$payment->paid_amount}}</strong></td>
                                            </tr>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td><strong>Due Amount:</strong></td>
                                                <td><strong>{{$payment->due_amount}}</strong></td>
                                            </tr>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td><strong>Grand Total:</strong></td>
                                                <td><strong>{{$payment->total_amount}}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <button type="submit" class="btn btn-success">Invoice Approve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
