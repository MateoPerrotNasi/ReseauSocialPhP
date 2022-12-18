<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Principal</title>
</head>
    <body>
        <?php $pseudo = $_COOKIE['user'];
        echo"<p>Bienvenue sur le site $pseudo</p>"
        ?>
        <div>
            <a href="templates/friend_list.php">Liste d'amis</a>
            <br>
            <a href="authentification/login.php">Déconnexion</a>
        </div>
        <br>
        <span>Entrez un message:</span>
        <br>
        <form action="index.php" method="post">
            <input type="text" name="content" placeholder="Contenu">
            <input type="hidden" name="action" value="Poster">
            <input type="submit" value="Poster">
        </form>
        <div class="feed">
            <?= $content ?>
        </div>
    </body>
</html>