<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = Supplier::all();
        return view('backend.supplier.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.supplier.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = New Supplier();
        $data->name    = $request->name;
        $data->email   = $request->email;
        $data->mobile  = $request->mobile;
        $data->address = $request->address;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('view-supplier')->with('success','Supplier inserted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Supplier::find($id);
        return view('backend.supplier.edit_supplier',compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = Supplier::find($id);
        $updateData->name   = $request->name;
        $updateData->email  = $request->email;
        $updateData->mobile = $request->mobile;
        $updateData->address = $request->address;
        $updateData->updated_by   = Auth::user()->id;
        $updateData->update();
        return redirect()->route('view-supplier')->with('success','Supplier updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daleteData = Supplier::find($id);
        $daleteData->delete();
        return redirect()->back();
    }
}
