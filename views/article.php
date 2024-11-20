<?php 
    session_start();
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    require('../actions/questions/showArticleContentAction.php');
    require('../actions/questions/postAnswerAction.php');
    require('../actions/questions/showAllAnswersOfQuestionAction.php');
    require('../actions/users/logoutAutoAction.php');
    
    ?>
    <?php include '../includes/head.php'; ?>
<body>
    <?php include('../includes/navbar.php');?>
    <br><br>

    <div class="container">
        <?php 
        if(isset($errorMsg)){ echo $errorMsg;}
        if(isset($question_publication_date)):
        ?>
        <section class="show-content">
            <h3><?= $question_title; ?> </h3>
            <hr>
            <p><?= $question_content; ?></p>
            <hr>
            <small>Par <?= '<a href="profile.php?id='.$question_id_author.'">'. $question_pseudo_author. '</a> ' . "le " .$question_publication_date ?></small>
        </section><!--show-content -->
        <br>
        <section class="show-answers">
            <?php 
            while($answer = $getAllAnswersOfThisQuestion->fetch()) {
                ?>
                <div class="card">
                    <div class="card-header">
                        <a href="profile.php?id=<?= $answer['id_auteur']; ?>" class="custom-link">
                            <?= $answer['pseudo_auteur'];?>
                        </a>
                        <?php if(isset($_SESSION['auth'])): ?>
                            <a href="#replyForm" class="btn btn-sm btn-primary float-end">Répondre</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <?= $answer['contenu'];?>
                    </div>
                    <div class="card-footer">
                        <small>le <?= date('d/m/Y', strtotime($answer['date_answer'])); ?></small>
                    </div>
                </div>
                <br>
                <?php 
            }
            ?>
        </section><!--show-answers -->

        <?php 
            if(isset($_SESSION['auth'])): ?>
            <div id="replyForm" class="mt-3">
                <form class="form-group" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Réponse :</label>
                        <textarea name="answer" class="form-control"></textarea>
                        <br>
                        <button class="btn btn-primary" type="submit" name="validate">Répondre</button>
                    </div>
                </form>
            </div><!--replyForm -->
        <?php else: ?>
            <div class="text-center mt-3">
                <a href="login.php" class="btn btn-primary">Se connecter pour répondre</a>
            </div>
        <?php endif; ?>
        <?php endif; ?>    
    </div><!--container -->
    <br><br>
    <?php include "../includes/footer.php";?>
</body>
</html>