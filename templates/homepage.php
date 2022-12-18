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
                <br>Réaction: <?=$post->reactionYes;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionOui">&#x1F44D;</a> <?=$post->reactionNo;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionNoN">&#x1F44E;</a>  <?=$post->reactionLaugh;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionRire">&#x1F602;</a>  <?=$post->reactionLove;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionCoeur">&#x2764;</a>  <?=$post->reactionSad;?><a href="index.php?identifier=<?=$post->identifier;?>&reaction=reactionPleur">&#x1F622;</a>
                <br>
                <?php
                    foreach ($comments as $comment) {
                        if ($comment->postidentifier == $post->identifier) {
                ?>
                <br>
                <div>
                    <ul>
                        <li>
                            "<?= htmlspecialchars($comment->content); ?>" -Envoyé par: <?= $comment->userName; ?>
                            <br>Le <?= $comment->dateEnvoi; ?>
                        </li>
                        <br>
                    </ul>
                </div>
                <?php
                        }
                }
                ?>
                <br>
                <br>
                <form action="index.php" method="post">
                    <input type="hidden" name="identifier" value="<?= $post->identifier; ?>">
                    <input type="hidden" name="action" value="Commenter">
                    <input type="text" name="contentComment" placeholder="Commentaire">
                    <input type="submit" value="Commenter">
                </form>
                <br>
                <form action="index.php" method="post">
                    <input type="hidden" name="identifier" value="<?= $post->identifier; ?>">
                    <input type="hidden" name="action" value="Modifier">
                    <input type="submit" value="Modifier">
                </form>
                <br>
                <form action="index.php" method="post">
                    <input type="hidden" name="identifier" value="<?= $post->identifier; ?>">
                    <input type="hidden" name="action" value="Supprimer">
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