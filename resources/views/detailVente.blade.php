<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Commande</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
    <!-- Fontawesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

    
</head>
<body>
    <!-- Include the administrator header -->
    @include("layouts.app")

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title fs-3 mb-4 text-center">Détails de Produit de magazin</h1>
    <div class="mb-3">
        <input type="text" class="form-control"  value="Numéro de commande :{{ $idCommande }}" readonly>
    </div>

                        
<div class="mb-3">
    <input type="text" class="form-control" id="productCount" value="Total des produits:{{ $totalProduits }} " readonly>
</div>

<div class="d-flex justify-content-end mb-2">
            <a href="{{ route('venteDetail.index', ['id' => $commandes->idCommande]) }}" class="btn btn-success">Ajouter</a>
 </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Référence du produit</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité</th>
                                    <th>Taille</th>
                                    <th>Couleur</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produits as $produit)
                                <tr>
                                    <td>{{ $produit['reference'] }}</td>
                                    <td>{{ $produit['prix_unitaire'] }}</td>
                                    <td>{{ $produit['quantite'] }}</td>
                                    <td>{{ $produit['tailleL'] }}</td>
                                    <td>
                                    <div style="width: 20px; height: 20px; background-color: {{ $produit['couleur'] }}; margin: 0 auto;"></div>
                                    <span>   {{ $produit['couleur'] }} </span>
                                    </td>
                                    <td><img height="100px" width="100px" src="{{ asset('storage/' . $produit['image']) }}" alt="Image de référence"></td>
                                    <td>
            <a href="" class="btn btn-sm btn-primary">Modifier</a>
            <a href="#" class="btn btn-sm btn-danger btn-delete" data-Ligne-id="{{ $produit['idLigne'] }}">Supprimer</a>
            </td>
                                </tr>
                                    @endforeach

                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <div class="total-price">
                                <p>Prix total:</p>
                                <span class="price-value">{{ number_format($prixTotal, 2) }} MAD</span>
                            </div>                            
                            <a href="/vente" class="btn btn-primary mx-2 ml-auto">Liste des ventes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".btn-delete");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();

                const ligneId = this.getAttribute("data-Ligne-id");
                const confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce detail ?");

                if (confirmation) {
                    fetch(`/supprimerLigneCommande/${ligneId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message); // Afficher le message
                            window.location.href = '{{ route('vente.detail', ['id' => $commandes->idCommande]) }}';
                             // Rediriger l'utilisateur
                        } else {
                            alert('Erreur lors de la suppression.'); // Gérer les erreurs
                        }
                    })
                    .catch(error => {
                        alert('Une erreur s\'est produite.'); // Gérer les erreurs
                    });
                }
            });
        });
    });
</script>
    <!-- Custom Javascript -->
</body>
</html>
