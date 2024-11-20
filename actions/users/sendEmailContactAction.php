<?php
// Fonction pour nettoyer les entrées
function clean_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs requis sont remplis
    if (isset($_POST['pseudo'], $_POST['email'], $_POST['message'])) {
        // Récupère les données du formulaire et les nettoie
        $pseudo = clean_input($_POST['pseudo']);
        $email = clean_input($_POST['email']);
        $message = clean_input($_POST['message']);

        // Validation simple de l'adresse e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "L'adresse e-mail n'est pas valide.";
        } else {
            // Configuration de l'e-mail
            $to = "abdelazizben.dev@gmail.com";
            $subject = "Nouveau message de contact";
            $body = "Pseudo: $pseudo\n";
            $body .= "Email: $email\n";
            $body .= "Message:\n$message";

            // Envoi de l'e-mail
            if (mail($to, $subject, $body)) {
                $successMsg = "Votre message a été envoyé avec succès !";
            } else {
                $errorMsg = "Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard.";
            }
        }
    } else {
        $errorMsg = "Veuillez remplir tous les champs du formulaire.";
    }
}
?>
