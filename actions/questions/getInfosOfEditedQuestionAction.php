<?php
require('../actions/database.php');

//Verification si l'id est bien passé en parametre dans l url
if(isset($_GET['id']) AND !empty($_GET['id'])) {
    
    $idOfQuestion = $_GET['id'];

    //Verification si la question existe dans la base de données
    $checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute([$idOfQuestion]);

    if($checkIfQuestionExists->rowCount() > 0) {

        //Récupère les informations de la question
        $questionInfos = $checkIfQuestionExists->fetch();
        if($questionInfos['id_auteur'] == $_SESSION['id']) {
            
            $question_title = $questionInfos['titre'];
            $question_content = $questionInfos['contenu'];

            $question_content = str_replace('<br/>', '', $question_content);
        }else{
            $errorMsg = "Vous n'êtes pas autorisé à accéder à cette question";
        }

    }else{
        $errorMsg = "Aucune question n'a été trouvée";
    }
}else{
    $errorMsg= "Aucune question n'a été trouvée";
}
?>