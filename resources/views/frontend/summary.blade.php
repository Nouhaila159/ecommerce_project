
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
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
	
	 <li><a href="{{ route('contact') }}"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
            @if(Auth::check() && Auth::user()->roleId === 1)
            <li><a href="{{ route('home.index') }}"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
            @endif

            <li>	<div aria-labelledby="navbarDropdown">
            
            @if(Auth::check()) <!-- Vérifie si l'utilisateur est connecté -->
            <a class="dropdown-item" href="#" onclick="logout();"><span class="glyphicon glyphicon-log-out"> {{ __('Logout') }}</a>
			@else
            <a class="dropdown-item" href="#" onclick="logout();"><span class="glyphicon glyphicon-log-in"> Login</a>
			@endif
                <!-- Le champ bouton submit pour le formulaire de déconnexion -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
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
					
					<li><a href="{{ route('historique') }}">Mon Historique</a></li>


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
									@foreach ($livraison as $city)
										<option value="{{ $city->prix }}">{{ $city->livraison }} ({{ $city->prix }})</option>
									@endforeach
								</select>
								<!-- Champ caché pour stocker le nom de la ville -->
								<input type="hidden" id="selected_city" name="selected_city" value="">
								<!-- Champ caché pour stocker le prix de livraison -->
								<input type="hidden" id="delivery-price" name="delivery-price" value="">
								<button type="submit" class="btn btn-primary">valider</button>
							</form>
							
							<div>
								<p id="displayed-delivery-price">Le prix de livraison : {{ session('delivery-charge') }} MAD</p>
								<p id="displayed-selected-city">Ville de livraison : {{ session('selected_city') }}</p>
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
						   
							<tr style="border-top: 1px solid #000">
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
						
						<center><a href="#" class="btn btn-1" data-toggle="modal" data-target="#checkoutModal" id="checkout-button">Checkout</a></center>

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
								<input type="number" name="prix_livraison" id="prix_livraison" class="form-control" value="{{ session('delivery-charge') }}" readonly>
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
    const deliveryForm = document.getElementById('delivery-form');

    deliveryForm.addEventListener('submit', function(event) {
        // Récupérez la valeur sélectionnée dans le menu déroulant
        const selectedOption = document.getElementById('delivery_charge').options[document.getElementById('delivery_charge').selectedIndex];
        const selectedCity = selectedOption.textContent.split('(')[0].trim();
        const selectedPrice = selectedOption.value;

        // Mettez à jour les champs cachés avec la ville sélectionnée et le prix de livraison
        document.getElementById('selected_city').value = selectedCity;
        document.getElementById('delivery-price').value = selectedPrice;
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
<script>
    function logout() {
        // Envoie de la requête de déconnexion au serveur
        document.getElementById('logout-form').submit();
    }
    </script>

</body>
</html>

