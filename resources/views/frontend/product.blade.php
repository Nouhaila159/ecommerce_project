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
        @if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
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
					<li><a href="{{ route('accueil') }}">Home</a></li>
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
	<!--///////////////////Product Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('accueil') }}">Home</a></li>
						<li><a href="category">Category</a></li>
						<li><a href="product">Clothes</a></li>
					</ul>
				</div>
			</div>
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
											<li class="col-lg-4 col-sm-2">
												<a href="#"><img class="img-responsive reference-image" src="{{ asset('storage/' . $reference->urlPhoto) }}"></a>
												<p style="font-size: 10px">{{ $reference->referenceP }}</p>
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
									<span class="reduced-price green-text">
                                                                        {{ $produitsPublies->prixP - ($produitsPublies->reductionP * $produitsPublies->prixP) / 100 }}MAD
                                                                    </span>
                                                                    <del class="original-price red-text">{{ $produitsPublies->prixP }}MAD</del>
                                                                    <span class="reduction-rate">(-{{ $produitsPublies->reductionP }}%)</span>
                                            @else
										<span>{{ $produitsPublies->prixP }} MAD</span>
									@endif
								</div>
											
								<div class="options">
    <p>Options disponibles:</p>
    <div class="circles-container">
        @foreach($produitsPublies->references as $reference)
            <div class="color-row">
                @foreach($reference->tailles as $taille)
                    <div class="color-item" data-couleur="{{ $reference->couleur }}" data-taille="{{ $taille->taille }}">
                        <div> <a class="product-intro__color-radio" style="background-color: {{ $reference->couleur }};" href=""></a></div>
                        {{ $taille->taille }} ({{ $taille->quantiteT }})
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
<a href="{{ route('cart', ['product_id' => $produitsPublies->idP]) }}" id="addToCartBtn" class="btn btn-3" style="margin-bottom:10px">Ajouter au panier</a>

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
									<form name="form1" id="ff" method="post" action="contact">
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
	
	<!-- IMG-thumb -->
	<div class="modal fade" id="myModal" tabaccueil="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    const colorItems = document.querySelectorAll('.color-item');
    const addToCartBtn = document.getElementById('addToCartBtn');

    // Variables pour stocker la couleur et la taille sélectionnées
    let selectedCouleur = null;
    let selectedTaille = null;

    // Ajouter un gestionnaire d'événement click à chaque élément
    colorItems.forEach(colorItem => {
        colorItem.addEventListener('click', () => {
            // Désélectionner l'élément précédemment sélectionné
            if (selectedCouleur) {
                selectedCouleur.classList.remove('selected');
            }

            // Sélectionner l'élément actuel
            colorItem.classList.add('selected');
            selectedCouleur = colorItem;

            selectedTaille = colorItem.getAttribute('data-taille');
        });
    });

    // Ajouter un gestionnaire d'événement click au bouton "Ajouter au panier"
    addToCartBtn.addEventListener('click', () => {
        if (selectedCouleur && selectedTaille) {
            const couleur = selectedCouleur.getAttribute('data-couleur');
            // Ici, vous pouvez appeler la fonction pour ajouter le produit au panier
            addProductToCart(couleur, selectedTaille);
        } else {
            alert("Veuillez sélectionner une couleur et une taille avant d'ajouter au panier.");
        }
    });

    function addProductToCart(couleur, taille) {
        // Ici, vous pouvez implémenter la logique pour ajouter le produit au panier
        console.log(`Produit ajouté au panier : Couleur - ${couleur}, Taille - ${taille}`);
        // Rediriger vers la page du panier ou effectuer d'autres actions si nécessaires
    }
</script>

</body>
</html>
