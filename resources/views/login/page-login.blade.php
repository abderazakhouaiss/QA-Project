<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Authentification</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap_4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor/linearicons/style.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">
	<script src="{{ asset('assets/scripts/jquery-3.3.1.min.js')}}"></script>
	<script src="{{ asset('assets/scripts/registration_script.js')}}"></script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							@if(isset($msg))
								<div class="alert alert-danger text-center text-monospace" role="alert">
									{{ $msg }}
								</div>
							@endif
							<p>
								<a href="{{ url('login/google') }}" class="btn btn-block btn-danger"> <i class="fab fa-google"></i>  
									S'inscrire via Google+</a>
								<a href="{{ url('login/facebook') }}" class="btn btn-block btn-primary"> <i
											class="fab fa-facebook-f"></i>   S'inscrire via Facebook</a>
							</p>
							<p class="divider-text">
								<span class="bg-light">Ou</span>
							</p>
							<div class="header">
								<p class="lead text-monospace">S'authentifier</p>
							</div>
							<form class="form-auth-small" action="{{ url('login/check') }}" method="post">
								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" name="email" class="form-control" id="email" value="" placeholder="Email" aria-invalid="email" required>
									<small id="emailHelp" class="form-text text-warning" style="float: left;margin: 5px;"></small>
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Mot de passe</label>
									<input type="password" name="pass" class="form-control" id="signin-password" value="" placeholder="Mot de passe" required>
								</div>
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="S'authentifier"/>
								{{--<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
								</div>--}}
								<div  style="padding: 10px;">
									<a href="{{ url('register') }}">S'inscrire</a>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Answer Bucket</h1>
							<p>Dévelopé pour vous</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
