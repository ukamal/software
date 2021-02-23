<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Units;
use App\Model\Category;
use App\Model\Purchase;
use Auth;
use DB;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use PDF;

class InvoiceController extends Controller
{
    public function view(){
    	$invoices = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
    	return view('backend.invoice.view_invoice',compact('invoices'));
    }

    public function add(){
    	$data['categories'] = Category::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if ($invoice_data == null) {
            $firstReg = '0';
            $data['invoice_no'] = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data+1;
        }
        $data['customers'] = Customer::all();
        $data['date'] = date('Y-m-d');
    	return view('backend.invoice.add_invoice',$data);
    }

    public function store(Request $request){
        if ($request->category_id == null) {
            return redirect()->back()->with("error","Sorry! You didn't select any products");
        }else{
            if ($request->paid_amount>$request->estimated_amount) {
                return redirect()->back()->with('Sorry','Please check again later for submission!');
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->created_by = Auth::user()->id;
               
                DB::transaction(function() use($request,$invoice) {
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++) { 
                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d',strtotime($request->date));
                            $invoice_details->invoice_id  = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id  = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price  = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status      = '0';
                            $invoice_details->save();
                        }
                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name    = $request->name;
                            $customer->mobile  = $request->mobile;
                            $customer->email   = $request->email;
                            $customer->address = $request->address;
                            $customer->status  =  '1';
                            $customer->created_by = Auth::user()->id;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }

                        $payment              = new Payment();
                        $payment_details      = new PaymentDetail();
                        $payment->invoice_id  = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                       if ($request->paid_status == 'full_paid') {
                           $payment->paid_amount = $request->estimated_amount;
                           $payment->due_amount = '0';
                           $payment_details->current_paid_amount = $request->estimated_amount;
                       }elseif ($request->paid_status == 'full_due') {
                           $payment->paid_amount = '0';
                           $payment->due_amount = $request->estimated_amount;
                           $payment_details->current_paid_amount = '0';
                       }elseif ($request->paid_status == 'partial_paid') {
                           $payment->paid_amount = $request->paid_amount;
                           $payment->due_amount = $request->estimated_amount-$request->paid_amount;
                           $payment_details->current_paid_amount = $request->paid_amount;
                       }
                       $payment->save();
                       $payment_details->invoice_id = $invoice->id;
                       $payment_details->date = date('Y-m-d',strtotime($request->date));
                       $payment_details->save();
                    }
                });
            }
        }
        return redirect()->route('view-invoice')->with('success','Data saved successfully!');
    }

    public function invoicePendingList(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.invoice_pending_list',compact('invoices'));
    }

    public function approvedInvoice($id){
        $invoices = Invoice::with(['invoice_details'])->findOrFail($id);
        return view('backend.invoice.invoice_approved', compact('invoices'));

    }

    public function delete($id){
        $invoice = Invoice::find($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();

        return redirect()->route('invoice-pending-list')->with('success','Data delete successfully!');
    }

    public function approvalStore(Request $request, $id){
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product = Product::where('id',$invoice_details->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]) {
                return redirect()->back()->with('error','Sorry! You approve maximum value');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approve_by = Auth::user()->id;
        $invoice->status = '0';
        DB::transaction(function() use ($request,$invoice,$id){
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '0';
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((float)$request->selling_qty[$key]);
                $product->save();
            }
            $invoice->save();
        });
        return redirect()->route('invoice-pending-list')->with('success','Invoice successfully Approved!');
    }

    public function invoicePrintList(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.pos_invoice_list',compact('invoices'));
    }

    function invoicePrint($id) {
        $data['invoices'] = Invoice::with(['invoice_details'])->find($id);
        $pdf = PDF::loadView('backend.pdf.invoice_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    //Daily Invoice Report
    public function dailyInvoiceReport(){
       return view('backend.invoice.daily_invoice_report');
    }
    public function dailyReportPdf(Request $request){
        $sdata = date('Y-m-d',strtotime($request->start_date));
        $edata = date('Y-m-d',strtotime($request->end_date));
        $data['allData'] = Invoice::whereBetween('date',[$sdata,$edata])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.daily_invoice_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
