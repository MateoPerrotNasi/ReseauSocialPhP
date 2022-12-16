<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Principal</title>
</head>
    <body>
        <p>Bienvenue sur le site</p>
        <!-- <p>&#x;</p> -->
        <span>Entrez un message:</span>
        <form action="index.php" method="post">
            <input type="text" name="content" placeholder="Contenu">
            <input type="text" name="userName" placeholder="NomUtilisateur">
            <input type="submit" value="Poster">
        </form>
        <?= $content ?>
    </body>
</html>