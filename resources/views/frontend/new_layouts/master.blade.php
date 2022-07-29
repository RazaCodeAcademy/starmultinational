<!DOCTYPE html>
<html lang="en">

    @include('frontend.new_layouts.head')

    <body class="vertical-layout vertical-menu 1-column bg-lighten-2 menu-expanded welcome fixed-navbar"data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"  >
     
        @yield('content')

        

        {{-- included script section --}}
        @include('frontend.new_layouts.scripts')
    </body>
</html>