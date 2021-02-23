<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daily Purchase Report</title>
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
						<td width="35%"></td>
						<td>
                            <u><strong>Daily Purchase Report: {{date('d-m-y',strtotime($start_date))}}-  {{date('d-m-y',strtotime($end_date))}}</strong>
                            </u>
                        </td>
						<td></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	   
         <div class="card-body">
<table id="example1" class="table table-bordered table-hover table-responsive" width="100%" border="1">
<thead>
<tr>
    <th>SL.</th>
    <th>Purchase No</th>
    <th>Date</th>
    <th>product Name</th>
    <th>Quantity</th>
    <th>Unit Pprice</th>
    <th>Total Price</th>
</tr>
</thead>
<tbody>
    @php
        $total_sum = '0';
    @endphp
@foreach($allData as $key => $purchase)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$purchase->purchase_no}}</td>
        <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
        <td>{{$purchase['product']['name']}}</td>
        <td>
            {{$purchase->buying_qty}}
            {{$purchase['product']['unit']['name']}}
        </td>
        <td>{{$purchase->unit_price}}</td>
        <td>{{$purchase->buying_price}}</td>
        @php
            $total_sum += $purchase->buying_price;
        @endphp
    </tr>
@endforeach
<tr>
    <td colspan="6" style="text-align: right;"><strong>
        Grand Total :
    </strong></td>
    <td>{{$total_sum}}</td>
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