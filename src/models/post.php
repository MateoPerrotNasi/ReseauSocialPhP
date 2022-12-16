<?php

namespace ReseauSocial\Models\Post;

require_once('src/lib/database.php');

use ReseauSocial\Lib\Database\DatabaseConnection;

class Post
{
    public string $content;
    public string $userName;
    public string $reactionYes;
    public string $reactionNo;
    public string $reactionLaugh;
    public string $reactionLove;
    public string $reactionSad;
    public string $identifier;
}

class Posts
{
    public DatabaseConnection $connection;

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT ID, Content, UserName FROM post WHERE ID = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();	
        $post = new Post();
        $post->identifier = $row['ID'];
        $post->content = $row['Content'];
        $post->userID = $row['UserName'];

        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT ID, Content, UserName FROM post"
        );
        $feed = [];
        while(($row = $statement->fetch())) {
            $post = new Post();
            $post->identifier = $row['ID'];
            $post->content = $row['Content'];
            $post->userName = $row['UserName'];
            $feed[] = $post;
        }
        $statement->execute();

        return $feed;
    }
    public function createPost(string $content, string $userName)
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO `post` (Content, UserName) VALUES (?, ?)"
        );
        $isAdded = $statement->execute([$content, $userName]);
        if ($isAdded >! 0) {
            throw new Exception("Le post n'a pas pu être ajouté");
        }
    }
    public function deletePost(string $identifier)
    {
        $statement = $this->connection->getConnection()->prepare(
            "DELETE FROM `post` WHERE ID = ?"
        );
        $isDeleted = $statement->execute([$identifier]);
        if ($isDeleted >! 0) {
            throw new Exception("Le post n'a pas pu être supprimé");
        }
    }
}
?>