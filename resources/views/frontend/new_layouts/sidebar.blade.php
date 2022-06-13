<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item "><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main"><a href="{{ route('admin.home') }}"> {{ __('Dashboard') }}</a>
        </li>
        <li class=" navigation-header">
          <span data-i18n="nav.category.layouts">{{ __('Menu') }}</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
          data-placement="right" data-original-title="Layouts"></i>
        </li>
        <li class="nav-item ">
          <a href="#">
            <i class="la la-tag"></i>
            <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Manage Users') }}</span>
          </a>
          <ul class="menu-content">
            <li class="">
              <a class="menu-item" href="{{ route('admin.user.create') }}">{{ __('Add New') }}</a>
            </li>
            <li class="">
              <a class="menu-item" href="{{ route('admin.user.index') }}">{{ __('List Users') }}</a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="#">
            <i class="la la-tag"></i>
            <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Manage Games') }}</span>
          </a>
          <ul class="menu-content">
            <li class="">
              <a class="menu-item" href="{{ route('admin.game.create') }}">{{ __('Add New') }}</a>
            </li>
            <li class="">
              <a class="menu-item" href="{{ route('admin.game.index') }}">{{ __('List Games') }}</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#">
            <i class="la la-tag"></i>
            <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Manage Wallets') }}</span>
          </a>
          <ul class="menu-content">
            <li class="">
              <a class="menu-item" href="{{ route('admin.user_wallet.create') }}">{{ __('Add Wallet Amount') }}</a>
            </li>
            <li class="">
              <a class="menu-item" href="{{ route('admin.user_wallet.index') }}">{{ __('List Wallets') }}</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#">
            <i class="la la-tag"></i>
            <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Manage News') }}</span>
          </a>
          <ul class="menu-content">
            <li class="">
              <a class="menu-item" href="{{ route('admin.news.create') }}">{{ __('Add News') }}</a>
            </li>
            <li class="">
              <a class="menu-item" href="{{ route('admin.news.index') }}">{{ __('List') }}</a>
            </li>
          </ul>
        </li>
        
     
      </ul>
    </div>
  </div>