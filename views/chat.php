<?php 
    session_start();
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    // Vérifie si le pseudo est présent dans la session, sinon le définir à null
    $pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : null; 
    include "../includes/head.php";
    include "../actions/database.php";
    require('../actions/users/logoutAutoAction.php');
?>
<?php
   $reqUsers = $bdd->prepare("SELECT * FROM users");
   $reqUsers->execute();
   $users = $reqUsers->fetchAll();
   
    if(isset($_POST['send'])) {
        // Récupérons le message 
        $message = $_POST['message'];

        // Vérifions si le champ n'est pas vide
        if(isset($_POST['send'])) {
            // Récupérons le message 
            $message = $_POST['message'];
        
            // Vérifions si le champ n'est pas vide
            if(isset($message) && $message != "") {
                // Insérer le message dans la base de données en utilisant une requête préparée
                $req = $bdd->prepare("INSERT INTO messages (pseudo, msg, date) VALUES (:pseudo, :message, NOW())");
                $req->bindParam(':pseudo', $pseudo);
                $req->bindParam(':message', $message);
                $req->execute();

                // Actualisation de la page 
                header('Location:chat.php');
            } else {
                // Si le message est vide, on actualise la page 
                header('Location:chat.php');
            }
        }        
    }

    if(isset($_SESSION['login_success_msg'])) {
        $msgSuccess = $_SESSION['login_success_msg'];
        unset($_SESSION['login_success_msg']);
    }
    ?>
<body>
    <?php include "../includes/navbar.php"; ?>
    <?php
        if(isset($msgSuccess)) {
            echo '<div class="alert alert-success text-center">' . $msgSuccess . '</div>';
        }
    ?>
    <div class="d-flex justify-content-between my-4">
        <div class="btn-retour">
            <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
        </div>
    </div>
   <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="users">
                    <div class="table-responsive">
                        <table id="user-table" class="table table-striped">
                            <caption>Utilisateurs</caption>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <?php
                                        
                                        $iconeEnLigne = ($user['en_ligne'] == 1) ? '<img class="icone-ligne" src="../images/pngegg.png" alt="En ligne">' : '';
                                        $iconeHorsLigne = ($user['en_ligne'] == 0) ? '<img class="icone-ligne" src="../images/pngrouge.png" alt="Hors ligne">' : '';
                                    ?>
                                    <tr>
                                    <td class="icone-ligne">
                                    <a href="profile.php?id=<?= urlencode($user['id']); ?>">
                                        <?= ucfirst(strtolower($user['pseudo'])); ?>
                                    </a>
                                        <?= $iconeEnLigne ?>
                                        <?= $iconeHorsLigne ?>
                                    </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div><!--table-responsive-->
                </div><!--users-->
            </div><!--col-md-4-->
                <!-- Menu déroulant pour les smartphones -->
                <select id="user-dropdown" class="form-select d-block d-md-none">
                    <option value="" selected>Utilisateur</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id']; ?>">
                            <?= ucfirst(strtolower($user['pseudo'])); ?>
                            <?php if ($user['en_ligne'] == 1): ?>
                                (En ligne)
                            <?php else: ?>
                                (Hors ligne)
                            <?php endif; ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <br><br><br>
            <div class="col-md-6">
                <div class="chat">
                    <div class="pseudo">
                        <span><?= isset($pseudo) ? strtoupper($pseudo) : 'Visiteur' ?></span>
                        <?php if(isset($_SESSION['pseudo'])) {?>
                            <a href="../actions/users/logout.php" class="btn btn-danger">Déconnexion</a>
                        <?php 
                        }else{?>
                            <a href="login.php" class="btn btn-primary">Se connecter</a>
                        <?php 
                        }
                        ?>
                    </div><!--pseudo-->
                    
                    <div class="messages_box">Chargement ...</div>
                    
                    <form action="" class="send_message" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="2" placeholder="Votre message"></textarea>
                        </div>
                        <?php if($pseudo) { // Vérifie si l'utilisateur est connecté ?>
                        <button type="submit" class="btn btn-primary send_msg" name="send">Envoyer</button>
                    <?php } else { ?>
                        <br>
                        <div class="alert alert-warning" role="alert">
                            Vous devez être connecté pour envoyer un message.
                        </div>
                    <?php } ?>
                    </form>
                </div><!--chat-->
            </div><!--col-md-6-->
        </div><!--row-->
    </div><!--container-->
    <script> 
        //actualisation de la page en utilisant AJAX
        var message_box = document.querySelector('.messages_box');
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "../actions/chat/messagesAction.php", true);
            xhttp.send();
        }, 500);
    </script>
    <script>
    // Récupère l'élément select
    const userDropdown = document.getElementById('user-dropdown');

    // Écoute les changements
    userDropdown.addEventListener('change', function() {
        // Récupère l'ID de l'utilisateur sélectionné
        const userId = userDropdown.value;
        if (userId) {
            //Page de profil via l'ID de l'user
            window.location.href = 'profile.php?id=' + userId;
        }
    });
    </script>
    <br><br>
<?php include "../includes/footer.php";?>
</body>
</html>