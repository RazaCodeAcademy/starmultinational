<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// use mails
use App\Mail\AccountUpgrade;

// use models
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\Role;
use App\Models\Hit;
use App\Models\HitBonus;
use App\Models\Point;
use App\Models\PaymentMethod;
use App\Models\AccountType;
use App\Models\UserSponser;
use App\Models\PhasePairing;
use App\Models\DirectEarning;
use App\Models\TotalEarning;
use App\Models\IndirectEarning;
use App\Models\CurrentEarning;

class UserController extends Controller
{
    public function listAdmins()
    {
        $account_types = AccountType::orderBy('id', 'desc')->get();
        $users = User::whereHas(
            'roles', function($q){
                $q->where('role_id', '2');
            })->orderby('created_at','desc')->get();
       
        return view('backend.pages.user.list', compact('users','account_types'));
    }
    public function listEmployers()
    {
        $users= User::whereHas(
            'roles', function($q){
                $q->where('role_id', '2');
            })->orderby('created_at','desc')->get();
       
        return view('backend.pages.user.list', compact('users'));
    }

    public function createUser()
    {
        $payment_methods = PaymentMethod::all();
        return view('backend.pages.user.create', compact('payment_methods'));
    }

    public function storeUser(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'placement' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'payment_process' => 'required',
            'sponser_id' => 'required',
                'password' => [
                'required',
                'string',
                'min:6',    
                'confirmed',         
                'confirmed',         
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];

        $messages = [
            'password.regex' => 'Password must be one capital one small, one special character and one number'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->toArray());

        $data1=array('role_id'=>'2',"model_type"=>'App\Models\User',"model_id"=>$user->id);
        ModelHasRole::insert($data1);

        return redirect()->route('listAdmins')->with('success', 'Record Added Successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $payment_methods = PaymentMethod::all();
        if($user == null)
        {
            return redirect()->route('listUsers')->with('error', 'No Record Found.');
        }

        return view('backend.pages.user.edit', compact('user','payment_methods'));
    }

    public function updateUser(Request $request,$id)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|max:255',
            'email' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'placement' => 'required',
            
            'city' => 'required',
            
            'zip_code' => 'required',
       
            'phone_number' => 'required',
            'cnic' => 'required',
            'payment_process' => 'required',
            'sponser_id' => 'required',
        ];

        if($request->password){
            $rules['password'] = [
            'required',
            'string',
            'min:6',            
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', 
        ];
        }
        $messages = [
            'password.regex' => 'Password must be one capital one small, one special character and one number'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $request['password'] = bcrypt($request->password);
        $user = User::find($id);
        $user->update($request->toArray());

        

        return redirect()->route('listAdmins')->with('success', 'Record Updated Successfully.');
    }

    public function deleteUser(Request $request){
        $user =User::where('id',$request->id)->first();

        if(empty($user)) {
            return response()->json(['status' => 0]);
        }

       User::where('id',$request->id)->delete();
       ModelHasRole::where('model_id',$request->id)->delete();

        return response()->json(['status' => 1]);
    }

    public function viewUser($id)
    {
        $user = User::where('id', $id)
        ->whereHas(
            'roles', function($q){
                $q->where('name', 'admin')->orwhere('name', 'employer')->orwhere('name','employee');
            })->orderby('created_at','desc')->first();

        if($user == null)
        {
            return redirect()->route('listUsers')->with('error', 'No Record Found.');
        }

        return view('backend.pages.user.view', compact('user'));
    }
    public function account_type(Request $request,$id)
    {
        
        $request['account_type'] = $request->account_type;
        $user = User::find($id);

        $sponser = User::find($user->sponser_id);
        if(empty($sponser)){
            return response()->json([
                'success' => true,
                'message' => "Your Sponser is no more longer please select new sponser for yourself!",
            ]);
        }
        
        $amount = 0;

        $account = AccountType::find($request->account_type);

        $isValidUpgradation = $user->account_bal ? $account->price <= $user->account_bal->price : false;
        if($isValidUpgradation){
            return response()->json([
                'success' => false,
                'message' => "Your can not upgrade this account anymore!",
            ]);
        }

        $sponser_account_price = $sponser->account_bal ? $sponser->account_bal->price : 0;
        $prev_ern = prev_earn($user->account_bal ? $user->account_bal->name : "");
        if($account->price <= $sponser_account_price || $sponser_account_price == 0){
            if($account->name == 'Pre member Enrollment account'){
                $amount= 3 - $prev_ern;
            }elseif($account->name == 'Member Enrollment account'){
                $amount= 5 - $prev_ern;
            }elseif($account->name == 'Supervisor enrollment Account'){
                $amount= 8 - $prev_ern;
                
            }elseif($account->name == 'Manager Enrollment Account'){
                $amount= 10 - $prev_ern;
            }
            $this->direct_earning($user->sponser_id, $amount);
        }else{
            if($sponser->account_bal->name == 'Pre member Enrollment account'){
                $amount= $prev_ern <= 3 ? 3 - $prev_ern : 0;
            }elseif($sponser->account_bal->name == 'Member Enrollment account'){
                $amount= $prev_ern <= 5 ? 5 - $prev_ern : 0;
            }elseif($sponser->account_bal->name == 'Supervisor enrollment Account'){
                $amount= $prev_ern <= 8 ? 8 - $prev_ern : 0;
            }elseif($sponser->account_bal->name == 'Manager Enrollment Account'){
                $amount= $prev_ern <= 10 ? 10 - $prev_ern : 0;
            }
            $this->direct_earning($user->sponser_id, $amount);
        }

        $user->update($request->toArray());

        $user = User::find($id);
        Mail::to($user->email)->send(new AccountUpgrade($user->username, $user->account_bal->name));
    
        return response()->json([
            'success' => true,
            'message' => "Account updated successfuly!",
        ]);
        
    }

    public function direct_earning($sponser_id, $amount)
    {
        $direct_earning = DirectEarning::where('user_id', $sponser_id )->whereDate('created_at', Carbon::today())->first();
        if($direct_earning){
            $direct_earning->amount += $amount;
            $direct_earning->save();
        }else{
            $direct_earning = DirectEarning::create([
                'user_id' => $sponser_id,
                'amount' => $amount,
            ]);
        }
        $this->total_earning($sponser_id, $amount);
        $this->earn_current($sponser_id, $amount);
    }
    
    public function indirect_earning($sponser_id)
    {
        $earning = IndirectEarning::where('user_id', $sponser_id)->whereDate('created_at', Carbon::today())->first();
        if($earning){
            $earning->amount += 2;
            $earning->save();
        }else{
            $earning = IndirectEarning::create([
                'user_id' =>  $sponser_id,
                'amount'=> 2,
            ]);
        }
        
        $this->total_earning($sponser_id, 2);
    }
    
    public function total_earning($sponser_id, $amount)
    {
        $total_earning = TotalEarning::where('user_id', $sponser_id)->first();
        if($total_earning){
            $total_earning->amount += $amount;
            $total_earning->save();
        }else{
            $total_earning = TotalEarning::create([
                'user_id' => $sponser_id,
                'amount' => $amount,
            ]);
        }

        $this->earn_points($sponser_id, $total_earning->amount);
        $this->earn_hits($sponser_id, $total_earning->amount);
    }

    public function earn_points($sponser_id, $amount)
    {
        $point = Point::where('user_id', $sponser_id)->whereDate('created_at', Carbon::today())->first();
        $points = Point::where('user_id', $sponser_id)->sum('number');
        $remain_amount = $amount - (5*$points);
        $mod_amount = ($remain_amount % 5);
        $points = (($remain_amount - $mod_amount)/5);
        if($point){
            $point->number += $points;
            $point->save();
        }else{
            $point = Point::create([
                'user_id' => $sponser_id,
                'number' => $points,
            ]);
        }
    }

    public function earn_hits($sponser_id, $amount)
    {
        $hit = Hit::where('user_id', $sponser_id)->first();
        $hits = Hit::where('user_id', $sponser_id)->sum('number');
        $remain_amount = $amount - (20*$hits);
        $mod_amount = ($remain_amount % 20);
        $hits = (($remain_amount - $mod_amount)/20);
        $total_earning = TotalEarning::where('user_id', $sponser_id)->first();
        $total_earning->amount += $hits*2;
        $total_earning->save();
        if($hit){
            $hit->number += $hits;
            $hit->save();
        }else{
            $hit = Hit::create([
                'user_id' => $sponser_id,
                'number' => $hits,
            ]);
        }

        $this->earn_hit_bonus($sponser_id, $hit->number);
    }

    public function earn_hit_bonus($sponser_id, $hits)
    {
        $hitbonus = HitBonus::where('user_id', $sponser_id)->first();
        if($hitbonus){
            $hitbonus->amount = $hits*2;
            $hitbonus->save();
        }else{
            HitBonus::create([
                'user_id' => $sponser_id,
                'amount' => $hits*2,
            ]);
        }
    }
    public function earn_current($sponser_id, $amount)
    {
        $current = CurrentEarning::where('user_id', $sponser_id)->first();
        if($current){
            $current->amount += $amount;
            $current->save();
        }else{
            CurrentEarning::create([
                'user_id' => $sponser_id,
                'amount' => $amount,
            ]);
        }
    }
}