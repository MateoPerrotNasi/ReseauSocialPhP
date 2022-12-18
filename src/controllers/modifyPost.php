<?php

namespace ReseauSocial\Controllers\ModifyPost;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class modifyPost
{
    public function execute(string $identifier, string $content)
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $feed->modifyPost($identifier, $content);
    }
}