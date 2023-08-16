<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
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

    <!-- Orders Body  -->
   <div class="container-fluid">
      <div class="row ps-0" style="padding-left: 0 !important">
         <!------ Side Bar  ------->
         @include('partials.sidebar')
         <!-- Side Bar ends -->

         <!------- Orders Content  ------>
         <div class="col-10 px-4 mt-3 product-content-container">
            <!-- Orders body heading title -->
               <h1 class="fs-2 mb-3">All Orders</h1>
            
            <!-- Orders Table  -->
            <table class="table table-bordered table-striped table-hover">
               <thead>
                   <tr>
                       <th>ORDER Numéro</th>
                       <th>Nom du client</th>
                       <th>Date de la commande</th>
                       <th>Date de livraison</th>
                       <th>Adresse de livraison</th>
                       <th>Prix de livraison</th>
                       <th>Statut de livraison</th>
                       <th>Statut</th>
                       <th>Détails commande</th>
                       <th>Facture</th>
                       <th>validation</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($commandes as $commande)
                   <tr>
                       <td>{{ $commande->idCommande }}</td>
                       <td>{{ $commande->client->nomC }} {{ $commande->client->prenomC }}
                        <br>Télé: +212{{ $commande->client->telC }}
                        <br>{{ $commande->client->adresseC }},{{ $commande->client->villeC }} </td>
                       <td>{{ $commande->date_commande }}</td>
                       <td>{{ $commande->date_livraison }}</td>
                       <td>{{ $commande->adresse_livraison }}</td>
                       <td>{{ $commande->prix_livraison }}</td>
                       <td><button  id="statutBtnL{{ $commande->idCommande }}" 
                        class="btn {{ $commande->statut_livraison === 'non livrée' ? 'btn-danger' : 'btn-success' }}"
                        onclick="changerStatutLivraison({{ $commande->idCommande }})">
                    {{ $commande->statut_livraison }}
                </button></td>
                       
                       <td>
                        <button  id="statutBtn{{ $commande->idCommande }}" 
                                class="btn {{ $commande->statut_commande === 'non traitée' ? 'btn-danger' : 'btn-success' }}"
                                onclick="changerStatut({{ $commande->idCommande }})">
                            {{ $commande->statut_commande }}
                        </button>
                    </td>
                     <td><a href="{{ url('/detailCommande', $commande->idCommande) }}" class="btn btn-dark">Details</a></td>
                     <td>
                        <a href="{{ url('/facture', $commande->idCommande) }}" class="btn btn-light" style="display: flex; align-items: center;">
                            <i class="fas fa-print" style="margin-right: 5px;"></i> <!-- Icône d'impression -->
                        </a>
                    </td>  
                    <form action="{{ route('updateValidation', $commande->idCommande) }}" method="POST">
                        @csrf
                        <td>
                            <select name="validation" id="validation" onchange="this.form.submit()">
                                <option value="annulé" style="background: red" @if ($commande->validation === 'annulé') selected @endif>Annulé</option>
                                <option value="en cours" style="background: yellow" @if ($commande->validation === 'en cours') selected @endif>En cours</option>
                                <option value="validé" style="background: green" @if ($commande->validation === 'validé') selected @endif>Validé</option>
                            </select>
                        </td>
                    </form>
                        
                   </tr>

                   

                   @endforeach
               </tbody>
           </table>

                    <!-- Pagination  -->
 <div class="mt-5">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($commandes->currentPage() > 1)
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $commandes->url(1) }}" aria-label="Previous">
                    Previous
                </a>
            </li>
        @endif

        {{-- Page Number Links --}}
        @for ($i = 1; $i <= $commandes->lastPage(); $i++)
            <li class="page-item {{ $i === $commandes->currentPage() ? 'active' : '' }}">
                <a class="page-link text-white fw-bold" href="{{ $commandes->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($commandes->hasMorePages())
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $commandes->url($commandes->currentPage() + 1) }}" aria-label="Next">
                    Next
                </a>
            </li>
        @endif
    </ul>
</div>
         <!-- Pagination ends -->
         </div>
         <!-- Orders Content ends -->
      </div>
   </div>
   <!-- Orders Body ends -->

   <!------Add Orders modal ------>
   <div class="modal modal-lg fade" id="addnew-brand-modal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Brand</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
             <!--ADD category form -->
            <form action="">
               <!-- ADD category input  -->
               <div class="mb-3 mt-3">
                  <label for="product-title" class="form-label fw-bold">Brand Name</label>
                  <input autocomplete="off" type="text" class="form-control" id="brand-name" placeholder="Brand Name" name="brand_name">
               </div>
               <!-- submit btn  -->
               <input class="btn btn-sm rounded px-5 mt-3 fs-6 fw-bold text-white common-btn" type="submit" name="add_brand_submitbtn" value="Add" id="add-brand-submitbtn">
               </div>
               <!-- form ends  -->
            </form>
         </div>
      </div>
   </div>
   <!-- Add Brand modal ends-->
   <!-- Ajouter une zone pour afficher les détails du client -->

    @include('partials.footer')
    <script>
      function changerStatut(commandeId) {
          var bouton = document.getElementById("statutBtn" + commandeId);
          var confirmation = confirm("Confirmez-vous que vous avez traité cette commande?");
          
          if (confirmation) {
              fetch("/commandes/" + commandeId + "/update-statut", {
                  method: 'PUT',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                      'Content-Type': 'application/json'
                  }
              })
              .then(response => response.json())
              .then(data => {
                  bouton.textContent = "Traité";
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
  <script>
   function changerStatutLivraison(commandeId) {
       var bouton = document.getElementById("statutBtnL" + commandeId);
       var confirmation = confirm("Confirmez-vous que vous avez livré cette commande?");
       
       if (confirmation) {
           fetch("/commandes/" + commandeId + "/update-statutLivraison", {
               method: 'PUT',
               headers: {
                   'X-CSRF-TOKEN': '{{ csrf_token() }}',
                   'Content-Type': 'application/json'
               }
           })
           .then(response => response.json())
           .then(data => {
               bouton.textContent = "livré";
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