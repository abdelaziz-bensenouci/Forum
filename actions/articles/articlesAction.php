<?php

    $sql = $bdd->prepare("SELECT titre, contenu, photo_url, video_url, url_savoir_plus FROM articles ORDER BY date_publication DESC");
    $sql->execute();
    $articles = $sql->fetchAll(PDO::FETCH_ASSOC);
?> 