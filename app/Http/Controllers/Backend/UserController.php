<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function viewUser(){
    	$data['allData'] = User::all();

    	// compact way
    	// $allData = User::all();
    	return view('backend.user.view_user',$data);
    }

    public function addUser(){
    	// dd($kamal->toArray());
    	return view('backend.user.add_user');
    }

    public function store(Request $request){
    	$data = new User();
    	$data->usertype = $request->usertype;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->password = bcrypt($request->password);
    	$data->save();
    	return redirect()->route('view-user')->with('success','Data inserted successfully!');
    }
    
    public function editUser($id){
        $editData = User::find($id);
        //dd($editData);
        return view('backend.user.edit_user',compact('editData'));
    }
    
    public function updateUser(Request $request, $id){
        $data = User::find($id);
    	$data->usertype = $request->usertype;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->save();
    	return redirect()->route('view-user')->with('success','Data updated successfully!');
    }
    
    public function deleteUser($id){
        $deleteData = User::find($id);
        if(file_exists('public/upload/user_images/' . $deleteData->image) AND ! empty($deleteData->image)){
            unlink('public/upload/user_images/' . $deleteData->image);
        }
        $deleteData->delete();
    	return redirect()->route('view-user')->with('success','Data deleted successfully!');
    }
}



