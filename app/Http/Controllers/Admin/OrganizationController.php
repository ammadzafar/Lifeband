<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\OrganizationUpdateRequest;
use App\Model\CoronaContact;
use App\Model\Organization;
use App\Model\Role;
use App\Model\UserAccount;
use App\Services\Admin\AdminServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrganizationController extends Controller
{
    protected $organization;
    public function __construct(AdminServices $organization){
        $this->organization = $organization;
    }

    public function organizationIndex(){
        if (auth()->user()->isAdmin()){
            $organizations = Organization::all();
        }
        if (auth()->user()->isOrganizer()){
            $organizations = Organization::where('email',auth()->user()->email)->get();
        }
        return view ('admin.organization.home',compact('organizations'));

    }
    public function organizationDashboard($id){
        if (auth()->user()->isAdmin()){
            $organization = Organization::findorfail($id);
            Session::put('type','organization');
        }
        if (auth()->user()->isOrganizer()){
            $organization = Organization::findorfail($id);
            Session::put('type','organization');
        }
        $safe_users = UserAccount::select('id', 'created_at')
            ->where('account_id',$organization->id)
            ->where('account_type','organization')
            ->where('status','not-infected')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $safe_status = [];
        $safe_record = [];
        foreach ($safe_users as $key => $value) {
            $safe_status[(int)$key] = count($value);
        }
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($safe_status[$i])) {
                $safe_record[$i]['count'] = $safe_status[$i];
            } else {
                $safe_record[$i]['count'] = 0;
            }
            $safe_record[$i]['month'] = $month[$i - 1];
        }
        $users = UserAccount::where('account_id',$organization->id)->where('account_type','organization')->get();
        $count_safe =  0;
        $count_medium =  0;
        $count_high =  0;
        foreach ($users as $user){
            if ($user->coronaContact){
                $count_safe += CoronaContact::where('user_account_id',$user->id)->where('contact_type','safe')->count();
                $count_medium += CoronaContact::where('user_account_id',$user->id)->where('contact_type','medium')->count();
                $count_high +=CoronaContact::where('user_account_id',$user->id)->where('contact_type','medium')->count();
            }
        }
        $year_record = UserAccount::select('id', 'created_at')
            ->where('account_id',$organization->id)
            ->where('account_type','organization')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $usermcount = [];
        $userArr = [];
        foreach ($year_record as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i]['count'] = $usermcount[$i];
            } else {
                $userArr[$i]['count'] = 0;
            }
            $userArr[$i]['month'] = $month[$i - 1];
        }

        /* ====================================== temperature ================================== */

        $users_temperature = UserAccount::select('temperature','created_at')
            ->where('account_id',$organization->id)
            ->where('account_type','organization')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get()->groupBy(function ($time){
                return Carbon::parse($time->created_at)->format('H');
            });

        $avg_temperature = [];
        $i = 0;
        foreach ($users_temperature as $key => $temperatures ){
            $total_temperature = 0;
            foreach ($temperatures as $key1 => $value){
                $total_temperature += $value->temperature;
            }
            $avg_temperature[$i]['hour'] = $key;
            $avg_temperature[$i]['avg_temperature'] = round($total_temperature/count($temperatures),1);
            $i++;
        }

        return view('admin.organization.dashboard',compact('organization','users','count_safe','count_medium','count_high','userArr','safe_record','avg_temperature'));
    }
    public function socialDistance($id){

        if (auth()->user()->isAdmin()){
            $organization = Organization::findorfail($id);
            Session::put('type','organization');
        }
        if (auth()->user()->isOrganizer()){
            $organization = Organization::findorfail($id);
            Session::put('type','organization');
        }
        $users = UserAccount::where('account_id',$organization->id)->where('account_type','organization')->get();
        $total_count = 0;
        $total = 0;
        $count_safe =  0;
        $count_medium =  0;
        $count_high =  0;
        foreach ($users as $user){
            if ($user->coronaContact){
                $count_safe += CoronaContact::where('user_account_id',$user->id)->where('contact_type','safe')->count();
                $count_medium += CoronaContact::where('user_account_id',$user->id)->where('contact_type','medium')->count();
                $count_high +=CoronaContact::where('user_account_id',$user->id)->where('contact_type','medium')->count();
            }
        }
        $total_count += $count_safe+$count_high+$count_medium;
        if ($total_count > 0){
            $safe = round($count_safe/$total_count * 100,2);
            $medium = round($count_medium/$total_count * 100,2);
            $high = round($count_high/$total_count * 100,2);
        }else{
            $safe = round($count_safe/1 * 100,2);
            $medium = round($count_medium/1 * 100,2);
            $high = round($count_high/1 * 100,2);
        }

        $status_infected = UserAccount::where('account_id',$organization->id)->where('account_type','organization')->where('status','infected')->count();
        $status_not_infected = UserAccount::where('account_id',$organization->id)->where('account_type','organization')->where('status','not-infected')->count();
        $total += $status_infected + $status_not_infected;
        if ($total > 0){
            $infected = round(($status_infected/$total * 100),2);
            $not_infected =  round(($status_not_infected/$total * 100),2);
        }else{
            $infected = ($status_infected/1 * 100);
            $not_infected =  ($status_not_infected/1 * 100);
        }

        $user_corona_contacts = UserAccount::with(['coronaContact'=>function ($query) use ($id) {
        }])->where('account_id',$id)->get();
        $contacted_users = [];
        foreach ($user_corona_contacts as $key => $contact){
            foreach ($contact->coronaContact as $i => $item){
                $user_band = UserAccount::where('band_address',$item->contact_person_bluetooth_address)->first();
                $contacted_users[$key][$i]["name"] = $contact->name;
                $contacted_users[$key][$i]["contacted_person"] = $user_band->name ?? null;
                $contacted_users[$key][$i]["date"] = Carbon::parse($item->created_at)->format('d-m-Y');
                $contacted_users[$key][$i]["time"] = Carbon::parse($item->created_at)->format('H-i');
            }
        }
//        dd($contacted_users);

        return view('admin.organization.social-distance',compact('organization','users','safe','medium','high','infected','not_infected','contacted_users'));
    }

    public function employTracing(Request $request){

        $date = explode('_',$request->date);
        $from = $date[0];
        $to = $date[1];

        $user_corona_contacts = UserAccount::with(['coronaContact' => function ($query) use ($request,$from,$to) {
            $query->whereBetween('created_at', [$from, $to]);
        }])->where('account_id',$request->id)->get();

//        dd($user_corona_contacts);

        $filter_users = [];
        foreach ($user_corona_contacts as $key => $contact){
            foreach ($contact->coronaContact as $i => $item){
                $user_band = UserAccount::where('band_address',$item->contact_person_bluetooth_address)->first();
                $filter_users[$key][$i]["name"] = $contact->name;
                $filter_users[$key][$i]["contacted_person"] = $user_band->name ?? '';
                $filter_users[$key][$i]["date"] = Carbon::parse($item->created_at)->format('d-m-Y');
                $filter_users[$key][$i]["time"] = Carbon::parse($item->created_at)->format('H-i');
            }
        }
        return response()->json([
            'status' => 'success',
            'filter' => $filter_users,
        ]);
    }

    public function distanceViolation(Request $request){

        $total = 0;
        $status_infected = 0;
        $status_not_infected = 0;
        $date = explode('_',$request->date);
        $from = $date[0];
        $to = $date[1];
        $violation = UserAccount::where('account_id',$request->id)->whereBetween('created_at', [$from, $to])->get();
        foreach($violation as $status){
            if ($status->status == 'infected'){
                $status_infected += 1;
            }else{
                $status_not_infected += 1 ;
            }
        }

        $total += $status_infected + $status_not_infected;
        if ($total > 0){
            $infected = round(($status_infected/$total * 100),2);
            $not_infected =  round(($status_not_infected/$total * 100),2);
        }else{
            $infected = ($status_infected/1 * 100);
            $not_infected =  ($status_not_infected/1 * 100);
        }

        return response()->json([
            'status' => 'success',
            'violation' => $violation,
            'user_infected' => $infected,
            'user_ntinfected' => $not_infected,
        ]);
    }

    public function status(Request $request){
//        dd($request->all());
        $user = UserAccount::findOrFail($request->id);
        $user->status = mb_strtolower($request->status);
        $user->save();

        $status_infected = UserAccount::where('account_id',$request->account_id)->where('status','infected')->count();
        $status_not_infected = UserAccount::where('account_id',$request->account_id)->where('status','not-infected')->count();
        $total = $status_infected + $status_not_infected;

        if ($total > 0){
            $infected = $status_infected/$total * 100;
            $not_infected =  $status_not_infected/$total * 100;
        }else{
            $infected = $status_infected/1 * 100;
            $not_infected =  $status_not_infected/1 * 100;
        }

        $response=[
            'status_code'=>200,
            'infected'=>$infected,
            'not_infected'=>$not_infected
        ];
        return response()->json($response);
    }
    public function userIndex(Request $request,$id){
        try {
            $organization = Organization::findorfail($id);
            if ($request->name){
                $users = UserAccount::where('account_id',$organization->id)->where('name','like',"%".$request->name."%")->get();
            }else{
                $users = UserAccount::where('account_id',$organization->id)->get();
            }
            return view('admin.organization.users',compact('organization','users'));
        }catch(\Exception $e) {
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }

    public function filter(Request $request){

        $filters = UserAccount::where('account_type','organization')->get();
        foreach ($filters as $filter){
            $filter->blood_oxygen_filter = $request->oxygen ?? null;
            $filter->blood_pressure_filter = $request->blood_pressure ?? null;
            $filter->heart_rate_filter = $request->heart_rate ?? null;
            $filter->fatigue_filter = $request->fatigue ?? null;
            $filter->save();
        }
        return back();
    }
    public function organizationStore(OrganizationRequest $request){
        try {
            $this->organization->organizationStore($request);
            return redirect()->route('organization.home')->with('success', 'Organization Added Successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function organizationEdit($id){
        $organization = Organization::findorfail($id);
        return view('admin.organization.modal',compact('organization'));
    }
    public function organizationUpdate(OrganizationUpdateRequest $request,$id)
    {
        try {
            $this->organization->update($request,$id);
            return redirect()->route('organization.home')->with('success', 'Organization Updated Successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function organizationDelete($id)
    {
        try {
            $this->organization->delete($id);
            return redirect()->route('organization.home')->with('success', 'Organization Deleted Successfully!');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
    public function userInfo($id){
        $user_detail = UserAccount::where('id',$id)->first();
        return view('admin.organization.user-detail',compact('user_detail'))->render();
    }

    public function assignQuestionnaire(Request $request){
        try {
            $user = UserAccount::find($request->id);
            $user->questionnaire_assigned = $request->questionnaire_assigned;
            $user->save();
        }catch(\Exception $e){
            return redirect()->back()->with('error', error_details($e,'Something went wrong!'.$e->getMessage()));
        }
    }
}
