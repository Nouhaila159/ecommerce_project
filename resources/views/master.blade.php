<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <!-- Favicon -->
   <link rel="icon" type="image/x-icon" href="./images/logo.jpeg">
   <!-- Fontawesome Icons  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- Custom Css  -->
   <link rel="stylesheet" href="./css/style.css">
   <!-- bootstrap Css  -->
   {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

</head>
<body>
   <!-- Admin header  -->
   {{-- @include('partials.header') --}}
   @include("layouts.app")
    <!-- Admin header ends -->

    <!-- Dashboard Body  -->
   <div class="container-fluid">
      <div class="row ps-0" style="padding-left: 0 !important">
         <!------ Side Bar  ------>
        @include('partials.sidebar')
         <!-- Side Bar ends -->

         <!------- Dashboard Content ----- -->
         <div class="col-10 px-4 mt-3">
            <h1 class="fs-2 mb-2">Dashboard</h1>

            <div class="row dashboard-content-container">
               <div class="col-4 position-relative">
                  <div class="dashboard-content-detail">
                  <span class="nums-count fs-1">{{ $totalProduits }}</span>
               <span class="nums-count-title fs-5">Produits</span>
                  </div>
               </div>
               <div class="col-4 position-relative">
                  <div class="dashboard-content-detail">
                     <span class="nums-count fs-1">{{ $totalCategories }}</span>
                     <span class="nums-count-title fs-5">Catégories</span>
                  </div>
               </div>
               <div class="col-4 position-relative">
                  <div class="dashboard-content-detail">
                     <span class="nums-count fs-1">{{ $totalReferences }}</span>
                     <span class="nums-count-title fs-5">Réferences</span>
                  </div>
               </div>
               <div class="col-4 position-relative">
                  <div class="dashboard-content-detail">
                     <span class="nums-count fs-1">{{ $totalMarques }}</span>
                     <span class="nums-count-title fs-5">Marques</span>
                  </div>
               </div>
               <div class="col-4 position-relative">
                  <div class="dashboard-content-detail">
                     <span class="nums-count fs-1">{{ $totalCommandes }}</span>
                     <span class="nums-count-title fs-5">Commandes</span>
                  </div>
               </div>
               <div class="col-4 position-relative">
                  <div class="dashboard-content-detail">
                     <span class="nums-count fs-1">{{ $totalUsers }}</span>
                     <span class="nums-count-title fs-5">Utilisateurs</span>
                  </div>
               </div>
            </div>
            <!-- row  -->
          
         </div>
         <!-- Dashboard Content ends  -->
      </div>
   </div>
   

   <!-- Footer  -->
   @include('partials.footer')
   <!-- bootstrap Js  -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>