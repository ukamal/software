@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Customer wise Report</h1>
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
                                    Select Criteria
                                </h3>
                            </div>
                            <div class="card-body">
                              <div class="row">
 <div class="col-md-12 text-center">
     <strong>Customer Wise Credit Report</strong>
     <input type="radio" name="customer_wise_report" value="scustomer_wise_credit" class="search_value">
     <strong style="margin-left: 50px;">Customer Wise Paid Report</strong>
     <input type="radio" name="customer_wise_report" value="customer_wise_paid" class="search_value">
 </div>
</div>
<div class="show_credit" style="display: none;">
 <form action="{{route('customer-wise-credit-report')}}" method="get" id="customer_credit_wise_form" target="_blank">
     <div class="form-row">
          <div class="col-md-10">
             <label for="">Customer Name</label>
             <select name="customer_id" id="customer_id" class="form-control select2">
                 <option value="">Select Customer</option>
                @foreach($customers as $customer)
                 <option value="{{$customer->id}}">Name:{{$customer->name}},Mobile:{{$customer->mobile}},Address:{{$customer->address}}</option>
                @endforeach
             </select>
         </div>
        <div class="col-md-2" style="margin-top: 25px;">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
     </div>
 </form>
</div>
                              
<div class="show_paid" style="display: none;">
 <form action="{{route('customer-wise-paid-report')}}" method="get" id="customer_paid_wise_form" target="_blank">
     <div class="form-row">
         <div class="col-sm-10">
            <label>Customer Name</label>
            <select name="customer_id" id="customer_id" class="form-control select2">
              <option value="">Customer Name</option>
              @foreach($customers as $customer)
                <option value="{{$customer->id}}">Name:{{$customer->name}},Mobile:{{$customer->mobile}},Address:{{$customer->address}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2" style="margin-top: 25px;">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
     </div>
 </form>
</div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
          $(function () {
              $('#customer_credit_wise_form').validate({
                  rules: {
                      customer_id: {
                          required: true,
                      }
                  },
                  messages: {

                  },
                ignore:[],
                errorPlacement:function(error,element){
                   if (element.attr("name") == "customer_id") {
                        error.insertAfter(element.next());
                   }else{
                    error.insertAfter(element);
                   }
                },
                errorClass:'text-danger',
                validClass:'text-success',
              });
          });

          //Show Supplier / Product wise
          $(document).on('change','.search_value',function(){
            var search_value = $(this).val();
            if (search_value == 'scustomer_wise_credit') {
                $('.show_credit').show();
            }else{
                $('.show_credit').hide();
            }
            if (search_value == 'customer_wise_paid') {
              $('.show_paid').show();
            }else{
              $('.show_paid').hide();
            }
          });
    </script>
    <script>
        $(function () {
              $('#customer_paid_wise_form').validate({
                  rules: {
                      customer_id: {
                          required: true,
                      },
                  },
                  messages: {

                  },
                ignore:[],
                errorPlacement:function(error,element){
                   if (element.attr("name") == "category_id") {
                        error.insertAfter(element.next());
                   }else{
                     error.insertAfter(element);
                   }
                },
                errorClass:'text-danger',
                validClass:'text-success',
              });
          });
    </script>


@endsection
