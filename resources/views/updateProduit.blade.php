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
         <div class="col-md-6">
            <div class="card">
                
               <div class="card-body">
                <h1 class="card-title fs-2 mb-4 mt-4 text-center">Modifier Produit</h1>
                @if($errors->has('produit'))
                <div class="alert alert-danger">
                    {{ $errors->first('produit') }}
                </div>
                @endif
                 <!-- form -->
                 <form action="{{ route('produits.update', $produit->idP) }}" method="POST">
               @csrf
               @method('PUT')
   
               <!-- row -->
               <div class="row">
                  <!-- col left  -->
                  <div class="col-9">
                     <!-- Product Title -->
                     <div class="mb-3 mt-3">
                        <label for="product-title" class="form-label fw-bold">Nom de produit</label>
                        <input autocomplete="off" type="text" class="form-control" id="product-title" placeholder="Nom de produit" name="NomP" value="{{ $produit->nomP }}" required>
                     </div>
                     <!-- Product Category, SubCategory & Brand -->
                     <div class="mb-3 row">
                        <!--  Product Category -->
                        <div class="col-4 d-flex flex-column">
                           <label for="product-category" class="form-label fw-bold">Ctégorie</label>
                           <select name="product_category" id="product-category" class="form-select" required>
                              <option disabled>catégorie de produit</option>
                              @foreach($categories as $categorie)
                              <option value="{{ $categorie->idCategorie }}" @if($categorie->idCategorie === $produit->idCategorie) selected @endif>{{ $categorie->categorie }}</option>
                           @endforeach
                        </select>
                        </div>
                        <!--  Product Sub-Category -->
                        <div class="col-4 d-flex flex-column">
                           <label for="product-materiel" class="form-label fw-bold">Matériel</label>
                           <select name="product_materiel" id="product-materiel" class="form-select" required>
                              <option disabled>Matière première de produit</option>
                              @foreach($materiels as $materiel)
                              <option value="{{ $materiel->idMateriel }}" @if($materiel->idMateriel === $produit->idMateriel) selected @endif>{{ $materiel->materiel }}</option>
                           @endforeach
                        </select>
                        </div>
                        <!--  Product Brand -->
                        <div class="col-4 d-flex flex-column">
                           <label for="product-brand" class="form-label fw-bold">Marque</label>
                           <select name="product_brand" id="product-brand" class="form-select" required>
    <option disabled>Marque de produit</option>
    @foreach($marques as $marque)
        <option value="{{ $marque->idMarque }}" @if($marque->idMarque === $produit->idMarque) selected @endif>{{ $marque->marque }}</option>
    @endforeach
</select>

                        </div>
                        <!--  Product Description -->
                        <div class="col-12 mt-3 d-flex flex-column">
                           <label for="product-description" class="form-label fw-bold">Description</label>
                           <textarea class="p-3" name="product-description" id="description" cols="20" rows="10" required>{{ $produit->descriptionP }}</textarea>
                        </div>
                     </div>
   
                  </div>
                  <!-- col right  -->
                  <div class="col-3">
                     <!-- Product Price  -->
                     <div class="mb-3 d-flex flex-column">
                        <label for="product-price" class="form-label fw-bold">Prix</label>
                        <input type="number" class="form-control" id="product-price" name="product_price" value="{{ $produit->prixP }}" required>
                     </div>

                     <div class="mb-3 d-flex flex-column">
                        <label for="product-reduction" class="form-label fw-bold">Réduction</label>
                        <input type="number" class="form-control" id="product-reduction" name="product_reduction" value="{{ $produit->reductionP }}" required>
                     </div>
                     <!-- submit btn  -->
                     <input type="submit" name="add-product-submitbtn" value="Modifier" id="add-product-submitbtn" class="btn btn-primary rounded">
                     
                     <div>
                     <a href="/produit" class="btn rounded mt-3 fs-6 fw-bold text-white common-btn btn-danger">Liste des produits</a>

                  </div>
               </div>
               <!-- form ends  -->
            </form>
               </div>
            </div>
         </div>
      </div>
   </div>


   <!-- bootstrap Js  -->
   <!-- Custom Javascript  -->
   <!-- Scripts -->
</body>
</html>
