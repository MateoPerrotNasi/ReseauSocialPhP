<?php

namespace ReseauSocial\Controllers\AddReaction;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class addReaction
{
    public function execute(string $identifier, string $reaction)
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $feed->addReaction($identifier, $reaction);
    }
}