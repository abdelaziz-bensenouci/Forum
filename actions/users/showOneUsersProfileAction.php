<?php 
    require('../actions/database.php');

    //Recuperer l'id de l'utilisateur'
    if(isset($_GET['id']) AND !empty($_GET['id'])){
            
        //l'id de l'utilisateur'
        $idOfUser = $_GET['id'];

        //On vérifie si l'utilisateur existe
        $checkIfUserExists = $bdd->prepare("SELECT pseudo, nom, prenom, inscription FROM users WHERE id =? ");
        $checkIfUserExists->execute(array($idOfUser));

        if($checkIfUserExists->rowCount() > 0){

            //On recupère les informations de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();
            $user_pseudo = $usersInfos['pseudo'];
            $user_lastname = $usersInfos['nom'];
            $user_firstname = $usersInfos['prenom'];
            $user_inscription = $usersInfos['inscription'];

            //Récupération de toutes les questions de l'utilisateur
            $getHisQuestions = $bdd->prepare("SELECT * FROM questions WHERE id_auteur =? ORDER BY id DESC");
            $getHisQuestions->execute(array($idOfUser));
            $countGetHisQuestions = $getHisQuestions->rowCount();

            //Recuperation puis calcul du nombre de messages dans le chat
            $countMessages = $bdd->prepare("SELECT * FROM messages WHERE pseudo =?");
            $countMessages->execute(array($user_pseudo ));
            $count = $countMessages->rowCount();

            //Recuperation puis calcul du nombre de reponses
            $countAnswers = $bdd->prepare("SELECT * FROM answers WHERE id_auteur =? ORDER BY id DESC");
            $countAnswers->execute(array($idOfUser));
            $countGetAnswers = $countAnswers->rowCount();

        }else{
            $errorMsg = "Aucun utilisateur trouvé";
        }


    }else{
        $errorMsg = "Aucun utilisateur trouvé";
    }
?>