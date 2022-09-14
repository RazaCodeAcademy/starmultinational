<div class="main-menu menu-fixed menu-light  menu-shadow">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Dahboard') }}</span>
            </li>

            <li class=" navigation-header">
                <span data-i18n="">Account</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                    data-placement="right" data-original-title="Account"></i>
            </li>

            <li class="nav-item">
                <a href="{{ route('transaction.index') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Transaction History') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('earning.history.index') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Earning History') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('withdraw.index') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Withdraw') }}</span>
                </a>
            </li>
            {{-- <li class="nav-item">
            <a href="{{ route('wallet.index') }}">
              <i class="la la-tag"></i>
              <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Wallet') }}</span>
            </a>
          </li> --}}
            <li class="nav-item">
                <a href="{{ route('search.index') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Search') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('referal.index') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Referral History') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('referal.create') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Referral Network') }}</span>
                </a>
            </li>

            <li class=" navigation-header">
                <span data-i18n="">Settings</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
                    data-placement="right" data-original-title="Settings"></i>
            </li>

            <li class="nav-item">
                <a href="{{ route('update-employee-details-page') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('Profile') }}</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('feedback.create') }}">
                    <i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.page_layouts.main">{{ __('FeedBack') }}</span>
                </a>
            </li>



            <li class="">
                <a class="btn btn-danger text-white m-2" href="{{ route('logout') }}">{{ __('Logout') }}</a>
            </li>

        </ul>
    </div>
</div>
