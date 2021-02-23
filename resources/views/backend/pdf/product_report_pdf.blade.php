<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stock Report PDF</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tr>
						<td><strong></strong></td>
						<td><span style="font-size: 20px;background: #ddd;">FreelancerPharmacy <br> </span>Bhulta, Rupganj, Narayanganj</td>
						<td><span>ShowRoom No:0123654789 <br> Owner No:0213654789</span></td>
					</tr>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<table>
					<tbody>
					  <tr>
						<td width="50%"></td>
						<td><u><strong>Product Wise Stock Report</strong></u></td>
						<td></td>
					  </tr>
					  <tr>
					  	<td>
							
						</td>
					  </tr>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	   
         <div class="card-body">
            <table id="example1" border="1" width="100%">
                <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>In: Qty</th>
                    <th>Out: Qty</th>
                    <th>Stock</th>
                    <th>Units</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $buying_total = App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                    $selling_total = App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                @endphp
                    <tr>
                        <td>{{$product['supplier']['name']}}</td>
                        <td>{{$product['category']['name']}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$buying_total}}</td>
                        <td>{{$selling_total}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product['unit']['name']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
            <br>
            <hr>
        <table width="100%">
        	<tbody>
        		<tr>
        			<td></td>
        			<td width="60%"></td>
        			<td><p style="float: right;border-bottom: 1px solid #ddd">Owner Signuture</p></td>
        		</tr>
        	</tbody>
        </table>
        @php
        	$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        @endphp
        <i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i>
	</body>
</html>