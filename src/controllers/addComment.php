<?php

namespace ReseauSocial\Controllers\AddComment;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Comment\Comments;

class addComment
{
    public function execute(string $content, string $userName, string $post)
    {
        $feed = new Comments();
        $feed->connection = new DatabaseConnection();
        $feed->createComment($content, $userName, $post);
    }
}