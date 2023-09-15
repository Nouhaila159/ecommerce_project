<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une commande</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Ajouter une nouvelle commande</div>
                <div class="card-body">
                    <form action="{{ route('ajouterVente.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="search_client" class="form-label">Sélectionner un client existant</label>
                            <select class="form-select" id="search_client" name="search_client">
                                <option value="">Sélectionnez un client...</option>
                                <!-- Boucle pour afficher les options d'e-mails -->
                                @foreach ($clients as $client)
                                    <option value="{{ $client->emailC }}">{{ $client->emailC }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary mt-2" id="search_button">Rechercher</button>
                        </div>
                        
                        <!-- Champs pour les informations du client trouvé -->
                        <div id="search_results" style="display: none;">
                            <div class="mb-1">
                                <label class="form-label">Informations du client trouvé :</label>
                            </div>
                            <div class="mb-3">
                                <label for="nomC_found" class="form-label">Nom du client</label>
                                <input type="text" class="form-control" id="nomC_found" name="nomC" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="prenomC_found" class="form-label">Prénom du client</label>
                                <input type="text" class="form-control" id="prenomC_found" name="prenomC"readonly>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Adresse du client</label>
                                <input type="text" class="form-control" id="adresseC_found" name="adresseC" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Telephone du client</label>
                                <input type="number" class="form-control" id="telC_found" name="telC" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Ville du client</label>
                                <input type="text" class="form-control" id="villeC_found" name="villeC" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="client_name" class="form-label">Email du client</label>
                                <input type="email" class="form-control" id="emailC_found" name="emailC" readonly>
                            </div>                        
                        </div>
                        
                        <!-- Champs pour les informations du client à remplir manuellement -->
                        <div id="manual_entry">
                            <div class="mb-3">
                                <label class="form-label">Remplir manuellement :</label>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nom du client</label>
                                <input type="text" class="form-control" id="client_name" name="nomC" required>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Prenom du client</label>
                                <input type="text" class="form-control" id="prenomC" name="prenomC" required>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Adresse du client</label>
                                <input type="text" class="form-control" id="adresseC" name="adresseC" required>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Telephone du client</label>
                                <input type="number" class="form-control" id="telC" name="telC" required>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Ville du client</label>
                                <input type="text" class="form-control" id="villeC" name="villeC" required>
                            </div>
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Email du client</label>
                                <input type="email" class="form-control" id="emailC" name="emailC" required>
                            </div>  
                        </div>
                        <div class="mb-3">
                            <label for="date_commande" class="form-label">Date de la commande</label>
                            <input type="date" class="form-control" id="date_commande" name="date_commande" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_livraison" class="form-label">Date de livraison</label>
                            <input type="date" class="form-control" id="date_livraison" name="date_livraison" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse_livraison" class="form-label">Adresse de livraison</label>
                            <input type="text" class="form-control" id="adresse_livraison" name="adresse_livraison" required>
                        </div>
                        <div class="mb-3">
                            <label for="livraison" class="form-label">Ville de livraison</label>
                            <select id="livraison" name="livraison">
                                @foreach ($livraison as $liv)
                                    <option value="{{ $liv->livraison }}" data-prix="{{ $liv->prix }}">{{ $liv->livraison }} ({{ $liv->prix }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prix_livraison" class="form-label">Prix de livraison</label>
                            <input type="number" class="form-control" id="prix_livraison" name="prix_livraison" readonly>
                        </div>                     
                        <div class="mb-3">
                            <label for="prix_livraison" class="form-label">Origine</label>
                            <select class="form-select" id="origine" name="origine" required>
                                <option value="Magasin">Magasin</option>
                                <option value="SiteWeb">SiteWeb</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter la commande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchButton = document.getElementById("search_button");
        const searchResults = document.getElementById("search_results");
        const manualEntry = document.getElementById("manual_entry");
        const submitButton = document.querySelector("button[type='submit']");

        searchButton.addEventListener("click", function() {
            const searchTerm = document.getElementById("search_client").value;

            fetch(`/search-client?emailC=${searchTerm}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(clientData => {
                    if (clientData) {
                        searchResults.style.display = "block";
                        manualEntry.style.display = "none";
                        document.getElementById("nomC_found").value = clientData.nomC;
                        document.getElementById("prenomC_found").value = clientData.prenomC;
                        document.getElementById("emailC_found").value = clientData.emailC;
                        document.getElementById("telC_found").value = clientData.telC;
                        document.getElementById("villeC_found").value = clientData.villeC;
                        document.getElementById("adresseC_found").value = clientData.adresseC;
                        
                        // Désactiver les champs de saisie manuelle
                        document.getElementById("client_name").readOnly = true;
                        document.getElementById("prenomC").readOnly = true;
                        document.getElementById("adresseC").readOnly = true;
                        document.getElementById("telC").readOnly = true;
                        document.getElementById("villeC").readOnly = true;
                        document.getElementById("emailC").readOnly = true;
                        
                        // Activer le bouton de soumission
                        submitButton.disabled = false;
                    } else {
                        searchResults.style.display = "none";
                        manualEntry.style.display = "block";
                        
                        // Désactiver les champs de saisie automatique
                        document.getElementById("nomC_found").readOnly = true;
                        document.getElementById("prenomC_found").readOnly = true;
                        document.getElementById("adresseC_found").readOnly = true;
                        document.getElementById("telC_found").readOnly = true;
                        document.getElementById("villeC_found").readOnly = true;
                        document.getElementById("emailC_found").readOnly = true;
                        
                        // Activer le bouton de soumission
                        submitButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la recherche du client :", error);
                    searchResults.style.display = "none";
                    manualEntry.style.display = "block";
                });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Lorsque la sélection de la ville change
    $("#livraison").change(function () {
        var selectedPrice = $(this).find(":selected").data("prix");
        $("#prix_livraison").val(selectedPrice);
    });
});
</script>

<!-- Bootstrap JS (optional) -->

</body>
</html>
