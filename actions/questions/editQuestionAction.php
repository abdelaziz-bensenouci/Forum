<?php 
    require('../actions/database.php');
   
    //Validation du formulaire
    if(isset($_POST['validate'])) {

        //Vérification que les champs sont remplis
        if(!empty($_POST['title']) && !empty($_POST['content'])){
            
            //Données à faire passer dans la requete
            $new_question_title = htmlspecialchars($_POST['title']);
            $new_question_content = nl2br(htmlspecialchars($_POST['content']));

            //Modifier les informations de la question dans la base de données
            $editQuestionOnWebsite = $bdd->prepare('UPDATE questions SET titre =?, contenu =? WHERE id =?');
            $editQuestionOnWebsite->execute(array($new_question_title,$new_question_content, $idOfQuestion));

            header('Location: my-questions.php');
        }else{
            $errorMsg = "Veuillez remplir tous les champs";
        }
    }
?>