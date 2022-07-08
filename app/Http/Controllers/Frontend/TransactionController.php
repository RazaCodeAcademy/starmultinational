<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Refferaltransfer;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpgradeAccount;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where('sender_id', Auth::user()->id)->get();
        return view('frontend.pages.transaction.histroy',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction = Transaction::where('sender_id', Auth::user()->id)->first();
        return view('frontend.pages.transaction.index',compact('transaction'));
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
            'sender_id' => Auth::user()->id,
            'amount' => $request->amount,
            'status' => 1,

        ];
        $transaction = Transaction::create($data);
        if($transaction){
            $user = Auth::user();
            Mail::to($user->email)->send(new UpgradeAccount($user));
             $referal_amount = New Refferaltransfer;
             $referal_amount->sender_id = Auth::user()->id;
             if(Auth::user()->sponser_id != '' || Auth::user()->sponser_id != 'admin' || Auth::user()->sponser_id == User::all() ){

                 $referal_amount->referal_recever_id = Auth::user()->sponser_id;
             }
             if(Auth::user()->account_bal->name == 'Supervisor enrollment Account'){
                $referal_amount->amount = 8;
                
            }elseif(Auth::user()->account_bal->name == 'Member Enrollment account'){
                 $referal_amount->amount = 5;
                 
            }elseif(Auth::user()->account_bal->name == 'Pre member Enrollment account'){
                 $referal_amount->amount = 3;
                 
            }
            elseif(Auth::user()->account_bal->name == 'Manager Enrollment Account'){
                 $referal_amount->amount = 10;
                 
            }
            $referal_amount->save();

            $notification = array(
                'success' => ' Amount Send Successfully!', 
                );
            return redirect()->back()->with($notification);
        }
    
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
}
