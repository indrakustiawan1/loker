<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<!-- core -->
	<link rel="stylesheet" href="{{ asset('backend') }}/vendors/core/core.css">
    <!-- datepicker -->
	<link rel="stylesheet" href="{{ asset('backend') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<!-- icon font -->
	<link rel="stylesheet" href="{{ asset('backend') }}/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/vendors/fontawesome-free/css/all.min.css" type="text/css">
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/select2/select2.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('backend') }}/vendors/jquery-tags-input/jquery.tagsinput.min.css">
    <!-- Layout styles -->  
	<link rel="stylesheet" href="{{ asset('backend') }}/css/demo_1/style.css">
    <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.png" />
    <!-- core:js -->
    <script src="{{ asset('backend') }}/vendors/core/core.js"></script>
</head>
<body class="sidebar-dark">
	<div class="main-wrapper">
        
        <!-- partial:partials/_sidebar.html -->
        <x-layouts.sidebar></x-layouts.sidebar>
		<!-- partial -->
        
		<div class="page-wrapper">
					
            <!-- partial:partials/_navbar.html -->
            <x-layouts.navbar></x-layouts.navbar>
			<!-- partial -->
            
            @yield('content')
            
			<!-- partial:partials/_footer.html -->
			<x-layouts.footer></x-layouts.footer>
			<!-- partial -->
		
		</div>
	</div>
    <!-- plugin -->
    {{-- <script src="{{ asset('backend') }}/vendors/chartjs/Chart.min.js"></script> --}}
    <script src="{{ asset('backend') }}/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="{{ asset('backend') }}/vendors/jquery.flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('backend') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('backend') }}/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('backend') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('backend') }}/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('backend') }}/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <!-- end plugin js -->
    <!-- inject:js -->
    <script src="{{ asset('backend') }}/vendors/feather-icons/feather.min.js"></script>
    <script src="{{ asset('backend') }}/js/template.js"></script>
    <!-- endinject -->
    <!-- custom js for this page -->
    <script src="{{ asset('backend') }}/js/dashboard.js"></script>
    <script src="{{ asset('backend') }}/js/datepicker.js"></script>
    <script src="{{ asset('backend') }}/js/data-table.js"></script>
    <script src="{{ asset('backend') }}/js/select2.js"></script>
    <script src="{{ asset('backend') }}/js/tags-input.js"></script>
	<!-- end custom js for this page -->
</body>
</html>    