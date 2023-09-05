<?php
// Supposons que vous avez déjà établi une connexion à la base de données

// 1. Récupérer les données de la table info_site
$infoSite = DB::table('info_site')->first(); // Vous pouvez ajuster la requête selon vos besoins

// Maintenant vous avez les données extraites
$logoUrl = $infoSite->urlPhotoS; // URL du logo depuis la base de données
$telNumber = $infoSite->teleS; // Numéro de téléphone depuis la base de données
$gmailAddress = $infoSite->emailS; // Adresse email depuis la base de données
?>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="logo"><img src="{{ asset('storage/' . $logoUrl) }}" style="width: 100px; height: 100px;"/></div>
            </div>
            <div class="col-md-6 text-right">
                <div class="phone"><span class="glyphicon glyphicon-earphone"></span><?php echo "+212 ". $telNumber; ?></div>
                <div class="mail"><span class="glyphicon glyphicon-envelope"></span><?php echo $gmailAddress; ?></div>
                <form class="form-search">
                    <input type="text" class="input-medium search-query">
                    <button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
            <div id="cart"><a class="btn btn-cart" href="summary"><span class="glyphicon glyphicon-shopping-cart">
            </span>Mon Panier<strong>{{ $paniersCount ?? '0' }}</strong></a></div>

        </div>
    </div>
</header>

