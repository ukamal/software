<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Wise Paid Report</title>
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
                        <td width="55%"></td>
                        <td><u><strong>Customer Wise Paid Report</strong></u></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
       
         <div class="card-body">
              <table id="example1" class="table table-bordered table-hover" width="100%" border="1">
                <thead>
                <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $total_paid = '0';
                    @endphp
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
                            @php
                                $total_paid += $payment->paid_amount;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td style="text-align: right;">Grand Total : </td>
                        <td>{{$total_paid}}</td>
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