<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Settings</title>
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

         <!------- Settings Content  ------>
         <div class="col-10 px-4 mt-3 product-content-container">
            <!-- Settings body heading -->
            <div class="mb-2">
               <h1 class="fs-2">Site Settings</h1>
            </div>
            
            <!-- Settings Form  -->
            <form action="">
               <!-- row -->
               <div class="row">
                  <!-- col left  -->
                  <div class="col-6">
                     <!-- Site Name -->
                     <div class="mb-3 mt-3 ">
                        <label for="Site Name" class="form-label fw-bold">Site Name</label>
                        <input autocomplete="off" type="text" class="form-control form-control-sm" id="site-name" name="site_name" value="Super Market">
                     </div>

                    <!-- Site Title -->
                     <div class="mb-3 mt-3">
                        <label for="Site Title" class="form-label fw-bold">Site Title</label>
                        <input autocomplete="off" type="text" class="form-control form-control-sm" id="site-title" name="site_title" value="Online Shopping Project for Mobiles, Clothes, Electronics and many more....">
                     </div>

                     <!-- Site Description -->
                     <div class="mb-3 mt-3">
                        <label for="Site Description" class="form-label fw-bold">Site Description</label>
                        <textarea class="form-control form-control-sm" name="site_description" id="site-description" cols="30" rows="6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis quia repudiandae sapiente sed sunt.
                        </textarea>
                     </div>

                     <!-- Contact Email -->
                     <div class="mb-3 mt-3">
                        <label for="Contact-Email" class="form-label fw-bold">Contact Email</label>
                        <input autocomplete="off" type="email" class="form-control form-control-sm" id="contact-email" name="contact_email" value="abc@gmail.com">
                     </div>

                     <!-- Contact Phone Number -->
                     <div class="mb-3 mt-3">
                        <label for="Contact-Email" class="form-label fw-bold">Contact Phone Number</label>
                        <input autocomplete="off" type="number" class="form-control form-control-sm" id="contact-phone-number" name="contact_phone_number" value="87654567">
                     </div>
   
                  </div>
                  <!-- col right  -->
                  <div class="col-6">
                     <!-- Site Logo -->
                     <div class="mb-3 mt-3">
                        <label for="product-title" class="form-label fw-bold">Site Logo</label>
                        <input type="file" class="form-control form-control-sm" id="site-logo" name="site_logo">
                     </div>

                     <!-- Current Site Logo -->
                     <div class="product_img mb-3">
                        <img src="./images/logo.png" alt="Logo">
                     </div>

                     <!-- Currency Format -->
                     <div class="mb-3 d-flex flex-column">
                        <label for="product-title" class="form-label fw-bold">Currency Format</label>
                        <input type="text" class="form-control form-control-sm" id="currency-format" name="currency_format" value="BDT.">
                     </div>

                       <!-- Contact Address -->
                     <div class="mb-3 d-flex flex-column">
                        <label for="vailable-quantity" class="form-label fw-bold">Contact Address</label>
                        <input type="text" class="form-control form-control-sm" id="contact_address" name="contact_address" value="#157, Ukhia, Cox's Bazar">
                     </div>

                     <!-- Footer Text -->
                     <div class="mb-3 d-flex flex-column">
                        <label for="vailable-quantity" class="form-label fw-bold">Footer Text</label>
                        <input type="text" class="form-control form-control-sm" id="footer-text" name="footer_text" value="Copyright &copy; 2022">
                     </div>

                     <!-- submit btn  -->
                     <input class="btn btn-sm rounded px-5 mt-3 fs-6 fw-bold text-white common-btn" type="submit" name="setting-submitbtn" value="Update" id="setting-submitbtn">
                  </div>
               </div>
               <!-- form ends  -->
            </form>
            <!-- Settings Form end  -->
           
         </div>
         <!-- Settings Content ends -->
      </div>
   </div>
   <!-- Settings Body ends -->

  

   @include('partials.footer')

   <!-- bootstrap Js  -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Custom Javascript  -->
   <script type="text/javascript" src="./js/admin-script.js"></script>
</body>
</html>