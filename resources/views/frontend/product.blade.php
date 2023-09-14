<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
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
					
					<li><a href="{{ route('historique') }}">Mon Historique</a></li>



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
												<!-- Ajoutez un attribut data-toggle et data-target pour déclencher la fenêtre modale -->
												<a href="#" data-toggle="modal" data-target="#enlarged-image-modal" onclick="enlargeImage('{{ asset('storage/' . $reference->urlPhoto) }}')">
													<img class="img-responsive reference-image" src="{{ asset('storage/' . $reference->urlPhoto) }}">
												</a>
												<p style="font-size: 10px">{{ $reference->referenceP }}</p>
											</li>
										@endforeach
									</ul>
								</div>
								
								<!-- Fenêtre modale pour l'image agrandie -->
									<div class="modal fade" id="enlarged-image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-body">
													<img class="img-responsive" src="" id="enlarged-img" alt="Image agrandie">
													<button class="btn btn-primary" onclick="showPreviousImage()">Previous</button>
													<button class="btn btn-primary" onclick="showNextImage()">Next</button>
												</div>
											</div>
										</div>
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
									<!-- Placer ici le code if pour vérifier la disponibilité du stock -->
									@if ($stockAvailable)
									<div class="circles-container">
										@foreach($produitsPublies->references as $reference)
												<div class="color-row">
													@foreach($reference->tailles as $taille)
													@if($taille->quantiteT>0)
														<div class="color-item" data-couleur="{{ $reference->couleur }}" data-taille="{{ $taille->taille }}" data-quantite="{{ $taille->quantiteT }}" data-reference="{{ $reference->idR }}">
															<div> <a class="product-intro__color-radio" style="background-color: {{ $reference->couleur }};" href=""></a></div>
															{{ $taille->taille }} ({{ $taille->quantiteT }})
															<div class="selected-size" style="display: none;">{{ $taille->taille }}</div>
														</div>
													
													@endif	
													@endforeach
												</div>
											@endforeach

									</div>
										<!-- Affichez les quantités et les tailles ici -->
									@else
										<p style="color: red;">Produit en rupture de stock</p>
									@endif
									
								</div>
								
								<a href="{{ route('cart') }}" id="addToCartBtn" class="btn btn-3" style="margin-bottom:10px; display: none;">Ajouter au panier</a>

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
							<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
							<li><a href="#commentaire" data-toggle="tab">Commentaire</a></li>
						</ul>
						<div class="tab-content">
							<div id="description" class="tab-pane fade in active">
								<p>{{ $produitsPublies->descriptionP }}</p>						
							</div>
							<div id="commentaire" class="tab-pane fade">
								<form action="{{ route('commentaire.storeCommentaire') }}" method="POST" class="comment-form">
									@csrf
									<input type="hidden" name="productId" value="{{ $produitsPublies->idP }}">
									<textarea name="comment" rows="2" style="width: 80%; margin-right: 65px;" placeholder="Write your comment here"></textarea>
									<button type="submit" class="btn btn-primary">Submit</button>
									
								</form>
								<div class="commentaires">
									@foreach ($commentaires as $commentaire)
										<div class="comment">
											<p>{{ $commentaire->commentaire }}</p>
											<!-- Affichez d'autres détails du commentaire si nécessaire -->
										</div>
									@endforeach
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
    document.addEventListener('DOMContentLoaded', () => {
        const colorItems = document.querySelectorAll('.color-item');
        let selectedCircle = null;
        let selectedReferenceId = null;
        let selectedTaille = null;
        let selectedQuantite = null;

        const selectedTailleElement = document.getElementById('selected-taille');

        colorItems.forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                const circleRadio = item.querySelector('.product-intro__color-radio');
                if (circleRadio) {
                    if (selectedCircle) {
                        selectedCircle.removeChild(selectedCircle.querySelector('.selected-arc'));
                    }

                    const selectedArc = document.createElement('div');
                    selectedArc.classList.add('selected-arc');
                    circleRadio.appendChild(selectedArc);
                    selectedCircle = circleRadio;

                    selectedReferenceId = item.getAttribute('data-reference');
                    selectedTaille = item.getAttribute('data-taille');
                    selectedQuantite = item.getAttribute('data-quantite');

                    if (selectedTailleElement) {
                        if (selectedTaille && selectedQuantite) {
                            selectedTailleElement.textContent = `Taille sélectionnée : ${selectedTaille} (Quantité : ${selectedQuantite})`;
                        } else {
                            selectedTailleElement.textContent = 'Aucune taille sélectionnée';
                        }
                    }

                    const addToCartBtn = document.getElementById('addToCartBtn');
                    if (selectedReferenceId) {
                        addToCartBtn.style.display = 'block';
                        const newCartUrl = `{{ route('cart') }}?product_id={{ $produitsPublies->idP }}&reference_id=${selectedReferenceId}&selected_taille=${selectedTaille}&selected_quantite=${selectedQuantite}`;
                        addToCartBtn.setAttribute('href', newCartUrl);
                    } else {
                        addToCartBtn.style.display = 'none';
                        addToCartBtn.removeAttribute('href');
                    }
                }
            });
        });
    });
</script>
<script>
function logout() {
	// Envoie de la requête de déconnexion au serveur
	document.getElementById('logout-form').submit();
}
</script>
<script>
    $(document).ready(function() {
        // Cacher le formulaire de commentaire au chargement de la page
        $('#commentaire').removeClass('in active'); // Assurez-vous qu'il est caché

        // Gérer les clics sur les onglets
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.target.href.includes('#commentaire')) {
                $('#description').removeClass('in active');
                $('#commentaire').addClass('in active');
            } else {
                $('#description').addClass('in active');
                $('#commentaire').removeClass('in active');
            }
        });
    });
</script>
<script>
    var currentIndex = 0; // Variable pour suivre l'index de l'image actuellement affichée

    // Fonction pour agrandir l'image et l'afficher dans la fenêtre modale
    function enlargeImage(imageUrl) {
        const enlargedImg = document.getElementById('enlarged-img');
        
        // Modifie la source de l'image dans la fenêtre modale
        enlargedImg.src = imageUrl;
    }

    // Fonction pour afficher l'image suivante
    function showNextImage() {
        const numImages = {!! json_encode(count($produitsPublies->references)) !!}; // Le nombre total d'images
        if (currentIndex < numImages - 1) {
            currentIndex++;
            const nextImage = document.querySelectorAll('.reference-image')[currentIndex];
            const imageUrl = nextImage.src;
            enlargeImage(imageUrl);
        }
    }

    // Fonction pour afficher l'image précédente
    function showPreviousImage() {
        if (currentIndex > 0) {
            currentIndex--;
            const previousImage = document.querySelectorAll('.reference-image')[currentIndex];
            const imageUrl = previousImage.src;
            enlargeImage(imageUrl);
        }
    }
</script>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
