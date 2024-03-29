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
                    <div class="col-xl-3 col-lg-6 col-12">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex align-center">
                                        <img src="{{ Auth::user()->get_image() }}" alt="profile" width="100"
                                            height="100" style="border-radius: 5px; margin-left:33%; ">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><img src="{{ asset('public/icons/earning.jpeg') }}" alt=""
                                                    width="50px" height="50px"></h1>
                                        </div>
                                        <div class="col-7 pl-3">
                                            <h5>Current Balance</h5>
                                            <h6 class="text-muted">Total Earning</h6>
                                        </div>
                                        <div class="col-3 text-right">
                                            <h4>
                                                @if ($withdraw_amount > 0)
                                                    <span
                                                        class=" text-danger">${{ $current_earning ?? 0 }}</span>
                                                @else
                                                    <span class=" text-danger">${{ $current_earning ?? 0 }}</span>
                                                @endif
                                            </h4>
                                            <h6 class="success darken-4">${{ ($total_earning) ?? 0 }}</i></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><img src="{{ asset('public/icons/hits.jpeg') }}" alt=""
                                                    width="50px" height="50px"></h1>
                                        </div>
                                        <div class="col-7 pl-3">
                                            <h5>Hits</h5>
                                            <h6 class="text-muted">Bonus</h6>
                                        </div>
                                        <div class="col-3 text-right">
                                            <h4 class="danger darken-4">{{ $hits ?? 0 }}</h4>
                                            <h6 class="success darken-4">${{ $hit_bonus ?? 0 }}</i></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><img src="{{ asset('public/icons/points.jpeg') }}" alt=""
                                                    width="50px" height="50px"></h1>
                                        </div>
                                        <div class="col-7 pl-3">
                                            <h5>Recent Points</h5>
                                            <h6 class="text-muted">Total Points</h6>
                                        </div>
                                        <div class="col-3 text-right">
                                            <h4 class="danger darken-4">
                                                {{ $today_earn_points ? $today_earn_points->number : 0 }}</h4>
                                            <h6 class="success darken-4">{{ $earn_points ?? 0 }} </i></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card crypto-card-3 pull-up">
                            <div class="card-content">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <h1><img src="{{ asset('public/icons/wallets.jpeg') }}" alt=""
                                                    width="50px" height="50px"></h1>
                                        </div>
                                        <div class="col-7 pl-3 py-2">
                                            <h5>Wallet</h5>
                                        </div>
                                        <div class="col-3 text-right py-1">
                                            <h4>
                                                @if (!empty($transaction))
                                                    @if ($transaction->status == 1)
                                                        <h3 class="success">
                                                            ${{ Auth::user()->account_bal ? Auth::user()->account_bal->price : 0 }}
                                                        </h3>
                                                    @endif
                                                @else
                                                    <h3 class="success">
                                                        ${{ Auth::user()->account_bal ? Auth::user()->account_bal->price : 0 }}
                                                    </h3>
                                                @endif
                                            </h4>
                                        </div>
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
            @elseif (!empty($transaction) && Auth::user()->account_bal->name != 'Manager Enrollment Account')
                <div class="alert alert-success" role="alert" id="succMsg">
                    <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Successfully Upgraded Your Account </p>
                    <p> Want to Change Membership <a href="{{ route('membership.create') }}"><u>make a request for
                                upgradation</u></a> </p>

                </div>
            @elseif(!empty(Auth::user()->account_bal) && empty($transaction))
                <div class="alert alert-warning" role="alert" id="succMsg">
                    <button type="button" class="close " data-dismiss="alert" aria-label="Close">

                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Congratulations your activation balance for
                        <b>({{ Auth::user()->account_bal ? Auth::user()->account_bal->name : 'n/a' }})</b> enrollment amount {{ Auth::user()->account_bal ? Auth::user()->account_bal->price : 0 }}$ has been transferred in your account wallet.
                    </p>
                    <a href="{{ route('transaction.create') }}"><u>Click here to upgrade your account.</u></a>

                </div>
            @endif
            <div class="row">

                <div class="col-lg-8 col-md-12 col-12 col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Account Overview</h4>
                            <div class="card-header-action">
                                @if (!empty($transaction))
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
                                                <img class='mr-3 rounded-circle img-responsive' width='80'
                                                    height='80' src='{{ Auth::user()->get_image() }}' alt=''>
                                                <div class="float-right"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="text-small">Registered</div>
                                            <div class="media-title">{{ Auth::user()->created_at }}</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="text-small">Name</div>
                                            <div class="media-title">{{ Auth::user()->username }}
                                                ({{ Auth::user()->email }})</div>
                                        </div>
                                    </li>
                                    {{-- @if (!empty($transaction)) --}}
                                    <li class="">
                                        <div class="media-body">
                                            <div class="text-small">
                                                Referral URL
                                            </div>
                                            <div style="white-space: nowrap; overflow-x:scroll; border: 1px solid black;">
                                                <a id="referal_link" class=""
                                                    href="{{ route('user-profile', Auth::user()->id) }}" target="_blank"
                                                    title="">
                                                    {{ url()->route('user-profile', Auth::user()->id) }}
                                                </a>
                                            </div>
                                            {{-- <button id="btnCopy" class="btn btn-sm btn-success" title="Click to copy referal link!"
                                                onclick="copyToClipboard(); alert('Referal link coppied!');">Copy</button> --}}
                                        </div>
                                    </li>
                                    {{-- @endif --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Referrals & Earnings Performance</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
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
                                @if (!empty($transaction))
                                    <div class="summary-info">
                                        <h4><span class="text-success"><i
                                                    class="la la-caret-up"></i></span>${{ Auth::user()->account_bal->price ?? 0 }}
                                            <span class="text-danger"><i
                                                    class="la la-caret-down"></i></span>${{ $transaction->amount ?? '0' }}
                                        </h4>
                                        <div class="text-muted">from total 1 transactions</div>
                                        <h3 class="mt-2"><span class="text-info"><i
                                                    class="fas fa-wallet"></i></span>${{ Auth::user()->account_bal->price - $transaction->amount ?? 0 }}
                                        </h3>
                                        <h4>Account Type </h4>
                                        <span
                                            class="text">{{ Auth::user()->account_bal->name ?? 'Enrollment Account' }}</span>
                                        <div class="d-block mt-2">
                                            <a href="{{ route('membership.index') }}">View Details</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="summary-info">
                                        <h4><span class="text-success"><i class="la la-caret-up"></i></span>$0 <span
                                                class="text-danger"><i class="la la-caret-down"></i></span>$0 </h4>
                                        <div class="text-muted">from total 1 transactions</div>
                                        <h3 class="mt-2"><span class="text-info"><i
                                                    class="fas fa-wallet"></i></span>${{ Auth::user()->account_bal->price ?? 0 }}
                                        </h3>
                                        <h4>Account Type </h4>
                                        <span
                                            class="text">{{ Auth::user()->account_bal->name ?? 'Enrollment Account' }}</span>
                                        <div class="d-block mt-2">
                                            <a href="{{ route('membership.index') }}">View Details</a>
                                        </div>
                                    </div>
                                @endif
                                <div class="summary-item">
                                    <h6><span class='text-muted'>Registered Since</span> {{ Auth::user()->created_at }}
                                    </h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Points</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <table style="width: 100%;" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Points') }}</th>
                                            <th>{{ __('Date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($list_points) > 0)
                                            @foreach ($list_points as $point)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $point->number }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($point->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const copyToClipboard = () => {
            /* Get the text field */
            var copyText = document.getElementById("referal_link");

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.innerText);
        }
    </script>

    <script>
        window.onload = function() {

            var refferal_analytics = <?php echo json_encode($refferal_analytics, true); ?>;
            refferal_analytics.forEach(ele => {
                ele.x = new Date(ele.x);
            });

            var total_earning_analytics = <?php echo json_encode($total_earning_analytics, true); ?>;
            total_earning_analytics.forEach(ele => {
                ele.x = new Date(ele.x);
            });

            console.log(new Date(2017, 01, 4));

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                // title: {
                //     text: "Referrals & Earnings"
                // },
                axisX: {
                    unit: "day",
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    },
                },
                axisY: {
                    title: "Referrals",
                    includeZero: true,
                    crosshair: {
                        enabled: true
                    }
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                        type: "line",
                        showInLegend: true,
                        name: "Referrals",
                        markerType: "square",
                        color: "#F08080",
                        xValueFormatString: "DD MMM, YYYY",
                        dataPoints: refferal_analytics
                    },
                    {
                        type: "line",
                        showInLegend: true,
                        name: "Earnings",
                        xValueFormatString: "DD MMM, YYYY",
                        dataPoints: total_earning_analytics
                    }
                ]
            });
            chart.render();

            function toogleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>
@endsection
