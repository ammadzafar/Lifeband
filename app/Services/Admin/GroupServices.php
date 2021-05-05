<?php


namespace App\Services\Admin;


use App\Model\Group;
use App\Model\UserAccount;

class GroupServices
{
    public function store($request)
    {
        $group = new Group();
        $group->account_id = $request->account_id;
        $group->name = $request->name;

        if ($request->hasFile('image'))
        {
            $filename =$request->file('image')->getClientOriginalName();
            $request->file('image')->move('uploads/group',$filename);
        }
        $group->image = $filename;
        $group->save();

        foreach($request->user_id as $user)
        {
            UserAccount::where('id',$user)->update(['group_id'=>$group->id]);
        }
    }
    public function update($request,$id)
    {
        $update_group = Group::findorfail($id);
        $update_group->account_id = $request->account_id;
        $update_group->name = $request->name;
        $filename = '';
        if ($request->hasFile('image'))
        {
            $filename =$request->file('image')->getClientOriginalName();
            $request->file('image')->move('uploads/group',$filename);
        }
        $update_group->image = $filename;
        $update_group->save();

        UserAccount::where('group_id',$id)->update(['group_id'=>null]);
        foreach($request->user_id as $user)
        {
            UserAccount::where('id',$user)->update(['group_id'=>$update_group->id]);
        }
    }
    public function delete($id)
    {
        $group = Group::findorfail($id);
        UserAccount::where('group_id',$id)->update(['group_id'=>null]);
        $group->delete();
    }
}
