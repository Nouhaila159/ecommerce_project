
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
        </li> </ul>
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
				@if (!empty($commandes))
					<h1>Historique des commandes de {{ Auth::user()->name }}</h1>
	
					@foreach ($commandes as $commande)
				@php
				$cnt++;
			@endphp
			
			<p>Commande : {{ $cnt }}</p>
			 
					<p>Date de commande : {{ $commande->date_commande }}</p>
					<p>Nom du client : {{ $commande->client->nomC }} {{ $commande->client->prenomC }}</p>
					<p>Date de livraison : {{ $commande->date_livraison }}</p>
					<p>Prix de livraison  : {{ $commande->prix_livraison }}</p>
					<p>l'état du commande  : {{ $commande->validation }}</p>


					<!-- Affichez d'autres informations de la commande ici -->
	
					<h3>Lignes de commande :</h3>
					@if (isset($lignesCommande[$commande->idCommande]))
                <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID de la ligne</th>
                <th>Référence</th>
                <th>Quantité</th>
				<th>Taille</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($lignesCommande[$commande->idCommande] as $ligne)
                <tr>
                    <td>{{ $ligne->idLigneC }}</td>
					<td>
						@php
							$reference = App\Models\Reference::find($ligne->idR);
							if ($reference) {
								echo '<img src="' . asset('storage/' . $reference->urlPhoto) . '" alt="Product Image" style="width: 75px;"/>';
							}
						@endphp
					</td>
					 <td>{{ $ligne->quantite }}</td>
					
				
					<td>
						@php
							$taille = App\Models\Tailles::find($ligne->idT);
							if ($taille) {
								echo $taille->taille;
							}
						@endphp
					</td>
					

                    <!-- Affichez d'autres informations de la ligne de commande ici -->
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Aucune ligne de commande pour cette commande.</p>
@endif

				@endforeach
				@else
					<p>Aucun historique de commande pour vous.</p>
				@endif
			</div>
		</div>
	</div>
	
	

	<!-- Popup Modal -->
<!-- Code HTML du formulaire modal -->


<script>
	function logout() {
		// Envoie de la requête de déconnexion au serveur
		document.getElementById('logout-form').submit();
	}
	</script>

</body>
</html>


