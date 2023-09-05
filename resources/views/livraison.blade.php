<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Livraisons</title>
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

    <!-- Brands Body  -->
   <div class="container-fluid">
      <div class="row ps-0" style="padding-left: 0 !important">
         <!------ Side Bar  ------->
         @include('partials.sidebar')
         <!-- Side Bar ends -->

         <!------- Brands Content  ------>
         <div class="col-10 px-4 mt-3 product-content-container">
            <!-- Brands body heading -->
            <div class="d-flex justify-content-between align-items-center mb-2">
               <h1 class="fs-2">Les Livraisons</h1>
               @if($errors->has('livraison'))
<div class="alert alert-danger">
    {{ $errors->first('livraison') }}
</div>
@endif
               <a href="#" class="btn btn-sm fs-6 px-3 fw-bold rounded-pill text-white common-btn" data-bs-toggle="modal" data-bs-target="#addnew-brand-modal">Add New</a>
            </div>
            
            <!-- Sub-category Table  -->
            <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Ville de la livraison</th>
            <th>Prix de la livraison</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach($livraisons as $livraison)
      <tr>
          <td>{{ $livraison->livraison }}</td>
          <td>{{ $livraison->prix }} MAD</td>

          <td> 
              <!-- Actions  -->
              <form method="POST" action="{{ route('livraison.destroy', ['id' => $livraison->idlivraison]) }}">
                @csrf
                @method('DELETE')
                <a href="/update_livraison/{{ $livraison->idlivraison }}" class="btn btn-primary">
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
        @if ($livraisons->currentPage() > 1)
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $livraisons->url(1) }}" aria-label="Previous">
                    Previous
                </a>
            </li>
        @endif

        {{-- Page Number Links --}}
        @for ($i = 1; $i <= $livraisons->lastPage(); $i++)
            <li class="page-item {{ $i === $livraisons->currentPage() ? 'active' : '' }}">
                <a class="page-link text-white fw-bold" href="{{ $livraisons->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($livraisons->hasMorePages())
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $livraisons->url($livraisons->currentPage() + 1) }}" aria-label="Next">
                    Next
                </a>
            </li>
        @endif
    </ul>
</div>
         
         <!-- Brands Content ends -->
   
   <!-- Brands Body ends -->

   <!------Add Brands modal ------>
   <div class="modal modal-lg fade" id="addnew-brand-modal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Ajouter une livraison</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
             <!--ADD category form -->
             <form action="{{route('livraison.store')}}" method="POST">
               @csrf <!-- Add the CSRF token -->
            
               <!-- ADD category input  -->
               <div class="mb-3 mt-3">
                  <label for="livraison" class="form-label fw-bold">Ville de la livraison</label>
                  <input autocomplete="off" type="text" class="form-control" id="livraison" placeholder="Ville de la livraison" name="livraison" required>
               </div>
               <div class="mb-3 mt-3">
                  <label for="livraison" class="form-label fw-bold">Prix de la livraison</label>
                  <input autocomplete="off" type="number" class="form-control" id="prix" placeholder="prix de la livraison" name="prix" required>
               </div>
               <!-- submit btn  -->
               <input class="btn btn-sm rounded px-5 mt-3 fs-6 fw-bold text-white common-btn" type="submit" name="addLivraison" value="Add" id="add-brand-submitbtn">
            </form>
         </div>
      </div>
   </div>
   </div>
   <!-- Add Brand modal ends-->
    @include('partials.footer')

   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
   
  
  
  
  
  
  
</body>
</html>