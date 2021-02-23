<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{

    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        //dd($user);
        return view('backend.user.view_profile',compact('user'));
    }

    public function edit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.user.edit_profile',compact('editData'));
    }

    public function update(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->mobile   = $request->mobile;
        $data->address  = $request->address;
        $data->gender   = $request->gender;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('/upload/user_images/'.$data->image));
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('/upload/user_images'),$filename);
            $data['image']= $filename;
        }
        $data->save();

        return redirect()->route('profiles-view')->with('Profile updated successfully!');
    }

    public function passwordView(){
        return view('backend.user.edit_password');
    }

    public function passwordUpdate(Request $request){
        if (Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->current_password])) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('profiles-view')->with('success','Password change successfully!');
        }else{
            //dd('ok');
            return redirect()->back()->with('error','Your current password dotch not match ');
        }
        //dd('ok');
    }

}
