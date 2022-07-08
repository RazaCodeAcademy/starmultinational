@extends('frontend.pages_layouts.master')
@section('title')
Dashboard
@endsection
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- eCommerce statistic -->
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-12">
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex align-center">
                                   <img src="{{ Auth::user()->get_image() }}" alt="profile" width="100" height="100" style="border-radius: 5px; margin-left:33%; ">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
          
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-12">
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="info">$ {{ $direct_earning  ? $direct_earning->amount : 0 }}</h3>
                                        <h6>Earnings</h6>
                                    </div>
                                    <div>
                                        <i class="icon-cash info font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-12">
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        {{-- @dd(Auth::user()->sponser[0]->phase_no == 1 && count(Auth::user()->sponser)> 5 )  --}}


                                        <h3 class="warning">${{ $indirect_earning  ? $indirect_earning->amount : 0 }}</h3>

                                        <h6>Bonus</h6>
                                    </div>
                                    <div>
                                        <i class="icon-money warning font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-12">
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">

                                        @php
                                            
                                        if(!empty($indirect_earning && $direct_earning) )
                                        {
                
                                                $total= $indirect_earning->amount + $direct_earning->amount;
                                            }
                                            else{
                                                $total = 0;
                                        }
            
                                        @endphp

                                       @if(!empty($withdraw))
                                        <h3 class="danger">${{  $total ?  $total-$withdraw->amount : 0 }}</h3>
                                        @else
                                        <h3 class="danger">${{  $indirect_earning->amount + $direct_earning->amount ?? 0 }}</h3>
                                        @endif
                                       
                                        <h6>Points</h6>
                                    </div>
                                    <div>
                                        <i class="icon font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-12">
                </div>
                <div class="col-xl-4 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        @if(!empty($transaction))
                                        @if($transaction->status == 1 )

                                        <h3 class="success">
                                            ${{ Auth::user()->account_bal->price - $transaction->amount ?? 0 }}</h3>

                                        @endif
                                        @else
                                        <h3 class="success">
                                            ${{ Auth::user()->account_bal->price ?? 0 }} </h3>
                                        @endif
                                        <h6>Wallet Amount </h6>
                                    </div>
                                    <div>
                                        <i class="icon font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (empty(Auth::user()->account_bal))
        <div class="alert alert-danger" role="alert" id="succMsg">
            <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>
            </button>
            <p> Account registered Successfully
                Please upgrade your account in 24 hours otherwise your account will be deleted
                 </p>
            <a href="{{ route('membership.index') }}"><u>Click Here To Upgrade your Account</u></a>

        </div>
        @elseif (!empty($transaction))
        <div class="alert alert-success" role="alert" id="succMsg">
            <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>
            </button>
            <p>Successfully Upgraded Your Account </p>

        </div>
        @else
        <div class="alert alert-warning" role="alert" id="succMsg">
            <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>
            </button>
            <p>Congratulations Your registration bonus transfer for the Account Type of <b>{{ Auth::user()->account_bal->name ?? 'n/a' }}</b> to your wallet please transfer ${{ Auth::user()->account_bal->price ?? 0 }} To StarMultiNational to withdraw balance Amount! </p>
            <a href="{{ route('transaction.create') }}"><u>Transfer Amount ??</u></a>

        </div>
        @endif
        <div class="row">

            <div class="col-lg-8 col-md-12 col-12 col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Account Overview</h4>
                        <div class="card-header-action">
                            @if(!empty($transaction))
                            <div class='badge badge-success'>Active</div>
                            @else
                            <div class='badge badge-success'>InActive</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="summary-item">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">
                                            <img class='mr-3 rounded-circle img-responsive' width='80' height='80' src='{{ Auth::user()->get_image() }}' alt=''>
                                            <div class="float-right"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="text-small">Registered</div>
                                        <div class="media-title">{{Auth::user()->created_at}}</div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="text-small">Name</div>
                                        <div class="media-title">{{ Auth::user()->username }} ({{ Auth::user()->email }})</div>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="media-body">
                                        <div class="text-small">
                                            Referral URL
                                        </div>

                                        <a class="" href="{{ route('user-profile',Auth::user()->id) }}" target="_blank" title="">
                                            {{ url()->route('user-profile',Auth::user()->id) }}
                                        </a>


                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Membership</h4>
                        <div class="card-header-action">
                            <div class='badge badge-success'>Active</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            @if(!empty($transaction))
                            <div class="summary-info">
                                <h4><span class="text-success"><i class="la la-caret-up"></i></span>${{ Auth::user()->account_bal->price ?? 0 }} <span class="text-danger"><i class="la la-caret-down"></i></span>${{ $transaction->amount ?? '0'}} </h4>
                                <div class="text-muted">from total 1 transactions</div>
                                <h3 class="mt-2"><span class="text-info"><i class="fas fa-wallet"></i></span>${{ Auth::user()->account_bal->price - $transaction->amount ?? 0 }} </h3>
                                <h4>Account Type </h4>
                                <span class="text">{{ Auth::user()->account_bal->name ?? 'Enrollment Account' }}</span>
                                <div class="d-block mt-2">
                                    <a href="{{ route('membership.index') }}">View Details</a>
                                </div>
                            </div>
                            @else
                            <div class="summary-info">
                                <h4><span class="text-success"><i class="la la-caret-up"></i></span>$0 <span class="text-danger"><i class="la la-caret-down"></i></span>$0 </h4>
                                <div class="text-muted">from total 1 transactions</div>
                                <h3 class="mt-2"><span class="text-info"><i class="fas fa-wallet"></i></span>${{ Auth::user()->account_bal->price ?? 0 }} </h3>
                                <h4>Account Type </h4>
                                <span class="text">{{ Auth::user()->account_bal->name ?? 'Enrollment Account' }}</span>
                                <div class="d-block mt-2">
                                    <a href="{{ route('membership.index') }}">View Details</a>
                                </div>
                            </div>
                            @endif
                            <div class="summary-item">
                                <h6><span class='text-muted'>Registered Since</span> {{ Auth::user()->created_at }}</h6>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
