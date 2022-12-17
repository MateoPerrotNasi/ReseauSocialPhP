<?php ob_start(); ?>

<?php
foreach ($posts as $post) {
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <link rel="stylesheet" type="text/css" href="./style.css">
    </head>
    <body>
    <div class="feed">
        <ul>
            <li>
                "<?= htmlspecialchars($post->content); ?>" -Envoyé par: <?= $post->userName; ?>
                <br>Le <?= $post->dateEnvoi; ?>
                <br>Réaction: <?=$post->reactionYes;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionYes">&#x1F44D;</a> <?=$post->reactionNo;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionNo">&#x1F44E;</a>  <?=$post->reactionLaugh;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionLaugh">&#x1F602;</a>  <?=$post->reactionLove;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionLove">&#x2764;</a>  <?=$post->reactionSad;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionSad">&#x1F622;</a>
                <form action="index.php" method="post">
                    <input type="hidden" name="identifier" value="<?= $post->identifier; ?>">
                    <input type="submit" value="Supprimer">
                </form>
            </li>
        </ul>
    </div>
    </body>
    </html>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>