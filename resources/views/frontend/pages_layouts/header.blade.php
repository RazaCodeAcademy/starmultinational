<!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
              <img class="brand-logo" alt="modern admin logo" src="https://starmultinational.com/wp-content/uploads/2022/05/site-logo.png" >
              <h3 class="brand-text">Star Multinational</h3>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"> 
              
                <img src="{{asset('public/candidate/dist/assets/media/svg/flags/100-pakistan.svg')}}" alt="" height="14" width="14" />
           
            <span class="selected-language"></span></a>
              <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                <a class="dropdown-item" href="">
                  <img src="{{asset('public/candidate/dist/assets/media/svg/flags/100-pakistan.svg')}}" alt="" height="20" width="20" />
           
                </a>
              </div>
            </li>
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,{{Auth::user()->username }}
                  <span class="user-name text-bold-700"></span>
                </span>
                <span class="avatar avatar-online">
                  @if(empty( user()->get_image() ))
                    
                  <img src="{{asset('public/frontend/img/download.png')}}" alt="avatar"><i></i></span>
                  @else
                  <img src="{{  user()->get_image() }}" alt="avatar"><i></i></span>

                  @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ route('update-employee-details-page') }}"><i class="ft-user"></i> {{ __('Edit Profile') }}</a>
               
                <div class="dropdown-divider"></div><a class="dropdown-item"  href="{{ route('logout') }}"
               
                ><i class="ft-power"></i> Logout</a>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </nav>