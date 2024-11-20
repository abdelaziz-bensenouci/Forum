<?php 
      
      if (isset($_SESSION['last_activity'])) {
        // Durée d'inactivité autorisée (en secondes)
        $inactive_duration = 60; // 5 minutes
  
        // Calcule le temps écoulé depuis la dernière activité
        $elapsed_time = time() - $_SESSION['last_activity'];
  
        // Vérifie si l'utilisateur est inactif depuis plus de la durée autorisée
        if ($elapsed_time > $inactive_duration) {
            // Détruit la session
            session_destroy();
            header("Location: ../actions/users/logout.php");
        }
      }
?>
    <script>
      // Stocke l'ID du minuteur
      let logoutTimer;

      // Fonction pour rediriger vers la page de déconnexion
      function autoLogout() {
        logoutTimer = setTimeout(function() {
          window.location.href = '../actions/users/logout.php';
        }, 60000); // 1 minute en millisecondes
      }

      // Démarre la fonction au chargement de la page
      autoLogout();

      // Réinitialise le minuteur lorsqu'une activité est détectée
      document.addEventListener('mousemove', function() {
        // Utilise clearTimeout avec l'ID du minuteur
        clearTimeout(logoutTimer); 
        autoLogout();
      });
    </script>