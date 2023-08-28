<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by Zerotheme dot com - Free Responsive Html5 Templates">
    <meta name="author" content="https://www.Zerotheme.com">
	
    <title>Fashion Shop | Free Bootstrap Themes by Zerotheme.com</title>
	
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
						<li><a href="account"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
						<li><a href="contact"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!--Header-->
	<header >
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div id="logo"><img src="images/logo.jpeg" style="width: 100px; height: 100px;"/></div>
				</div>
				<div class="col-md-6 text-right">
					<div class="phone"><span class="glyphicon glyphicon-earphone"></span>0123-456-789</div>
					<div class="mail"><span class="glyphicon glyphicon-envelope"></span>infor@yoursite.com</div>
					<form class="form-search">  
						<input type="text" class="input-medium search-query">  
						<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>  
					</form>
				</div>
				<div id="cart"><a class="btn btn-cart" href="cart"><span class="glyphicon glyphicon-shopping-cart"></span>CART<strong>0</strong></a></div>
			</div>
		</div>
	</header>
	<!--Navigation-->
	<nav id="menu" class="navbar">
		<div class="container">
			<div class="navbar-header"><span id="heading" class="visible-xs">Categories</span>
			  <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index">Home</a></li>
					
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
					
					<li><a href="category">New Fashion</a></li>
					<li><a href="category">Hot Fashion</a></li>
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
						<li><a href="index">Home</a></li>
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
							<div class="name"><h3><a href="product.html">{{ $product->nomP }}</a></h3></div>
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
	<footer>
		<div class="brand">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="images/brand1-250x100.jpg" /></a>
					</div>
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="images/brand2-250x100.jpg" /></a>
					</div>
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="images/brand1-250x100.jpg" /></a>
					</div>
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="images/brand4-250x100.jpg" /></a>
					</div>
				</div>
			</div>
		</div>
		<div class="top-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 text-right">
						<h4>Subcribe Email</h4>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
					<div class="col-md-6">
						<form name="subcribe-email" action="subcribe.php">
							<div class="subcribe-form form-group">
								<input class="form-inline" type="text" name="email" value="1"><button href="#" class="btn btn-4" type="submit">Subcribe</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
		<div class="container">
			<div class="wrap-footer">
				<div class="row">
					<div class="col-md-3 col-footer footer-1">
						<img src="images/logo.jpeg" style="width: 100px; height: 100px;"/>

						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
					<div class="col-md-3 col-footer footer-2">
						<div class="heading"><h4>Customer Services</h4></div>
						<ul>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Delivery Information</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Terms & Conditions</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-footer footer-3">
						<div class="heading"><h4>My Account</h4></div>
						<ul>
							<li><a href="#">My Account</a></li>
							<li><a href="#">Brands</a></li>
							<li><a href="#">Gift Vouchers</a></li>
							<li><a href="#">Specials</a></li>
							<li><a href="#">Site Map</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-footer footer-4">
						<div class="heading"><h4>Contact Us</h4></div>
						<ul>
							<li><span class="glyphicon glyphicon-home"></span>California, United States 3000009</li>
							<li><span class="glyphicon glyphicon-earphone"></span>+91 8866888111</li>
							<li><span class="glyphicon glyphicon-envelope"></span>infor@yoursite.com</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						Your Store ?? 20xx - Designed by <a href="https://www.Zerotheme.com" target="_blank">Zerotheme</a>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<ul>
								<li><img src="images/visa-curved-32px.png" /></li>
								<li><img src="images/paypal-curved-32px.png" /></li>
								<li><img src="images/discover-curved-32px.png" /></li>
								<li><img src="images/maestro-curved-32px.png" /></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
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
