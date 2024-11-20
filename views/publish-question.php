<?php 
    require('../actions/users/securityAction.php'); 
    require('../actions/questions/publishQuestionAction.php');
    require('../actions/users/logoutAutoAction.php');
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

    if(isset($_SESSION['login_success_msg'])) {
        $msgSuccess = $_SESSION['login_success_msg'];
        unset($_SESSION['login_success_msg']);
    }
?>

<?php include ("../includes/head.php"); ?>
<body>
    <?php include('../includes/navbar.php');?>
    <?php 
        if(isset($errorMsg)){ 
            echo '<div class="alert alert-danger text-center">'.$errorMsg.'</div>';
        }elseif(isset($successMsg)){ 
            echo '<div class="alert alert-success text-center">'.$successMsg.'</div>';
        }elseif(isset($msgSuccess)) { 
            echo '<div class="alert alert-success text-center">'.$msgSuccess.'</div>';
        }
    ?>
    <br>
    <br>
    <div class="container">
        <form class="container" method="POST" accept-charset="UTF-8">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titre de la question *</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contenu *</label>
                <textarea class="form-control" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="validate">Publier la question</button>
            <p>* Champs obligatoires</p>
        </form>
    </div><!--container -->
    <br><br>
    <?php include "../includes/footer.php";?>
</body>
</html>