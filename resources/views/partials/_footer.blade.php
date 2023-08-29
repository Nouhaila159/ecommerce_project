<?php
// Supposons que vous avez déjà établi une connexion à la base de données

// 1. Récupérer les données de la table info_site
$infoSite = DB::table('info_site')->first(); // Vous pouvez ajuster la requête selon vos besoins

// Maintenant vous avez les données extraites
$logoUrl = $infoSite->urlPhotoS; // URL du logo depuis la base de données
$telNumber = $infoSite->teleS; // Numéro de téléphone depuis la base de données
$gmailAddress = $infoSite->emailS; // Adresse email depuis la base de données
$descriptionS= $infoSite->descriptionS; 
$AdresseS= $infoSite->adesseS; 
?>

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
						<img src="{{ asset('storage/' . $logoUrl) }}" style="width: 200px; height: 200px;" />
						<p><?php echo $descriptionS; ?></p>
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
						<div class="heading"><h4>My account</h4></div>
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
							<li><span class="glyphicon glyphicon-home"></span><?php echo $AdresseS; ?></li>
							<li><span class="glyphicon glyphicon-earphone"></span><?php echo "+212 ". $telNumber; ?></li>
							<li><span class="glyphicon glyphicon-envelope"></span><?php echo $gmailAddress; ?></li>
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
	