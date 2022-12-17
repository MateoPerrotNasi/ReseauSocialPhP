<?php

namespace ReseauSocial\Controllers\RemoveReaction;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class removeReaction
{
    public function execute(string $identifier, string $reaction)
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $feed->removeReaction($identifier, $reaction);
    }
}