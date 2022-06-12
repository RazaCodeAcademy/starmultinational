<!DOCTYPE html>
<html lang="en">

    @include('frontend.pages_layouts.head')

    <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"  >
        {{-- included header section --}}
        @include('frontend.pages_layouts.header')

        {{-- included sidebar section --}}
        @include('frontend.pages_layouts.sidebar')

        {{-- yielded content section --}}
        @yield('content')

        {{--  included footer section
        @include('frontend.pages_layouts.footer')  --}}

        {{-- included script section --}}
        @include('frontend.pages_layouts.scripts')
    </body>
</html>