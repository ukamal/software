<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice Details PDF</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tr>
						<td><strong>Invoice No:# {{$payment['invoice']['invoice_no']}}</strong></td>
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
						<td><u><strong>Customer Invoice Details:</strong></u></td>
						<td></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
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
                <tr>
                	<td colspan="7" style="text-align: center;font-weight: bold;">Paid Summery</td>
                </tr>
                <tr>
                	<td colspan="3" style="text-align: left;">Date:</td>
                	<td colspan="4">Amount:</td>
                </tr>
                @php
                	$payment_details = App\Model\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                @endphp
                @foreach($payment_details as $pay_detail)
                <tr>
                	<td colspan="3">{{date('d-m-Y',strtotime($pay_detail->date))}}</td>
                	<td colspan="4">{{$pay_detail->current_paid_amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

            @php
            $date = new DateTime('now', new dateTimezone('Asia/Dhaka'));
            @endphp
            <i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i>

            <br>
            <hr>
            <table width="100%">
            	<tbody>
            		<tr>
            			<td><p>Customer Signuture</p></td>
            			<td width="60%"></td>
            			<td><p style="float: right;">Seller Signuture</p></td>
            		</tr>
            	</tbody>
            </table>
	</body>
</html>