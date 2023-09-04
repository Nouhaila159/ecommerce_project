<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by Zerotheme dot com - Free Responsive Html5 Templates">
    <meta name="author" content="https://www.Zerotheme.com">
	
    <title>RedlySS</title>
	
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"  type="text/css">
	
	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/style1.css">
	
	
	<!-- Custom Fonts -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"  type="text/css">
    <link rel="stylesheet" href="fonts/font-slider.css" type="text/css">
	
	<!-- Core JavaScript Files -->  	 
    <script src="js/bootstrap.min.js"></script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<!--Top-->
	<nav id="top">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<select class="language">
						<option value="English" selected>English</option>
						<option value="France">France</option>
						<option value="Germany">Germany</option>
					</select>
					<select class="currency">
						<option value="USD" selected>USD</option>
						<option value="EUR">EUR</option>
						<option value="DDD">DDD</option>
					</select>
				</div>
				<div class="col-xs-6">
				<ul class="top-link">
        @if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
        @else
            <li><a href="account"><span class="glyphicon glyphicon-user"></span> My account</a></li>
        @endif
        <li><a href="contact"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
    </ul>
				</div>
			</div>
		</div>
	</nav>
	<!--Header-->
	@include('partials._header')

	<!--Navigation-->
	<nav id="menu" class="navbar">
		<div class="container">
			<div class="navbar-header"><span id="heading" class="visible-xs">Categories</span>
			  <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="accueil">Home</a></li>
					
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Men Fashion</a>
						<div class="dropdown-menu">
							<div class="dropdown-inner">
								<ul class="list-unstyled">
									<li><a href="category">Text 201</a></li>
									<li><a href="category">Text 202</a></li>
									<li><a href="category">Text 203</a></li>
									<li><a href="category">Text 204</a></li>
									<li><a href="category">Text 205</a></li>
								</ul>
							</div> 
						</div>
					</li>
					<li><a href="summary">Mon Panier</a></li>

				</ul>
			</div>
		</div>
	</nav>
	
	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Account Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="index">Home</a></li>
						<li><a href="account">Account</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				
				<div class="col-md-6" style="margin-bottom: 30px;">
					<div class="heading"><h2>Login</h2></div>
					<form name="form1" id="ff1" method="POST" action="{{ route('login') }}">
					@csrf
					<div class="form-group">
							<input type="text" class="form-control" placeholder="Username :" name="username" id="username" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password :" name="email" id="email" required>
						</div>
						<button type="submit" class="btn btn-4" name="login" id="login">Login</button>
						<a href="#">Forgot Your Password ?</a>
					</form>
				</div>
				
				
				<div class="col-md-6">
					<div class="heading"><h2>New User ? Create An Account.</h2></div>
					<form name="form2" id="ff2" method="POST" action="{{ route('register') }}">
					@csrf
					<div class="form-group">
    			<input type="text" class="form-control" placeholder="First Name :" name="firstname" id="firstname" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Last Name :" name="lastname" id="lastname" required>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" placeholder="Email Address :" name="email" id="email" required>
				</div>
				<div class="form-group">
					<input type="tel" class="form-control" placeholder="Mobile :" name="phone" id="phone" required>
				</div>
				<div class="form-group">
					<label>Gender:</label>
					<input name="gender" id="gender_male" type="radio" value="male"> Male
					<input name="gender" id="gender_female" type="radio" value="female"> Female 
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Password :" name="password" id="password" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Retype Password :" name="repassword" id="repassword" required>
				</div>
				<div class="form-group">
					<input name="agree" id="agree" type="checkbox" > I agree to your website.
				</div>
				<button type="submit" class="btn btn-4">Create</button>

					</form>
				</div>
				@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
			</div>
		</div>
	</div>
	@include('partials._footer')
	 
</body>
</html>
