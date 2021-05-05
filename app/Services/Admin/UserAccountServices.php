<?php


namespace App\Services\Admin;

use App\Model\Organization;
use App\Model\Role;
use App\Model\User;
use App\Model\UserAccount;
use Illuminate\Support\Facades\Hash;

class UserAccountServices
{
    public function userStore ($request)
    {
        $user = new UserAccount();
        $user->name = $request->name;
        $user->account_id = $request->account_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->height = $request->height;
        $user->height_unit = $request->height_unit;
        $user->weight = $request->weight;
        $user->weight_unit = $request->weight_unit;
        $user->wear_side = $request->wear_side;
        $user->personal_goal = $request->personal_goal;

        if ($request->hasFile('image'))
        {
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('uploads/users/images',$filename);
        }
        $user->image = $filename;

        $account = Organization::find($request->account_id);
        if ($account) {
            $user->account_type = 'organization';
        }else{
            $user->account_type = 'family';
        }
        $user->save();

        $auth_user = new User();
        $auth_user->name = $user->name;
        $auth_user->email = $user->email;
        $auth_user->password = $user->password;
        $auth_user->save();
    }
    public function organizationAdmin($request){

        $role = Role::where('name','organization')->first()->id;
        $org_admin = new User();
        $org_admin->name = $request->name;
        $org_admin->role_id = $role;
        $org_admin->email = $request->email;
        $org_admin->password = Hash::make($request->password);
        $org_admin->save();
    }
    public function familyAdmin($request){
        $role = Role::where('name','family')->first()->id;
        $family_admin = new User();
        $family_admin->name = $request->name;
        $family_admin->role_id = $role;
        $family_admin->email = $request->email;
        $family_admin->password = Hash::make($request->password);
        $family_admin->save();
    }
}
