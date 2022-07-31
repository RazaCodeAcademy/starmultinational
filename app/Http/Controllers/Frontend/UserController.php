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
use App\Models\UserSponser;
use App\Models\IndirectEarning;
use App\Models\ModelHasRole;
use App\Models\PhasePairing;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\PaymentMethod;
use Photos\Facades\Image;

class UserController extends Controller
{
    public function create()
    {
        $payment_methods = PaymentMethod::all();
        $username = User::find(1)->username;
        
        return view('frontend.pages.register',compact('payment_methods', 'username'));
    }

    public function store(Request $request){
        // dd($request);
        
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users,email',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'placement' => 'required',
            'city' => 'required',
            
            'zip_code' => 'required',
            
            'phone_number' => 'required|unique:users,phone_number',
            'cnic' => 'required',
            'payment_process' => 'required',
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
            $sponser = User::find($request->sponser_user_id);
            $phase = UserSponser::orderby('id', 'Desc')->where('sponser_id', $request->sponser_user_id)->first();
            if(empty($sponser->account_bal) && $request->username != $request->sponser_id){
                $notification = array(
                'error' => 'The sponser account is not upgraded please try with another sponser!', 
                );
                return redirect()->back()->with($notification);
            }
            if(!empty($phase)){
                $sponser_account_phase1 =  $sponser->account_bal ? ($sponser->account_bal->name == 'Member Enrollment account' || $sponser->account_bal->name == 'Supervisor enrollment Account' || $sponser->account_bal->name == 'Manager Enrollment Account') : '';
                $sponser_account_phase =  $sponser->account_bal ? ($sponser->account_bal->name == 'Supervisor enrollment Account' || $sponser->account_bal->name == 'Manager Enrollment Account') : '';
                if($sponser_account_phase1){
                    if($phase->phase_no == 1){
                        $phase_user = UserSponser::orderby('id', 'Desc')->where([['phase_no', $phase->phase_no], ['sponser_id', $sponser->id]])->get();
                        if(count($phase_user)< 2){
                          $left =  $phase_user->where('placement', 1);
    
                          if(count($left) == 1 && $request->placement == 1){
                            $notification = array(
                                'error' => 'Left placement is not empty You must choose right placement!', 
                                );
                            return redirect()->back()->with($notification);
    
                          }
                          
                            $right =  $phase_user->where('placement', 2);
      
                            if(count($right) == 1 && $request->placement == 2){
    
                              $notification = array(
                                  'error' => 'Right placement is not empty You must choose left placement!', 
                                  );
                              return redirect()->back()->with($notification);
                            }
                           $user = $this->register($request,$phase->phase_no);
                        }else{
                           $user= $this->register($request,$phase->phase_no+1);
                        }
    
    
                    }
                }
                if($sponser_account_phase){

                    if($phase->phase_no == 2){
                        $phase_user = UserSponser::orderby('id', 'Desc')->where([['phase_no', $phase->phase_no], ['sponser_id', $sponser->id]])->get();
                        
                        if(count($phase_user)< 12){
                          $left =  $phase_user->where('placement',1);
    
                          if(count($left) >= 6 && $request->placement == 1){
                            $notification = array(
                                'error' => 'Left placement is not empty You must choose right placement!', 
                                );
                            return redirect()->back()->with($notification);
    
                          }
                          
                            $right =  $phase_user->where('placement',2);
      
                            if(count($right) >= 6 && $request->placement == 2){
    
                              $notification = array(
                                  'error' => 'Right placement is not empty You must choose left placement!', 
                                  );
                              return redirect()->back()->with($notification);
                            }
                           $user = $this->register($request,$phase->phase_no);
                        }else{
                           $user= $this->register($request,$phase->phase_no+1);
                        }
    
    
                    }
                    if($phase->phase_no == 3){
                        $phase_user = UserSponser::orderby('id', 'Desc')->where([['phase_no', $phase->phase_no], ['sponser_id', $sponser->id]])->get();
                        
                        if(count($phase_user)< 24){
                          $left =  $phase_user->where('placement',1);
    
                          if(count($left) >= 12 && $request->placement == 1){
                            $notification = array(
                                'error' => 'Left placement is not empty You must choose right placement!', 
                                );
                            return redirect()->back()->with($notification);
    
                          }
                          
                            $right =  $phase_user->where('placement',2);
      
                            if(count($right) >= 12 && $request->placement == 2){
    
                              $notification = array(
                                  'error' => 'Right placement is not empty You must choose left placement!', 
                                  );
                              return redirect()->back()->with($notification);
                            }
                           $user = $this->register($request,$phase->phase_no);
                        }else{
                           $user= $this->register($request,$phase->phase_no+1);
                        }
    
    
                    }
                    if($phase->phase_no == 4){
                        $phase_user = UserSponser::orderby('id', 'Desc')->where([['phase_no', $phase->phase_no], ['sponser_id', $sponser->id]])->get();
                        
                        if(count($phase_user)< 48 ){
                          $left =  $phase_user->where('placement', 1);
    
                          if(count($left) >= 24 && $request->placement == 1){
                            $notification = array(
                                'error' => 'Left placement is not empty You must choose right placement!', 
                                );
                            return redirect()->back()->with($notification);
    
                          }
                          
                            $right =  $phase_user->where('placement',2);
      
                            if(count($right) >= 24 && $request->placement == 2){
    
                              $notification = array(
                                  'error' => 'Right placement is not empty You must choose left placement!', 
                                  );
                              return redirect()->back()->with($notification);
                            }
                           $user = $this->register($request, $phase->phase_no);
                        }else{
                            $notification = array(
                                'error' => 'You cannot register with this sponser_id because Its Limit is full !', 
                                );
                            return redirect()->back()->with($notification);
                        }
                    }
                }elseif(empty($sponser->account_bal)){
                    $user = $this->register($request, 1);
                }

            }else{
                
                $user = $this->register($request, 1);
            }
 
            $notification = array(
            'success' => 'User Register Successfully!', 
            );
            $data1=array('role_id'=>'2',"model_type"=>'App\Models\User',"model_id"=>$user->id);
            ModelHasRole::insert($data1);
            
        }

        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect()->route('dashboard')->with($notification);
        }
          
    }
public function register($request, $phase_no)
{
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
    if($user){
        if($request->username != $request->sponser_id){
            $user_sponser = New UserSponser;
            $user_sponser->user_id = $user->id;
            $user_sponser->sponser_id = $request->sponser_user_id;
            $user_sponser->phase_no = $phase_no;
            $user_sponser->placement = $request->placement;
            $user_sponser->save();
            
            if($user_sponser){
                $this->phase_pairing($request->sponser_user_id, $phase_no);
            }
        }

        
        if($request->hasfile('image')){
            $path = $request->file('image')->store('user', 'public');
            upload_image($path, $user->id, User::class);
        }
    }
    
    return $user;
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
            'email' => 'required',
            'password' => 'required'
        );

      $validator = Validator::make($request->all() , $rules);

          if ($validator->fails())
          {
              return \redirect()->route('login')->withErrors($validator)->withInput();
          }
          else
            {
                $user_with_email_data = array(
                    'email' => $request->email,
                    'password' => $request->password,
                );
                
                $user_with_username_data = array(
                    'username' => $request->email,
                    'password' => $request->password,
                );

            if (Auth::attempt($user_with_email_data) || Auth::attempt($user_with_username_data))
            {   
                    if (Auth::user()->hasRole('admin'))
                    {
                        
                        $notification = array(
                            'success' => 'Login Successfully!', 
                            );
                        return redirect()->route('adminDashboard')->with($notification);
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
        $username =User::find($id)->username;
        $payment_methods = PaymentMethod::all();
       return view('frontend.pages.register',compact('payment_methods', 'username'));
    }

    public function phase_pairing($sponser_id, $phase_no)
    {
        $phases = UserSponser::where('sponser_id', $sponser_id)->where('phase_no', $phase_no)->get();
        $left = $phases->where('placement', 1)->count();
        $right = $phases->where('placement', 2)->count();
        $phase_pairing = PhasePairing::where('user_id', $sponser_id)->where('phase_no', $phase_no)->first();
        $placements = 0;
        if($left > $right){
            $placements = ($left - ($left - $right));
        }elseif($left < $right){
            $placements = ($right - ($right - $left));
        }else{
            $placements = $right;
        }
        if($phase_pairing){
            if($phase_pairing->pair < $placements){
                $phase_pairing->pair += 1;
                $phase_pairing->save(); 
            }
        }else{
            if($placements > 0){
                PhasePairing::create([
                    'user_id' => $sponser_id,
                    'phase_no' => $phase_no,
                    'pair' => $placements,
                ]);
            }
        }
    }

}