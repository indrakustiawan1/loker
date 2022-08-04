<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Loker - Login</title>
	<link rel="stylesheet" href="{{ asset('backend') }}/vendors/core/core.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/vendors/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" href="{{ asset('backend') }}/css/demo_1/style.css">
    <link rel="shortcut icon" href="{{ asset('backend') }}/images/favicon.png" />
</head>
<body class="sidebar-dark">
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center" >
				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                                <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper" style="background-image: url({{ asset('backend') }}/images/hiring.png)">
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">Loker<span> SIAK</span></a>
                                        <h5 class="text-muted font-weight-normal mb-4">Selamat Datang! Masuk ke akun anda.</h5>
                                        @if (session()->has('notifications'))
                                            <div class="alert alert-danger" role="alert">{{ session('notifications') }}</div>
                                        @endif
                                        <form class="forms-sample" action="{{ url('authenticate') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama">
                                                @error('name')
                                                    <small class="text-warning err" id="name_error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="current-password" placeholder="Password">
                                                @error('password')
                                                    <small class="text-warning err" id="password_error">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 text-white">MASUK</button>
                                            </div>
                                            <a href="register.html" class="d-block mt-3 text-muted">Bukan Pengguna? Daftar</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- core:js -->
	<script src="{{ asset('backend') }}/vendors/core/core.js"></script>
	<script src="{{ asset('backend') }}/vendors/feather-icons/feather.min.js"></script>
	<script src="{{ asset('backend') }}/js/template.js"></script>
</body>
</html>