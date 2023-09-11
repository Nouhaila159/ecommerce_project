<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>
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
             <h1 class="fs-2 mb-3">All Users</h1>
             <div class="d-flex justify-content-between align-items-center mb-2">
                <a href="#" class="btn btn-sm fs-6 px-3 fw-bold rounded-pill text-white common-btn" data-bs-toggle="modal" data-bs-target="#addUserModal">Add Admin</a>
            </div>
            
             <table class="table table-sm table-bordered table-hover table-striped">
               <thead>
                  <tr>
                    
                     <th>Nom complet</th>
                     <th>Nom d'utilisateur</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)
                  <tr>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->email }}</td>
                    
                    <td>
                        <?php
                        if ($user->roleId == 0) {
                            echo 'client';
                        } else {
                            echo 'admin';
                        }
                        ?>
                    </td>
                     <td>
            <!-- Actions pour chaque utilisateur -->
            <form action="{{ route('blocked.user', ['userId' => $user->id]) }}" method="POST" id="blockForm_{{ $user->id }}">
                @csrf
                <!-- Le bouton pour bloquer ou débloquer l'utilisateur -->
                <button id="blockButton" type="submit" class="btn btn-sm @if ($user->is_blocked) btn-danger @else btn-success @endif ms-2">
                    @if ($user->is_blocked==1)
                        Bloqué
                    @else
                        Autorisé
                    @endif
                </button>
                
            </form>
                        
        </td>
    </tr>
    @endforeach
</tbody>
 </table>

    <!-- Modal pour Ajouter un utilisateur -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout d'utilisateur -->
                <form method="POST" action="{{route('user.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <!-- Ajoutez d'autres champs ici selon vos besoins -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                            Fermer
                        </button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
     
                  <!-- Pagination  -->
 <div class="mt-5">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($users->currentPage() > 1)
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $users->url(1) }}" aria-label="Previous">
                    Previous
                </a>
            </li>
        @endif

        {{-- Page Number Links --}}
        @for ($i = 1; $i <= $users->lastPage(); $i++)
            <li class="page-item {{ $i === $users->currentPage() ? 'active' : '' }}">
                <a class="page-link text-white fw-bold" href="{{ $users->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($users->hasMorePages())
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $users->url($users->currentPage() + 1) }}" aria-label="Next">
                    Next
                </a>
            </li>
        @endif
    </ul>
</div>
         <!-- Pagination ends -->
         </div>
         <!------- Users Content end ------>
      </div>
   </div>
 <!-- Users Body  end-->
 @include('partials.footer')
 
 <script>
    @foreach ($users as $user)
        document.getElementById('blockForm_{{ $user->id }}').addEventListener('submit', function (event) {
            if (!confirm('Êtes-vous sûr de vouloir bloquer/débloquer ce compte ?')) {
                event.preventDefault(); // Annule la soumission du formulaire si l'utilisateur annule la confirmation
            }
        });
    @endforeach
</script>

   <!-- bootstrap Js  -->
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>