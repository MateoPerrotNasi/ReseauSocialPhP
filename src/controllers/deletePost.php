<?php

namespace ReseauSocial\Controllers\DeletePost;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class deletePost
{
    public function execute(string $identifier)
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $feed->deletePost($identifier);
    }
}