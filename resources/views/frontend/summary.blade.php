
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

			</div>
			<div class="row">
				@if (session('error'))
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
				@endif
				@if(request('success'))
    <div class="alert alert-success">
        {{ request('success') }}
    </div>
@endif

                @foreach($paniers as $panier)
                    <div class="product well">
                        <div class="col-md-3">
                            <div class="image">
                                <img src="{{ asset('storage/' . $panier->reference->urlPhoto) }}" style="max-width: 250px; height: 300px;" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="caption">
                                <div class="name"><h3><a href="product">{{ $panier->produit->nomP }}</a></h3></div>
                                <ul class="info">
                                    <li>Marque: {{ $produit->marque->marque }}</li> <!-- Replace with your actual brand data -->
                                    <li>Matières textiles: {{ $panier->produit->materiel->materiel }}</li>
                                    <li>Catégorie: {{ $panier->produit->categorie->categorie  }}</li>
                                    <li>
                                        <span id="selected-taille">
                                            Taille choisie : {{ $panier->taille->taille }} (Quantité : {{ $panier->quantiteP }})
                                        </span>
                                    </li>
                                </ul>
                                <div class="prixP">
                                    @if ($produit->reductionP > 0)
                                        <span class="reduced-price green-text">
                                            {{ $panier->produit->prixP - ($panier->produit->reductionP * $panier->produit->prixP) / 100 }}MAD
                                        </span>
                                    @endif
                                </div>
                                <div> 
                                    {{ $panier->produit->descriptionP }}
                                </div>	

								<form action="{{ route('cart.update', ['panier' => $panier->idPaniers]) }}" method="POST">
									@csrf
									@method('PUT')
									<div class="form-group">
										<label for="quantiteP">Quantité :</label>
										<input type="number" name="quantiteP" id="quantiteP" value="{{ $panier->quantiteP }}">
									</div>
									<button type="submit" class="btn btn-primary">Mettre à jour</button>
								</form>                                
                                <form action="{{ route('cart.destroy', ['panier' => $panier->idPaniers]) }}" method="POST" style="display: inline-block;"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce panier?');">
                                    @csrf
                                    @method('DELETE')
									<button type="submit" class="btn btn-default delete-button">Supprimer</button>
                                </form>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                @endforeach
            </div>
	<!-- Ajoutez ce formulaire à l'endroit où vous souhaitez afficher la forme -->
		<div class="row">
				<div class="col-md-4 col-md-offset-8 ">
					<center><a href="index" class="btn btn-1">Continue To Shopping</a></center>
				</div>
			</div>
			<div class="row">
				<div class="pricedetails">
					<div class="col-md-4 col-md-offset-8">
					
						
						<table>

							<h6>Facture</h6>
							<form method="POST" action="{{ route('calculate-total-price') }}" id="delivery-form">
								@csrf
								<label for="delivery_charge">Frais de livraison par ville :</label>
								<select id="delivery_charge" name="delivery_charge">
									<option value="20">Marrakech (20 MAD)</option>
									<option value="30">Casablanca (30 MAD)</option>
									<option value="50">Autres villes (50 MAD)</option>
								</select>
							
								<!-- Champ caché pour stocker le nom de la ville -->
								<input type="hidden" id="selected_city_input" name="selected_city" value="">
								
								<button type="submit" class="btn btn-primary">choisir une ville</button>
							</form>
							
							
							<div>
								@if(session()->has('selected_city'))
									<p>Le prix de livraison : {{ session('delivery_charge') }} MAD</p>
									<p>Ville de livraison : {{ session('selected_city') }}</p>
								@endif
							</div>
							
							
							@php
								$totalPrice = 0; // Initialisez le total à zéro
							@endphp
				
							@foreach($paniers as $panier)
								@php
									// Calcul du prix pour ce produit dans le panier
									$prixProduit = $panier->produit->prixP - ($panier->produit->reductionP * $panier->produit->prixP) / 100;
									
									// Multiplication par la quantité dans le panier
									$prixTotalProduit = $prixProduit * $panier->quantiteP;
									
									// Ajoutez le prix total de ce produit au total général
									$totalPrice += $prixTotalProduit;
								@endphp
								<tr>
									<td>{{ $panier->produit->nomP }} ({{ $panier->quantiteP }})</td>
									<td>{{ $prixTotalProduit }}MAD</td>
								</tr>
							@endforeach
						   
							<tr style="border-top: 1px solid #333">
								<td><h5>TOTAL</h5></td>
								<td>
									@if(session('totalPrice'))
										{{ session('totalPrice') }} MAD
									@else
										{{ $totalPrice }} MAD
									@endif
								</td>
							</tr>
						</table>
						
						<center><a href="#" class="btn btn-1" data-toggle="modal" data-target="#checkoutModal">Checkout</a></center>
					</div>
				</div>
			</div>
		</div>
	</div>	

	<!-- Popup Modal -->
<!-- Code HTML du formulaire modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Formulaire de Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Première étape du formulaire (informations du client) -->
                <div id="client-form">
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
						<div class="form-group">
							<label for="nom">Nom :</label>
							<input type="text" name="nomC" id="nomC" class="form-control">
						</div>
						
						<div class="form-group">
							<label for="prenomC">Prénom :</label>
							<input type="text" name="prenomC" id="prenomC" class="form-control">
						</div>
						<div class="form-group">
							<label for="telC">Téléphone:</label>
							<input type="tele" name="telC" id="telC" class="form-control">
						</div>
						<div class="form-group">
							<label for="adresseC">Adresse :</label>
							<input type="text" name="adresseC" id="adresseC" class="form-control">
						</div>
						<div class="form-group">
							<label for="villeC">Ville :</label>
							<input type="text" name="villeC" id="villeC" class="form-control">
						</div>
						<div class="form-group">
							<label for="emailC">Email :</label>
							<input type="email" name="emailC" id="emailC" class="form-control">
						</div>

                    <button type="button" id="next-button" class="btn btn-primary">Suivant</button>
                </div>               
					<div id="commande-form" style="display: none;">
                        
						<div class="form-group">
							<div class="form-group">
								<label for="adresse_livraison">Adresse de livraison :</label>
								<input type="text" name="adresse_livraison" id="adresse_livraison" class="form-control">
							</div>
							<div class="form-group">
								<label for="date_livraison">Date de livraison :</label>
								<input type="date" name="date_livraison" id="date_livraison" class="form-control">
							</div>
							<div class="form-group">
								<label for="prix_livraison">Prix de livraison :</label>
								<input type="number" name="prix_livraison" id="prix_livraison" class="form-control" value="{{ session('delivery_charge') }}">
							</div>     
							<button type="button" id="prev-button" class="btn btn-secondary">Précédent</button>
							<button type="submit" class="btn btn-primary">Valider</button>              
						 </form>
                   
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
.delete-button {
    position: absolute;
    bottom: 10px; /* Adjust this value to control the vertical position */
    left: 775px; /* Adjust this value to control the horizontal position */
}
</style>
<script>
    // Variable JavaScript pour stocker le nom de la ville
    var selectedCity = "{{ session('selected_city') }}";

    // Fonction pour mettre à jour le nom de la ville
    function updateSelectedCity(cityName) {
        document.getElementById("selected_city").textContent = cityName;
    }

    // Mettez à jour le nom de la ville lorsque la page est chargée
    updateSelectedCity(selectedCity);

    // Fonction pour gérer le changement de sélection
    document.getElementById("delivery_charge").addEventListener("change", function() {
        var selectedValue = this.value;
        var cityName = "";

        // Associez la valeur à un nom de ville
        switch (selectedValue) {
            case "20":
                cityName = "Marrakech";
                break;
            case "30":
                cityName = "Casablanca";
                break;
            case "50":
                cityName = "Autres villes";
                break;
            default:
                cityName = "Inconnu";
        }

        // Mettez à jour le nom de la ville dans la variable JavaScript
        selectedCity = cityName;

        // Affichez le nom de la ville sur la page
        updateSelectedCity(cityName);

        // Mettez à jour la valeur du champ caché
        document.getElementById("selected_city_input").value = cityName;
    });
</script>
<script>
$(document).ready(function() {
    // Masquer la deuxième étape au chargement de la page
    $('#commande-form').hide();

    // Gérer le bouton "Suivant"
    $('#next-button').click(function() {
        $('#client-form').hide();
        $('#commande-form').show();
    });

    // Gérer le bouton "Précédent"
    $('#prev-button').click(function() {
        $('#commande-form').hide();
        $('#client-form').show();
    });
});
</script>

</body>
</html>

