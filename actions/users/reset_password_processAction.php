<?php 
session_start();
require('../actions/database.php');

if(isset($_POST['submit'])){
    // Récupérer les données du formulaire
    $newPassword = htmlspecialchars($_POST['new_password']);
    $confirmPassword = htmlspecialchars($_POST['confirm_password']);
    $token = htmlspecialchars($_POST['token']); // Le token envoyé dans le formulaire

    // Vérifier que les mots de passe saisis correspondent
    if($newPassword === $confirmPassword) {
        // Vérifier que le token est valide et correspond à un utilisateur
        $checkTokenValidity = $bdd->prepare('SELECT id FROM users WHERE reset_token = ?');
        $checkTokenValidity->execute([$token]);

        if($checkTokenValidity->rowCount() > 0){
            // Token valide, mettre à jour le mot de passe dans la base de données
            $user = $checkTokenValidity->fetch();
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updatePasswordQuery = $bdd->prepare('UPDATE users SET mdp = ?, reset_token = NULL WHERE id = ?');
            $updatePasswordQuery->execute([$hashedPassword, $user['id']]);

            $msgSuccess = "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            // Token invalide
            $errorMsg = "Le lien de réinitialisation du mot de passe est invalide.";
        }
    } else {
        // Mots de passe ne correspondent pas
        $errorMsg = "Les mots de passe saisis ne correspondent pas.";
    }
}
?>
