<footer>
  <div class="footer-bottom" style="text-align: center;">
      @php
          // Utilisez la classe InfoSite pour récupérer les informations du footer depuis la base de données
          $infoSite = \App\Models\InfoSite::find(1); // Assurez-vous que 1 est l'ID correct de votre enregistrement

          // Vérifiez si l'enregistrement a été trouvé avant d'afficher le footer
          if ($infoSite) {
              echo $infoSite->footerS;
          } else {
              echo "Footer non disponible";
          }
      @endphp
  </div>

</footer>

  