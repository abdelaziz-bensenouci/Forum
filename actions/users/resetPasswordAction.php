<?php 
session_start();
require('../actions/database.php');

if(isset($_POST['submit'])){
    $pseudo_email = htmlspecialchars($_POST['pseudo_email']);
    
    $checkUserExistence = $bdd->prepare('SELECT id, email FROM users WHERE email = ?');
    $checkUserExistence->execute([$pseudo_email]);

    if($checkUserExistence->rowCount() > 0){
        $user = $checkUserExistence->fetch();
        // Générer un token unique pour la réinitialisation du mot de passe
        $token = bin2hex(random_bytes(32));

        // Maj bdd avec le token
        $updateTokenQuery = $bdd->prepare('UPDATE users SET reset_token = ? WHERE id = ?');
        $updateTokenQuery->execute([$token, $user['id']]);

        //e-mail de réinitialisation du mdp
        $to = $user['email'];
        $subject = 'Reinitialisation du mot de passe';
        $message = 'Bonjour, veuillez cliquer sur le lien suivant pour réinitialiser votre mot de passe : http://localhost/Forum/reset_password.php?token='.$token;
        $headers = 'From: http://localhost/Forum/index.php' . "\r\n" .
            'Reply-To: http://localhost/Forum/index.php' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers)) {
            $msgSuccess = "Un e-mail de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.";
        } else {
            $errorMsg = "Une erreur s'est produite lors de l'envoi de l'e-mail de réinitialisation.";
        }
    } else {
        $errorMsg = "Aucun compte associé à cet e-mail ou pseudo n'a été trouvé.";
    }
}
?>
