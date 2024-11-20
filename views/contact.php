<?php
session_start();
include('../includes/head.php');
include('../actions/users/sendEmailContactAction.php');
?>

<body>
    <?php include('../includes/navbar.php'); ?>
    <br><br>
    <div class="container">
        <form class="container" method="POST">
            <div class="form_contact">
                <h1 class="h1">Contact</h1>
            </div>
            <?php if (isset($errorMsg)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMsg; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($successMsg)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMsg; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo *</label>
                <input type="text" class="form-control" name="pseudo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" name="message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="validate">Envoyer</button>
            <p>* Champs obligatoires</p>
        </form>
    </div><!--container -->
    <br><br>
    <?php include "../includes/footer.php"; ?>
</body>

</html>
