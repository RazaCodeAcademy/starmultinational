@extends('frontend.pages_layouts.master')
 @section('title') 
 Wallet 
 @endsection
  @section('content')
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
            <div class="section-header">
                <h1><i class="fa fa-fw fa-hand-holding-usd"></i>Wallet</h1> </div>
            <div class="section-body">
                <input type="hidden" name="hal" value="withdrawreq">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>
                            Total Amount <span class=" text-info">{{ Auth::user()->account_bal->price+$direct_earning->amount+$indirect_earning->amount ?? 0 }}$</span>              </h4> </div>
                   
                    <div class="card-footer bg-whitesmoke">
                        <div class="row">
                            <div class="col-sm-12 text-small text-danger"> You are allowed to submit a withdrawal request once a time! The system will simply ignore the request if it is do not meets the requirements. </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <input type="hidden" name="dosubmit" value="1"> </div>
        </div>
    </div>
  </div>
  
    
 @endsection