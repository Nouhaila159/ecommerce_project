<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>
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
             <h1 class="fs-2 mb-3">Tous les Messages</h1>
                <div class="message-list">
                    @foreach($messages as $message)
                    <div class="message-box alert">
                        <div class="message-box">
                            <div class="message-actions">
                                <form id="deleteForm_{{ $message->id }}" method="POST" action="{{ route('message.delete', ['id' => $message->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0);" class="delete-icon" onclick="confirmDelete({{ $message->id }})">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </form>
                            </div>
                            <h5>{{ $message->created_at }}</h5>
                            <strong>Nom complet:</strong> {{ $message->name }}<br>
                            <strong>Email:</strong> {{ $message->email }}<br>
                            <strong>Téléphone:</strong> {{ $message->phone }}<br>
                            <strong>Message:</strong> {{ $message->message }}
                        </div>
                    </div>
                    @endforeach
                </div>
             </div>
       
      
                  <!-- Pagination  -->
                  <!-- Pagination ends -->
         </div>

         <!------- Users Content end ------>
      </div>
   </div>
 <!-- Users Body  end-->
 @include('partials.footer')


   <!-- bootstrap Js  -->
   <!-- Custom Javascript  -->
       <script type="text/javascript" src="./js/admin-script.js"></script>


   <script>
       function confirmDelete(messageId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) {
        // Si l'utilisateur confirme, redirigez vers la route de suppression avec l'ID
        document.querySelector(`#deleteForm_${messageId}`).submit();

    }
}
</script>


   <style>
       /* Styles pour la liste des messages */
       .message-list {
           max-height: 80vh; /* Hauteur maximale de la liste des messages */
           overflow-y: auto; /* Activer le défilement vertical si nécessaire */
       }
       * {
           margin: 0;
           padding: 0;
           box-sizing: border-box;
       }

       h3 {
           font-family: Quicksand;
       }

       .alert {
           width: 50%;
           margin: 20px;
           padding: 10px; /* Réduisez la hauteur du message */
           position: relative;
           border-radius: 5px;
           box-shadow: 0 0 15px 5px #ccc;
           
       }

       /* Style CSS */
       .delete-icon {
           position: absolute;
           top: 5px; /* Ajustez la position verticale si nécessaire */
           right: 5px; /* Ajustez la position horizontale si nécessaire */
           font-size: 20px;
           color: #ff0000; /* Couleur rouge pour l'icône de poubelle */
           cursor: pointer;
       }
   </style>

</body>
</html>
