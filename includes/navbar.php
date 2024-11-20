<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">Dans ma bulle</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="forum.php">Forum</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chat.php">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="articles_ressources.php">Articles et ressources</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="publish-question.php">Publier une question</a>
        </li>
        
        <?php if(isset($_SESSION['auth'])) {
          ?>
        <li class="nav-item">
          <a class="nav-link" href="my-questions.php">Mes questions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php?id=<?= $_SESSION['id']; ?>">Mon profil</a>
        </li>
          <li class="nav-item">
          <a class="nav-link" href="../actions/users/logout.php">Déconnexion</a>
        </li>
          <?php 
        }else{
          ?>
          <li class="nav-item">
          <a class="nav-link" href="login.php">Se connecter/S'inscrire</a>
        </li>
        <?php
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        </ul>
    </div>
  </div>
</nav>