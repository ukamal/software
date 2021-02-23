@extends('backend.layouts.master')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Supplier/Product wise stock</h1>
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
                                    Select Criteria
                                </h3>
                            </div>
                            <div class="card-body">
<div class="row">
   <div class="col-md-12 text-center">
       <strong>Supplier Wise Report</strong>
       <input type="radio" name="supplier_wise" value="supplier_wise" class="search_value">
       <strong style="margin-left: 50px;">Product Wise Report</strong>
       <input type="radio" name="supplier_wise" value="product_wise" class="search_value">
   </div>
</div>
<div class="show_supplier" style="display: none;">
 <form action="{{route('stock-report-supplier-wise-pdf')}}" method="get" id="supplier_wise_form" target="_blank">
     <div class="form-row">
          <div class="col-md-6 offset-2">
             <label for="">Supplier Name</label>
             <select name="supplier_id" id="" class="form-control select2">
                 <option value="">Select Supplier</option>
                 @foreach($suppliers as $supplier)
                 <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                 @endforeach
             </select>
         </div>
        <div class="col-md-4" style="margin-top: 25px;">
          <button type="submit" class="btn btn-primary">Search</button>
        </div>
     </div>
 </form>
</div>
                              
<div class="show_product" style="display: none;">
 <form action="{{route('stock-report-product-wise-pdf')}}" method="get" id="product_wise_form" target="_blank">
     <div class="form-row">
         <div class="col-sm-4">
            <label>Category Name</label>
            <select name="category_id" id="category_id" class="form-control select2">
              <option value="">Category Name</option>
              @foreach($categories as $categorie)
              <option value="{{$categorie->id}}">{{$categorie->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="col-sm-6">
            <label>Product Name</label>
             <select name="product_id" id="product_id" class="form-control">
              <option value="">Select Product</option>
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
              $('#supplier_wise_form').validate({
                  rules: {
                      supplier_id: {
                          required: true,
                      },
                  },
                  messages: {

                  },
                ignore:[],
                errorPlacement:function(error,element){
                   if (element.attr("name") == "supplier_id") {
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
            if (search_value == 'supplier_wise') {
                $('.show_supplier').show();
            }else{
                $('.show_supplier').hide();
            }
            if (search_value == 'product_wise') {
              $('.show_product').show();
            }else{
              $('.show_product').hide();
            }
          });
    </script>
    <script>
        $(function () {
              $('#product_wise_form').validate({
                  rules: {
                      category_id: {
                          required: true,
                      },
                      product_id: {
                          required: true,
                      },
                  },
                  messages: {

                  },
                ignore:[],
                errorPlacement:function(error,element){
                   if (element.attr("name") == "category_id") {
                        error.insertAfter(element.next());
                   }else if(element.attr("name") == "product_id"){
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
    
    <script type="text/javascript">
      $(function(){
        $(document).on('change','#category_id',function(){
          var category_id = $(this).val();
          $.ajax({
            url:"{{route('get-product')}}",
            type:"GET",
            data:{category_id:category_id},
            success:function(data){
              var html = '<option value="">Select Product</option>';
              $.each(data,function(key,v){
                html +='<option value="'+v.id+'">'+v.name+'</option>';
              });
              $('#product_id').html(html);
            }
          });
        });
      });
    </script>


@endsection
