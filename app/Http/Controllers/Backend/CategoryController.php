<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use Auth;

class CategoryController extends Controller
{
    public function view(){
    	$categories = Category::all();
    	return view('backend.category.view_category',compact('categories'));
    }

    public function add(){
    	return view('backend.category.add_category');
    }

    public function store(Request $request){
    	$category = new Category();
    	$category->name = $request->name;
    	$category->created_by = Auth::user()->id;
    	$category->save();
    	return redirect()->route('view-category')->with('success','Category inserted successfully!');
    }

    public function edit($id){
    	$editCat = Category::find($id);
    	return view('backend.category.edit_category',compact('editCat'));
    }

    public function update(Request $request, $id){
    	$updateCat = Category::find($id);
    	$updateCat->name = $request->name;
    	$updateCat->updated_by = Auth::user()->id;
    	$updateCat->update();
    	return redirect()->route('view-category')->with('success','Category updated successfully!');
    }

    public function delete($id){
    	$deleteCat = Category::find($id);
    	$deleteCat->delete();
    	return redirect()->back()->with('success','Category deleted successfully!');
    }
}
