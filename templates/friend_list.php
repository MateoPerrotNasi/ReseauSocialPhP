<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="../style.css" />
   </head>
   <body>
   <?php

        // On récupère le pseudo de l'utilisateur dans le cookie
        $pseudo = $_COOKIE['user'];

        echo "<h1>Liste d'amis de $pseudo : </h1>";

        // On récupère le pdo
        $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');

        // On seléctionne les amis de l'utilisateur
        $result = $pdo->query("SELECT * FROM friend_requests WHERE envoyeur = '$pseudo' && friend_verif = 1 OR receveur = '$pseudo' && friend_verif = 1 ");

        // On affiche les amis de l'utilisateur
        if ($result->rowCount() > 0) {
            echo "<ul>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $receveur = $row["receveur"];
                $envoyeur = $row["envoyeur"];
                if ($receveur == $pseudo) {
                    echo "<li>$envoyeur</li>";
                }
                else {
                    echo "<li>$receveur</li>";
                }
            }


            echo "</ul>";
        }

    ?>
    <h2>Rechercher un ami : </h2>
    <form method="post" action="../src/controllers/addFriend.php">
    <input type="text" id="receveur" name="receveur"/>
    <input type="submit" name="submit" value="Envoyer" />
    <h3>Demandes envoyées : </h3>
    <?php

        // On récupère le pseudo de l'utilisateur dans le cookie
        $pseudo = $_COOKIE['user'];      

        // On récupère le pdo
        $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');

        // On sélectionne les demandes d'amis envoyées par l'utilisateur
        $result = $pdo->query("SELECT * FROM friend_requests WHERE envoyeur = '$pseudo' && friend_verif = 0 ");

        // On affiche les demandes d'amis envoyées par l'utilisateur
        if ($result->rowCount() > 0) {

            echo "<ul>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $receveur = $row["receveur"];
                echo "<li>Vous avez envoyé une demande d'ami à $receveur</li>";
            }


            echo "</ul>";
        }

    ?>
    <h3>Demandes reçues : </h3>
    <?php

        // On récupère le pseudo de l'utilisateur dans le cookie
        $pseudo = $_COOKIE['user'];

        // On récupère le pdo
        $pdo = new PDO('mysql:host=localhost;dbname=reseausocial', 'root', '');

        // On sélectionne les demandes d'amis reçues par l'utilisateur
        $result = $pdo->query("SELECT * FROM friend_requests WHERE receveur = '$pseudo' && friend_verif = 0 ");

        // On affiche les demandes d'amis reçues par l'utilisateur
        if ($result->rowCount() > 0) {

            echo "<ul>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            
            $envoyeur = $row["envoyeur"];
            echo "<li>Vous avez reçu une demande d'ami de $envoyeur</li>";
            echo '|';
            echo '<a href="http://localhost/ReseauSocial/templates/accept">Accepter</a>';
            echo '|       |';
            echo '<a href="http://localhost/ReseauSocial/templates/accept.php">Refuser</a>';
            echo '|';
        }


            echo "</ul>";
        }

    ?>
    </form>
   </body>
</html>
