<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use Auth;
use PDF;
use App\Model\Payment;
use App\Model\PaymentDetail;

class CustomerController extends Controller
{
    public function view(){
    	$data['allData'] = Customer::all();
    	return view('backend.customer.view_customer',$data);
    }

    public function add(){
    	return view('backend.customer.add_customer');
    }

    public function store(Request $request){
    	$CustomerData = new Customer();
    	$CustomerData->name 	= $request->name;
    	$CustomerData->email 	= $request->email;
    	$CustomerData->mobile 	= $request->mobile;
    	$CustomerData->address 	= $request->address;
    	$CustomerData->created_by = Auth::user()->id;
    	$CustomerData->save();
    	 return redirect()->route('view-customer')->with('success','Supplier inserted successfully!');
    }

    public function edit($id){
    	$editData = Customer::find($id);
    	return view('backend.customer.edit_customer',compact('editData'));
    }

    public function update(Request $request, $id){
    	$updateData = Customer::find($id);
    	$updateData->name 	= $request->name;
    	$updateData->email 	= $request->email;
    	$updateData->mobile 	= $request->mobile;
    	$updateData->address 	= $request->address;
    	$updateData->updated_by = Auth::user()->id;
    	$updateData->update();
    	return redirect()->route('view-customer')->with('success','Supplier Information updated successfully!');
    }

    public function delete($id){
    	$customerDelete = Customer::find($id);
    	$customerDelete->delete();
    	return redirect()->back()->with('success','Supplier Information Deleted successfully!');
    }

    public function creditCustomer(){
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        //dd($allData->toArray());
        return view('backend.customer.credit_customer',compact('allData'));
    }

    public function creditCustomerPdf(Request $request){
        $data['allData'] = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.credit_customer_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function editInvoice($invoice_id){
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.customer.edit_invoice',compact('payment'));
    }

    public function updateInvoice(Request $request, $invoice_id){
       if ($request->new_paid_amount<$request->paid_amount) {
           return redirect()->back()->with('error','Sorry! You have paid maximum value');
       }else{
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        $payment_details = new PaymentDetail();
        $payment->paid_status = $request->paid_status;
        if ($request->paid_status=='full_paid') {
            $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
            $payment->due_amount = '0';
            $payment_details->current_paid_amount = $request->new_paid_amount;
        }elseif ($request->paid_status=='partial_paid') {
             $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
            $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
            $payment_details->current_paid_amount = $request->paid_amount;
        }
        $payment->save();
        $payment_details->invoice_id = $invoice_id;
        $payment_details->date = date('Y-m-d',strtotime($request->date));
        $payment_details->save();
        return redirect()->route('credit-customer')->with('success','Invoice successfully Updated');
       }
    }

    public function csDetailsInvoicePdf($invoice_id){
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('backend.pdf.customer_invoice_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function paidCustomer(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        //dd($allData->toArray());
        return view('backend.customer.paid_customer',compact('allData'));
    }

    public function paidCustomerPdf(Request $request){
        $data['allData'] = Payment::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('backend.pdf.paid_customer_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function customerReport(){
        $customers = Customer::all();
        return view('backend.customer.customer_wise_report',compact('customers'));
    }

    public function customerCreditReport(Request $request){
        $data['allData'] = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.customer_wise_credit_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function customerPaidReport(Request $request){
        $data['allData'] = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('backend.pdf.customer_wise_paid_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
