<?php 
    session_start();
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    require('../actions/questions/showAllQuestionAction.php');
    include('../includes/head.php');
    require('../actions/users/logoutAutoAction.php');

    if(isset($_SESSION['login_success_msg'])) {
        $msgSuccess = $_SESSION['login_success_msg'];
        unset($_SESSION['login_success_msg']);
      }
?>
<body>
    <?php include('../includes/navbar.php'); ?>
    <?php 
      if(isset($msgSuccess)) {
        echo '<div class="alert alert-success text-center">' . $msgSuccess . '</div>';
      }
    ?>
    <div class="d-flex justify-content-between my-4">
        <div class="btn-retour">
            <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
        </div>
    </div>
    <br><br>
    <div class="container">
        <h1 class="h1">Forum</h1>
        <br>
        <form method="GET">
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <input type="search" name="search" class="form-control center-input" placeholder="mots clés">
                </div>
                <div class="col-4">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </div>
            </div><!--form-group-->
        </form>
        <br>
        <div class="card">
            <div class="card-header">
                <a href="article.php?id=<?= $getQuestionPresentationData['id']; ?>" class="custom-link">
                    <?= $getQuestionPresentationData['titre'];?>
                </a>
                    <span class="badge bg-secondary">Épinglé</span>
            </div>
            <div class="card-body">
                <a href="article.php?id=<?= $getQuestionPresentationData['id']; ?>" class="custom-card-content">
                    <?= $getQuestionPresentationData['contenu']; ?>
                </a>
            </div>
                <div class="card-footer">
                    Publié par <a href="profile.php?id=<?= $getQuestionPresentationData['id_auteur']; ?>"><?= $getQuestionPresentationData['pseudo_auteur'];?></a> le <?= $getQuestionPresentationData['date_publication']; ?>
                </div>
        </div><!--card-->
              <br>
        <?php 
            while($question = $getAllQuestions->fetch()){
                ?>
                    <div class="card">
                        <div class="card-header">
                            <a href="article.php?id=<?= $question['id']; ?>" class="custom-link">
                            <?= $question['titre'];?>
                            </a>
                        </div>
                        <div class="card-body">
                            <a href="article.php?id=<?= $question['id']; ?>" class="custom-card-content">
                                <?= substr($question['contenu'], 0, 50); ?>... <!-- Affiche un aperçu du contenu, les 50 premiers caractères -->
                            </a>
                        </div>
                        <div class="card-footer">
                        Publié par <a href="profile.php?id=<?= $question['id_auteur']; ?>"><?= $question['pseudo_auteur'];?></a> le <?= $question['date_publication']; ?>
                        </div>
                    </div><!--card -->
                    <br>
                <?php
            }
        ?>
    </div><!--container -->
    <br><br>
    <?php include "../includes/footer.php";?>
</body>
</html>