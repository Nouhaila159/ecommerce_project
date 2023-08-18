<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catégories</title>
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
                <h1 class="card-title fs-2 mb-4 mt-4 text-center">Modifier Catégorie</h1>
                @if($errors->has('categorie'))
                <div class="alert alert-danger">
                    {{ $errors->first('categorie') }}
                </div>
                @endif
                <form action="/updateCategorie/traitement" method="POST" class="mt-2">
                     @csrf
                     <input type="hidden" name="idCategorie" value="{{ $categories->idCategorie }}">
                     <div class="mb-3">
                        <label for="categorie" class="form-label">Nom de la Catégorie</label>
                        <input type="text" class="form-control" id="categorie" name="categorie" value="{{ $categories->categorie }}">
                     </div>
                     <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">Modifier Catégorie</button>
                        <a href="/categorie" class="btn btn-danger">Liste des categories</a>
                     </div>
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
