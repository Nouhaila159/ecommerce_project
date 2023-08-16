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
                        <h1 class="text-center mb-4">Ajouter une référence</h1>
                        <form action="{{ route('ajouter_reference') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="idProduit" value="{{ $id }}">
                            <div class="row mb-5">
                                <div class="col-md-3">
                                    <label for="reference" class="form-label">Référence</label>
                                    <input type="text" name="reference" id="reference" class="form-control" placeholder="Référence" required>
                                    <div id="reference-error" class="text-danger"></div> <!-- Élément pour afficher le message d'erreur -->
                                </div>
                                <div class="col-md-2">
                                    <label for="couleur" class="form-label">Couleur</label>
                                    <input type="color" name="couleur" id="couleur" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-md-2">
                                    <img id="image-preview" src="" alt="Preview Image" class="mt-2" style="max-height: 100px;">
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tailles et Quantités</label>
                                <div id="taille-quantite-container">
                                    <div class="row taille-quantite-row mb-3">
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
                                                <!-- Ajoutez d'autres options de taille ici -->
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" name="quantites[]" class="form-control" placeholder="Quantité" required>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-btn" onclick="removeTailleQuantiteRow(this)">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addTailleQuantiteRow()">Ajouter une ligne</button>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter référence</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
    url: $(this).attr('action'),
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    async: true, // Assurez-vous que la requête est asynchrone
    success: function (response) {
        alert('Référence ajoutée avec succès.');
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

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        var preview = document.getElementById('image-preview');
        var selectedImage = event.target.files[0];
        if (selectedImage) {
            preview.src = URL.createObjectURL(selectedImage);
        } else {
            preview.src = ''; // Clear the preview when no image is selected
        }
    });
</script>

</body>
</html>
