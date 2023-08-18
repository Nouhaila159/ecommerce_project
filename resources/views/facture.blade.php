<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.jpeg') }}">
    <title>Facture</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .facture {
            width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .entete {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
        }
        .informations {
            
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .details-produits {
            width: 100%;
            border-collapse: collapse;
        }
        .details-produits th, .details-produits td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="facture">
            <div class="entete">
                <h1>Facture :</h1>
            </div>
            <div class="text-center">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="informations">
                        <h4>Informations de la Commande:</h4>
                        <hr>
                        <p><strong>ID de commande:</strong> {{ $commande->idCommande }}</p>
                        <p><strong>Date de commande:</strong> {{ $commande->date_commande }}</p>
                        <p><strong>Date de livraison:</strong> {{ $commande->date_livraison }}</p>
                        <p><strong>Adresse de livraison:</strong> {{ $commande->adresse_livraison }}</p>
                        <p><strong>Prix de livraison:</strong> {{ $commande->prix_livraison }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="informations">
                        <h4>Informations du Client:</h4>
                        <hr>
                        <p><strong>Client:</strong> {{ $client->nomC }} {{ $client->prenomC }} </p>
                        <p><strong>Adresse:</strong> {{ $client->adresseC }}, {{ $client->villeC }} </p>
                        <p><strong>Email:</strong> {{ $client->emailC }}</p>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <!-- Afficher les informations du client ici -->
                        <!-- Afficher les informations de la commande ici -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Taille</th>
                                    <th>Couleur</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits as $produit)
                                <tr>
                                    <td>{{ $produit['reference'] }}</td>
                                    <td>{{ $produit['prix_unitaire'] }}</td>
                                    <td>{{ $produit['quantite'] }}</td>
                                    <td>{{ $produit['tailleL'] }}</td>
                                    <td>{{ $produit['couleur'] }}</td>
                                    <td><img height="100px" width="100px" src="{{ asset('storage/' . $produit['image']) }}" alt="Image de référence"></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            <p><strong>Total produits:</strong> {{ $totalProduits }} </p>
                            <p><strong>Prix total:</strong> {{ $prixTotal+$commande->prix_livraison }} MAD</p>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('telechargerFactureV', $idCommande) }}" class="btn btn-primary" download>Télécharger la facture</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
