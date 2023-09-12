<?php
// Supposons que vous avez déjà établi une connexion à la base de données

// 1. Récupérer les données de la table info_site
$infoSite = DB::table('info_site')->first(); // Vous pouvez ajuster la requête selon vos besoins

// Maintenant vous avez les données extraites
$telNumber = $infoSite->teleS; // Numéro de téléphone depuis la base de données
$gmailAddress = $infoSite->emailS; // Adresse email depuis la base de données
$AdresseS= $infoSite->adesseS; 
?>

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
	
	<!-- jQuery and Modernizr-->
	<script src="js/jquery-2.1.1.js"></script>
	
	<!-- Core JavaScript Files -->  	 
    <script src="js/bootstrap.min.js"></script>
	
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
            <li><a href=""><span class="glyphicon glyphicon-user"></span> My account</a></li>
        @endif
		<li>	<div aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="#" onclick="logout();">
				{{ __('Logout') }}
			</a>
			<!-- Le champ bouton submit pour le formulaire de déconnexion -->
			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
				@csrf
			</form>
		</div></li>
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
	<!--///////////////////Contact Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="accueil">Home</a></li>
						<li><a href="contact">Contact</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="heading"><h1>CONTACT US</h1></div>
				</div>
				<div class="col-md-6" style="margin-bottom: 20px;">
				@if(session('message'))
					<div class="alert alert-success">
						{{ session('message') }}
					</div>
					@endif
				<form name="form1" id="ff" method="post" action="{{ route('contact.store') }}">
				@csrf 
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Your Name *" name="name" id="name" required data-validation-required-message="Please enter your name.">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Your Email *" name="email" id="email" required data-validation-required-message="Please enter your email address.">
						</div>
						<div class="form-group">
							<input type="tel" class="form-control" placeholder="Your Phone *" name="phone" id="phone" required data-validation-required-message="Please enter your phone number.">
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Your Message *" name="message" id="message" required data-validation-required-message="Please enter a message."></textarea>
						</div>
						<button type="submit" class="btn btn-1">Send Message</button>
					</form>
				</div>
				<div class="col-md-6">
					<p><span class="glyphicon glyphicon-home"></span><?php echo " " . $AdresseS; ?></p>
					<p><span class="glyphicon glyphicon-earphone"></span><?php echo " +212 ". $telNumber; ?></p>
					<p><span class="glyphicon glyphicon-envelope"></span><?php echo " ".$gmailAddress; ?></p>

				</div>
			</div>
		</div>
	</div>
	@include('partials._footer')
	<script>
		function logout() {
			// Envoie de la requête de déconnexion au serveur
			document.getElementById('logout-form').submit();
		}
		</script>
</body>
</html>
