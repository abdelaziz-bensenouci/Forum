<?php 
    session_start();

    //Verifie si l'utilisateur est authentifié
    if(!isset($_SESSION['auth'])){
        header('Location: ../../login.php');
    }
    require('../database.php');

    //Verification si l'id de la question est present dans l'url
    if(isset($_GET['id']) AND !empty($_GET['id'])){

        //Recuperation de l'id de la question
        $idOfTheQuestion = $_GET['id'];
        
        //Vérification si la question existe
        $checkIfQuestionExists = $bdd->prepare('SELECT id_auteur FROM questions WHERE id = ?');
        $checkIfQuestionExists->execute(array($idOfTheQuestion));

        if($checkIfQuestionExists->rowCount() > 0){

            //Verification si l'id de la question correspond à l'id de l'utilisateur
            $questionsInfos = $checkIfQuestionExists->fetch();
            if($questionsInfos['id_auteur'] == $_SESSION['id']){
                
                //Suppression de la question
                $deleteThisQuestion = $bdd->prepare('DELETE FROM questions WHERE id =?');
                $deleteThisQuestion->execute(array($idOfTheQuestion));

                header('Location: ../../views/my-questions.php');
            }else{
                echo "Vous ne pouvez pas supprimer cette question";
            }
        }else{
            echo "Aucune question n'a été sélectionnée";
        }
    }else{
        echo "Aucune question n'a été sélectionnée";
    }

?>