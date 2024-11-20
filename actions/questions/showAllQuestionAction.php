<?php 
    require('../actions/database.php');

        //Recuperation de la question "présentation"
        $getQuestionPresentation = $bdd->query('SELECT id, id_auteur, titre, contenu, pseudo_auteur, date_publication FROM questions WHERE id = 1');
        $getQuestionPresentationData = $getQuestionPresentation->fetch();

        $getAllQuestions = $bdd->query('
        SELECT q.id, q.id_auteur, q.titre, q.contenu, q.pseudo_auteur, q.date_publication 
        FROM questions q
        LEFT JOIN (
            SELECT id_question, MAX(date_answer) AS max_date_answer
            FROM answers
            GROUP BY id_question
        ) a ON q.id = a.id_question
        WHERE q.id <> 1
        ORDER BY COALESCE(a.max_date_answer, q.date_publication) DESC, q.id DESC
        ');
        
        //Verifie si une recherche a été rentrée par l'utilisateur
        if(isset($_GET['search']) AND !empty($_GET['search'])) {

            //La recherche
            $usersSearch = $_GET['search'];

            //Récuperation de toutes les questions correspondant à la recherche (en fonction du titre)
            $getAllQuestions = $bdd->query('SELECT id, id_auteur, titre, contenu, pseudo_auteur, date_publication FROM questions WHERE titre LIKE "%'.$usersSearch.'%" ORDER BY id DESC');

        }
?>