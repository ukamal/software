<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Units;
use Auth;

class UnitsController extends Controller
{
    public function view(){
    	$data['allData'] = Units::all();
    	return view('backend.units.unit_view',$data);
    }

    public function add(){
    	return view('backend.units.add_units');
    }

    public function store(Request $request){
    	$unitsData = new Units();
    	$unitsData->name = $request->name;
    	$unitsData->created_by = Auth::user()->id;
    	$unitsData->save();
    	return redirect()->route('view-units')->with('success','Units inserted successfully!');
    }

    public function edit(Request $request, $id){
    	$unitEdit = Units::find($id);
    	return view('backend.units.edit_unit',compact('unitEdit'));
    }

    public function update(Request $request, $id){
    	$updateUnit = Units::find($id);
    	$updateUnit->name = $request->name;
    	$updateUnit->updated_by = Auth::user()->id;
    	$updateUnit->update();
    	return redirect()->route('view-units')->with('success','Units updated successfully!');
    }

    public function delete($id){
    	$unitDelete = Units::find($id);
    	$unitDelete->delete();
    	return redirect()->back()->with('success','Units deleted successfully!');
    }
}
