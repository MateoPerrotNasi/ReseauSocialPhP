<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Principal</title>
</head>
    <body>
        <p>Bienvenue sur le site</p>
        <span>Entrez un message:</span>
        <form action="index.php" method="post">
            <input type="text" name="content" placeholder="Contenu">
            <input type="submit" value="Poster">
        </form>
        <div class="feed">
            <?= $content ?>
        </div>
    </body>
</html>