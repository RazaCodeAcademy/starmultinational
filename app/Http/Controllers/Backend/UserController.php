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

class UserController extends Controller
{
    public function listAdmins()
    {
        $users = User::whereHas(
            'roles', function($q){
                $q->where('role_id', '2');
            })->orderby('created_at','desc')->get();
       
        return view('backend.pages.user.list', compact('users'));
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
}