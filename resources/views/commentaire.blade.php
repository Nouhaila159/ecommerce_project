<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commentaire</title>
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

    <!-- Out of Stock Body  -->
   <div class="container-fluid">
      <div class="row ps-0" style="padding-left: 0 !important">
         <!------ Side Bar  ------->
         @include('partials.sidebar')
         <!-- Side Bar ends -->

         <!------- Users Content  ------>
         <div class="col-10 px-4 mt-3 product-content-container">
             <!-- Users body heading title -->
             <h1 class="fs-2 mb-3">Commentaires</h1>
             <table class="table table-sm table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Produit</th>
                        <th>Commentaire</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commentaires as $commentaire)
                    <tr>
                        <td>{{ $commentaire->user->name }}</td>
                        <td>{{ $commentaire->produit->nomP }}</td>
                        <td>{{ $commentaire->commentaire }}</td>
                        <td>
                            <!-- Actions pour chaque utilisateur -->
                            <form action="{{ route('changer_commentaire', $commentaire->idCommentaire) }}" method="POST" id="changerForm_{{ $commentaire->idCommentaire }}">
                                @csrf
                                @method('PATCH') <!-- Utilisation de la méthode PATCH pour mettre à jour le commentaire -->
                        
                                <!-- Champ caché pour stocker le statut actuel du commentaire -->
                                <input type="hidden" name="statut" value="{{ $commentaire->statut ? 1 : 0 }}">
                                <!-- Le bouton pour bloquer ou débloquer l'utilisateur -->
                                <button id="blockButton" type="submit" class="btn btn-sm @if ($commentaire->statut) btn-success @else btn-danger @endif ms-2">
                                    {{ $commentaire->statut ? 'Autorisé' : 'Bloqué' }} 
                                </button>
                            </form>
                              
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

  
 
         <!-- Pagination ends -->
         </div>
         <!------- Users Content end ------>
      </div>
   </div>

   <script>
   @foreach ($commentaires as $commentaire)
        document.getElementById('changerForm_{{ $commentaire->idCommentaire }}').addEventListener('submit', function (event) {
            if (!confirm('Êtes-vous sûr de vouloir Autorisé/bloquer ce commentaire ?')) {
                event.preventDefault(); // Annule la soumission du formulaire si l'utilisateur annule la confirmation
            }
        });
    @endforeach
</script>
 <!-- Users Body  end-->
 @include('partials.footer')
 


   <!-- bootstrap Js  -->
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>