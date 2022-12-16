<?php

namespace ReseauSocial\Controllers\Post;

require_once 'src/lib/database.php';
require_once 'src/models/post.php';

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class Post
{
    public function execute(string $identifier)
    {

        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $post = $feed->getPost($identifier);

        require 'templates/display.php';
    }
}
?>