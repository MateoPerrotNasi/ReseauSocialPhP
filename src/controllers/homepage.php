<?php
namespace ReseauSocial\Controllers\Homepage;

require_once 'src/lib/database.php';
require_once 'src/models/post.php';
require_once 'src/models/comment.php';

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;
use ReseauSocial\Models\Comment\Comments;

class Homepage
{
    public function execute(string $pseudo)
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $posts = $feed->getFeed($pseudo);

        $comments = new Comments();
        $comments->connection = new DatabaseConnection();
        $comments = $comments->getComments();

        require 'templates/homepage.php';
    }
}
?>