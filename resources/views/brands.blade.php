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
               <h1 class="fs-2">Les Marques</h1>
               @if($errors->has('marque'))
<div class="alert alert-danger">
    {{ $errors->first('marque') }}
</div>
@endif
               <a href="#" class="btn btn-sm fs-6 px-3 fw-bold rounded-pill text-white common-btn" data-bs-toggle="modal" data-bs-target="#addnew-brand-modal">Add New</a>
            </div>
            
            <!-- Sub-category Table  -->
            <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Nom de la marque</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach($marques as $marque)
      <tr>
          <td>{{ $marque->marque }}</td>
          <td> 
              <!-- Actions  -->
              <form method="POST" action="{{ route('brands.destroy', ['id' => $marque->idMarque]) }}">
                @csrf
                @method('DELETE')
                <a href="/update_brands/{{ $marque->idMarque }}" class="btn btn-primary">
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
        @if ($marques->currentPage() > 1)
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $marques->url(1) }}" aria-label="Previous">
                    Previous
                </a>
            </li>
        @endif

        {{-- Page Number Links --}}
        @for ($i = 1; $i <= $marques->lastPage(); $i++)
            <li class="page-item {{ $i === $marques->currentPage() ? 'active' : '' }}">
                <a class="page-link text-white fw-bold" href="{{ $marques->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($marques->hasMorePages())
            <li class="page-item">
                <a class="page-link text-white fw-bold" href="{{ $marques->url($marques->currentPage() + 1) }}" aria-label="Next">
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
            <h4 class="modal-title">Ajouter une marque</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
             <!--ADD category form -->
             <form action="{{route('brands.store')}}" method="POST">
               @csrf <!-- Add the CSRF token -->
            
               <!-- ADD category input  -->
               <div class="mb-3 mt-3">
                  <label for="marque" class="form-label fw-bold">Nom de la marque</label>
                  <input autocomplete="off" type="text" class="form-control" id="marque" placeholder="Nom de la marque" name="marque">
               </div>
            
               <!-- submit btn  -->
               <input class="btn btn-sm rounded px-5 mt-3 fs-6 fw-bold text-white common-btn" type="submit" name="addMarque" value="Add" id="add-brand-submitbtn">
            </form>
         </div>
      </div>
   </div>
   </div>
   <!-- Add Brand modal ends-->
    @include('partials.footer')

   <!-- bootstrap Js  -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
   
  
  
  
  
  
  
</body>
</html>