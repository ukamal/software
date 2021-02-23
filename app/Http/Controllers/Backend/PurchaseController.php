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
use PDF;

class PurchaseController extends Controller
{
    public function view(){
    	$purchases = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
    	return view('backend.purchase.view_purchase',compact('purchases'));
    }

    public function add(){
    	$data['suppliers']  = Supplier::all();
    	$data['units'] 		= Units::all();
    	$data['categories'] = Category::all();
    	return view('backend.purchase.add_purchase',$data);
    }

    public function store(Request $request){
        if ($request->category_id == null) {
            return redirect()->back()->with('error','Sorry! You do not select any item');
        }else{
           $count_category = count($request->category_id);
           for ($i=0; $i < $count_category; $i++) { 
               $purchase = new Purchase();
               $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
               $purchase->supplier_id = $request->supplier_id[$i];
               $purchase->category_id = $request->category_id[$i];
               $purchase->product_id = $request->product_id[$i];
               $purchase->purchase_no = $request->purchase_no[$i];
               $purchase->description = $request->description[$i];
               $purchase->buying_qty = $request->buying_qty[$i];
               $purchase->unit_price = $request->unit_price[$i];
               $purchase->buying_price = $request->buying_price[$i];
               $purchase->created_by = Auth::user()->id;
               $purchase->status = '0';
               $purchase->save();
           }
        }
        return redirect()->route('view-purchase')->with('success','Data successfully Saved!');
    }

    public function delete($id){
        $deletePurchase = Purchase::find($id);
        $deletePurchase->delete();
        return redirect()->route('view-purchase')->with('success','Data deleted successfully!');
    }

    public function pendingList(){
       $purchases = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
       return view('backend.purchase.view_pending_list',compact('purchases'));
    }

    public function approved($id){
       $purchase = Purchase::find($id);
       $product = Product::where('id',$purchase->product_id)->first();
       $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
       $product->quantity = $purchase_qty;
       if($product->save()){
        DB::table('purchases')->where('id',$id)->update(['status' => 1]);
       }
       return redirect()->route('pending-list')->with('success','Data approved successfully!');
    }

    public function dailyPurchaseReport(){
      return view('backend.purchase.daily_purchase_report');
    }

    public function dailyPurchaseReportPdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $data['allData'] = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->orderBy('supplier_id')->orderBy('category_id')->orderBy('product_id')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.daily_purchase_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
