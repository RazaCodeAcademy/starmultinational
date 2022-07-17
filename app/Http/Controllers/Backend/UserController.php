<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use models
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\Role;
use App\Models\PaymentMethod;
use App\Models\AccountType;
use App\Models\DirectEarning;

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
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'payment_process' => 'required',
            'sponser_id' => 'required',
            'mother_name' => 'required',
            'favourite_pet' => 'required',
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
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'payment_process' => 'required',
            'sponser_id' => 'required',
            'mother_name' => 'required',
            'favourite_pet' => 'required',
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

        $user->update($request->toArray());
        
        $sponser = User::where('username', $user->sponser_id)->first();
        if(empty($sponser)){
            return response()->json([
                'success' => true,
                'message' => "Your Sponser is no more longer please select new sponser for yourself!",
            ]);
        }
        
        $amount = 0;
       
        if($user->account_bal->name == 'Member Enrollment account'){
            $amount= 5;
        }elseif($user->account_bal->name == 'Pre member Enrollment account'){
            $amount= 3;
            
        }elseif($user->account_bal->name == 'Supervisor enrollment Account'){
            $amount= 8;
            
        }elseif($user->account_bal->name == 'Manager Enrollment Account'){
            $amount= 10;
            
        }
        $direct_earning = DirectEarning::where('user_id', $sponser->id )->first();
        if($direct_earning){

            $direct_earning->amount = $amount;
            $direct_earning->save();
           
        }else{
            DirectEarning::create([
                'user_id' => $sponser->id,
                'amount' => $amount,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Account updated successfuly!",
        ]);
        
    }
}