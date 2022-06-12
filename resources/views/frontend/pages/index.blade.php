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
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="info">$0</h3>
                      <h6>Earnings</h6>
                    </div>
                    <div>
                      <i class="icon-cash info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="warning">$0</h3>
                      <h6>Bonus</h6>
                    </div>
                    <div>
                      <i class="icon-money warning font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="danger">0</h3>
                      <h6>Points</h6>
                    </div>
                    <div>
                      <i class="icon font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
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
                    <h4>Account Overview</h4>
                    <div class="card-header-action">
                        <div class='badge badge-success'>Active</div>                    </div>
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
                                                            <li class="media">
                                    <div class="media-body">
                                        <div class="text-small">Referral URL <a href="{{ url()->current() }}" target="_blank" class="d-sm-none" data-toggle="tooltip" title=""><span class="text-small"><i class="fa fa-fw fa-external-link-alt"></i></span></a></div>
                                        <div class="media-title">
                                            <a class="d-none d-sm-block" href="{{ url()->current() }}" target="_blank" data-toggle="tooltip" title="">
                                                {{ url()->current() }}                                             
                                            </a>
                                            <div class="d-sm-none">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control form-control-sm" value="" id="myrefurlid" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary btn-sm" type="button" onclick="copyInputText('myrefurlid')"><i class="fa fa-copy fa-fw"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                                        </ul>
                    </div>
                </div>
            </div>
    
@endsection