<?php 
    session_start();
    require('actions/questions/showAllQuestionIndexAction.php');
    require('actions/database.php');
    require('actions/articles/articlesAction.php');

    if(isset($_SESSION['signup_success_msg'])) {
      $msgSuccess = $_SESSION['signup_success_msg'];
      unset($_SESSION['signup_success_msg']);
    }elseif(isset($_SESSION['login_success_msg'])) {
      $msgSuccess = $_SESSION['login_success_msg'];
      unset($_SESSION['login_success_msg']);
    }

    // Vérifie si l'user est connecté
    if (isset($_SESSION['last_activity'])) {
      // Durée d'inactivité autorisée (en secondes)
      $inactive_duration = 60; // 5 minutes

      // Calcule le temps écoulé depuis la dernière activité
      $elapsed_time = time() - $_SESSION['last_activity'];

      // Vérifier si l'user est inactif depuis plus de la durée autorisée
      if ($elapsed_time > $inactive_duration) {
          // Détruit la session 
          session_destroy();
          header("Location: actions/users/logout.php");
      }
    }

    // Maj du temps de dernière activité
    $_SESSION['last_activity'] = time();
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
            <a class="nav-link" href="views/articles_ressources.php">Articles et ressources</a>
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
      ?>
    <div class="title">
        <h1>Dans ma bulle</h1>
        <img src="images/bulle.png" alt="bulle" class="img">
    </div>
    <br>
    <div class="info text-center">
      <h4>Info: l'autisme n'est pas une maladie !</h4>
    </div>
    <br>
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
        <?php
        $count = 0;
        foreach ($articles as $article):
        ?>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title"><?= $article['titre']; ?></h4>
                    <p class="card-text"><?= $article['contenu']; ?></p>
                    <div class="card_index">
                        <?php if (!empty($article['photo_url'])): ?>
                            <img src="<?= $article['photo_url']; ?>" class="img_index">
                        <?php endif; ?>
                        <br>
                        <?php if (!empty($article['video_url'])): ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?= $article['video_url']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                        <br>
                    </div>
                    <div class="card_index">
                        <a href="<?= $article['url_savoir_plus']; ?>" class="btn btn-primary" target="_blank">En savoir plus</a>
                    </div>
                </div>
            </div><!--card-->
        </div><!--col-md-6-->
        <?php
        $count++; 
        if ($count >= 5) break;
        endforeach;
        ?>
      </div><!--row-->
      <br>
          <div class="card_index">
            <a href="views/articles_ressources.php" class="btn btn-primary">Voir plus d'articles et ressources</a>
          </div>
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
      <legend>Dernières activités dans le forum :</legend>
      <fieldset>
        <div class="card">
          <div class="card-header">
            <a href="views/article.php?id=<?= $getQuestionPresentationData['id']; ?>" class="custom-link">
              <?= $getQuestionPresentationData['titre'];?>
            </a>
                <span class="badge bg-secondary">Épinglé</span>
          </div>
          <div class="card-body">
            <a href="views/article.php?id=<?= $getQuestionPresentationData['id']; ?>" class="custom-card-content">
              <?= $getQuestionPresentationData['contenu']; ?>
            </a>
          </div>
          <div class="card-footer">
            Publié par <a href="views/profile.php?id=<?= $getQuestionPresentationData['id_auteur']; ?>"><?= $getQuestionPresentationData['pseudo_auteur'];?></a> le <?= $getQuestionPresentationData['date_publication']; ?>
          </div>
        </div><!--card-->
              <br>
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
          <div class="col-md-4">
              <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/a_PecDgksow?si=cLt0m3rBcZ7leZDx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </div>
          </div>
      </div><!--row-->
    </div><!--container -->
    <br><br>
    <?php include "includes/footer.php";?>
    <script>
      // Stocke l'ID du minuteur
      let logoutTimer;

      // Fonction pour rediriger vers la page de déconnexion
      function autoLogout() {
        logoutTimer = setTimeout(function() {
          window.location.href = 'actions/users/logout.php';
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
</body>
</html>