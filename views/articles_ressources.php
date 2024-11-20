<?php
    session_start();
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    require('../actions/database.php');
    require('../actions/articles/articlesAction.php');
    include('../includes/head.php');

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
    <div class="container">
        <h1 class="h1">Articles et ressources</h1>
        <br>
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title"><?= $article['titre']; ?></h4>
                            <p class="card-text"><?= $article['contenu']; ?></p>
                            <div class="card_index">
                                <?php if (!empty($article['photo_url'])): ?>
                                    <img src="../<?= $article['photo_url']; ?>" class="img_index">
                                <?php endif; ?>
                                <?php if (!empty($article['video_url'])): ?>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="<?= $article['video_url']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <br>
                            <div class="card_index">
                                <a href="<?= $article['url_savoir_plus']; ?>" class="btn btn-primary" target="_blank">En savoir plus</a>
                            </div>
                        </div>
                    </div><!--card-->
                </div><!--col-md-6-->
            <?php endforeach; ?>
        </div><!--row-->
    </div><!--container-->
    <br><br>
    <?php include "../includes/footer.php"; ?>
</body>
</html>
