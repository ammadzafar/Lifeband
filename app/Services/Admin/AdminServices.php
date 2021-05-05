<?php


namespace App\Services\Admin;

use App\Mail\AdminInviteMail;
use App\Model\Organization;
use App\Model\User;
use Illuminate\Support\Facades\Mail;

class AdminServices
{
    public function organizationStore($request)
    {
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->category = $request->category;

        if ($request->hasFile('image'))
        {
            $filename =$request->file('image')->getClientOriginalName();
            $request->file('image')->move('uploads/organization/logos',$filename);
        }

        $organization->image = $filename;
        $organization->email = $request->email;
        $organization->bands = $request->bands;
        $organization->admin_name = $request->admin_name;

        $organization->save();

        Mail::to($organization->email)->send(new AdminInviteMail($organization));
    }
//    public function Edit($id)
//    {
//        $organization = Organization::findorfail($id);
////        dd($organization);
//        return view('admin.organization.modal',compact('organization'));
//    }
    public function update($request,$id)
    {
        $update_organization = Organization::findorfail($id);
        $update_organization->name = $request->name;
        $update_organization->category = $request->category;

        if ($request->hasFile('image'))
        {
            $filename =$request->file('image')->getClientOriginalName();
            $request->file('image')->move('uploads/organization/logos',$filename);
        }

        $update_organization->image = $filename;
        $update_organization->email = $request->email;
        $update_organization->bands = $request->bands;
        $update_organization->admin_name = $request->admin_name;

        $update_organization->save();

    }
    public function delete($id)
    {
        $organization = Organization::findorfail($id);
        User::where('email',$organization->email)->delete();
        $organization->delete();
    }
}
