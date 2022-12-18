<?php

    // On récupère le pdo
    $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');

    // On récupère le pseudo de l'utilisateur dans le cookie
    $pseudo = $_COOKIE['user'];

    // Si l'utilisateur accepte la demande d'ami
    if (isset($_GET['action']) && ($_GET['action'] == 'accept')) {

        // On récupère le pseudo de l'utilisateur qui a envoyé la demande d'ami
        $envoyeur = $_GET['envoyeur'];

        // On met à jour la colonne "friend_verif" de la table "friends_requests"
        $query = $pdo->prepare("UPDATE friend_requests SET friend_verif = 1 WHERE envoyeur = ? AND receveur = ?");
        $query->execute([$envoyeur, $pseudo]);

    }

    // Si l'utilisateur refuse la demande d'ami
    if (isset($_GET['action']) && ($_GET['action'] == 'decline')) {

        // On récupère le pseudo de l'utilisateur qui a envoyé la demande d'ami
        $envoyeur = $_GET['envoyeur'];

        // On supprime l'entrée de la table "friends_requests"
        $query = $pdo->prepare("DELETE FROM friend_requests WHERE envoyeur = ? AND receveur = ?");
        $query->execute([$envoyeur, $pseudo]);
    }

    // On selection les utilisateurs qui ont envoyé une demande d'ami à l'utilisateur
    $query= $pdo->query("SELECT * FROM friend_requests WHERE receveur = '$pseudo' && friend_verif = 0 ");

    echo "<h3>Demandes reçues : </h3>";

    // On affiche les demandes d'amis reçues par l'utilisateur
    if ($query->rowCount() > 0) {

        echo "<ul>";
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        
            $envoyeur = $row["envoyeur"];
            echo "<form method='get' action='accept.php'>";
            echo "<li>Vous avez reçu une demande d'ami de $envoyeur</li>";
            echo '|';
            echo '<button type="submit" name="action" value="accept">Accepter</button>';
            echo '|       |';
            echo '<button type="submit" name="action" value="decline">Refuser</button>';
            echo '|';
            echo "<input type='hidden' name='envoyeur' value='$envoyeur'>";
            echo '</form>';
        }


        echo "</ul>";
    }

    // bouton de retour
    echo '<a href="http://localhost/ReseauSocial/templates/friend_list.php">Retour</a>';

?>