<?php
require('../actions/users/reset_password_processAction.php');
include('../includes/head.php');
?>

<body>
    <?php include('../includes/navbar.php'); ?>
    <br>
    <br>
    <div class="container">
        <form class="container" method="POST">
            <?php if (isset($errorMsg)) { ?>
                <p><?php echo $errorMsg; ?></p>
            <?php } ?>
            <?php if (isset($msgSuccess)) { ?>
                <p><?php echo $msgSuccess; ?></p>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" name="new_password">
            </div>
            <div class="mb-3">
                <label class="form-label">Comfirmer le mot de passe</label>
                <input type="password" class="form-control" name="confirm_password">
            </div>
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <button type="submit" class="btn btn-primary" name="submit">Réinitialiser le mot de passe</button>
    <br><br>
            <a href="login.php"><p>Retour à la page de connexion</p></a>
        </form>
    </div><!--container-->
    <br><br>
    <?php include "../includes/footer.php"; ?>
</body>

</html>
