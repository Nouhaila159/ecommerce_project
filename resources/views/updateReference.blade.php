
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
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
                        <h1 class="text-center mb-4">Modifier la réference</h1>
                        <form action="{{ route('reference.update', ['id' => $reference->idR]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="idProduit" value="{{ $id }}">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="reference" class="form-label">Référence</label>
                                    <input type="text" name="reference" id="reference" class="form-control" placeholder="Référence" value="{{ $reference->referenceP }}" required>
                                    <div id="reference-error" class="text-danger"></div> <!-- Élément pour afficher le message d'erreur -->
                                </div>
                                <div class="col-md-2">
                                    <label for="couleur" class="form-label">Couleur</label>
                                    <input type="color" name="couleur" id="couleur" class="form-control" value="{{ $reference->couleur }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-2">
                                <img src="{{ asset('storage/' . $reference->urlPhoto) }}" alt="Current Image" class="mt-2" style="max-height: 100px; max-width: 100px;">
                            </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tailles et Quantités</label>
                                <div id="taille-quantite-container">
                                @foreach ($sizesAndQuantities as $sizeAndQuantity)
                                    <div class="row taille-quantite-row mb-2">
                                        <div class="col-md-4">
                                            <select name="tailles[]" class="form-select" required>
                                                <option value="" disabled>Choisir une taille</option>
                                                <option value="{{ $sizeAndQuantity->taille }}" selected>{{ $sizeAndQuantity->taille }}</option>
                                                <option value="XS">XS</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="XXL">XXL</option>
                                                <option value="XXXL">XXXL</option>
                                                <!-- Ajoutez d'autres options de taille ici -->
                                                </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" name="quantites[]" class="form-control" placeholder="Quantité" value="{{ $sizeAndQuantity->quantiteT }}" required>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-btn" onclick="removeTailleQuantiteRow(this)">Supprimer</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addTailleQuantiteRow()">Ajouter une ligne</button>
                            </div>
                            <button type="submit" class="btn btn-success">Modifier réference</button>
                        </form>
                        <div class="d-flex justify-content-center">
                        <a href="{{ route('produits.detail', ['id' => $id]) }}" class="btn btn-danger">Annuler</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript -->
    <script>
        function addTailleQuantiteRow() {
    var container = document.getElementById("taille-quantite-container");
    var newRow = document.createElement("div");
    newRow.className = "row taille-quantite-row mb-2";
    newRow.innerHTML = `
        <div class="col-md-4">
            <select name="tailles[]" class="form-select" required>
                <option value="" selected disabled>Choisir une taille</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="XXXL">XXXL</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" name="quantites[]" class="form-control" placeholder="Quantité" required>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-btn" onclick="removeTailleQuantiteRow(this)">Supprimer</button>
        </div>
    `;
    container.appendChild(newRow);
}


        function removeTailleQuantiteRow(button) {
            var row = button.parentNode.parentNode;
            row.remove();
        }
    </script>

<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST', // Change back to POST
                data: formData,
                processData: false,
                contentType: false,
                async: true,
                success: function (response) {
                   // Mettre à jour les quantités dans le tableau sizesAndQuantities
                    var sizesAndQuantities = response.sizesAndQuantities;
                    sizesAndQuantities.forEach(function (item) {
                        var size = item.taille;
                        var quantity = item.quantiteT;
                        
                        // Trouver le select correspondant à la taille
                        var select = $('[name="tailles[]"]').filter(function() {
                            return $(this).val() === size;
                        });
                        // Mettre à jour la quantité associée
                        select.closest('.taille-quantite-row').find('input[name="quantites[]"]').val(quantity);
                    });
 
                    alert('Référence modifiée avec succès.');
                    window.location.href = "{{ route('produits.detail', ['id' => $id]) }}";
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.reference) {
                        $('#reference-error').text(xhr.responseJSON.errors.reference[0]);
                    }
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
