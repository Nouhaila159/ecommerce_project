<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Produits</title>
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
   <!------ Admin header ----- -->
   @include("layouts.app")
    <!-- Admin header ends -->

    <!-- Products Body  -->
   <div class="container-fluid">
      <div class="row ps-0" style="padding-left: 0 !important">
         <!------ Side Bar  ------->
         @include('partials.sidebar')
         <!-- Side Bar ends -->

         <!------- Products Content  ------>
         <div class="col-10 px-4 mt-3 product-content-container">
            <!-- Products body heading -->
            <div class="d-flex justify-content-between align-items-center mb-2">
               <h1 class="fs-2">Products</h1>
               <a href="#" class="btn btn-sm fs-6 px-3 fw-bold rounded-pill text-white common-btn" data-bs-toggle="modal" data-bs-target="#addnew-product-modal">Add New</a>
            </div>
            
            <!-- Products Table  -->
            <table class="table table-bordered table-striped table-hover">
               <thead>
                 <tr>
                   <th>ID</th>
                   <th>Produit</th>
                   <th>Description</th>
                   <th>Marque</th>
                   <th>Matériel</th>
                   <th>Ctégorie</th>
                   <th>Prix</th>
                   <th>Réduction</th>
                   <th>Detail</th>
                   <th>Statut</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
               @foreach($produits as $produit)
                  <tr>
    
                     <td>{{ $produit->idP }}</td>
                     <td>{{ $produit->nomP }}</td>
                     <td>{{ $produit->descriptionP }}</td>
                     <td>{{ $produit->marque->marque }}</td>
                     <td>{{ $produit->materiel->materiel  }}</td>
                     <td>{{ $produit->categorie->categorie }}</td>
                     <td>{{ $produit->prixP }} MAD</td>
                     <td>{{ $produit->reductionP }} %</td>
                     <td><a href="{{ url('/detailProduit', $produit->idP) }}" class="btn btn-sm btn-success py-1">Details</a></td>
                     <td>
                        <button  id="statutBtn{{ $produit->idP }}" 
                                class="btn {{ $produit->statutP === 'non publié' ? 'btn-danger' : 'btn-success' }}"
                                onclick="changerStatut({{ $produit->idP }})">
                            {{ $produit->statutP }}
                        </button>
                    </td>

                     <td class="d-flex justify-content-around"> 
                     <form method="POST" action="{{ route('produits.destroy', $produit->idP) }}">
                @csrf
                @method('DELETE')
                <a href="{{ url('/updateProduit', $produit->idP) }}" class="btn btn-primary">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
               <button type="submit" class="btn btn-danger btn-dm">
                <i class="fa-regular fa-trash-can"></i> 
               </button>
             </form> 
                     </td>
                   
                  </tr>
                  @endforeach
               </tbody>
             </table>

         <!-- Pagination  -->
 <div class="mt-5">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($produits->currentPage() > 1)
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $produits->url(1) }}" aria-label="Previous">
                    Previous
                </a>
            </li>
        @endif

        {{-- Page Number Links --}}
        @for ($i = 1; $i <= $produits->lastPage(); $i++)
            <li class="page-item {{ $i === $produits->currentPage() ? 'active' : '' }}">
                <a class="page-link text-white fw-bold" href="{{ $produits->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($produits->hasMorePages())
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $produits->url($produits->currentPage() + 1) }}" aria-label="Next">
                    Next
                </a>
            </li>
        @endif
    </ul>
</div>

             
        
        

         <!-- Products Content ends -->
      </div>
   </div>
   <!-- Products Body ends -->

   <!------ addnew-product-modal ------>
   <div class="modal modal-xl fade" id="addnew-product-modal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Product</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
             <!-- form -->
            <form action="{{route('produits.store')}}" method="POST">
               @csrf
               <!-- row -->
               <div class="row">
                  <!-- col left  -->
                  <div class="col-9">
                     <!-- Product Title -->
                     <div class="mb-3 mt-3">
                        <label for="product-title" class="form-label fw-bold">Nom de produit</label>
                        <input autocomplete="off" type="text" class="form-control" id="product-title" placeholder="Nom de produit" name="NomP" required>
                     </div>
                     <!-- Product Category, SubCategory & Brand -->
                     <div class="mb-3 row">
                        <!--  Product Category -->
                        <div class="col-4 d-flex flex-column">
                           <label for="product-category" class="form-label fw-bold">Catégorie</label>
                           <select name="product_category" id="product-category" class="form-select" required>
                              <option disabled>catégorie de produit</option>
                              @foreach($categories as $categorie)
                                 <option value="{{ $categorie->idCategorie}}">{{ $categorie->categorie }}</option>
                              @endforeach
                                 </select>
                        </div>
                        <!--  Product Sub-Category -->
                        <div class="col-4 d-flex flex-column">
                           <label for="product-materiel" class="form-label fw-bold">Matière premiere</label>
                           <select name="product_materiel" id="product-materiel" class="form-select" required>
                              <option disabled>Matière premiere de produit</option>
                              @foreach($materiels as $materiel)
                                 <option value="{{ $materiel->idMateriel}}">{{ $materiel->materiel }}</option>
                              @endforeach
                                 </select>
                        </div>
                        <!--  Product Brand -->
                        <div class="col-4 d-flex flex-column">
                           <label for="product-brand" class="form-label fw-bold">Marque</label>
                           <select name="product_brand" id="product-brand" class="form-select" required>
                              <option disabled>Marque de produit</option>
                              @foreach($marques as $marque)
                                 <option value="{{ $marque->idMarque }}">{{ $marque->marque }}</option>
                              @endforeach
                                 </select>

                        </div>
                        <!--  Product Description -->
                        <div class="col-12 mt-3 d-flex flex-column">
                           <label for="product-description" class="form-label fw-bold">Description</label>
                           <textarea class="p-3" name="product-description" id="description" cols="20" rows="10" required></textarea>
                        </div>
                     </div>
   
                  </div>
                  <!-- col right  -->
                  <div class="col-3">
                     <!-- Product Price  -->
                     <div class="mb-3 d-flex flex-column">
                        <label for="product-price" class="form-label fw-bold">Prix</label>
                        <input type="number" class="form-control" id="product-price" name="product_price" required>
                     </div>
                     <div class="mb-3 d-flex flex-column">
                        <label for="product-reduction" class="form-label fw-bold">Réduction</label>
                        <input type="number" class="form-control" id="product-reduction" name="product_reduction" required>
                     </div>
                     <!-- submit btn  -->
                     <input class="btn btn-sm rounded px-5 mt-3 fs-6 fw-bold text-white common-btn" type="submit" name="add-product-submitbtn" value="Ajouter" id="add-product-submitbtn">
                  </div>
               </div>
               <!-- form ends  -->
            </form>
         </div>
      </div>
   </div>
   </div>
   <!-- addnew-product-modal ends-->

 @include('partials.footer')

 <script>
      function changerStatut(idP) {
          var bouton = document.getElementById("statutBtn" + idP);
          var confirmation = confirm("Confirmez-vous que vous avez publié ce produit dans le site?");
          
          if (confirmation) {
              fetch("/produits/" + idP + "/update-statut", {
                  method: 'PUT',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                      'Content-Type': 'application/json'
                  }
              })
              .then(response => response.json())
              .then(data => {
                  bouton.textContent = "publié";
                  bouton.classList.remove('btn-danger');
                  bouton.classList.add('btn-success');
                  bouton.disabled = true;
                  alert(data.message);
              })
              .catch(error => {
                  console.error('Erreur lors de la mise à jour du statut', error);
              });
          }
      }
  </script>

   <!-- bootstrap Js  -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>