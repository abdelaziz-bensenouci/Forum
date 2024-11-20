<?php 
  require('../actions/users/resetPasswordAction.php');
  include('../includes/head.php');
?>
<body>
<?php include('../includes/navbar.php');?>
    <br>
    <br>
    <div class="container">
        <form class="container" method="POST">
            <?php 
                if(isset($errorMsg)){ 
                    echo '<p>'.$errorMsg.'</p>';
                } 
                if(isset($msgSuccess)){ 
                    echo '<p>'.$msgSuccess.'</p>';
                } 
            ?>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="pseudo_email">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Réinitialiser le mot de passe</button>
            <br><br>
            <a href="login.php"><p>Retour à la page de connexion</p></a>
        </form>
    </div><!--container-->
    <br><br>
    <?php include "../includes/footer.php";?>
</body>
</html>
