<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daily Invoice Report</title>
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
						<td width="45%"></td>
						<td><u><strong>Daily Invoice Report: {{date('d-m-y',strtotime($start_date))}}-  {{date('d-m-y',strtotime($end_date))}}</strong></u></td>
						<td width="30%"></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	   
         <div class="card-body">
            <table id="example1" class="table table-bordered table-hover table-responsive" border="1" width="100%">
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
                    @php
                        $total_sum = '0';
                    @endphp
                @foreach($allData as $key => $invoice)
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
                        @php 
                            $total_sum += $invoice['payment']['total_amount'];
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">Grand Total</td>
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
	</body>
</html>