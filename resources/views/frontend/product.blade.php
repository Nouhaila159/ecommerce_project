<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="Free Bootstrap Themes by Zerotheme dot com - Free Responsive5 Templates">
		<meta name="author" content="https://www.Zerotheme.com">
		
		<title>Fashion Shop | Free Bootstrap Themes by Zerotheme.com</title>
		
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css"  type="text/css">
		
		<!-- Custom CSS -->
		<link rel="stylesheet" href="../css/style1.css">
		
		
		<!-- Custom Fonts -->
		<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"  type="text/css">
		<link rel="stylesheet" href="../fonts/font-slider.css" type="text/css">
		
		<!-- jQuery and Modernizr-->
		<script src="../js/jquery-2.1.1.js"></script>
		
		<!-- Core JavaScript Files -->  	 
		<script src="../js/bootstrap.min.js"></script>
		
		<script src="../js/photo-gallery.js"></script>
		
		
		<!--5 Shim and Respond.js IE8 support of5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="js5shiv.js"></script>
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
					<div id="logo"><img src="../images/logo.jpeg" style="width: 100px; height: 100px;"/></div>
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
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Women Fashion</a>
						<div class="dropdown-menu">
							<div class="dropdown-inner">
								<ul class="list-unstyled">
									<li><a href="category">Text 101</a></li>
									<li><a href="category">Text 102</a></li>
								</ul>
							</div>
						</div>
					</li>
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
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Kids Fashion</a>
						<div class="dropdown-menu" style="margin-left: -203.625px;">
							<div class="dropdown-inner">
								<ul class="list-unstyled">
									<li><a href="category">Text 301</a></li>
									<li><a href="category">Text 302</a></li>
									<li><a href="category">Text 303</a></li>
									<li><a href="category">Text 304</a></li>
									<li><a href="category">Text 305</a></li>
								</ul>
								<ul class="list-unstyled">
									<li><a href="category">Text 306</a></li>
									<li><a href="category">Text 307</a></li>
									<li><a href="category">Text 308</a></li>
									<li><a href="category">Text 309</a></li>
									<li><a href="category">Text 310</a></li>
								</ul>
								<ul class="list-unstyled">
									<li><a href="category">Text 311</a></li>
									<li><a href="category">Text 312</a></li>
									<li><a href="category#">Text 313</a></li>
									<li><a href="category#">Text 314</a></li>
									<li><a href="category">Text 315</a></li>
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
	<!--///////////////////Product Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div id="main-content" class="col-md-8">
					<div class="product">
						<div class="col-md-6">
							<div class="image">
								@php
								$firstReference = $references->first();
								@endphp
								@if($firstReference)                                
									<center>
										<a href="{{ route('product.show', ['id' => $produitsPublies->idP]) }}">
											<img style="margin-top: 50px;" src="{{ asset('storage/' . $firstReference->urlPhoto) }}" />
										</a>
									</center>
								@endif
								<div class="image-more">
									<ul class="row">
										@foreach($produitsPublies->references as $reference)
											<li class="col-lg-3 col-sm-3 col-xs-4">
												<a href="#"><img class="img-responsive reference-image" src="{{ asset('storage/' . $reference->urlPhoto) }}"></a>
												<p>{{ $reference->referenceP }}</p>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="caption">
								<div class="name"><h3>{{ $produitsPublies->nomP }}</h3></div>
								<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span></div>
								<div class="info">
									<ul>
										<li>Marque: {{ $produitsPublies->marque->marque }}</li>
										<li>Matières textiles: {{ $produitsPublies->materiel->materiel }}</li>
										<li>Catégorie: {{ $produitsPublies->categorie->categorie  }}</li>
									</ul>
								</div>
								<div class="prixP">
									@if ($produitsPublies->reductionP > 0)
										<span class="original-price red-text">{{ $produitsPublies->prixP }} MAD</span>
										<span class="reduced-price green-text">
											{{ $produitsPublies->prixP - ($produitsPublies->reductionP * $produitsPublies->prixP) / 100 }} MAD
										</span>
										<span class="reduction-rate">(-{{ $produitsPublies->reductionP }} )</span>
									@else
										<span>{{ $produitsPublies->prixP }} MAD</span>
									@endif
								</div>
											
								<div class="options">
									<p>Options disponibles:</p>
									<div class="circles-container">
										@foreach($produitsPublies->references as $reference)
											@foreach($reference->tailles as $taille)
												
													<p>{{ $reference->couleur }} {{ $taille->taille }} ( {{ $taille->quantiteT }})</p>
													<input type="number" class="quantity-input" min="0" max="{{ $taille->quantiteT }}" value="0">
													<p class="error-message" style="color: red; display: none;">La quantité dépasse le stock disponible.</p>
												
											@endforeach
										@endforeach
									</div>
								</div>	
								<a href="{{ route('cart.index', ['product_id' => $produitsPublies->idP, 'reference_id' => $firstReference->idR, 'quantity' => '1']) }}" class="btn btn-3">Go to Cart</a>
								<div class="share well">
									<strong style="margin-right: 13px;">Share :</strong>
									<a href="#" class="share-btn" target="_blank">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="#" class="share-btn" target="_blank">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="#" class="share-btn" target="_blank">
										<i class="fa fa-linkedin"></i>
									</a>
									<a href="#" class="share-btn" target="_blank">
										<i class="fa fa-instagram"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>	
					<div class="product-desc">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#description">Description</a></li>
							<li><a href="#review">Review</a></li>
						</ul>
						<div class="tab-content">
							<div id="description" class="tab-pane fade in active">
							<p>{{ $produitsPublies->descriptionP }}</p>						
							</div>
							<div id="review" class="tab-pane fade">
							  <div class="review-text">
								<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							  </div>
							  <div class="review-form">
								<h4>Write a review</h4>
									<form name="form1" id="ff" method="post" action="contact.php">
										<label>
										<span>Enter your name:</span>
										<input type="text"  name="name" id="name" required>
										</label>
										<label>
										<span>Your message here:</span>
										<textarea name="message" id="message"></textarea>
										</label>
										<center><input class="sendButton" type="submit" name="Submit" value="Submit"></center>
									</form>
							  </div>
							</div>
						</div>
					</div>
					
				</div>
				<div id="sidebar" class="col-md-4">
					<div class="widget wid-categories">
						<div class="heading"><h4>CATEGORIES</h4></div>
						<div class="content">
							<ul>
								@foreach($categories as $categorie)
									<li><a href="#">{{ $categorie->categorie }}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<div class="widget wid-categories">
						<div class="heading"><h4>Matières textiles</h4></div>
						<div class="content">
							<ul>
								@foreach($materiels as $materiel)
									<li><a href="#">{{ $materiel->materiel }}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
					
					<div class="widget wid-brand">
						<div class="heading"><h4>Marque</h4></div>
						<div class="content">
							@foreach($marques as $marque)
								<label class="checkbox">
									<input type="checkbox" name="brand">{{ $marque->marque }}
								</label>
							@endforeach
						</div>
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
						<a href="#"><img src="../images/brand1-250x100.jpg" /></a>
					</div>
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="../images/brand2-250x100.jpg" /></a>
					</div>
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="../images/brand1-250x100.jpg" /></a>
					</div>
					<div class="col-lg-3 col-xs-6">
						<a href="#"><img src="../images/brand4-250x100.jpg" /></a>
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
						<img src="../images/logofooter.png" />
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
								<li><img src="../images/visa-curved-32px.png" /></li>
								<li><img src="../images/paypal-curved-32px.png" /></li>
								<li><img src="../images/discover-curved-32px.png" /></li>
								<li><img src="../images/maestro-curved-32px.png" /></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	<!-- IMG-thumb -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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
	<script>
	$(document).ready(function(){
		$(".nav-tabs a").click(function(){
			$(this).tab('show');
		});
		$('.nav-tabs a').on('shown.bs.tab', function(event){
			var x = $(event.target).text();         // active tab
			var y = $(event.relatedTarget).text();  // previous tab
			$(".act span").text(x);
			$(".prev span").text(y);
		});
	});
	</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".quantity-input").on("change", function() {
            var input = $(this);
            var maxQuantity = parseInt(input.attr("max"));
            var selectedQuantity = parseInt(input.val());

            var errorMessage = input.next(".error-message");

            if (selectedQuantity > maxQuantity) {
                errorMessage.show();
            } else {
                errorMessage.hide();
            }
        });
    });
</script>

</body>
<>
