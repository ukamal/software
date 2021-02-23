<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Units;
use App\Model\Category;
use Auth;
use PDF;

class StockController extends Controller
{
    public function stockReport(){
    	$allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
    	return view('backend.stock.stock_report',compact('allData'));
    }

    public function stockReportPdf(){
    	$data['allData'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
    	$pdf = PDF::loadView('backend.pdf.stock_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Stock-Report-PDF.pdf');
    }

    public function supplierProductWise(){
    	$data['suppliers'] = Supplier::all();
    	$data['categories'] = Category::all();
    	return view('backend.stock.suplier_product_wise',$data);
    }

    public function supplierWisePdf(Request $request){
    	$data['allData'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
    	$pdf = PDF::loadView('backend.pdf.supplier_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Stock-Report-PDF.pdf');
    }

    public function productWisePdf(Request $request){
    	$data['product'] = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
    	$pdf = PDF::loadView('backend.pdf.product_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('Stock-Report-PDF.pdf');
    }
}
