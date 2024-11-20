<?php 
    require('../actions/database.php');

    $getAllAnswersOfThisQuestion = $bdd->prepare("SELECT id_auteur, pseudo_auteur, id_question, contenu, date_answer FROM answers WHERE id_question =? ORDER BY id ASC");
    $getAllAnswersOfThisQuestion->execute(array($idOfTheQuestion));

?>