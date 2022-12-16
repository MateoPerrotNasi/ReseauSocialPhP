<?php

namespace ReseauSocial\Controllers\AddPost;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class addPost
{
    public function execute(string $content, string $userName)
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $feed->createPost($content, $userName);
    }
}