<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item "><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main"><a href="{{ route('dashboard') }}"> {{ __('Dashboard') }}</a>
        </li>
        <li class=" navigation-header">
          <span data-i18n="nav.category.layouts">{{ __('Menu') }}</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
          data-placement="right" data-original-title="Layouts"></i>
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