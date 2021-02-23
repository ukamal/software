<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Units;
use App\Model\Category;
use Auth;

class ProductController extends Controller
{
    public function view(){
    	$products = Product::all();
    	return view('backend.product.view_product',compact('products'));
    }

    public function add(){
    	$data['suppliers']  = Supplier::all();
    	$data['units'] 		= Units::all();
    	$data['categories'] = Category::all();
    	return view('backend.product.add_product',$data);
    }

    public function store(Request $request){
    	$product = new Product();
    	$product->supplier_id = $request->supplier_id;
    	$product->unit_id 	  = $request->unit_id;
    	$product->category_id = $request->category_id;
    	$product->name 		  = $request->name;
    	$product->quantity 	  = '0';
    	$product->created_by  = Auth::user()->id;
    	$product->save();
    	return redirect()->route('view-product')->with('success','Data inserted successfully!');
    }

    public function edit(Request $request, $id){
    	$data['products']   = Product::find($id);
    	$data['suppliers']  = Supplier::all();
    	$data['units'] 		= Units::all();
    	$data['categories'] = Category::all();
    	return view('backend.product.edit_product',$data);
    }

    public function update(Request $request, $id){
    	$product = Product::find($id);
    	$product->supplier_id = $request->supplier_id;
    	$product->unit_id 	  = $request->unit_id;
    	$product->category_id = $request->category_id;
    	$product->name 		  = $request->name;
    	$product->updated_by  = Auth::user()->id;
    	$product->update();
    	return redirect()->route('view-product')->with('success','Data updated successfully!');
    }

    public function delete($id){
    	$product = Product::find($id);
    	$product->delete();
    	return redirect()->back()->with('success','Data updated successfully!');
    }
}
