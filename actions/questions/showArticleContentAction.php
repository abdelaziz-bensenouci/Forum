<?php 
    require('../actions/database.php');

    //Verification si l'id de la question est present dans l'url
    if(isset($_GET['id']) AND !empty($_GET['id'])) {

        //Recuperation de l'id de la question
        $idOfTheQuestion = $_GET['id'];

        //Vérification si la question existe
        $checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
        $checkIfQuestionExists->execute(array($idOfTheQuestion));

        if($checkIfQuestionExists->rowCount() > 0) {

            //Recuperation des informations de la question
            $questionInfos = $checkIfQuestionExists->fetch(PDO::FETCH_ASSOC);

            //Stockage des informations de la question dans des variables
            $question_title = $questionInfos['titre'];
            $question_content = $questionInfos['contenu'];
            $question_id_author = $questionInfos['id_auteur'];
            $question_pseudo_author = $questionInfos['pseudo_auteur'];
            $question_publication_date = $questionInfos['date_publication'];
        
        }else{
            $errorMsg = "Aucune question n'a été trouvée";
        }

    }else{
        $errorMsg = "Aucune question n'a été trouvée";
    }

?>