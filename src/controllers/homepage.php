<?php
namespace ReseauSocial\Controllers\Homepage;

require_once 'src/lib/database.php';
require_once 'src/models/post.php';

use ReseauSocial\Lib\Database\DatabaseConnection;
use ReseauSocial\Models\Post\Posts;

class Homepage
{
    public function execute()
    {
        $feed = new Posts();
        $feed->connection = new DatabaseConnection();
        $posts = $feed->getPosts();

        require 'templates/homepage.php';
    }
}
?>