<?php 
session_start();
require('../actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //On vérifie que tous les champs sont renseignés
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['password'])){
        
        //Données de l'utilisateur
        $user_email = htmlspecialchars($_POST['email']);
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_firstname = htmlspecialchars($_POST['firstname']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //On vérifie si l'utilisateur existe déjà
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ? OR email =? ');
        $checkIfUserAlreadyExists->execute(array($user_pseudo, $user_email));

        if($checkIfUserAlreadyExists->rowCount() == 0){
            //Si l'utilisateur n'existe pas, on l'enregistre dans la bdd
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users (pseudo, nom, prenom, mdp, inscription, email) VALUES (?,?,?,?, now(), ?)');
            $insertUserOnWebsite->execute(array($user_pseudo, $user_lastname, $user_firstname, $user_password, $user_email));

            //on passe le champs en_ligne a 1 (en ligne)
            $req = $bdd->prepare("UPDATE users SET en_ligne = 1 WHERE pseudo = '$user_pseudo'");
            $req->execute();

             // Envoi de l'e-mail de confirmation
             $to = $user_email;
             $subject = "Confirmation de création de compte";
             $message = "Bonjour $user_firstname $user_lastname,\n\nVotre compte a bien été créé sur notre site. Vous pouvez désormais vous connecter avec votre pseudo $user_pseudo.\n\nCordialement,\nL'équipe de dansmabulle.info";
             $headers = "From: contact@dansmabulle.info";
 
             // Envoi de l'e-mail
             mail($to, $subject, $message, $headers);

            //Récupération des données de l'utilisateur
            $getInfosOfThisUserReq = $bdd->prepare('SELECT id, pseudo, nom, prenom FROM users WHERE nom =? AND prenom= ? AND pseudo = ?');
            $getInfosOfThisUserReq->execute(array($user_lastname, $user_firstname, $user_pseudo));
            $usersInfos = $getInfosOfThisUserReq->fetch();

            //Si l'utilisateur n'existe pas, on l'enregistre dans la session
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['nom'];
            $_SESSION['firstname'] = $usersInfos['prenom'];
            $_SESSION['pseudo'] = $usersInfos['pseudo'];
            $_SESSION['email'] = $usersInfos['email'];

            $_SESSION['signup_success_msg'] = "Votre compte a bien été créé. Vous êtes maintenant connecté à votre compte";
            //Redirection vers la page d'accueil
            header('Location: ../index.php');
        }else{
            $errorMsg = "L'utilisateur existe déjà";
        }
    }else{
    $errorMsg = "Veuillez compléter tous les champs";
    }
}
?>