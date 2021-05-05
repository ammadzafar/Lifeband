<?php

namespace App\Http\Controllers\Admin;

use App\Model\FamilyAccount;
use App\Model\Group;
use App\Model\Organization;
use App\Model\UserAccount;
use App\Services\Admin\GroupServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public $group;
    public function __construct(GroupServices $group)
    {
        $this->group = $group;
    }

    public function create($id)
    {
        $organization = Organization::find($id);
        if ($organization == null)
        {
            $family_account = FamilyAccount::find($id);
            $group_users = Group::where('account_id',$id)->get();
            $users = UserAccount::where('account_id',$id)->where('group_id',null)->get();
            return view('admin.organization.group',compact('group_users','users','family_account','organization'));
        }
        $group_users = Group::where('account_id',$id)->get();
        $users = UserAccount::where('account_id',$id)->where('group_id',null)->get();
        return view('admin.organization.group',compact('group_users','users','organization'));

    }
    public function store(Request $request)
    {
        try {
            $this->group->store($request);
            return redirect()->back()->with('success','Group Created Successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error',error_details($e,'something went wrong!'.$e->getMessage()));
        }
    }
    public function edit($id)
    {
//        dd($id);
        try {
             $group = Group::findorfail($id);
//             dd($group->account_id);
             $group_users = UserAccount::where('group_id',$id)->orWhere('account_id',$group->account_id)->where('group_id','=',null)->get();
//             dd($group_users);
            $users = UserAccount::where('account_id',$group->account_id)->where('group_id',null)->get();
            return view('admin.organization.group-modal',compact('group','group_users','users'));
//            return redirect()->back()->with('success','Group Created Successfully');

        }catch(Exception $e){
            return redirect()->back()->with('error',error_details($e,'something went wrong!'.$e->getMessage()));
        }
    }
    public function update(Request $request,$id)
    {
        try {
            $this->group->update($request, $id);
            return redirect()->back()->with('success', 'Group updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', error_details($e, 'something went wrong!' . $e->getMessage()));
        }
    }
    public function delete($id)
    {
//        dd($id);
        try {
            $this->group->delete($id);
            return redirect()->back()->with('success', 'Group deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', error_details($e, 'something went wrong!' . $e->getMessage()));
        }
    }
}
