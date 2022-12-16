<?php ob_start(); ?>

<?php
foreach ($posts as $post) {
?>
    <div class="news">
        <ul>
            <li>
                "<?= htmlspecialchars($post->content); ?>" -Envoyé par: <?= $post->userName; ?> Réaction: <span>&#x1F44D;</span> <span>&#x1F44E;</span>  <span>&#x1F602;</span>  <span>&#x2764;</span>  <span>&#x1F622;</span> 
                <form action="index.php" method="post">
                    <input type="hidden" name="identifier" value="<?= $post->identifier; ?>">
                    <input type="submit" value="Supprimer">
                </form>
            </li>
        </ul>        
    </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>