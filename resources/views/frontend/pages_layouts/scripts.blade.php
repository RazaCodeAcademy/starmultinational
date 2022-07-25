<!-- BEGIN VENDOR JS-->
  <script src="{{ asset('public/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{ asset('public/app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/charts/raphael-min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/charts/morris.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}"
  type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}"
  type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/data/jvector/visitor-data.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>

  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  
  <script src="{{ asset('public/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ asset('public/app-assets/js/scripts/pages/dashboard-sales.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/forms/switch.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/app-assets/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
  <script src="{{asset('public/app-assets/js/toastr.js')}}"></script>
  <script src="{{asset('public/app-assets/js/toastr.min.js')}}"></script>

  <script src="{{asset('public/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  


  <!-- END PAGE LEVEL JS-->

  @if(session()->has('language'))
    <script>
        toastr.options.positionClass = 'toast-top-left';
    </script>
@else
    <script>
        toastr.options.positionClass = 'toast-top-right';
    </script>
@endif

@if(Session::has('success'))
    <script>
        toastr.success('{{  Session::get('success') }}')
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.error('{{  Session::get('error') }}')
    </script>
@endif





