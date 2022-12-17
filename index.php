<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/addPost.php');
require_once('src/controllers/deletePost.php');
require_once('src/controllers/addReaction.php');
require_once('src/controllers/removeReaction.php');
require_once('src/models/post.php');
require_once('src/models/user.php');

use ReseauSocial\Controllers\Homepage\Homepage;
use ReseauSocial\Controllers\AddPost\AddPost;
use ReseauSocial\Controllers\DeletePost\DeletePost;
use ReseauSocial\Controllers\AddReaction\AddReaction;
use ReseauSocial\Controllers\RemoveReaction\RemoveReaction;
use ReseauSocial\Models\User\Users;

try {
    if (isset($_GET['reaction']) & isset($_GET['identifier'])) {
        if (!isset($_COOKIE['identifier']) || ($_COOKIE['identifier'] != $_GET['identifier'])) {
            setcookie('reaction', $_GET['reaction'], time() + 3600, '/');
            setcookie('identifier', $_GET['identifier'], time() + 3600, '/');
            (new AddReaction())->execute($_GET['identifier'], $_GET['reaction']);
            (new Homepage())->execute();
        }
        else if ($_COOKIE['reaction'] != $_GET['reaction']) {
            (new RemoveReaction())->execute($_GET['identifier'], $_COOKIE['reaction']);
            (new AddReaction())->execute($_GET['identifier'], $_GET['reaction']);
            setcookie('reaction', $_GET['reaction'], time() + 3600, '/');
            setcookie('identifier', $_GET['identifier'], time() + 3600, '/');
            (new Homepage())->execute();
        }
        else {
            (new RemoveReaction())->execute($_GET['identifier'], $_GET['reaction']);
            setcookie('reaction', '', time() - 3600, '/');
            setcookie('identifier', '', time() - 3600, '/');
            (new Homepage())->execute();
        }
    }
    else if (isset($_POST['identifier'])) {
        (new DeletePost())->execute($_POST['identifier']);
        (new Homepage())->execute();
    }
    else if (isset($_POST['content'])) {
        (new AddPost())->execute($_POST['content'], 'Krisfies');
        (new Homepage())->execute();
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
?>