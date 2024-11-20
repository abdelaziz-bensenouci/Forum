<?php 
session_start();
require('../database.php');

$redirect_url = "../../index.php";

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // Utilisation d'une requête préparée pour la sécurité
    $req = $bdd->prepare("UPDATE users SET en_ligne = 0 WHERE id = ?");
    $req->execute([$user_id]);
    // Suppression des variables de session avant de détruire la session
    session_unset();
    session_destroy();
    
    $msgSuccessLogout = "Vous êtes maintenant déconnecté de votre compte";
    // Ajouter le message au paramètre d'URL pour la redirection
    $redirect_url .= '?msgSuccessLogout=' . urlencode($msgSuccessLogout);

    if(isset($_SESSION['redirect_url'])) {
        // Vers l'URL stockée
        $redirect_url = $_SESSION['redirect_url'];
        // Supprime l'URL stockée dans la session
        unset($_SESSION['redirect_url']); 
        // Redirection et arrêt de l'exécution du script
        $msgSuccessLogout = "Vous êtes maintenant déconnecté de votre compte";
        header("Location: $redirect_url");
        exit();
    } else {
        // Vers la page d'accueil par défaut
        $msgSuccessLogout = "Vous êtes maintenant déconnecté de votre compte";
        header("Location: ../../index.php");
        exit();
    }
} else {
    header("Location: $redirect_url");
    exit();
}
?>
