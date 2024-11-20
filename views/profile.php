<?php 
    session_start();
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    require('../actions/users/showOneUsersProfileAction.php');
    require('../actions/users/logoutAutoAction.php');
?>

<?php include('../includes/head.php'); ?>
<body>
    <?php include('../includes/navbar.php'); ?>
    <div class="d-flex justify-content-between my-4">
        <div class="btn-retour">
            <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
        </div>
    </div>
    <div class="container">
        <?php 
            if(isset($errorMsg)){ 
                echo $errorMsg; 
            }
            if(isset($getHisQuestions)){
        ?>
        <div class="card">
            <div class="card-body">
                <h4><?= ucfirst(strtolower($user_pseudo)) ; ?></h4>
                <hr>
                <p>Inscrit depuis le : <?= date('d/m/Y', strtotime($user_inscription)); ?></p>
                <p><?= $count ?> message(s) dans le chat</p>
                <p><?= $countGetHisQuestions?> question(s) publiée(s)</p>
                <p><?= $countGetAnswers?> réponse(s) dans le forum </p>
            </div>
        </div>
        <br>
        <?php
            if ($getHisQuestions->rowCount() > 0) {
        ?>
        <h4>Question(s) posée(s) :</h4>
        <?php
            }
            while($question = $getHisQuestions->fetch()){
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
                le <?= $question['date_publication'];?>
            </div>
        </div><!--card-->
        <br>
        <?php
            }
        ?>
        <?php
            }
        ?>
    </div><!--container -->
    <br><br>
    <?php include "../includes/footer.php";?>
</body>
</html>
