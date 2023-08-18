<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commande de magazin</title>
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
            <!-- Orders Table  -->


            <div class="text-end mb-3">
               <a href="{{ route('ajouterVente') }}" class="btn btn-primary">Ajouter une commande</a>
           </div>

<table class="table table-bordered table-striped table-hover">
   <thead>
       <tr>
           <th>ID Commande</th>
           <th>Client</th>
           <th>Date de la commande</th>
           <th>Date de livraison</th>
           <th>Adresse de livraison</th>
           <th>Prix de livraison</th>
           <th>Statut de livraison</th>
           <th>Statut</th>
           <th>Détails commande</th>
           <th>Facture</th>
           <th>validation</th>
           <th>actions</th>
       </tr>
   </thead>
   <tbody>
       @foreach ($commandesAvecMontantTotal as $commande)
           <tr>
               <td>{{ $commande['commande']->idCommande  }}</td>
               <td>{{ $commande['commande']->client->nomC }} {{ $commande['commande']->client->prenomC }}
                  <br>Télé: +212{{ $commande['commande']->client->telC }}
                  <br>{{ $commande['commande']->client->adresseC }},{{ $commande['commande']->client->villeC }} </td>
               <td>{{ $commande['commande']->date_commande }}</td>
               <td>{{ $commande['commande']->date_livraison }}</td>
               <td>{{ $commande['commande']->adresse_livraison }}</td>
               <td>{{ $commande['commande']->prix_livraison }}</td>
               <td><button  id="statutBtnL{{ $commande['commande']->idCommande }}" 
                  class="btn {{ $commande['commande']->statut_livraison === 'non livrée' ? 'btn-danger' : 'btn-success' }}"
                  onclick="changerStatutLivraisonV({{ $commande['commande']->idCommande }})">
              {{ $commande['commande']->statut_livraison }}
          </button>
         </td>
         <td>
         <button  id="statutBtn{{ $commande['commande']->idCommande }}" 
                 class="btn {{ $commande['commande']->statut_commande === 'non traitée' ? 'btn-danger' : 'btn-success' }}"
                 onclick="changerStatutV({{ $commande['commande']->idCommande }})">
             {{ $commande['commande']->statut_commande }}
         </button>
     </td>
               <td><a href="{{ url('/detailVente', $commande['commande']->idCommande) }}" class="btn btn-dark">Details</a></td>
               
               <td>
                  <a href="{{ url('/facture', $commande['commande']->idCommande) }}" class="btn btn-light" style="display: flex; align-items: center;">
                      <i class="fas fa-print" style="margin-right: 5px;"></i> 
                  </a>
              </td>  

              <form action="{{ route('updateValidationV', $commande['commande']->idCommande) }}" method="POST">
               @csrf
               <td>
                  <select name="validation" id="validation" onchange="this.form.submit()">
                      <option value="annulé" style="background: red" @if ($commande['commande']->validation === 'annulée') selected @endif>Annulé</option>
                      <option value="en cours" style="background: yellow" @if ($commande['commande']->validation === 'en cours') selected @endif>En cours</option>
                      <option value="validé" style="background: green" @if ($commande['commande']->validation === 'validée') selected @endif>Validé</option>
                  </select>
              </td>
           </form>
               <td>   
                <form action="{{ route('destroy', ['id' => $commande['commande']->idCommande]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-regular fa-trash-can"></i> 
                    </button>
                </form>

                <a href="{{ route('updateVente', ['id' => $commande['commande']->idCommande, 'showForm' => 1]) }}" class="btn btn-primary">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                
                </td>
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
   
   <!-- Add Brand modal ends-->
   <!-- Ajouter une zone pour afficher les détails du client -->

    @include('partials.footer')

   <!-- bootstrap Js  -->
   <!-- Custom Javascript  -->
   <script>
      function changerStatutV(commandeId) {
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
                  bouton.textContent = "Traitée";
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
   function changerStatutLivraisonV(commandeId) {
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
               bouton.textContent = "livrée";
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




   <script type="text/javascript" src="./js/admin-script.js"></script> 

</body>
</html>