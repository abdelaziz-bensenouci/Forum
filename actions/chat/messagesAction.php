<?php
session_start();

$pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : null; 
include "../database.php";

// Requête pour afficher les messages
$req = $bdd->prepare("SELECT * FROM messages ORDER BY date ASC");
$req->execute();

if ($req->rowCount() == 0) {
    echo "Messagerie vide !";
} else {
    // Boucle pour parcourir les messages
    while ($row = $req->fetch()) {
        // Votre condition de comparaison avec le pseudo de l'utilisateur
        if ($row['pseudo'] == $pseudo) {
            ?>
            <div class="message your_message">
                <span>Vous</span>
                <p><?= $row['msg'] ?></p>
                <p class="date"><?= $row['date'] ?></p>
            </div><!--message your_message-->
            <?php
        } else {
            // Requête pour obtenir les informations de l'utilisateur actuel
            $reqUser = $bdd->prepare("SELECT id FROM users WHERE pseudo = ?");
            $reqUser->execute([$row['pseudo']]);
            $user = $reqUser->fetch();
            ?>
            <div class="message others_message">
                <span><?= $row['pseudo']; ?></span>
                <p><?= $row['msg'] ?></p>
                <p class="date"><?= $row['date'] ?></p>
            </div><!--message others_message-->
            <?php
        }
    }
}
?>
