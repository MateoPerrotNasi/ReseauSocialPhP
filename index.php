<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/addPost.php');
require_once('src/controllers/deletePost.php');
require_once('src/controllers/getUserName.php');
require_once('src/models/post.php');
require_once('src/models/user.php');

use ReseauSocial\Controllers\Homepage\Homepage;
use ReseauSocial\Controllers\AddPost\AddPost;
use ReseauSocial\Controllers\DeletePost\DeletePost;
use ReseauSocial\Controllers\GetUserName\GetUserName;
use ReseauSocial\Models\User\Users;

try {
    if (isset($_POST['identifier'])) {
        (new DeletePost())->execute($_POST['identifier']);
        (new Homepage())->execute();
    }
    else if (isset($_POST['content']) && isset($_POST['userName'])) {
        if(strval($_POST ['content']) != "" && strval($_POST ['userName']) != ""){
            (new AddPost())->execute($_POST['content'], $_POST['userName']);
            (new Homepage())->execute();
        } else {
            throw new Exception("Veuillez remplir tous les champs");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
?>