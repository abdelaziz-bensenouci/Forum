<?php 
    session_start();
    require('actions/questions/showAllQuestionIndexAction.php');
    require('actions/database.php');

    if(isset($_SESSION['signup_success_msg'])) {
      $msgSuccess = $_SESSION['signup_success_msg'];
      unset($_SESSION['signup_success_msg']);
    }
    if(isset($_GET['msgSuccessLogout'])) {
      $msgSuccessLogout = $_GET['msgSuccessLogout'];
      unset($_GET['msgSuccessLogout']);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Forum et chat de discussion et d'entraide sur l'autisme (TSA). Partagez vos expériences, posez vos questions et trouvez du soutien.">
    <link rel="manifest" href="manifest.json">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Forum</title>
    <link rel="icon" href="images/bulle.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Dans ma bulle</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="views/forum.php">Forum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="views/chat.php">Chat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="views/publish-question.php">Publier une question</a>
          </li>
            
            <?php if(isset($_SESSION['auth'])) {
              ?>
            <li class="nav-item">
              <a class="nav-link" href="views/my-questions.php">Mes questions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="views/profile.php?id=<?= $_SESSION['id']; ?>">Mon profil</a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="actions/users/logout.php">Déconnexion</a>
            </li>
              <?php 
            }else{
              ?>
              <li class="nav-item">
              <a class="nav-link" href="views/login.php">Se connecter/S'inscrire</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="views/contact.php">Contact</a>
            </li>
        </ul>
      </div><!--collapse navbar-collapse-->
    </div><!--container-fluid -->
  </nav>
      <?php 
      if(isset($msgSuccess)) {
        echo '<div class="alert alert-success text-center">' . $msgSuccess . '</div>';
      }
      if(isset($msgSuccessLogout)) {
        echo '<div class="alert alert-success text-center">' . $msgSuccessLogout . '</div>';
      }
      ?>
    <div class="title">
        <h1>Dans ma bulle</h1>
        <img src="images/bulle.png" alt="bulle" class="img">
    </div>
    <br><br>
    <div class="container">
      <div class="presentation">
          <p>Notre mission est de fournir un espace dédié à l'autisme où chacun peut partager, informer et soutenir. Explorez nos ressources, échangez des expériences et découvrez une communauté bienveillante prête à accompagner chacun dans son parcours unique. Ensemble, nous cultivons la compréhension et la sensibilisation à l'autisme.</p>
          <br>
          <h3>Nos valeurs :</h3>
          <ul>
              <li>Partage</li>
              <li>Entraide</li>
              <li>Compréhension</li>
              <li>Sensibilisation</li>
          </ul>
      </div><!--presentation-->
    </div><!--container-->
    <br><br>
    <div class="container">
      <div class="definition">
          <h2>Qu'est-ce que l'autisme ?</h2>
          <p>L'autisme, également connu sous le nom de trouble du spectre autistique (TSA), est un trouble neurodéveloppemental qui affecte la communication, les interactions sociales et les comportements. Les personnes atteintes d'autisme peuvent présenter une gamme de symptômes et de sévérités différentes, allant de difficultés légères à sévères. Les caractéristiques courantes de l'autisme incluent des difficultés à comprendre les signaux sociaux, des intérêts restreints et répétitifs, ainsi que des sensibilités sensorielles particulières.</p>
      </div><!--definition-->
    </div><!--container-->
    <br>
    <div class="container">
      <h3 class="mt-5 mb-4">Articles et ressources :</h3>
      <div class="row">
          <div class="col-md-6">
              <div class="card mb-4">
                  <div class="card-body">
                      <h4 class="card-title">Nombre de personnes autistes en France</h4>
                      <p class="card-text">Selon <a href="https://www.autisme.fr/" target="_blank">Autisme France</a>, environ 700 000 personnes sont touchées par l'autisme en France.</p>
                      <a href="https://www.autisme.fr/" class="btn btn-primary" target="_blank">En savoir plus</a>
                  </div>
              </div><!--card-->
          </div><!--col-md-6-->
          <div class="col-md-6">
              <div class="card mb-4">
                  <div class="card-body">
                      <h3 class="card-title">Nombre de personnes autistes en Europe</h3>
                      <p class="card-text">Selon l'<a href="https://www.autismeurope.org/fr/qui-sommes-nous/le-spectre-autistique/" target="_blank">Autisme Europe</a>, environ 5 millions de personnes sont atteintes d'autisme en Europe.</p>
                      <a href="https://www.autismeurope.org/fr/qui-sommes-nous/le-spectre-autistique/" class="btn btn-primary" target="_blank">En savoir plus</a>
                  </div>
              </div>
          </div><!--col-md-6-->
      </div><!--row-->
    <!-- Liens vers des organisations de soutien -->
        <h3 class="mt-5 mb-4">Organisations de soutien :</h3>
        <ul>
            <li><a href="https://www.autisme-france.fr/">Autisme France</a></li>
            <li><a href="https://www.vaincrelautisme.org/">Vaincre l'Autisme</a></li>
            <li><a href="https://www.autismeurope.org/">Autisme Europe</a></li>
            <li><a href="https://www.autismspeaks.org/">Autism Speaks</a></li>
        </ul>
    </div><!--container -->
    <br><br>
    <div class="container">
      <legend>Dernières questions dans le forum :</legend>
      <fieldset>
          <?php 
          while($question = $getAllQuestions->fetch()){
          ?>
              <div class="card">
                  <div class="card-header">
                      <a href="views/article.php?id=<?= $question['id']; ?>" class="custom-link">
                          <?= $question['titre'];?>
                      </a>
                  </div>
                  <div class="card-body">
                      <a href="views/article.php?id=<?= $question['id']; ?>" class="custom-card-content">
                        <?= substr($question['contenu'], 0, 50); ?>... <!-- Affiche un aperçu du contenu, les 50 premiers caractères -->
                      </a>
                  </div>
                  <div class="card-footer">
                      Publié par <a href="views/profile.php?id=<?= $question['id_auteur']; ?>"><?= $question['pseudo_auteur'];?></a> le <?= $question['date_publication']; ?>
                  </div>
              </div><!--card -->
              <br>
          <?php
          }
          ?>
      </fieldset>
    </div><!--container -->
    <br><br>
    <div class="container text-center">
      <h4 class="mb-4">Vidéos :</h4>
      <div class="row justify-content-center">
          <div class="col-md-4">
              <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/o6nG_0CKITs?si=6bqoTsmincfzoTTP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </div>
          </div>
          <div class="col-md-4">
              <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/8zrJbcoPLRY?si=192aMXY5KdjIaYjd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </div>
          </div>
      </div><!--row-->
    </div><!--container -->
    <br><br>
    <?php include "includes/footer.php";?>
</body>
</html>