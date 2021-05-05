<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Model\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
    public function create($id){
        $user = User::findOrFail($id);
        return view('admin.settings.profile',['user'=>$user]);
    }
    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        return view('admin.settings.edit-profile',['user'=>$user]);
    }
    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.settings.change-password',['user'=>$user]);
    }
    public function profileUpdate(Request $request,$id){

        try {
            $filename = null;
            if ($request->hasFile('image')) {
                $filename = time().'_'.$request->file('image')->getClientOriginalName();
                $request->file('image')->move('uploads/api/images',$filename);
            }
            $request_all = $request->all();
            if ($request->has('image')){
                $request_all['image'] = $filename;
            }
            User::findOrFail($id)->update($request_all);
            return redirect()->route('admin.settings.create',$id)->with('success', 'Profile Updated Successfully!');
        }catch (\Exception $e){
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function changePasswordUpdate(Request $request){
            $user = User::findOrFail($request->id);
            if (!Hash::check($request->old_password,$user->password)){
                return response(error_response(500,'Invalid Password'));
            }
            $user->password = Hash::make($request->new_password);
            $user->save();
    }
}
