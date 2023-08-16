<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une commande</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Modifier une commande</div>
                <div class="card-body">
                    <form action="{{ route('updateVente', ['id' => $commande->idCommande]) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Utilisation de la méthode PUT pour la mise à jour -->

                        <div class="mb-3">
                            <label for="client_name" class="form-label">Nom du client</label>
                            <input type="text" class="form-control" id="client_name" name="nomC" value="{{ $commande['client']->nomC }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Prénom du client</label>
                            <input type="text" class="form-control" id="prenomC" name="prenomC" value="{{ $commande['client']->prenomC }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Adresse du client</label>
                            <input type="text" class="form-control" id="adresseC" name="adresseC" value="{{ $commande['client']->adresseC }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Téléphone du client</label>
                            <input type="text" class="form-control" id="telC" name="telC" value="{{ $commande['client']->telC }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Ville du client</label>
                            <input type="text" class="form-control" id="villeC" name="villeC" value="{{ $commande['client']->villeC }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Email du client</label>
                            <input type="text" class="form-control" id="emailC" name="emailC" value="{{ $commande['client']->emailC }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_commande" class="form-label">Date de la commande</label>
                            <input type="date" class="form-control" id="date_commande" name="date_commande" value="{{ $commande->date_commande }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_livraison" class="form-label">Date de livraison</label>
                            <input type="date" class="form-control" id="date_livraison" name="date_livraison" value="{{ $commande->date_livraison }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse_livraison" class="form-label">Adresse de livraison</label>
                            <input type="text" class="form-control" id="adresse_livraison" name="adresse_livraison" value="{{ $commande->adresse_livraison }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="prix_livraison" class="form-label">Prix de livraison</label>
                            <input type="number" class="form-control" id="prix_livraison" name="prix_livraison" value="{{ $commande->prix_livraison }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="prix_livraison" class="form-label">Origine</label>
                            <select class="form-select" id="origine" name="origine" required>
                                <option value="magazin" {{ $commande->origine === 'magazin' ? 'selected' : '' }}>Magazin</option>
                                <option value="siteWeb" {{ $commande->origine === 'siteWeb' ? 'selected' : '' }}>SiteWeb</option>
                            </select>
                        </div>
                        <!-- Ajoutez d'autres champs ici -->

                        <button type="submit" class="btn btn-primary">Modifier la commande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
