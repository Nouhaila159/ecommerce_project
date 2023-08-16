<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
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
               <h1 class="fs-2">Produits En Stock</h1>
            </div>
            <div class="mb-3">
        <strong>Nombre de produits en stock :</strong> {{ $produits->count() }}
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
                   <th>Statut de publication</th>
                   <th>Quantité en stock</th>
                   <th>Detail</th>
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
                     <td>
                        <strong class="{{ $produit->statutP === 'non publié' ? 'text-danger' : 'text-success' }}">
                            {{ $produit->statutP }}
                        </strong>
                    </td>
                     <td><strong>{{ $produit->quantite_disponible }}</strong></td>
                     <td><a href="{{ url('/detailProduit', $produit->idP) }}" class="btn btn-sm btn-success py-1">Details</a></td>
                   
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
         <!-- Pagination ends -->
         </div>
         <!-- Products Content ends -->
      </div>
   </div>
   <!-- Products Body ends -->

 @include('partials.footer')

   <!-- bootstrap Js  -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>