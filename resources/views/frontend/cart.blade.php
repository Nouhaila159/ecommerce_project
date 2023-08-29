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
				</ul>
			</div>
		</div>
	</nav>
	
	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Cart Page//////////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="accueil">Home</a></li>
						<li><a href="cart">Cart</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="product well">
					<div class="col-md-3">
						<div class="image">
							<img src="{{ asset('storage/' . $product->image) }}" /> <!-- Adjust the image path based on your actual data -->
						</div>
					</div>
					<div class="col-md-9">
						<div class="caption">
							<div class="name"><h3><a href="product">{{ $product->nomP }}</a></h3></div>
							<ul class="info">
								<li>Marque: {{ $product->marque->marque }}</li> <!-- Replace with your actual brand data -->
								<li>Matières textiles: {{ $product->materiel->materiel }}</li>
								<li>Catégorie: {{ $product->categorie->categorie  }}</li>
							</ul>
							<div class="prixP">
								@if ($product->reductionP > 0)
									<span class="original-price red-text">{{ $product->prixP }} MAD</span>
									<span class="reduced-price green-text">
										{{ $product->prixP - ($product->reductionP * $product->prixP) / 100 }} MAD
									</span>
									<span class="reduction-rate">(-{{ $product->reductionP }} )</span>
								@else
									<span>{{ $product->prixP }} MAD</span>
								@endif
							</div>	
						    <div> 
								{{ $product->descriptionP }}
							</div>						
							<label>Qty: </label> <input class="form-inline quantity" type="text" value="{{ $quantity }}"><a href="#" class="btn btn-3 ">Update</a>
							<hr>
							<a href="#" class="btn btn-default pull-right">REMOVE</a>
						</div>
					</div>
					<div class="clear"></div>
				</div>    
			</div>
			<!-- Repeat the above structure for each product/reference -->
		</div>
	</div>
		<div class="row">
				<div class="col-md-4 col-md-offset-8 ">
					<center><a href="#" class="btn btn-1">Continue To Shopping</a></center>
				</div>
			</div>
			<div class="row">
				<div class="pricedetails">
					<div class="col-md-4 col-md-offset-8">
						<table>
							<h6>Price Details</h6>
							<tr>
								<td>Total</td>
								<td>350.00</td>
							</tr>
							<tr>
								<td>Discount</td>
								<td>-----</td>
							</tr>
							<tr>
								<td>Delivery Charges</td>
								<td>100.00</td>
							</tr>
							<tr style="border-top: 1px solid #333">
								<td><h5>TOTAL</h5></td>
								<td>400.00</td>
							</tr>
						</table>
						<center><a href="#" class="btn btn-1">Checkout</a></center>
					</div>
				</div>
			</div>
		</div>
	</div>	
	@include('partials._footer')

<style>
		.reference-image {
    width: 100px; /* Adjust this to your desired width */
    height: 100px; /* Adjust this to your desired height */
		}	
.red-text {
    color: red;
}

.green-text {
    color: green;
}

</style>
	
</body>
</html>
