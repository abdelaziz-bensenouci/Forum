<?php 
    require('../actions/users/securityAction.php'); 
    require('../actions/questions/myQuestionsAction.php');
    require('../actions/users/logoutAutoAction.php');
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; 
?>

<?php include('../includes/head.php');?>
<body>
    <?php include('../includes/navbar.php');?>
    <br><br>
    <div class="container">
        <?php 
            if($getAllMyQuestions->rowCount() > 0) {
                while($question = $getAllMyQuestions->fetch()) {
        ?>
            <div class="card">
                <h5 class="card-header">
                    <a href="article.php?id=<?= $question['id']; ?>" class="custom-link">
                        <?= $question['titre'];?>
                    </a>
                </h5>
                <div class="card-body">
                    <a href="article.php?id=<?= $question['id']; ?>" class="btn btn-primary mb-2">Accéder à la question</a>
                    
                    <a href="edit-question.php?id=<?= $question['id'] ?>" class="btn btn-warning mb-2">Modifier la question</a>
                    
                    <a href="../actions/questions/deleteQuestionAction.php?id=<?= $question['id'] ?>" class="btn btn-danger mb-2">Supprimer la question</a>
                </div>
            </div><!--card -->
            <br>
        <?php
                }
            } else {
                echo "Aucune question n'a été posée";
            }
        ?>
    </div><!--container -->
    <br><br>
    <?php include "../includes/footer.php";?>
</body>
</html>
