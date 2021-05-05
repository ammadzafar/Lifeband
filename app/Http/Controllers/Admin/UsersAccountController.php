<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InviteUsersRequest;
use App\Model\SentMail;
use App\Services\Admin\UserAccountServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersAccountController extends Controller
{
    public $user;
    public function __construct(UserAccountServices $user)
    {
        $this->user = $user;
    }

    public function create($email)
    {
        $this->email = SentMail::where('email',$email)->first();
        return view('admin.organization.email')->with('data',$this->email);
    }
    public function store(Request $request)
    {
        try {
             $this->user->userStore($request);
            return redirect()->back()->with('success','Your Account has been successfully created');
        }catch (\Exception $e) {
            return redirect()->back()->with('error',error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function adminInvite($email){
        return view('admin.organization.admin-invite-email')->with('data',$email);
    }
    public function orgAdmin(Request $request){
        try {
            $this->user->organizationAdmin($request);
            return redirect()->back()->with('success','Your Account has been successfully created');
        }catch(\Exception $e){
            return redirect()->back()->with('error',error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function familyAdminInvite($email){
        return view('admin.family-accounts.admin-invite-email')->with('data',$email);
    }
    public function familyAdmin(Request $request){
        try {
            $this->user->familyAdmin($request);
            return redirect()->back()->with('success','Your Account has been successfully created');
        }catch(\Exception $e){
            return redirect()->back()->with('error',error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
}
