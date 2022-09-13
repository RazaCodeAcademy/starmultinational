<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Http\Request;
// use facades
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

// use mails
use App\Mail\AccountUpgrade;

// use models
use App\Models\Membership;
use App\Models\User; 
use App\Models\Transaction; 
use App\Models\Withdraw; 
use App\Models\AccountType;
use App\Models\DirectEarning;
use App\Models\TotalEarning;


class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
         $membership = Membership::where('user_id', Auth::user()->id)->first();
        
         return view('frontend.pages.membership.index',compact('membership'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = AccountType::all();
        return view('frontend.pages.membership.upgrade',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =[
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'status' => 1,

        ];
        $membership = Membership::create($data);
        $notification = array(
            'success' => ' Request Send Successfully!', 
            );
        return redirect()->back()->with($notification);
    }

    public function account_type(Request $request)
    {
        $userController = new UserController();
        $request['account_type'] = $request->account_type;
        $user = Auth::user();
        $sponser = User::find($user->sponser_id);
        $account = AccountType::find($request->account_type);
        $withdraw_amount = Withdraw::where('user_id', Auth::user()->id)->sum('amount');
        $total_earning = TotalEarning::where('user_id', Auth::user()->id)->first();

        $current_balance = $total_earning ? ($total_earning ? $total_earning->amount : 0) - ($withdraw_amount ? $withdraw_amount : 0) : 0;
        $extra_amount = $user->account_bal ? $account->price - $user->account_bal->price : 0;
        if($current_balance >= $extra_amount){
            $transaction = new Transaction();
            $transaction->amount = $extra_amount;
            $transaction->sender_id = $user->id ? $user->id : 1;
            $transaction->save();
            
            $data =[
                'payment_method' => $request->account_type,
                'amount' => $extra_amount,
                'user_id' => Auth::user()->id,

            ];
            $withdraw = Withdraw::create($data);
            $prev_ern = prev_earn($user->account_bal->name);
            if($account->price <= $sponser->account_bal->price){
                if($account->name == 'Pre member Enrollment account'){
                    $amount= 3 - $prev_ern;
                }elseif($account->name == 'Member Enrollment account'){
                    $amount= 5 - $prev_ern;
                }elseif($account->name == 'Supervisor enrollment Account'){
                    $amount= 8 - $prev_ern;
                    
                }elseif($account->name == 'Manager Enrollment Account'){
                    $amount= 10 - $prev_ern;
                }
                $userController->direct_earning($user->sponser_id, $amount);
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
                $userController->direct_earning($user->sponser_id, $amount);
            }
    
            $user->update($request->toArray());
                    
            if(!empty($transaction)){
                Mail::to($user->email)->send(new AccountUpgrade($user->username, $user->account_bal->name));
                return response()->json([
                    'success' => true,
                    'message' => "Account Upgraded Successfully",
                ]);
            }
        }
        

        return response()->json([
            'success' => false,
            'message' => "Account Not Upgraded Due To Insuficient Balance",
        ]);
        
        
    }
}