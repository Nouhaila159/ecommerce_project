<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Marques</title>
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
        <!-- Fontawesome Icons  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <!-- Custom Css  -->
        <link rel="stylesheet" href="./css/style.css">
        <!-- bootstrap Css  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    </head>
<body>
    @include("layouts.app") <!-- En-tête de l'administrateur -->

    <div class="container-fluid">
    <div class="row justify-content-center min-vh-100">
    <div class="col-md-10">
                <h1 class="card-title fs-2 mb-4 mt-4 text-center">Détails du produit</h1>
            <!-- Tableau avec les détails des produits -->
            <div class="card mt-4">
            <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('reference.index', ['id' => $produit->idP]) }}" class="btn btn-success">Ajouter</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID du produit</th>
                    <th>Réference</th>
                    <th>Couleur</th>
                    <th>Image</th>
                    <th>tailles disponibles</th>
                    <th>Quantité en Stock</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($references as $reference)
        <tr>
            <td>{{ $reference->idP }}</td>
            <td>{{ $reference->referenceP }}</td>
            <td class=" text-center">
            <div style="width: 20px; height: 20px; background-color: {{ $reference->couleur }}; margin: 0 auto;"></div>
            <span>{{ $reference->couleur }}</span>
            </td>

            <td>
                <img height="100px" width="100px" src="{{ asset('storage/' . $reference->urlPhoto) }}" alt="Image de référence">
            </td>
            <td>
                @foreach ($tailles[$reference->idR] as $taille)
                    {{ $taille->taille }} ({{ $taille->quantiteT }}) <br>
                @endforeach
            </td>
            <td>{{ $reference->quantiteR }}</td>
            <td>
            <a href="{{ route('reference.edit', ['idR' => $reference->idR, 'idP' => $reference->idP]) }}" class="btn btn-sm btn-primary">Modifier</a>
            <a href="#" class="btn btn-sm btn-danger btn-delete" data-reference-id="{{ $reference->idR }}">Supprimer</a>
            </td>
        </tr>
    @endforeach
</tbody>
                </table>
                <!-- Affichage de la quantité totale du produit -->
<div class="text-end">
    <p class="fw-bold">Quantité totale du produit : {{ $totalQuantiteProduit }}</p>
</div>
                <div class="d-flex justify-content-right">
                        <a href="/produit" class="btn btn-danger">Liste des produits</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<!-- bootstrap Js  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom Javascript  -->
<!-- Scripts -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".btn-delete");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();

                const referenceId = this.getAttribute("data-reference-id");
                const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cette référence ?");

                if (confirmation) {
                    fetch(`/supprimer-reference/${referenceId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message); // Afficher le message
                            window.location.href = '{{ route("produits.detail", ["id" => $produit->idP]) }}'; // Rediriger l'utilisateur
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


</body>
</html>
