<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réference</title>
    <!-- Liens vers les styles CSS (assurez-vous d'inclure vos propres liens ici) -->
</head>
<body>
    <header>
        @include("layouts.app") <!-- En-tête de l'administrateur -->
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Ajouter un produit à la commande</h1>
                        <form action="{{ route('venteDetail.add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="idVente" value="{{ $id }}">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label class="form-label">Référence</label>
                                    <select name="reference" id="reference" class="form-select" placeholder="Référence" required>
                                        <option disabled>catégorie de produit</option>
                                        <option type="hidden" style="color:grey">reference000</option>
                                        @foreach($references as $reference)
                                            <option value="{{ $reference->idR }}">{{ $reference->referenceP }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <img id="image-preview" src="" alt="Image de référence" style="max-height: 100px;">
                                </div>
                            </div>
                        
                            <div class="row taille-quantite-row mb-3">
                            <div class="col-md-4">
                                    <label class="form-label">Taille</label>
                                    <select name="taille" id="taille" class="form-select" required>
                                        <option value="" selected disabled>Choisir une taille</option>
                                        <!-- Les options de taille seront ajoutées ici dynamiquement -->
                                    </select>
                                </div>
                                        <div class="col-md-4">
                                        <label class="form-label">Quantité</label>
                                            <input type="number" name="quantite" class="form-control" placeholder="Quantité" required>
                                            <p id="max-quantity-info" class="text-muted">Quantité maximale : <span id="max-quantity">0</span></p>

                                        </div>
                                    </div>
                            <button type="submit" class="btn btn-success">Ajouter à la commande</button>
                        </form>
                        <div class="d-flex justify-content-center">
                        <a href="{{ route('vente.detail', ['id' => $id]) }}" class="btn btn-danger">Annuler</a>
                     </div>
                     @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
$(document).ready(function () {
    $("#taille").change(function () {
        var selectedValue = $(this).val();

        // Faire une requête Ajax pour obtenir la quantité maximale pour la taille sélectionnée
        $.ajax({
            url: "/get-max-quantity/" + selectedValue,
            method: "GET",
            success: function (response) {
                var maxQuantitySpan = $("#max-quantity");
                maxQuantitySpan.text(response.maxQuantity); // Mettez à jour la quantité maximale affichée
            },
            error: function (error) {
                console.log("Erreur lors de la récupération de la quantité maximale : ", error);
            }
        });
    });
});
</script>
<script>
    $(document).ready(function () {
        $("#reference").change(function () {
            var selectedValue = $(this).val();

            $.ajax({
                url: "/get-reference-image/" + selectedValue,
                method: "GET",
                success: function (response) {
                    // Utilisez asset pour générer l'URL correcte
                    var imageUrl = '{{ asset('storage') }}/' + response.urlPhoto;
                    $("#image-preview").attr("src", imageUrl);
                },
                error: function (error) {
                    console.log("Erreur lors de la récupération de l'image : ", error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#reference").change(function () {
            var selectedValue = $(this).val();

            // Faire une requête Ajax pour obtenir les tailles disponibles pour la référence sélectionnée
            $.ajax({
                url: "/get-reference-sizes/" + selectedValue,
                method: "GET",
                success: function (response) {
                    var tailleSelect = $("#taille"); // Sélectionnez le menu déroulant des tailles
                    tailleSelect.empty(); // Supprimez toutes les options existantes

                    // Ajoutez les nouvelles options de taille
                    $.each(response.sizes, function (index, size) {
                        tailleSelect.append($('<option>', {
                            value: size.idT,
                            text: size.taille
                        }));
                    });
                },
                error: function (error) {
                    console.log("Erreur lors de la récupération des tailles : ", error);
                }
            });
        });
    });
</script>
</body>
</html>
