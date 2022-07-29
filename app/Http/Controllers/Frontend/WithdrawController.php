<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountType;
use App\Models\PaymentMethod;
use App\Models\IndirectEarning;
use App\Models\DirectEarning;
use App\Models\Withdraw;
use Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $user = Auth::user();
        $withdraw = Withdraw::where('user_id', Auth::user()->id)->first();
        $indirect_earning = IndirectEarning::where('user_id', Auth::user()->id)->first();
        $direct_earning = DirectEarning::where('user_id', Auth::user()->id)->first();
         $payment_methods = PaymentMethod::all();
        return view('frontend.pages.withdraw.index',compact('withdraw','payment_methods','user','indirect_earning','direct_earning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,

        ];
        $withdraw = Withdraw::create($data);
        if($withdraw){
           
            return redirect()->route('dashboard')->with('success', 'Your Request has Sended Successfully!');
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
