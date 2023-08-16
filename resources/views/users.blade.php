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

             <table class="table table-sm table-bordered table-hover table-striped">
               <thead>
                  <tr>
                    
                     <th>Nom complet</th>
                     <th>Nom d'utilisateur</th>
                     <th>Email</th>
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
            <!-- Actions pour chaque utilisateur -->
            <a data-userid="" class="btn btn-sm btn-danger ms-2" href="#">Block</a>
                        <!-- delete -->
                        <a class="ms-2" data-userid="">
                           <i class="fa-regular fa-trash-can"></i>
                        </a>
            <!-- ... Autres actions ... -->
        </td>
    </tr>
    @endforeach
</tbody>
             </table>

         
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

   <!-- bootstrap Js  -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>