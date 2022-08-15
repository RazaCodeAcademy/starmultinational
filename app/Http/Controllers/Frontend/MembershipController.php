<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use App\Models\User; 
use App\Models\Transaction; 
use App\Models\AccountType;
use App\Models\DirectEarning;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function account_type(Request $request)
    {
        
        $request['account_type'] = $request->account_type;
        $user = User::where('id',Auth::user()->id)->first();

        $user->update($request->toArray());

        $transaction = Transaction::where('sender_id', Auth::user()->id)->first();
        $user = User::where('id',Auth::user()->id)->first();
        $transaction->amount = $user->account_bal ? $user->account_bal->price : 0;
        $transaction->update();
                
        $sponser = User::where('username', $user->sponser_id)->first();
        if(empty($sponser)){
            return response()->json([
                'success' => true,
                'message' => "Account Upgraded Successfully",
            ]);
        }
        
        
    }
}


// $amount = 0;
       
// if($user->account_bal->name == 'Member Enrollment account'){
//     $amount= 5;
// }elseif($user->account_bal->name == 'Pre member Enrollment account'){
//     $amount= 3;
    
// }elseif($user->account_bal->name == 'Supervisor enrollment Account'){
//     $amount= 8;
    
// }elseif($user->account_bal->name == 'Manager Enrollment Account'){
//     $amount= 10;
    
// }
// $direct_earning = DirectEarning::where('user_id', $sponser->id )->first();
// if($direct_earning){

//     $direct_earning->amount = $amount;
//     $direct_earning->save();
   
// }else{
//     DirectEarning::create([
//         'user_id' => $sponser->id,
//         'amount' => $amount,
//     ]);
// }

// return response()->json([
//     'success' => true,
//     'message' => "Account updated successfuly!",
// ]);