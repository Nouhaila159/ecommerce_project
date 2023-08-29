<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Free Bootstrap Themes by Zerotheme dot com - Free Responsive5 Templates">
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
			@if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
			  <li><a href=""><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
			@else
			  <li><a href="{{ route('account') }}"><span class="glyphicon glyphicon-user"></span> My account</a></li>
			@endif
			<li><a href="{{ route('contact') }}"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
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
    <!--///////////////////HomePage///////////////////////-->
    <!--//////////////////////////////////////////////////-->
    <div id="page-content" class="home-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Carousel -->
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="images/main-banner1-1440x550.jpg" alt="First slide">
                                <!-- Static Header -->
                                <div class="header-text hidden-xs">
                                    <div class="col-md-12 text-center">
                                    </div>
                                </div><!-- /header-text -->
                            </div>
                            <div class="item">
                                <img src="images/main-banner2-1440x550.jpg" alt="Second slide">
                                <!-- Static Header -->
                                <div class="header-text hidden-xs">
                                    <div class="col-md-12 text-center">
                                    </div>
                                </div><!-- /header-text -->
                            </div>
                            <div class="item">
                                <img src="images/main-banner3-1440x550.jpg" alt="Third slide">
                                <!-- Static Header -->
                                <div class="header-text hidden-xs">
                                    <div class="col-md-12 text-center">
                                    </div>
                                </div><!-- /header-text -->
                            </div>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div><!-- /carousel -->
                </div>
            </div>
            <div class="row">
                <div class="banner">
                    <div class="col-sm-4">
                        <img src="images/sub-banner1.jpg" />
                    </div>
                    <div class="col-sm-4">
                        <img src="images/sub-banner2.png" />
                    </div>
                    <div class="col-sm-4">
                        <img src="images/sub-banner3.png" />
                    </div>
                </div>
            </div>
            <div class="row">
    <h4>Les produits disponibles</h4>
    <div class="tab-content">
        <div id="featured" class="tab-pane fade in active">
            <div class="products">
                <div class="col-sm-7 five-three">
                    @php
                        $chunkedProducts = $produitsPublies->chunk(2); // Divisez les produits en groupes de 4
                    @endphp
                    
                    @foreach($chunkedProducts as $chunk)
                        <div class="row">
                            @foreach($chunk as $produit)
                                <div class="col-sm-4">
                                                <div class="product">
                                                    <div class="product-info"> <!-- Ajout de la classe product-info -->
                                                        <div class="image">
                                                            @php
                                                                $firstReference = $produit->references->first();
                                                            @endphp
                                                            @if($firstReference)
                                                            <a href="{{ route('product.show', ['id' => $produit->idP]) }}">
                                                                <img src="{{ asset('storage/' . $firstReference->urlPhoto) }}"  alt="Product Image"/>
                                                            </a>
                                                            
                                                            @endif
                                                            <ul class="buttons">
                                                                <li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                                                                <li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
                                                                <li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
                                                            </ul>
                                                        </div>
                                                        
                                                        <div class="caption">
                                                            <div class="name"><h4>{{ $produit->nomP }}</h4></div>
                                                            <div>
                                                                @if ($produit->reductionP > 0)
																<span class="reduced-price green-text">
                                                                        {{ $produit->prixP - ($produit->reductionP * $produit->prixP) / 100 }}MAD
                                                                    </span>
                                                                    <del class="original-price red-text">{{ $produit->prixP }}MAD</del>
                                                                    <span class="reduction-rate">(-{{ $produit->reductionP }}%)</span>
                                                                @else
                                                                    <span>{{ $produit->prixP }} MAD</span>
                                                                @endif
                                                            </div>
                                                            <div class="rating">
                                                                <span class="glyphicon glyphicon-star"></span>
                                                                <span class="glyphicon glyphicon-star"></span>
                                                                <span class="glyphicon glyphicon-star"></span>
                                                                <span class="glyphicon glyphicon-star"></span>
                                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											

                                        @endforeach
                                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

							<div class="clear"></div>
						</div>
					</div>
					<div id="new" class="tab-pane fade">
						<div class="products">
							<div class="col-sm-7 five-three">
								<div class="row">
								  <div class="col-sm-4">
									<div class="product">
											<div class="image">
												<a href="product"><img src="images/clothing_sp6_1.jpg" /></a>
												<ul class="buttons">
													<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
													<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
													<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
												</ul>
											</div>
											<div class="caption">
												<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
												<div class="price">$122<span>$98</span></div>
												<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></div>
											</div>
										</div>
								  </div>
								  <div class="col-sm-4">
									<div class="product">
											<div class="image">
												<a href="product"><img src="images/clothing_sp5_1.jpg" /></a>
												<ul class="buttons">
													<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
													<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
													<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
												</ul>
											</div>
											<div class="caption">
												<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
												<div class="price">$122<span>$98</span></div>
												<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></div>
											</div>
										</div>
								  </div>
								  <div class="col-sm-4">
									<div class="product">
											<div class="image">
												<a href="product"><img src="images/clothing_sp3_2.jpg" /></a>
												<ul class="buttons">
													<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
													<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
													<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
												</ul>
											</div>
											<div class="caption">
												<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
												<div class="price">$122<span>$98</span></div>
												<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span></div>
											</div>
										</div>
								  </div><!-- end inner row -->
								</div>
							</div>
							<div class="col-sm-5 five-two">
								<div class="row">
									<div class="col-sm-6">
										<div class="product">
												<div class="image">
													<a href="product"><img src="images/clothing_sp19_1.jpg" /></a>
													<div class="hot">
														<span>HOT</span>
													</div>
													<ul class="buttons">
														<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
														<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
														<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
													</ul>
												</div>
												<div class="caption">
													<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
													<div class="price">$122<span>$98</span></div>
													<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span></div>
												</div>
											</div>
									</div>
									<div class="col-sm-6">	
										<div class="product">
												<div class="image">
													<a href="product"><img src="images/clothing_sp12_1.jpg" /></a>
													<ul class="buttons">
														<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
														<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
														<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
													</ul>
												</div>
												
												<div class="caption">
													<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
													<div class="price">$122<span>$98</span></div>
													<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span></div>
												</div>
											</div>
									</div>
								</div><!-- end inner row -->
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="banner">
					<div class="col-sm-6">
						<img src="images/sub-banner4.jpg" />
					</div>
					<div class="col-sm-6">
						<img src="images/sub-banner5.jpg" />
					</div>
				</div>
			</div>
			<div class="row">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#best">BEST SALES</a></li>
					<li><a href="#special">SPECIAL</a></li>
				</ul>
				<div class="tab-content">
					<div id="best" class="tab-pane fade in active">
						<div class="products">
							<div class="col-sm-7 five-three">
								<div class="row">
								  <div class="col-sm-4">
									<div class="product">
											<div class="image">
												<a href="product"><img src="images/clothing_sp3_2.jpg" /></a>
												<ul class="buttons">
													<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
													<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
													<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
												</ul>
											</div>
											<div class="caption">
												<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
												<div class="price">$122<span>$98</span></div>
												<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span></div>
											</div>
										</div>
								  </div>
								  <div class="col-sm-4">
									<div class="product">
											<div class="image">
												<a href="product"><img src="images/clothing_sp5_1.jpg" /></a>
												<ul class="buttons">
													<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
													<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
													<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
												</ul>
											</div>
											<div class="caption">
												<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
												<div class="price">$122<span>$98</span></div>
												<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></div>
											</div>
										</div>
								  </div>
								  <div class="col-sm-4">
									<div class="product">
											<div class="image">
												<a href="product"><img src="images/clothing_sp6_1.jpg" /></a>
												<ul class="buttons">
													<li><a class="btn btn-2 cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
													<li><a class="btn btn-2 wishlist" href="#"><span class="glyphicon glyphicon-heart"></span></a></li>
													<li><a class="btn btn-2 compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a></li>
												</ul>
											</div>
											<div class="caption">
												<div class="name"><h3><a href="product">Pretty Playsuit</a></h3></div>
												<div class="price">$122<span>$98</span></div>
												<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></div>
											</div>
										</div>
								  </div><!-- end inner row -->
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('partials._footer')

	
	<!-- JS -->
	<script>
    $(document).ready(function() {
      // Fonction pour ajuster la taille de police
      function adjustFontSize() {
        $('.product .name h3').each(function() {
          var containerWidth = $(this).parent().width();
          var textWidth = $(this).width();
          var fontSize = parseInt($(this).css('font-size'));
          var newFontSize = (containerWidth / textWidth) * fontSize;
          $(this).css('font-size', newFontSize + 'px');
        });
      }

      // Appeler la fonction lors du chargement initial et du redimensionnement de la fenêtre
      adjustFontSize();
      $(window).resize(adjustFontSize);
    });
  </script>
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
	<style>
		.red-text {
    color: red;
}

.green-text {
    color: green;
}

	</style>

	<!-- Pagination -->
	<div class="pagination">
		{{ $produitsPublies->links() }}
	</div>
	
</body>
</html>
