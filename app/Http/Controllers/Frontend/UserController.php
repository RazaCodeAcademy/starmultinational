<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use beinmedia\payment\Parameters\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\PaymentMethod;
class UserController extends Controller
{
    public function create()
    {
        $payment_methods = PaymentMethod::all();
       return view('frontend.pages.register',compact('payment_methods'));
    }

    public function store(Request $request){
        
        
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

        $userCount = User::where('email', $request->email)->count();
        if ($userCount > 0){
            // dd( $userCount);
            $notification = array(
                'error' => 'Email Already Exists!', 
                );
            return redirect()->back()->with($notification);
        }
        else{
            $data =[
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'placement' => $request->placement,
                'city' => $request->city,
                'country' => $request->country,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'cnic' => $request->cnic,
                'payment_process' => $request->payment_process,
                'sponser_id' => $request->sponser_id,
                'mother_name' => $request->mother_name,
                'favourite_pet' => $request->favourite_pet,
                'password' => bcrypt($request->password),
            ];

            $user= User::create($data);


        }
        $notification = array(
        'success' => 'User Register Successfully!', 
        );
          $data1=array('role_id'=>'2',"model_type"=>'App\Models\User',"model_id"=>$user->id);
        ModelHasRole::insert($data1);

        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect()->route('dashboard')->with($notification);
        }
          
    }

    public function login()
    {
       
        if(Auth::check()){

            if (Auth::user()->hasRole('admin'))
            {
                return redirect()->route('adminDashboard');
            }
            elseif (Auth::user()->hasRole('employer'))
            
            {
               return redirect()->route('employerDashboard');
            }
            elseif (Auth::user()->hasRole('customer'))
            {
                return redirect()->route('dashboard');
            }
        }
        return view('frontend.pages.login');
    }

    public function loginuser(Request $request){
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

      $validator = Validator::make($request->all() , $rules);

          if ($validator->fails())
          {
              return \redirect()->route('login')->withErrors($validator)->withInput();
          }
          else
            {
                $userdata = array(
                    'email' => $request->email,
                    'password' => $request->password,
                );

            if (Auth::attempt($userdata))
            {   
                Auth::user()->last_login = Carbon::now()->toDateTimeString();
                // Auth::user()->update();
                    if (Auth::user()->hasRole('admin'))
                    {
                        
                        $notification = array(
                            'success' => 'Login Successfully!', 
                            );
                        return redirect()->route('adminDashboard')->with($notification);
                    }
                    elseif (Auth::user()->hasRole('employer'))
                    {
                        
                        return redirect()->route('employerDashboard')->with($notification);
                    }
                    elseif (Auth::user()->hasRole('customer'))
                    {   
                        $notification = array(
                            'success' => 'Login Successfully!', 
                            );
                        return redirect()->route('dashboard')->with($notification);
                    }
                }
                else
                {
                    $notification = array(
                        'error' => 'These Credentailas does not match to your recodes!', 
                        );
                    return \redirect()->route('login')->with($notification);
                }
        }
    }

    public function logout()
    {
        // Auth::user()->last_login = Carbon::now()->toDateTimeString();
        // Auth::user()->update();
        Auth::logout();
        $notification = array(
            'success' => 'logout Successfully!', 
            );
            return redirect()->to('https://starmultinational.com/');
    }

    public function profile($id)
    {
        $user =User::find($id);
        return redirect()->route('update-employee-details-page');
    }

}