<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('public/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" href="https://starmultinational.com/wp-content/uploads/2022/05/site-logo.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BEGIN VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/vendors.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/forms/icheck/custom.css') }}">
    <!-- END VENDOR CSS-->
    <!-- Switch CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">

    <!-- BEGIN MODERN CSS-->
    @if(session()->has('language'))
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css-rtl/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css-rtl/custom-rtl.css')}}">
    @else
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/app.css')}}">
    @endif

    @if(session()->has('language'))
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    @else
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
    @endif
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/forms/switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/colors/palette-switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/forms/checkboxes-radios.css') }}">
    <link href="{{asset('public/app-assets/css/toastr1.css')}}" rel="stylesheet">
    <link href="{{asset('public/app-assets/css/toastr2.css')}}" rel="stylesheet">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->

    <!-- END Custom CSS-->

    <style>
        .required {
            color: red;
        }

        .cursor {
            cursor: pointer;
        }
        .toggle-icon::before{
            display: none !important;
        }
        a::after{
            display: none !important;
        }

        

    </style>

    @yield('css')

    <script>
        window.onload = function () {
        
            var today = new Date();

            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var yesterday = today.getFullYear()+'-'+(today.getMonth()-1)+'-'+today.getDate();
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Referal & Earnings"
            },
            axisX:{
                unit: "day",
                crosshair: {
                    enabled: true,
                    snapToDataPoint: true
                }
            },
            axisY: {
                title: "Refferals",
                includeZero: true,
                crosshair: {
                    enabled: true
                }
            },
            toolTip:{
                shared:true
            },  
            legend:{
                cursor:"pointer",
                verticalAlign: "bottom",
                horizontalAlign: "left",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                type: "line",
                showInLegend: true,
                name: "Refferals",
                markerType: "square",
                xValueFormatString: "DD MMM, YYYY",
                color: "#F08080",
                dataPoints: [
                    { x: new Date(yesterday), y: {{$direct_earning_today->amount ?? 0 }} },
                    { x: new Date(date), y: {{$direct_earning_today->amount ?? 0 }} },
                  
                ]
            },
            {
                type: "line",
                showInLegend: true,
                name: "Earnings", 
                dataPoints: [
                    { x: new Date(yesterday), y: {{  $total_today ?? 0 }} },
                    { x: new Date(date), y: {{  $total_today ?? 0 }} },
                    
                    
                ]
            }]
        });
        chart.render();
        
        function toogleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }
        
        }
        </script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
