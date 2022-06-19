<div class="main-menu menu-fixed menu-light  menu-shadow" >
  <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="nav-item">
              <a href="{{ route('dashboard') }}">
                  <i class="la la-home"></i>
                  <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Dahboard') }}</span>
          </li>
         
          <li class="nav-item">
            <a href="#">
              <i class="la la-tag"></i>
              <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Transactions') }}</span>
            </a>
            <ul class="menu-content">
              <li class="">
                <a class="menu-item" href="{{ route('transaction.index') }} ">{{ __('Transaction History') }}</a>
              </li>
              <li class="">
                <a class="menu-item" href="{{route('withdraw.index')}} ">{{ __('Withdraw') }}</a>
              </li>
              <li class="">
                <a class="menu-item" href="{{route('wallet.index')}} ">{{ __('Wallet') }}</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#">
              <i class="la la-tag"></i>
              <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __(' User Referal  ') }}</span>
            </a>
            <ul class="menu-content">
              <li class="">
                <a class="menu-item" href="{{ route('referal.index') }}">{{ __('My Referal History') }}</a>
              </li>
              <li class="">
                <a class="menu-item" href="{{ route('referal.index') }}">{{ __('Referal Network') }}</a>
              </li>
            </ul>
          </li>


      </ul>
  </div>
</div>
