@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Customer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Invoice </li>
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
                                    Edit Invoice (Invoice No # {{$payment['invoice']['invoice_no']}})
                                    <a href="{{route('credit-customer')}}" class="btn btn-primary float-sm-right"> <i class="fa fa-list"></i> Creadit Customer List</a>
                                    
                                </h3>
                            </div>
                            <div class="card-body">
                                  <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <strong>Customer Info:</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><strong>Name: </strong>{{$payment['customer']['name']}}</td>
                                            <td width="25%"><strong>Mobile No: </strong>{{$payment['customer']['mobile']}}</td>
                                            <td width="30%"><strong>Address: </strong>{{$payment['customer']['address']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form action="{{route('customer_update_invoice',$payment->invoice_id)}}" method="post" id="myForm">
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
                                                $invoice_details = App\Model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                                            @endphp
                                            @foreach($invoice_details as $key => $details)
                                            <tr>
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
                                                <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                                <td><strong>{{$payment->due_amount}}</strong></td>
                                            </tr>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td><strong>Grand Total:</strong></td>
                                                <td><strong>{{$payment->total_amount}}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                         <div class="form-group col-md-3">
                                        <label for="">Paid Status</label>
                                          <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                                              <option value="">Select Status</option>
                                              <option value="full_paid">Full Paid</option>
                                              <option value="partial_paid">Partial Paid</option>
                                          </select>
                                          <input type="text" name="paid_amount" id="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                                          </div>
                                          <div class="form-group col-md-3">
                                            <label>Date</label>
                                            <input type="text" class="datepicker" id="datepicker" name="date" class="form-control" readonly placeholder="dd-mm-yyyy">
                                        </div>
                                        <div class="form-group col-md-3" style="padding-top: 30px;">
                                            <button class="btn btn-primary">Invoice Update</button>
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
        $(document).on('change','#paid_status',function(){
            var paid_status = $(this).val();
            if(paid_status == 'partial_paid'){
                $('.paid_amount').show();
            }else{
                $('.paid_amount').hide();
            }
        });

        //date
      $('.datepicker').datepicker({
          uiLibrary: 'bootstrap4',
          format: 'dd-mm-yyyy'
      });

      //validate
          $(function () {
          $('#myForm').validate({
              rules: {
                  paid_status: {
                      required: true,
                  },
                  date: {
                      required: true,
                  },
              },
              messages: {
                  paid_status: {
                      required: "Please enter a valid name",
                  },
                  date: {
                      required: "Please provide a valid mobile no",
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
